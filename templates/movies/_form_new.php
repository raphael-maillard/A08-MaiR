<!-- form new -->
<?php

// Init variable to skip error
$nameError = $directorError = $durationError = $dateError = $imageError = $name = $director = $duration = $date = "";

// If post not empty start the processing
if (!empty($_POST)) {

    $manager = new Manager($connect);
    $movie = new Movie;
    $imageObject = new Image;
    
    $answer = $manager->checkMovie($_POST);

    if ($answer)
    {
        $movie->hydrate($_POST);
        $imageObject->checkImage($_FILES);
        
        if(!empty($movie))
        {
            $manager->create($movie, $imageObject);
        }
    }

    $imageError = null !== $manager->getErrorImage() ? $imageError = $manager->getErrorImage() :"" ;
    $error = null !== $manager->getErrorData() ? $error = $manager->getErrorData() :"" ;

    
    $nameError = isset($error['nameError']) ? $nameError=$error['nameError']: "";
    $directorError = isset($error['directorError']) ? $directorError=$error['directorError']: "";
    $durationError = isset($error['durationError']) ? $durationError=$error['durationError']: "";
    $dateError = isset($error['dateError']) ? $dateError=$error['dateError']: "";

}

?>

<div class="container">
    <div class="row">
        <h1><strong>Ajouter un Film </strong></h1>
        <br>
        <!-- Start field to add information relative of new movie -->
        <form class="form col-sm-12 col-lg-12" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nom du film:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom du film" value="<?php print $name; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Réalisateur:</label>
                <input type="text" class="form-control" id="director" name="director" placeholder="Réalisateur" value="<?php echo $director; ?>"></input>
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $directorError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Durée:</label>
                <input type="time" class="form-control" id="time" name="duration" value="<?php echo $duration; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $durationError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Date de sortie:</label>
                <input type="date" class="form-control" id="time" name="date" value="<?php echo $date; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $dateError; ?></span>
            </div>
            <div class="form-group">
                <label for="category">Phase:</label>
                <select class="custom-select" name="phase" id="category">
                    <?php
                    // foreach to show the select phase and recovery the id to send the data
                    foreach ($connect->query('SELECT * FROM phases') as $row) {
                        print('<option value="' . $row['id'] . '">' . $row['phase'] . '</option>');
                    }
                    ?>
                </select>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="image">
                <label class="custom-file-label" for="customFile">Insérer l'affiche du film</label>
                <!-- If we detect problem we send a message adapt-->
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
        <!-- End field to add information -->
    </div>
</div>