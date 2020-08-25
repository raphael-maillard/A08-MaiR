<?php

// Init variable to skip error
$first_Name_Error = $last_Name_Error = $roleError = $dateError = $imageError = $first_name = $last_name = $role = $dob = $date = "";

if (!empty($_POST) ) {
    $first_name         = checkInput($_POST['first_name']);
    $last_name          = checkInput($_POST['last_name']);
    $dob                = checkInput($_POST['date']); 
    $role               = checkInput($_POST['role']);
    $image              = checkInput($_FILES['image']['name']);
    $imagePath          = './uploads/actors/' . basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    if(isset($_POST['movie_name'])) $movie = $_POST['movie_name'];   
    $isSuccess          = true;
    $isUploadSuccess    = false;

    if (empty($first_name)) {
        $first_Name_Error = '<div class="alert alert-warning" role="alert">
                             <p class="alert-heading">Veuillez saisir un Prénom</p>
                             </div>';
        $isSuccess = false;
    }
    if (empty($last_name)) {
        $last_Name_Error = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Veuillez saisir un Nom</p>
                            </div>';
        $isSuccess = false;
    }
    if (empty($dob)) {
        $dateError = '<div class="alert alert-warning" role="alert">
                         <p class="alert-heading">Veuillez saisir la date de naissance</p>
                         </div>';
        $isSuccess = false;
    }

    if (empty($role)) {
        $roleError = '<div class="alert alert-warning" role="alert">
                         <p class="alert-heading">Veuillez saisir le rôle joué</p>
                         </div>';
        $isSuccess = false;
    }

    if (empty($image)) {
        $imageError = '<div class="alert alert-warning" role="alert">
                      <p class="alert-heading">Insérer une image</p>
                      </div>';
        $isSuccess = false;
    }    
    else {
        // Adapt the parameter
        $isUploadSuccess = true;

        // Check the extension file
        if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $imageError = '<div class="alert alert-warning" role="alert">
                          <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                          </div>';
            $isUploadSuccess = false;
        }

        // Check if the file don't exist
        if (file_exists($imagePath)) {
            $imageError = '<div class="alert alert-warning" role="alert">
                          <p class="alert-heading">Le fichier existe déjà</p>
                          </div>';
            $isUploadSuccess = false;
        }

        // Check if the file respect the maximum size
        if ($_FILES['image']["size"] > 500000) {
            $imageError = '<div class="alert alert-warning" role="alert">
                           <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                           </div>';
            $isUploadSuccess = false;
        }
        // If not problem check if the move is okay
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

    // keep last id and add+1 // next id to use bdd

    if ($isSuccess == true && $isUploadSuccess == true) 
    {
    $request = $connect->prepare("INSERT INTO `actors` (`last_name`, `first_name`, `dob`, `created_at`, image) 
                            VALUES ( :last_name, :first_name, :date , CURRENT_TIMESTAMP, :image)"); 
    $sql = $request->execute(array(
                            "last_name" => $last_name,
                            "first_name" => $first_name,
                            "date" => $dob,
                            "image" => $image));

        $id = $connect->lastInsertId();
        // lastid_insert
            if ($sql and !empty($_POST['movie_name']) )
        {
            foreach ($_POST['movie_name'] as $movie)
            {
                $sth = $connect->prepare("INSERT INTO `actors_movies` (`id_actors`, `id_movies`, `role`) VALUES (:id, :movie, :role)");
                $sth->execute(array
                ( 
                                "id"=>$id,
                                "movie"=>$movie,
                                "role"=>$role
                ));
            }
            print('<div class="alert alert-success" role="alert">');
            print('    <h4 class="alert-heading text-center">Acteur ajouté avec succès !</h4>');
            print('</div>');
        }
        elseif ($sql and empty($_POST['movie_name']))
        {
            print('<div class="alert alert-success" role="alert">');
            print('    <h4 class="alert-heading text-center">Acteur ajouté avec succès ! Mais aucun rôle enregistré !</h4>');
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
}

// Function to check the data in the form
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
        <h1><strong>Ajouter une actrice ou un acteur </strong></h1>
        <br>
        <!-- Start field to add information relative of new movie -->
        <form class="form col-sm-12 col-lg-12" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">Prénom :</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom de la personne" value="<?php print $first_name; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $first_Name_Error; ?></span>
            </div>
            <div class="form-group">
                <label for="last_name">Nom :</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom de la personne" value="<?php print $last_name; ?>">
                <!-- If we detect problem we send a message adapt-->
                <span class="help-inline"><?php echo $last_Name_Error; ?></span>
            </div>
            <div class="form-group">
                <label for="date">Date de naissance :</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>">
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
                <input type="text" class="form-control" id="role" name="role" placeholder="indiquer le rôle " value="<?php echo $role; ?>"></input>
                <span class="help-inline"><?php echo $roleError; ?></span>
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