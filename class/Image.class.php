<?php

class Image
{
    // Attributs

    private $image ;
    private $nameImage;
    const PATHMOVIE = "uploads/";
    const PATHACTORS = "uploads/actors/";
    

    public function checkImage(array $file, $param = "movie")
    {
        if (isset($file) && !empty($file))
        {
            $imageName = checkInput($file['image']['name']);
            
            $path = $param=="movie" ? Image::PATHMOVIE : Image::PATHACTORS;
                         
            $imagePath = './'.$path.'' . basename($imageName);
  
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

            var_dump($imageExtension);

            $this->setImage($isUploadSuccess = true);

            $this->setNameImage($imageName);

            if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                            </div>';
                $this->setImage($isUploadSuccess = false);
            }

            if (file_exists($imagePath)) 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier existe déjà</p>
                            </div>';
                $this->setImage($isUploadSuccess = false);
            }

            if ($_FILES['image']["size"] > 50000) 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                            </div>';
                $this->setImage($isUploadSuccess = false);
            }

            if ($isUploadSuccess) 
            {
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    return $imageError = '<div class="alert alert-warning" role="alert">
                                <p class="alert-heading">Il y a eu une erreur lors de l\'upload</p>
                                </div>';
                    $this->setImage($isUploadSuccess = false);
                }
            }
        }
        else
        {
            return $imageError = '<div class="alert alert-warning" role="alert">
            <p class="alert-heading">Insérer une image</p>
            </div>';
            $this->setImage($isUploadSuccess = false);
        }
    }


    public function checkImageMovie(array $file)
    {
        if (isset($file) && !empty($file))
        {
            $imagePath = './uploads/' . basename($imageName);


            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

            $this->setImage($isUploadSuccess = true);

            if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                            </div>';
                $this->setImage($isUploadSuccess = false);
            }

            if (file_exists($imagePath)) 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier existe déjà</p>
                            </div>';
                $this->setImage($isUploadSuccess = false);
            }

            if ($_FILES['image']["size"] > 50000) 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                            </div>';
                $this->setImage($isUploadSuccess = false);
            }

            if ($isUploadSuccess) 
            {
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    return $imageError = '<div class="alert alert-warning" role="alert">
                                <p class="alert-heading">Il y a eu une erreur lors de l\'upload</p>
                                </div>';
                    $this->setImage($isUploadSuccess = false);
                }
            }
        }
        else
        {
            return $imageError = '<div class="alert alert-warning" role="alert">
            <p class="alert-heading">Insérer une image</p>
            </div>';
            $this->setImage($isUploadSuccess = false);
        }
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getNameImage()
    {
        return $this->nameImage;
    }

    public function setImage($answer)
    {
        $this->image = $answer;
    }

    public function setNameImage($name)
    {
        $this->nameImage = $name;
    }



}
?>