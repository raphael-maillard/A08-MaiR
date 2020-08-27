<!-- search -->
<?php

//  check if search is not empty
if(!empty($_POST['search']))
{
    // Recovery the variable search in global POST
    $keyword = $_POST['search'];

    // innit variable with  the request SQL, with the variable keyword keep on the top and order by newest
    $search = " SELECT movies.id, movies.name, movies.director, movies.release_date, movies.duration ,movies.image, phases.phase
                FROM phases 
                JOIN movies ON phases.id = movies.id_phase
                WHERE movies.name LIKE \"%$keyword%\"
                ORDER BY release_date ASC";
    // prepare the request
    $result = $connect->prepare($search);
    // execute the requestion
    $result->execute();
    $result=$result->fetchAll(PDO::FETCH_ASSOC);
}

    // Check if variable is empty or not
    //  IF he empty write on screen 
    if(empty($result))
    {
        echo'<h1 class="text-center">Aucun film trouvé</h1>';
    }
    // So do that
    else
    {
        echo '<h1 class="text-center"><strong>Résultat de la recherche </strong></h1>';
        echo '<div class="container">';

        // Init variable image to show the div at the good moment
        $image=0;

        // every 3 images print that
        if($image %3 == 0)
        {
            echo ' <div class="row">';
        }
        // Print the data
        foreach ($result as $result)
        {
            echo ' <div class="col-lg-4 col-md-12 mb-4">';
                echo ' <div class="p-4 bg-white">';
                    echo ' <div class="d-flex flex-column">';
                        echo '<a class="thumbnail" href="index.php?show-movie&id='.$result['id'].'">';
                        echo ' <div><img class="img-responsive img-thumbnail" src="../A08-MaiR/uploads/'.$result['image'].'" alt = "Affiche du film'.$result['name'].'" ></div></a>';
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
        // every 3 images print that
        if( $image %3 == 0)
        {
            echo ' </div>';
            $image=0;
        }
        echo ' </div>';

        
    }

    if(!empty($_POST['search']))
{
    // Recovery the variable search in global POST

    // innit variable with  the request SQL, with the variable keyword keep on the top and order by newest
    $searchActors = " SELECT actors.id, actors.first_name, actors.image, actors.last_name, actors.dob, actors.image
                FROM actors
                WHERE actors.first_name LIKE \"%$keyword%\"
                OR actors.last_name LIKE \"%$keyword%\"
                ORDER BY actors.last_name ASC";
    // prepare the request
    $result = $connect->prepare($searchActors);
    // execute the requestion
    $result->execute();
    $result=$result->fetchAll(PDO::FETCH_ASSOC);
}

    // 2nd part for the search in the actors part
    // Check if variable is empty or not
    //  IF he empty write on screen 
    if(empty($result))
    {
        echo'<h1 class="text-center">Aucun résultat trouvé pour les acteurs</h1>';
    }
    // So do that
    else
    {
        echo '<h1 class="text-center"><strong> La partie acteur de la recherche  </strong></h1>';
        echo '<div class="container">';

        // Init variable image to show the div at the good moment
        $image=0;

        // every 3 images print that
        if($image %3 == 0)
        {
            echo ' <div class="row">';
        }
        // Print the data
        foreach ($result as $result)
        {
            echo ' <div class="col-lg-4 col-md-12 mb-4">';
                echo ' <div class="p-4 bg-white">';
                    echo ' <div class="d-flex flex-column">';
                        echo '<a class="thumbnail" href="index.php?show-actor&id='.$result['id'].'">';
                        echo ' <div><img class="img-responsive img-thumbnail" src="./uploads/actors/' . $result['image'] . '" alt = "Portrait de l\'acteur ' . $result['last_name'], $result['first_name']  . '" ></div></a>';
                        $image++;
                        echo ' <div class="d-flex flex-column">';
                            echo ' <div class="d-flex flex-row justify-content-between align-items-center">';
                                echo ' <h5>' . $result['last_name'].' '.$result['first_name']. '</h5>';
                            echo ' </div>';
                        echo ' </div>';
                    echo ' </div>';
                echo ' </div>';
            echo ' </div>';
        }
        // every 3 images print that
        if( $image %3 == 0)
        {
            echo ' </div>';
            $image=0;
        }
        echo ' </div>';

        
    }

?> 