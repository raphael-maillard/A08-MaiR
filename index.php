<?php include_once './settings/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

    <?php include_once './templates/head.html'; ?>

    <body>

        <?php include_once './templates/header.html'; ?>

        <?php include_once './templates/nav.html'; ?>

        <section>
            <?php


if(!empty($_GET)){


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
