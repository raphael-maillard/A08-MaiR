<!-- show -->
<?php

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$statement = $connect->prepare('SELECT movies.id, movies.name, movies.director, movies.release_date, movies.duration ,movies.image, phases.phase,  movies.created_at, movies.modified_at
                                FROM phases 
                                JOIN movies ON phases.id = movies.id_phase
                                WHERE movies.id= ?');

$statement->execute(array($id));
$item = $statement->fetch();


$item['release_date'] = date("d-m-Y", strtotime($item['release_date']));
$item['created_at'] = date("d-m-Y", strtotime($item['created_at']));
$item['modified_at'] = date("d-m-Y", strtotime($item['modified_at']));


function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Affiche de film </strong></h1>
            <br>
            <form>
                <div class="form-group">
                    <label>Nom:</label><?php echo ' ' . $item['name'] ?>
                </div>
                <div class="form-group">
                    <label>Date de sortie:</label><?php echo ' ' . $item['release_date'] ?>
                </div>
                <div class="form-group">
                    <label>Durée:</label><?php echo ' ' . $item['duration'] ?>
                </div>
                <div class="form-group">
                    <label>Réalisateur:</label><?php echo ' ' . $item['director'] ?>
                </div>
                <div class="form-group">
                    <label>Phase:</label><?php echo ' ' . $item['phase'] ?>
                </div>
                <div class="form-group">
                    <label>Image:</label><?php echo ' ' . $item['image'] ?>
                </div>
                <div class="form-group">
                    <label>Date de création de la fiche:</label><?php echo ' ' . $item['created_at'] ?>
                </div>
                <div class="form-group">
                    <label>Dernière modification : </label><?php echo ' ' . $item['modified_at'] ?>
                </div>

            </form>

        </div>
        <div class="col-sm-6">
            <div class="thumbnail">
                <div class="d-flex flex-column pt-4">
                    <div><img class="img-fluid img-responsive" src="<?php echo ' ../A08-MaiR/uploads/' . $item['image'] . '" alt="Affiche du film ' . $item['name'] ?>"></div>
                </div>
            </div>
        </div>
        <div class="form-group p-4">
            <a class="btn btn-primary" href="index.php?list">Retour</a>

            <?php $id = $_GET['id'];
            echo '<a class="btn btn-warning" href="index.php?edit-movies&id=' . $id . '"> Modifier</a>'; ?>

            <a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Supprimer</a>
        </div>

        <!-- Modal -->
        <form action="index.php?list" method="POST">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Fenêtre de dialogue</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                <input type="hidden" name="id-del" value="<?php echo $_GET['id'] ?>">
                            </div>
                        </div>
                        <div class="modal-body">Voulez-vous vraiment supprimer ce film de la liste ?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" value="Supprimer" href="index.php?list" class="btn btn-danger">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>