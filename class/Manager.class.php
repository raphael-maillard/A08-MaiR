<?php 

Class Manager 
{
    // Attributs

    private $_db;
    private $ErrorData;
    private $errorImage;
    private $isSuccess;


    public function __construct (PDO $connect)
    {
        $this->setDb($connect);
    }

    // Getters to read the attibuts
    public function getDb()
    {
        return $this->_db;
    }

    // Return the data errors
    public function getErrorData()
    {
        return $this->ErrorData;
    }

    public function getErrorImage()
    {
        return $this->errorImage;
    }

    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    // Setters to deine attributs
    public function setDb (PDO $db)
    {
        $this->_db = $db;
    }

    public function setErrorImage ($ErrorImage)
    {
        $this->errorImage = $ErrorImage;
    }

    public function setErrorData ($Error)
    {
        $this->ErrorData = $Error;
    }

    public function setIsSuccess ($success)
    {
        $this->isSuccess = $success;
    }

    /**
     * @param array with every data of one movie 
     * And check indepedement the image and the data
     * 
     * if it's allright hydrate the object
     * 
     * @return Void
     */
    public function checkMovie($tab)
    {
        $imageObject = new Image;

        $movie = new Movie;


        if(isset($_FILES))$imageObject->checkImage($_FILES);

        $ErrorData = $movie->checkInput($tab);

        // Recovery check alright or not 
        $this->setIsSuccess($movie->getIsSuccess());
        if(!empty($ErrorData))
        {
            $this->setErrorData($ErrorData);
            return false;
        }else 
        {
            return true;
        }
    }

    /**
     * @param keep object movie 
     * excecute the requests 
     * @return Void 
     */
    public function create (Movie $movie, Image $imageObject)
    {
        echo 'je suis dans le create';

        $isUploadSuccess = $imageObject->getImage();
        $imageError = $imageObject->getImageError();
        $imagePath = $imageObject->getImagePath();
        $isSuccess = $this->getIsSuccess();

        if ($isUploadSuccess) 
        {
            echo ' je suis dans le upload';
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
            {
                $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Il y a eu une erreur lors de l\'upload</p>
                            </div>';
                $isUploadSuccess = false;
            }
        }
        else
        {
            $imageError = '<div class="alert alert-warning" role="alert">
                           <p class="alert-heading">Insérer une image</p>
                           </div>';
            $isUploadSuccess = false;
        }

        if ($isSuccess == true && $isUploadSuccess == true) 
        {
            $name = $movie->getName();
            $date = $movie->getDate();
            $duration = $movie->getDuration();
            $director = $movie->getDirector();
            $phase = $movie->getPhase();
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
        } else 
        {
            print('<div class="alert alert-danger" role="alert">');
            print('    <h4 class="alert-heading text-center">Un problème est survenue, le film n\'est pas enregistré !</h4>');
            print('</div>');

            $this->setErrorImage($imageError);
            return $imageError;
            
        }      
    }

    public function recoveryMovie(int $id)
    {

        $request = $this->_db->prepare('SELECT movies.id, movies.name, movies.director, movies.release_date, movies.duration ,movies.image, phases.phase, movies.id_phase
                                        FROM phases 
                                        JOIN movies ON phases.id = movies.id_phase 
                                        WHERE movies.id= :id');
        $request->bindValue("id", $id, PDO::PARAM_INT);
        $request->execute();
        
        $result = $request->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
?>