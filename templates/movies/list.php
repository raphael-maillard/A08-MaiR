<!-- list -->
<?php

$count = $connect->prepare("SELECT COUNT(*) AS row FROM movies");
$count->execute();


$sql = 'SELECT movies.id, movies.name, movies.image, phases.phase
        FROM phases
        JOIN movies ON phases.id = movies.id_phase
        ORDER BY release_date ASC';

$count= $count->fetchAll(PDO::FETCH_OBJ);
//Check line number
// print_r ("Nomre de ligne ".$count[0]->row."<br>");
//Init $row and $image
$row = $count[0]->row;
// echo $row;
$image=0;

if($image==0)
// Init container of gallery
{
echo '<div class="container mt-5 mb-5">';
    }

    echo '<div class="row col-sm-12 d-block text-center title">';
        echo ' <h1> Liste des films</h1><br>';
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
                                echo '<a class="thumbnail" href="index.php?id='.$item['id'].'">';
                                    echo ' <div><img class="img-responsive img-thumbnail" src="./uploads/'.$item['image'].'" alt = "Affiche du film '.$item['name'].'" ></div></a>';
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