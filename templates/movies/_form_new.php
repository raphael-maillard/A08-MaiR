<!-- form new -->


<?php 

if(isset($_POST))
{
    $name           = checkInput($_POST['name']);
    $director    = checkInput($_POST['director']);
    $duration       = checkInput($_POST['duration']);
    $date      = checkInput($_POST['date']);
    // $image          = checkInput($_FILES['image']['name']);
    // $imagePath      = '../images/' .basename($image);
    // $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    // $isSuccess      = true;
    // $isUploadSuccess = false;

    $query = $connect->prepare()

}
function checkInput ($data)
{
    $data= trim($data);
    $data= stripslashes($data);
    $data= htmlspecialchars($data);
    return $data; 
}



?> 

    <div class="container">
        <div class="row">
            <h1><strong>Ajouter un Film </strong></h1>
            <br>
            <form class="form col-sm-12 col-lg-12" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom du film:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom du film"
                        value="<?php print $name; ?>">
                    <span class="help-inline"><? echo $nameError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Réalisateur:</label>
                    <input type="text" class="form-control" id="director" name="director"
                        placeholder="Réalisateur" value="<?php echo $director; ?>"></input>
                    <span class="help-inline"><? echo $directorError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Durée:</label>
                    <input type="time" class="form-control" id="time" name="duration"
                        value="<?php echo $duration; ?>">
                    <span class="help-inline"><? echo $durationError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Date de sortie:</label>
                    <input type="date" class="form-control" id="time" name="date_realse"
                        value="<?php echo $date; ?>">
                    <span class="help-inline"><? echo $dateError; ?></span>
                </div>
                <div class="form-group">
                    <label for="category">Phase:</label>
                    <select class="custom-select" name="phase" id="category">
                        <?php                         
                            foreach($connect->query('SELECT * FROM phases') as $row)
                            {
                                print ('<option value="'.$row['id'].'">'.$row['phase'].'</option>');
                            }
                            $connect=null;
                        ?>
                    </select>
                    <span class="help-inline">
                        <? echo $phaseError; ?></span>
                </div>
                <div class="custom-file">
                    <input type="img" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Insérer l'affiche du film</label>
                </div>

                <br>
                <div class="form-actions ">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>
                        Ajouter</button>
                    <a class="btn btn-primary" href="index.php"> <span class="glyphicon glyphicon-arrow-left"></span>
                        Retour</a>
                </div>
            </form>