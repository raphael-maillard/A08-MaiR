<?php include_once './settings/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

    <?php include_once './templates/head.html'; ?>

    <body>

        <?php include_once './templates/header.html'; ?>

        <?php include_once './templates/nav.html'; ?>

        <section>
            <?php


if (isset($_GET["list"]) and ($_SERVER['REQUEST_METHOD'] != 'POST'))
{
    include './templates/movies/list.php';
}
elseif (!empty($_GET['id']) && empty($_POST))
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
else{

    echo '<h1 class="display-1 text-center">Bienvenue sur le listing des films Univers cinématographique Marvel </h1>';
}


            /**
             * Conditions with:
             *      - if/else
             *          or
             *      - switch/case
             */

            /** 
             * if ...
             *      include_once './templates/movies/_form_new.php';
             * 
             * elseif ...
             *      include_once './templates/movies/_form_edit.php';
             * 
             * elseif ...
             *      ...
             * 
             * ...
             * 
             * else ...
             *      - welcome message
             *      - button for add new movie
             */

            ?>
        </section>

        <?php include_once './templates/footer.html'; ?>

    </body>

</html>
