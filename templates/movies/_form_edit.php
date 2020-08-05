<!-- form edit -->
<?php

$nameError = $directorError = $durationError = $dateError = $imageError = "";

if (!empty($_GET['id'])) 
{
    $id = checkInput($_GET['id']);
}

if (!empty($_POST)) 
{
    $name               = checkInput($_POST['name']);
    $director           = checkInput($_POST['director']);
    $duration           = checkInput($_POST['duration']);
    $date               = checkInput($_POST['date']);
    $phase              = checkInput($_POST['phase']);
    $image              = checkInput($_FILES['image']['name']);
    $imagePath          = './uploads/' . basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

    if (empty($name)) 
    {
        $nameError = '<div class="alert alert-warning" role="alert">
                     <p class="alert-heading">Veuillez saisir un titre de film</p>
                     </div>';
        $isSuccess = false;
    }
    if (empty($director)) 
    {
        $directorError = '<div class="alert alert-warning" role="alert">
                         <p class="alert-heading">Veuillez remplir le champ</p>
                         </div>';
        $isSuccess = false;
    }
    if (empty($duration)) 
    {
        $durationError = '<div class="alert alert-warning" role="alert">
                         <p class="alert-heading">Veuillez saisir une durée</p>
                         </div>';
        $isSuccess = false;
    }
    if (empty($date)) 
    {
        $dateError = '<div class="alert alert-warning" role="alert">
                     <p class="alert-heading">Entré la date de sortie du film</p>
                     </div>';
        $isSuccess = false;
    }

    if(!empty($_FILES['image']['name']))
    {
        $isUploadSuccess=true;

        if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") 
        {
            $imageError = '<div class="alert alert-warning" role="alert">
                        <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                        </div>';
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) 
        {
            $imageError ='<div class="alert alert-warning" role="alert">
                        <p class="alert-heading">Le fichier existe déjà</p>
                        </div>';
            $isUploadSuccess = false;
        }
        if ($_FILES['image']["size"] > 500000) 
        {
            $imageError = '<div class="alert alert-warning" role="alert">
                        <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                        </div>';
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) 
        {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
            {
                $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Il y a eu une erreur lors de l\'upload</p>
                            </div>';
                $isUploadSuccess = false;                
            }
        }
    }
    if(empty($_FILES['image']['name']))
    {
        $statement = $connect->prepare('SELECT image  FROM movies WHERE movies.id= ?');

        $statement->execute(array($id));
        $item = $statement->fetch();
        $image= $item['image'];
        $isUploadSuccess=true;
    }
    if ($isSuccess ==true && $isUploadSuccess ==true) 
        {
            $query = $connect->prepare("UPDATE movies 
                                        SET name=:name, release_date=:date, duration=:duration, director=:director,image=:image, id_phase=:phase, modified_at=CURRENT_TIMESTAMP 
                                        WHERE movies.id=$id");
            $query->execute(array(
                "name" => $name,
                "date" =>$date, 
                "duration" =>$duration, 
                "director" =>$director,
                "image" =>$image, 
                "phase" =>$phase));
            print('<div class="alert alert-success" role="alert">');
            print('    <h4 class="alert-heading text-center">Film modifié avec succès !</h4>');
            print('</div>');
        } 
        else 
        {
            print "je suis pas dans la requete";
            print('<div class="alert alert-danger" role="alert">');
            print('    <h4 class="alert-heading text-center">Un problème est survenue, le film n\'est pas modifié !</h4>');
            print('</div>');
            echo $imageError;
        }
}
function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = $director = $duration = $date = "";

$statement = $connect->prepare('SELECT movies.id, movies.name, movies.director, movies.release_date, movies.duration ,movies.image, phases.phase
                                FROM phases 
                                JOIN movies ON phases.id = movies.id_phase
                                WHERE movies.id= ?');

$statement->execute(array($id));
$item = $statement->fetch();

$name=$item['name'];
$director=$item['director'];
$duration=$item['duration'];
$date=$item['release_date'];
$phase=$item['phase'];
$image=$item['image'];

$item['release_date'] = date("d-m-Y", strtotime($item['release_date']));

?>

<div class="container">
    <div class="row">
        <form class="form col-sm-12 col-lg-6" action="" method="POST" enctype="multipart/form-data">
            <h1><strong>Modifier un Film </strong></h1>
            <br>
            <div class="form-group">
                <label for="name">Nom du film:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom du film" value="<?php print $name; ?>">
                <span class="help-inline"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Réalisateur:</label>
                <input type="text" class="form-control" id="director" name="director" placeholder="Réalisateur" value="<?php echo $director; ?>"></input>
                <span class="help-inline"><?php echo $directorError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Durée:</label>
                <input type="time" class="form-control" id="time" name="duration" value="<?php echo $duration; ?>">
                <span class="help-inline"><?php echo $durationError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Date de sortie:</label>
                <input type="date" class="form-control" id="time" name="date" value="<?php echo $date; ?>">
                <span class="help-inline"><?php echo $dateError; ?></span>
            </div>
            <div class="form-group">
                <label for="category">Phase:</label>
                <select class="custom-select" name="phase" id="category">
                    <?php
                    foreach ($connect->query('SELECT * FROM phases') as $row) {
                        print('<option value="' . $row['id'] . '">' . $row['phase'] . '</option>');
                    }
                    $connect = null;
                    ?>
                </select>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="image">
                <label class="custom-file-label" for="customFile"></label>
                <span class="help-inline"><?php echo $imageError; ?></span>
            </div>
            <br><br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>
                    Modifier</button>
                <a class="btn btn-primary" href="index.php?list"> <span class="glyphicon glyphicon-arrow-left"></span>
                    Retour</a>
            </div>
        </form>

        <div class="col-sm-3">
            <h1><strong>Fiche du film</strong></h1>
            <br>
            <form>
                <div class="form-group">
                    <label>Nom:</label><?php echo ' ' . $item['name'] ?>
                </div>
                <div class="form-group">
                    <label>Date de sortie:</label><?php echo ' ' . $item['release_date'] ?>
                </div>
                <div class="form-group">
                    <label>Durée:</label><?php echo ' ' . $item['duration'] ?>
                </div>
                <div class="form-group">
                    <label>Réalisateur:</label><?php echo ' ' . $item['director'] ?>
                </div>
                <div class="form-group">
                    <label>Phase:</label><?php echo ' ' . $item['phase'] ?>
                </div>
                <div class="form-group">
                    <label>Image:</label><?php echo ' ' . $item['image'] ?>
                </div>

            </form>

        </div>
        <div class="col-sm-3">
            <div class="thumbnail">
                <div class="d-flex flex-column">
                    <div><img class="img-fluid img-responsive" src="<?php echo ' ../A08-MaiR/uploads/' . $item['image'] . '" alt="Affiche du film ' . $item['name'] ?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>