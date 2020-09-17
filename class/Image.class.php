<?php

class Image
{
    // Attributs

    private $image ;
    private $nameImage;
    private $imageError;
    private $imagePath;
    
    const PATHMOVIE = "uploads/";
    const PATHACTORS = "uploads/actors/";


    // Getters
    public function getImage()
    {
        return $this->image;
    }

    public function getNameImage()
    {
        return $this->nameImage;
    }
    public function getImageError()
    {
        return $this->imageError;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    // Setters
    public function setImage($answer)
    {
        $this->image = $answer;
    }

    public function setNameImage($name)
    {
        $this->nameImage = $name;
    }

    public function setImageError($error)
    {
        $this->imageError = $error;
    }

    public function setImagePath($path)
    {
        $this->imagePath = $path;
    }
    
    public function checkImage(array $file, $param = "movie")
    {
        if (isset($file) && $file['image']['error']!== 4)
        {
            var_dump($file);
            $imageName = checkInput($file['image']['name']);
            
            $path = $param=="movie" ? Image::PATHMOVIE : Image::PATHACTORS;
                         
            $imagePath = './'.$path.'' . basename($imageName);
            var_dump($imagePath);
  
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

            $isUploadSuccess = true;

            $this->setNameImage($imageName);

            if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") 
			{
                $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                            </div>';
               $isUploadSuccess = false;
            }

            if (file_exists($imagePath)) 
			{
                $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier existe déjà</p>
                            </div>';
                $isUploadSuccess = false;
            }
            var_dump($isUploadSuccess);

            if ($_FILES['image']["size"] > 50000) 
			{
                $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                            </div>';
                $isUploadSuccess = false;
            }
            var_dump($isUploadSuccess);

            if (isset($imagePath))$this->setImagePath($imagePath);  
            
            if (isset($isUploadSuccess))$this->setImage($isUploadSuccess);

            if (isset($imageError)) $this->setImageError($imageError);        
        }


        
    }

}
?>