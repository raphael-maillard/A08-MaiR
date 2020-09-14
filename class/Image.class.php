<?php

class Image
{
    // Attributs

    private $_image ;

    const VALID = "Valid";
    const INVALID = "Invalid";


    public function checkImage(array $file)
    {
        if (isset($file) && !empty($file))
        {
            $imageName = checkInput($file['image']['name']);
            $imagePath = './uploads/actors/' . basename($imageName);
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

            $isUploadSuccess    = true;

            if ($imageExtension != "jpg" && $imageExtension != "pnj" && $imageExtension != "jpeg" && $imageExtension != "gif") 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Les fichiers autorisés sont : .jpg, .pnj, .jpeg, .gif</p>
                            </div>';
                $isUploadSuccess = false;
            }

            if (file_exists($imagePath)) 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier existe déjà</p>
                            </div>';
                $isUploadSuccess = false;
            }

            if ($_FILES['image']["size"] > 30000) 
			{
                return $imageError = '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Le fichier ne doit pas dépasser 500KB</p>
                            </div>';
                $isUploadSuccess = false;
            }

            if ($isUploadSuccess) 
            {
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    return $imageError = '<div class="alert alert-warning" role="alert">
                                <p class="alert-heading">Il y a eu une erreur lors de l\'upload</p>
                                </div>';
                    $isUploadSuccess = false;
                }
            }
        }
        else
        {
            return $imageError = '<div class="alert alert-warning" role="alert">
            <p class="alert-heading">Insérer une image</p>
            </div>';
            $isUploadSuccess = false;
        }

        return $isUploadSuccess;

    }


}
?>