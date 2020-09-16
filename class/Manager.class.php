<?php 
require './class/CheckDataMovie.class.php';


Class Manager 
{

    // Attributs

    private $_db;

    public function __construct ($connect)
    {
        $this->setDb($connect);
    }


    public function getDb()
    {
        return $this->_db;
    }

    public function setDb (PDO $db)
    {
        $this->_db = $db;
    }

    public function checkMovie($tab)
    {
        $imageObject = new Image();

        $imageError = $imageObject->checkImage($_FILES);
        
        $isUploadSuccess = $imageObject->getImage();


        $movieCheck = new CheckdataMovie;

        $movieCheck->checkInputHydrate($tab);

        $isSuccess = $movieCheck->getIsSuccess();

        if ($isSuccess == true && $isUploadSuccess == true) 
        {
            $name = $movieCheck->getName();
            $date = $movieCheck->getDate();
            $duration = $movieCheck->getDuration();
            $director = $movieCheck->getDirector();
            $phase = $movieCheck->getPhase();
            $image = $imageObject->getNameImage();     
            

            $query = $this->_db->prepare("INSERT INTO movies ( name, release_date, duration, director, image, id_phase, created_at) 
            VALUES ( :name, :date, :duration, :director, :image, :phase, CURRENT_TIMESTAMP)");  
            $query->bindValue('name', $name, PDO::PARAM_STR);
            $query->bindValue('date', $date);
            $query->bindValue('duration', $duration);
            $query->bindValue('director', $director, PDO::PARAM_STR);
            $query->bindValue('image', $image, PDO::PARAM_STR);
            $query->bindValue('phase', $phase, PDO::PARAM_STR);         
            $query->execute();

            print('<div class="alert alert-success" role="alert">');
            print('    <h4 class="alert-heading text-center">Film ajouté avec succès !</h4>');
            print('</div>');
        } else {
            print('<div class="alert alert-danger" role="alert">');
            print('    <h4 class="alert-heading text-center">Un problème est survenue, le film n\'est pas enregistré !</h4>');
            print('</div>');
            echo $imageError;
        }
    }


}

?>