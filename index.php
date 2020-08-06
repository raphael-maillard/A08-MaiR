<!-- Call the parameters to ddatabase -->
<?php include_once './settings/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- Call the parameters -->
<?php include_once './templates/head.html'; ?>

<body>
    <!--Include the header  -->
    <?php include_once './templates/header.html'; ?>
    <!--Include the Nav bar everywhere  -->
    <?php include_once './templates/nav.html'; ?>

    <section>
        <?php
        // Condition show the good page in function what I want
        if (isset($_GET["list"]) and !isset($_GET['id'])) {
            include './templates/movies/list.php';
        } elseif (isset($_GET['id']) && isset($_GET['show-movie'])) {
            include './templates/movies/show.php';
        } elseif (isset($_POST['search'])) {
            include './templates/movies/search.php';
        } elseif (isset($_GET['add'])) {
            include './templates/movies/_form_new.php';
        } elseif (isset($_GET['list']) && !empty($_POST['id-del'])) {
            // recover the ID
            $id = ($_POST['id-del']);
            // Prepare the request
            $delete = $connect->prepare("DELETE FROM movies WHERE id= ?");
            // Take the ID inject in request and delete the line
            $delete->execute(array($id));
            return $delete->execute->fetchAll();
            // Message the delete agree
            print('<div class="alert alert-success" role="alert">');
            print('<h2 class="alert-heading text-center">Le film est effacé !</h2>');
            print('</div>');
        } elseif (isset($_GET['edit-movies']) && isset($_GET['id'])) {
            include './templates/movies/_form_edit.php';
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