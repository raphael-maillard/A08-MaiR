<!-- show -->
<?php

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$statement = $connect->prepare('SELECT movies.id, movies.name, movies.id_image, movies.director, movies.release_date, movies.duration ,images.image, images.alt, phases.phase
                           FROM images 
                           JOIN movies ON images.id = movies.id_image
                           JOIN phases ON phases.id = movies.id_phase
                           WHERE movies.id= ?');

// SELECT movies.id, movies.name, movies.id_image, images.image, images.alt , phases.phase
// FROM images
// JOIN movies ON images.id = movies.id_image
// JOIN phases ON phases.id = movies.id_phase

$statement->execute(array($id));
$item = $statement->fetch();
$connect = null;

$item['release_date']= date("d-m-Y", strtotime($item['release_date']));

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
            </form>

        </div>
        <div class="col-sm-6">
            <div class="thumbnail">
                <div class="d-flex flex-column">
                    <div><img class="img-fluid img-responsive" src="<?php echo ' ../A08-MaiR/uploads/' . $item['image'] ?>"></div>
                </div>
            </div>
        </div>
        <div class="form-actions ">
            <a class="btn btn-primary" href="index.php?list"> <span class="glyphicon glyphicon-arrow-left">Retour</a>
        </div>