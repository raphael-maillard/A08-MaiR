<?php 

// Init variable to skip error
$first_Name_Error = $last_Name_Error = $roleError = $dateError = $imageError = $first_name = $last_name = $role = $dob = $date = "";

if (!empty($_GET['id'])) {

    $id = checkInput($_GET['id']);

    if (!empty($_POST) ) {
        $first_name         = checkInput($_POST['first_name']);
        $last_name          = checkInput($_POST['last_name']);
        $dob                = checkInput($_POST['dob']); 
        $role               = checkInput($_POST['role']);
        $image              = checkInput($_FILES['image']['name']);
        $imagePath          = './uploads/actors/' . basename($image);
        $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
        $movie              = $_POST['movie_name'];
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

        // If don't change the image, recovery currently image
        if (empty($_FILES['image']['name'] && $isUploadSuccess == false)) {
            $statement = $connect->prepare('SELECT image  FROM movies WHERE movies.id= ?');
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['image'];
            $isUploadSuccess = true;
        }
        // If all signals are green let'sgo start the update proccess
        if ($isSuccess == true && $isUploadSuccess == true) 
        {
            // UPDATE `actors` SET `modify_at` = UTC_TIMESTAMP() WHERE `actors`.`id` = 2;
            //Init the variable 
            $update = $connect->prepare("UPDATE actors 
                                        SET last_name=:lastname, first_name=:first_name, dob=:dob, image=:image, modified_at=CURRENT_TIMESTAMP 
                                        WHERE movies.id=$id");
            $update->execute(array(
                "last_name" => $last_name,
                "first_name" => $first_name,
                "dob" => $dob,
                "image" => $image
            ));
            // Check if update the table actor_movie
            if (!empty($_POST['movie_name']) && !empty($_POST['role']) )
            {
                foreach ($_POST['movie_name'] as $movie)
                {
                    $sth = $connect->prepare("UPDATE actors_movies 
                                            SET id_movies=:movie, role=:role 
                                            WHERE id_actors=:id");
                    $sth->execute(array
                    ( 
                                    "id"=>$id,
                                    "movie"=>$movie,
                                    "role"=>$role
                    ));
                }
            }
            else 
            {
                print('<div class="alert alert-warning" role="alert">');
                print('    <h4 class="alert-heading text-center">Personne modifiée avec succès ! Mais le(s) rôle(s) et le(s) film(s) joué(s) ne sont pas modifiés</h4>');
                print('</div>');
            }
        } 
        else 
        {
            print('<div class="alert alert-danger" role="alert">');
            print('    <h4 class="alert-heading text-center">Un problème est survenue, le fiche n\'est pas modifiée !</h4>');
            print('</div>');
            echo $imageError;
        }
    }

    // Prepare request sql 
    $statement = $connect->prepare('SELECT actors.id, actors.last_name, actors.first_name, actors.image, actors.dob, actors.image, actors.created_at, actors_movies.role, movies.name
                                    FROM actors
                                    JOIN actors_movies ON actors.id = actors_movies.id_actors
                                    JOIN movies ON actors_movies.id_movies = movies.id
                                    WHERE actors.id= ?');

    // Execute the request
    $statement->execute(array($id));
    $item = $statement->fetch(PDO::FETCH_ASSOC);

    // Define the variables to complete the form
    $last_name= $item['last_name'];
    $first_name= $item['first_name'];
    $dob= $item['dob'];
    // $movie= $item['name'];
    $role= $item['role'];
    $image= $item['image'];

    var_dump($item);
    

    // Condition if the actor haven't role in the movies
    if($item==false)
    {
    $statement = $connect->prepare('SELECT actors.id, actors.last_name, actors.first_name, actors.image, actors.last_name, actors.dob, actors.image, created_at
        FROM actors
        WHERE actors.id= ?');

    // Execute the request
    $statement->execute(array($id));
    $item = $statement->fetch(PDO::FETCH_ASSOC);

    $last_name= $item['last_name'];
    $first_name= $item['first_name'];
    $dob= $item['dob'];
    $image= $item['image'];
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
        <h1><strong>Modifier la fiche de <?php echo "$last_name $first_name";?></strong></h1>
        <br>
        <!-- Start field to add information relative of new movie -->
        <form class="form col-sm-12 col-lg-8" action="" method="POST" enctype="multipart/form-data">
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
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $dob; ?>">
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
        </form>
    </div>
</div>
            