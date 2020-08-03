<!-- search -->
<?php 
    if(!empty($_POST['search']))
    {
        $keyword = $_POST['search'];

        $search = " SELECT movies.id, movies.name, movies.id_image, movies.director, movies.release_date, movies.duration ,images.image, images.alt, phases.phase
                    FROM images 
                    JOIN movies ON images.id = movies.id_image
                    JOIN phases ON phases.id = movies.id_phase
                    WHERE movies.name LIKE \"%$keyword%\"";

        $result = $connect->query($search);
        $result=$result->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($result);
        if(empty($result))
        {
            echo'<h1>Aucun résultat trouvé</h1>';
        }
        else

        echo '                  <h1><strong>Résultat de la recherche </strong></h1>';
        echo '        <div class="container">';

        $image=0;
        if($image %3 == 0)
        {
            echo ' <div class="row">';
        }

        foreach ($result as $result){

        echo ' <div class="col-lg-4 col-md-12 mb-4">';
        echo ' <div class="p-4 bg-white">';
            echo ' <div class="d-flex flex-column">';
                echo '<a class="thumbnail" href="index.php?id='.$result['id'].'">';
                    echo ' <div><img class="img-responsive img-thumbnail" src="../A08-MaiR/uploads/'.$result['image'].'" alt = "'.$result['alt'].'" ></div></a>';
                $image++;
                echo ' <div class="d-flex flex-column">';
                    echo ' <div class="d-flex flex-row justify-content-between align-items-center">';
                        echo ' <h5>'.$result['name'].'</h5>';
                        echo ' </div>';
                echo ' </div>';
            echo ' </div>';
        echo ' </div>';
    echo ' </div>';
        }
        if( $image %3 == 0)
        {
            echo ' </div>';
            $image=0;
        }
        echo ' </div>';

    }
    







?> 