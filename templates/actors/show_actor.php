<!-- show -->
<?php
// Recovery the id  and push in variable
if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

// Prepare request sql 
$statement = $connect->prepare('SELECT actors.id, actors.last_name, actors.first_name, actors.image, actors.dob, actors.image, actors.created_at, actors_movies.role
                                FROM actors
                                JOIN actors_movies ON actors.id = actors_movies.id_actors
                                WHERE actors.id= ?');


// Execute the request
$statement->execute(array($id));
$item = $statement->fetch(PDO::FETCH_ASSOC);

// Condition if the actor haven't role in the movies
if($item==false)
{
    $statement = $connect->prepare('SELECT actors.id, actors.last_name, actors.first_name, actors.image, actors.last_name, actors.dob, actors.image, created_at
                                    FROM actors
                                    WHERE actors.id= ?');

// Execute the request
$statement->execute(array($id));
$item = $statement->fetch(PDO::FETCH_ASSOC);
}

// Format the dates
$item['dob'] = date("d-m-Y", strtotime($item['dob']));
$item['created_at'] = date("d-m-Y", strtotime($item['created_at']));
if (isset($item['modify_at']))$item['modify_at'] = date("d-m-Y", strtotime($item['modify_at']));

// prepare the special request SQl for the foreach
$movie_name = $connect->prepare('SELECT movies.name
                                FROM actors
                                JOIN actors_movies ON actors.id = actors_movies.id_actors
                                JOIN movies ON actors_movies.id_movies = movies.id
                                WHERE actors.id= ?');

// Execute the request
$movie_name->execute(array($id));
$movie_name = $movie_name->fetchAll();

// function to check
function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Fiche d'acteur</strong></h1>
            <br>
            <!-- Start the form to enter the information relative at the movie -->
            <form>
                <!-- Start show the infomations -->
                <div class="form-group">
                    <label>Nom:</label><?php echo ' ' . $item['last_name'] ?>
                </div>
                <div class="form-group">
                    <label>Prénom:</label><?php echo ' ' . $item['first_name'] ?>
                </div>
                <div class="form-group">
                    <label>Date de naissance:</label><?php echo ' ' . $item['dob'] ?>
                </div>
                <div class="form-group">
                    <label>Présence dans le(s) film(s) : </label>
                    <?php
                    if(!empty($movie_name)){
                        echo '<table class="table">';
                         foreach ($movie_name as $row) 
                        {
                            echo '<tr><th scope="row"></th><td> ' . $row['name'] . ' </tr></td> ';
                        }
                        echo '</table>';}
                        else 
                        {
                            echo 'Aucun film enregistré pour cette personne';
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label>Dans le rôle de </label>
                    <?php 
                    if(isset($item['role'])) echo ' ' . $item['role'];
                    else echo 'Aucun rôle renseigné.';
                    ?>
                </div>
                <div class="form-group">
                    <label>Nom de l'image:</label><?php echo ' ' . $item['image'] ?>
                </div>
                <div class="form-group">
                    <label>Date de création de la fiche:</label><?php echo ' ' . $item['created_at'] ?>
                </div>
                <div class="form-group">
                    <label>Dernière modification : </label><?php if (!empty($item['modify_at'])) echo $item['modify_at'];
                                                            else echo ' Aucune modification enregistrée' ?>
                </div>
                <!-- end show the infomations -->

            </form>
            <!-- End the form -->

        </div>
        <div class="col-sm-6">
            <div class="thumbnail">
                <div class="d-flex flex-column pt-4">
                    <!-- Show the image and link onclick to this -->
                    <div><img class="img-fluid img-responsive" src="<?php echo ' uploads/actors/' . $item['image'] . '" alt="Photo de ' . $item['last_name'] ?>"></div>
                </div>
            </div>
        </div>
        <div class="form-group p-4">
            <a class="btn btn-primary" href="index.php?list-actors">Retour</a>
            <!-- Must to be use balise php for use the variable id  -->
            <?php
            $id = $_GET['id'];
            echo '<a class="btn btn-warning" href="index.php?edit-actors&id=' . $id . '"> Modifier</a>';
            ?>
            <!-- btn to show the dialog box  -->
            <a class="btn btn-danger" data-toggle="modal" data-target="#del-actor">Supprimer</a>
        </div>

        <!-- Modal to ask if you are sure to delete the item -->
        <form action="index.php?list-actors" method="POST">
            <div class="modal fade" id="del-actor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Fenêtre de dialogue</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                <input type="hidden" name="id-del-actors" value="<?php echo $_GET['id'] ?>">
                            </div>
                        </div>
                        <div class="modal-body">Voulez-vous vraiment supprimer ce film de la liste ?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" value="Supprimer" href="index.php?list-actors" class="btn btn-danger">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>