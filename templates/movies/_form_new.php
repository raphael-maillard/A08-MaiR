<!-- form new -->


<?php

$nameError = $directorError = $durationError = $dateError = $name = $director = $duration = $date = "";

if(!empty($_POST))
{
    $name               = checkInput($_POST['name']);
    $director           = checkInput($_POST['director']);
    $duration           = checkInput($_POST['duration']);
    $date               = checkInput($_POST['date']);
    $phase              = checkInput($_POST['phase']);
    $image              = checkInput($_FILES['image']['name']);
    $imagePath          = './uploads/' .basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

    echo $duration;

    if (empty($name)) {
        $nameError = "Ce champ n'est pas être vide.";
        $isSuccess = false;
    }

    if (empty($director)) {
        $directorError = "Ce champ n'est pas être vide.";
        $isSuccess = false;
    }
    if (empty($duration)) {
        $durationError = "Ce champ n'est pas être vide.";
        $isSuccess = false;
    }
    if (empty($data)) {
        $descriptionError = "Ce champ n'est pas être vide.";
        $isSuccess = false;
    }
    if (empty($image)) {
        $imageError = "Insérer une image";
        $isSuccess = false;
    } else {
        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $imageError = "Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        if ($_FILES['image']["size"] > 500000) {
            $imageError = "Le fichier ne doit pas dépasser 500KB";
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }
    if ($isSuccess && $isUploadSuccess) {
        echo'ajout réussi';
        // $query = $connect->prepare("INSERT INTO movies (name, director, duration, date, image), phases.id from phases values (?, ?, ?, ?, ?)");
        $query = $connect->prepare("INSERT INTO movies ( name, release_date, duration, director, image, id_phase, created_at) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP);");
        $query->execute(array($name, $date, $duration, $director, $image, $phase));
        $connect = null;
        var_dump($query);
        // header("Location:./index.php");
    }

}
function checkInput ($data)
{
    $data= trim($data);
    $data= stripslashes($data);
    $data= htmlspecialchars($data);
    return $data; 
}



?> 

    <div class="container">
        <div class="row">
            <h1><strong>Ajouter un Film </strong></h1> 
            <br>
            <form class="form col-sm-12 col-lg-12" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom du film:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom du film"
                        value="<?php print $name; ?>">
                    <span class="help-inline"><? echo $nameError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Réalisateur:</label>
                    <input type="text" class="form-control" id="director" name="director"
                        placeholder="Réalisateur" value="<?php echo $director; ?>"></input>
                    <span class="help-inline"><? echo $directorError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Durée:</label>
                    <input type="time" class="form-control" id="time" name="duration"
                        value="<?php echo $duration; ?>">
                    <span class="help-inline"><? echo $durationError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Date de sortie:</label>
                    <input type="date" class="form-control" id="time" name="date"
                        value="<?php echo $date; ?>">
                    <span class="help-inline"><? echo $dateError; ?></span>
                </div>
                <div class="form-group">
                    <label for="category">Phase:</label>
                    <select class="custom-select" name="phase" id="category">
                        <?php                         
                            foreach($connect->query('SELECT * FROM phases') as $row)
                            {
                                print ('<option value="'.$row['id'].'">'.$row['phase'].'</option>');
                            }
                            $connect=null;
                        ?>
                    </select>
                    <span class="help-inline">
                        <? echo $phaseError; ?></span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="image">
                    <label class="custom-file-label" for="customFile">Insérer l'affiche du film</label>
                </div>

                <br>
                <div class="form-actions ">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>
                        Ajouter</button>
                    <a class="btn btn-primary" href="index.php"> <span class="glyphicon glyphicon-arrow-left"></span>
                        Retour</a>
                </div>
            </form>