<!-- list -->
<?php

// $statement = $connect->query('SELECT movies.id, movies.name, movies.id_image,images.image, images.alt 
//                               FROM images 
//                               JOIN movies ON images.id = movies.id_image ');

// $statement->fetchAll(PDO::FETCH_OBJ);

// print_r($statement);


$count = $connect->prepare(" SELECT COUNT(*) AS row FROM movies ");
$count->execute();

$sql = 'SELECT movies.id, movies.name, movies.id_image,images.image, images.alt 
                              FROM images 
                              JOIN movies ON images.id = movies.id_image ';

$count= $count->fetchAll(PDO::FETCH_OBJ);
//Check line number
print_r ("Nomre de ligne ".$count[0]->row."<br>");
//Init $row and $image
$row = $count[0]->row;
$image=0;

if($image==0)
// Init container of gallery
{
echo '<div class="container mt-5 mb-5">';
    }

    echo '<div class="row col-sm-12 d-block text-center title">';
        echo ' <h1> La gallerie de la boite à fil</h1><br>';
        echo '</div>';

    // init traiment for items

        if($image %3 == 0)
        {
        echo ' <div class="row">';
            }
            foreach ($connect->query($sql) as $item)       
            {
                    echo ' <div class="col-lg-4 col-md-12 mb-4">';
                        echo ' <div class="p-4 bg-white">';
                            echo ' <div class="d-flex flex-column">';
                                echo '<a class="thumbnail" href="../A08-MaiR/uploads/'.$item['image'].'" data-size="1600x1067">';
                                    echo ' <div><img class="img-responsive img-thumbnail" src="../A08-MaiR/uploads/'.$item['image'].'" alt = "'.$item['alt'].'" ></div></a>';
                                $image++;
                                echo ' <div class="d-flex flex-column">';
                                    echo ' <div class="d-flex flex-row justify-content-between align-items-center">';
                                        echo ' <h5>'.$item['name'].'</h5>';
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

    if($row == $image){echo '</div>';}


?>