<!-- Call the parameters to ddatabase -->
<?php include_once './settings/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- Call the parameters -->
<?php include_once './templates/head.html'; ?>

<body class = "d-flex flex-column min-vh-100">
    <!--Include the header  -->
    <?php include_once './templates/header.html'; ?>
    <!--Include the Nav bar everywhere  -->
    <?php include_once './templates/nav.html'; ?>

    <section>
        <?php
        // Condition show the good page in function what you want

        // If you search a movies you arrived here
        if (isset($_POST['search'])) {
            include './templates/search.php';
        }

        // If you want add a movie the list
        elseif (isset($_GET['add-movie'])) {
            include './templates/movies/_form_new.php';
        }

        // If you want check the list of movies
        elseif (isset($_GET["list-movies"]) and !isset($_GET['id'])) {
            include './templates/movies/list.php';
        }

        // If you click on the card movie, you arrived here
        elseif (isset($_GET['id']) && isset($_GET['show-movie'])) {
            include './templates/movies/show.php';
        }

        // If you want to delete the movie the traitement is here
        elseif (isset($_GET['list-movies']) && !empty($_POST['id-del'])) {
            // recover the ID
            $id = ($_POST['id-del']);
            // Prepare the request
            $delete = $connect->prepare("DELETE FROM movies WHERE id= ?");
            // Take the ID inject in request and delete the line
            $delete->execute(array($id));
            // return $delete->execute->fetchAll();
            // Message the delete agree
            print('<div class="alert alert-success" role="alert">');
            print('<h2 class="alert-heading text-center">Le film est effacé !</h2>');
            print('</div>');
        }

        // For edit the movie you are redirect
        elseif (isset($_GET['edit-movies']) && isset($_GET['id'])) {
            include './templates/movies/_form_edit.php';
        }

        // If you want check the list of actors
        elseif (isset($_GET["list-actors"]) and !isset($_GET['id']) and !isset($_POST['id-del-actors'])) {
            include './templates/actors/list_actors.php';
        }

        // If you want add a movie the list
        elseif (isset($_GET['add-actor'])) {
            include './templates/actors/_form_new.php';
        }

        // If you click on the card movie, you arrived here
        elseif (isset($_GET['id']) && isset($_GET['show-actor'])) {
            include './templates/actors/show_actor.php';
        }

        // If you want to delete the movie the traitement is here
        elseif (isset($_GET['list-actors']) && isset($_POST['id-del-actors'])) {
            // recover the ID
            $id = ($_POST['id-del-actors']);
            // Prepare the request
            $delete = $connect->prepare("DELETE FROM actors WHERE id= ?");
            $nameImage = $connect->prepare("SELECT image FROM actors WHERE id= ?");
            // Take the ID inject in request and delete the line
            $nameImage->execute(array($id));
            $nameImage = $nameImage->fetch();
            if(!empty($nameImage['image']))
            {
                $path="./uploads/actors/".$nameImage['image']; 
                unlink($path);
                $successImg = unlink($path);
            }
            $delete->execute(array($id));
            $success =$delete->execute(array($id)); 
           
            // Message the delete agree
            if($success && $successImg)
            {
                print('<div class="alert alert-success" role="alert">');
                print('<h2 class="alert-heading text-center">L\'acteur est éffacé! Correctement</h2>');
                print('</div>');
            }
        }

        elseif (isset($_GET['edit-actors']) && isset($_GET['id'])) {
            include './templates/actors/_form_edit.php';
        }
        

        // Else show the home page
        else {
            echo '<h1 class="h1 text-center">Bienvenue sur le listing des films Univers cinématographique Marvel </h1>';
        }

        ?>
    </section>

    <!--Include the bottom page footer  -->
    <?php include_once './templates/footer.html'; ?>

</body>

</html>