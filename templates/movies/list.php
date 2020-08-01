<!-- list -->
<?php
include './settings/db.php';



if($image==0)
// Init container of gallery
{
echo '<div class="container mt-5 mb-5">';
    }

    echo '<div class="row col-sm-12 d-block text-center title">';
        echo ' <h1> La gallerie de la boite à fil</h1><br>';
        echo '</div>';

    //Show filter part
    echo '<div class="col-lg-4">';
        echo '<div class="btn-group">';
            echo ' <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filtre';
                echo ' <span class="caret"></span></button>';
            echo ' <ul class="dropdown-menu scrollable-menu" role="menu">';
                include './settings/db.php';
                $db = $connect;
                // foreach($db->query('SELECT * FROM movies') as $row)
                // {
                // print ('<li><a href="galery.php?id='.$row['id'].'" class="list-group-item list-group-item-action">'.$row['name'].' </a></li>');
                // }
                //End of connection DB
                $connect=null;

                echo ' </ul>';
            echo ' </div>';
        echo ' </div>';
    // init traiment for items
    // while ($item = $statement->fetch())
    // {
    // if($image %3 == 0)
    // {
    // echo ' <div class="row">';

    //     }

    //     echo ' <div class="col-lg-4 col-md-12 mb-4">';
    //         echo ' <div class="p-4 bg-white">';
    //             echo ' <div class="d-flex flex-column">';
    //                 echo '<a class="thumbnail" href="images/'.$item['image'].'" data-size="1600x1067">';
    //                     echo ' <div><img class="img-responsive img-thumbnail" src="images/'.$item['image'].'" width="" height=""></div></a>';
    //                 $image++;
    //                 echo ' <div class="d-flex flex-column">';
    //                     echo ' <div class="d-flex flex-row justify-content-between align-items-center">';
    //                         echo ' <h5>'.$item['name'].'</h5>';
    //                         echo ' <h6>'.$item['category'].'</h6>';
    //                         echo ' </div>';
    //                     echo ' <div><span>'.$item['dimension'].'</span><br>
    //                         <div class="description col-12">'.$item['description'].'</div>
    //                     </div>';
    //                     echo ' </div>';
    //                 echo ' </div>';
    //             echo ' </div>';
    //         echo ' </div>';


    //     if( $image %3 == 0)
    //     {
    //     echo ' </div>';
    // $image=0;
    // }

    // if($row == $image){echo '</div>';}
// }

?>