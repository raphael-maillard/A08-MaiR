<?php

// Init variable to skip error
$nameError = $directorError = $durationError = $dateError = $imageError = $first_name = $last_name = $director = $duration = $date = "";

// INSERT INTO `actors` (`id`, `last_name`, `first_name`, `dob`, `image`, `created_at`, `modify_at`) VALUES (NULL, 'Downey', 'Robert (Jr.)', '1965-04-04', NULL, CURRENT_TIMESTAMP, NULL); 


var_dump($_POST);


?>


<div class="container">
    <div class="row">
        <h1><strong>Ajouter une actrice ou un acteur </strong></h1>
        <br>
        <!-- Start field to add information relative of new movie -->
        <form class="form col-sm-12 col-lg-12" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">Prénom :</label>
                <input type="text" class="form-control" id="name" name="first_name" placeholder="Prénom de la personne" value="<?php print $first_name; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label for="last_name">Nom :</label>
                <input type="text" class="form-control" id="name" name="last_name" placeholder="Nom de la personne" value="<?php print $last_name; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label for="date">Date de naissance :</label>
                <input type="date" class="form-control" id="time" name="date" value="<?php echo $date; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $dateError; ?></span>
            </div>
            <div class="form-group">
                <label for="movie_name">A joué dans le film : ( Utilisé la touche Ctrl pour sélectionner plusieurs films )</label>
                <select class="custom-select" name="movie_name[]" id="movie_name" multiple class="chosen-select">
                    <?php
                    // foreach to show the select phase and recovery the id to send the data
                    foreach ($connect->query('SELECT movies.id, movies.name FROM movies') as $row) {
                        print('<option value="' . $row['id'] . '">' . $row['name'] . '</option>');

                    }
                    ?>
                </select>

                <label for="category">Dans le role de :</label>
                <input type="text" class="form-control" id="role" name="role" placeholder="indiquer le rôle " value="<?php echo $director; ?>"></input>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="image">
                <label class="custom-file-label" for="customFile">Insérer une photo de cette personne</label>
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
            <br>
        </form>
        <!-- End field to add information -->
    </div>
</div>