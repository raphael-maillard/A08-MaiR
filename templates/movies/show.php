<!-- show -->
<?php

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = $connect;
$statement = $db->prepare('SELECT movies.id, movies.name, movies.id_image, movies.director, movies.release_date, movies.duration ,images.image, images.alt 
                           FROM images 
                           JOIN movies ON images.id = movies.id_image  
                           WHERE movies.id= ?');

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
            <h1><strong>Voir un item </strong></h1>
            <br>
            <form action="">
                <div class="form-group">
                    <label>Nom:</label><?php echo ' ' . $item['name'] ?>
                </div>
                <div class="form-group">
                    <label>Date de sortie</label><?php echo ' ' . $item['release_date'] ?>
                </div>
                <div class="form-group">
                    <label>Durée:</label><?php echo ' ' . $item['duration'] ?>
                </div>
                <div class="form-group">
                    <label>Réalisateur:</label><?php echo ' ' . $item['director'] ?>
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
                    <!-- <div class="d-flex flex-column">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <h4><?php echo ' ' . $item['name'] ?></h4>
                        </div>
                        <div><?php echo ' ' . $item['dimension'] ?></div>
                        <br>
                        <h5><?php echo ' ' . $item['description'] ?></h5>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="form-actions ">
            <a class="btn btn-primary" href="index.php?list"> <span class="glyphicon glyphicon-arrow-left">Retour</a>
        </div>