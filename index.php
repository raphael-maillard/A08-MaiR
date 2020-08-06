<?php include_once './settings/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

    <?php include_once './templates/head.html'; ?>

    <body>

        <?php include_once './templates/header.html'; ?>

        <?php include_once './templates/nav.html'; ?>

        <section>
            <?php
            
                if (isset($_GET["list"]) and !isset($_GET['id']))
                {
                    include './templates/movies/list.php';
                }
                elseif (isset($_GET['id']) && isset($_GET['show-movie']))
                {
                    include './templates/movies/show.php';
                }
                elseif (isset($_POST['search']))
                {
                    include './templates/movies/search.php';
                }
                elseif(isset($_GET['add']))
                {
                    include './templates/movies/_form_new.php';
                } 
                elseif (isset($_GET['list']) && !empty($_POST['id-del'])) 
                {
                    $id = ($_POST['id-del']);
                    $delete = $connect->prepare("DELETE FROM movies WHERE id= ?");
                    $delete->execute(array($id));
                    print('<div class="alert alert-success" role="alert">');
                    print('<h2 class="alert-heading text-center">Le film est effacé !</h2>');
                    print('</div>');
                }
                elseif(isset($_GET['edit-movies']) && isset($_GET['id']))
                {
                    include './templates/movies/_form_edit.php';
                }
                else
                {
                    echo '<h1 class="h1 text-center">Bienvenue sur le listing des films Univers cinématographique Marvel </h1>';
                    
                }
            ?>
        </section>

        <?php include_once './templates/footer.html'; ?>

    </body>

</html>
