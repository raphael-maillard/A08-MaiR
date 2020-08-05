<!-- form new -->


<?php

$nameError = $directorError = $durationError = $dateError = $imageError = $name = $director = $duration = $date = "";

if (!empty($_POST)) {
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


    if (empty($name)) {
        $nameError = '<div class="alert alert-warning" role="alert">
                     <p class="alert-heading">Veuillez saisir un titre de film</p>
                     </div>';
        $isSuccess = false;
    }

    if (empty($director)) {
        $directorError = '<div class="alert alert-warning" role="alert">
                         <p class="alert-heading">Veuillez remplir le champ</p>
                         </div>';
        $isSuccess = false;
    }
    if (empty($duration)) {
        $durationError = '<div class="alert alert-warning" role="alert">
                         <p class="alert-heading">Veuillez saisir une durée</p>
                         </div>';
        $isSuccess = false;
    }
    if (empty($date)) {
        $dateError = '<div class="alert alert-warning" role="alert">
                     <p class="alert-heading">Entré la date de sortie du film</p>
                     </div>';
        $dateError = '<div class="alert alert-warning" role="alert">
                     <p class="alert-heading">Insérer une image</p>
                     </div>';
        $isSuccess = false;
    }
    if (empty($image)) {
        $imageError = '<div class="alert alert-warning" role="alert">
                      <p class="alert-heading">Insérer une image</p>
                      </div>';
        $isSuccess = false;
    } 
    else 
    {
        $isUploadSuccess=true;
        
        if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $imageError = '<div class="alert alert-warning" role="alert">
                          <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                          </div>';
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError ='<div class="alert alert-warning" role="alert">
                          <p class="alert-heading">Le fichier existe déjà</p>
                          </div>';
            $isUploadSuccess = false;
        }
        if ($_FILES['image']["size"] > 500000) {
            $imageError = '<div class="alert alert-warning" role="alert">
                           <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                           </div>';
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Il y a eu une erreur lors de l\'upload</p>
                            </div>';
                $isUploadSuccess = false;
            }
        }
    }
    if ($isSuccess == true && $isUploadSuccess == true) {
        $query = $connect->prepare("INSERT INTO movies ( name, release_date, duration, director, image, id_phase, created_at) 
                                    VALUES ( ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $query->execute(array($name, $date, $duration, $director, $image, $phase));
        print('<div class="alert alert-success" role="alert">');
        print('    <h4 class="alert-heading text-center">Film ajouté avec succès !</h4>');
        print('</div>');
    } 
    else 
    {
        print('<div class="alert alert-danger" role="alert">');
        print('    <h4 class="alert-heading text-center">Un problème est survenue, le film n\'est pas enregistré !</h4>');
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

?>

<div class="container">
    <div class="row">
        <h1><strong>Ajouter un Film </strong></h1>
        <br>
        <form class="form col-sm-12 col-lg-12" action="" method="POST" enctype="multipart/form-data">
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
                <label class="custom-file-label" for="customFile">Insérer l'affiche du film</label>
                <span class="help-inline"><?php echo $imageError; ?></span>
            </div>
            <br><br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>
                    Ajouter</button>
                <a class="btn btn-primary" href="index.php"> <span class="glyphicon glyphicon-arrow-left"></span>
                    Retour</a>
            </div>
        </form>
    </div>
</div>