<!-- form new -->


<?php 
$name= null;
$director=null;
$duration=null;
$date=null;



?> 

    <div class="container">
        <div class="row">
            <h1><strong>Ajouter un Film </strong></h1>
            <br>
            <form class="form col-sm-12 col-lg-12" role="form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom"
                        value="<?php print $name; ?>">
                    <span class="help-inline"><? echo $nameError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Réalisateur:</label>
                    <input type="text" class="form-control" id="director" name="director"
                        placeholder="Description" value="<?php echo $director; ?>"></input>
                    <span class="help-inline"><? echo $directorError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Durée:</label>
                    <input type="time" class="form-control" id="time" name="time"
                        value="<?php echo $duration; ?>">
                    <span class="help-inline"><? echo $durationError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Date de sortie:</label>
                    <input type="date" class="form-control" id="time" name="time"
                        value="<?php echo $date; ?>">
                    <span class="help-inline"><? echo $dateError; ?></span>
                </div>

                <div class="form-group">
                    <label for="category">Phase:</label>
                    <select class="form-control" name="category" id="category">
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
                <div class="form-group">
                    <label for="image">Sélectionner l'affiche du film</label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><? echo $imageError; ?></span>
                </div>

                <br>
                <div class="form-actions ">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>
                        Ajouter</button>
                    <a class="btn btn-primary" href="index.php"> <span class="glyphicon glyphicon-arrow-left"></span>
                        Retour</a>
                </div>
            </form>