<!-- list -->
<?php

// Init the variable to count howmany line(s)
$count = $connect->prepare("SELECT COUNT(*) AS row FROM movies");

// Exec the request
$count->execute();

// define variable with the request SQL
$sql = 'SELECT movies.id, movies.name, movies.image, phases.phase
        FROM phases
        JOIN movies ON phases.id = movies.id_phase
        ORDER BY release_date ASC';

$count= $count->fetchAll(PDO::FETCH_OBJ);
//Check line number

//Init $row and $image
$row = $count[0]->row;
$image=0;

// When you draw the div
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
            // make the request and read it
            foreach ($connect->query($sql) as $item)       
            {
                // At  everu loop in the table print that with the informations
                echo ' <div class="col-lg-4 col-md-6 col-xs-12 mb-4">';
                    echo ' <div class="p-4 bg-white">';
                        echo ' <div class="d-flex flex-column">';
                            echo '<a class="thumbnail" href="index.php?show-movie&id='.$item['id'].'">';
                                echo ' <div><img class="img-responsive img-thumbnail" src="./uploads/'.$item['image'].'" alt = "Affiche du film '.$item['name'].'" ></div></a>';
                                
                                // increment image
                                $image++;
                                
                            echo ' <div class="d-flex flex-column ">';
                                echo ' <div class="d-flex flex-row justify-content-between">';
                                    echo ' <h5>'.$item['name'].'</h5>';
                                    echo ' </div>';
                            echo ' </div>';
                        echo ' </div>';
                    echo ' </div>';
                echo ' </div>';
                // End of the loop
            }

            // when you close the div and reinitialise the variable image
            if( $image %3 == 0)
            {
                echo ' </div>';
                $image=0;
            }

    // When readout close the container
    if($row == $image)
    {
        echo '</div>';
    }

?>