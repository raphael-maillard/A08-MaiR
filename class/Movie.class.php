<?php 


class Movie{

    // Attributs for movies

    private $name;
    private $director;
    private $duration; 
    private $date;
    private $phase;
    private $isSuccess;
    private $id;

    // Getters

    public function getName()
    {
        return $this->name;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPhase()
    {
        return $this->phase;
    }

    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    public function getId()
    {
        return $this->id;
    }


    // Setters

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDirector(string $director)
    {
        $this->director = $director;
    }

    public function setDuration( $duration)
    {
        $this->duration = $duration;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function setPhase(string $phase)
    {
        $this->phase = $phase;
    }

    public function setIsSuccess(string $issuccess)
    {
        $this->isSuccess = $issuccess;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param array and hydrate the object 
     * 
     * @return Void
     */
    public function hydrate ($tab)
    {

        if (isset($tab['id']) && !empty($tab['id']))
        $this->setId(checkInput($tab['id']));

        if (isset($tab['name']) && !empty($tab['name']))
        $this->setName(checkInput($tab['name']));

        if (isset($tab['director']) && !empty($tab['director']))
        $this->setDirector(checkInput($tab['director']));

        if (isset($tab['duration']) && !empty($tab['duration']))
        $this->setDuration(checkInput($tab['duration']));

        if (isset($tab['date']) && !empty($tab['date']))
        $this->setDate(checkInput($tab['date']));

        if (isset($tab['phase']) && !empty($tab['phase']))
        $this->setPhase(checkInput($tab['phase']));

        // if (isset($tab['image']) && !empty($tab['image']))
        // $this->setImage(checkInput($tab['image']));


    }

    /**
     * @param recevied $array and check if it's not null and completed
     * 
     * Define a attribut to continue the process
     * 
     * @return message erro if problem is det
     */
    public function checkInput($tab)
    {
        $isSuccess = true;

        if (isset($tab['name']) && empty($tab['name']))
        {
            $errorData =array("nameError" => '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Veuillez saisir un titre de film</p>
                            </div>');
            $isSuccess = false;
            $this->setIsSuccess($isSuccess);
            return $errorData;
        }
    
        if (isset($tab['director']) && empty($tab['director'])) 
        {
            $errorData =array("directorError" => '<div class="alert alert-warning" role="alert">
                                <p class="alert-heading">Veuillez remplir le champ ci dessus</p>
                                </div>');
             $isSuccess = false;
            $this->setIsSuccess($isSuccess);
             return $errorData;
        }
    
        if (isset($tab['duration']) && empty($tab['duration']))
        {
            $errorData =array("durationError" => '<div class="alert alert-warning" role="alert">
                                <p class="alert-heading">Veuillez saisir une durée</p>
                                </div>');
            $isSuccess = false;
            $this->setIsSuccess($isSuccess);
            return $errorData;
        }
    
        if (isset($tab['date']) && empty($tab['date']))
        {
            $errorData =array("dateError" => '<div class="alert alert-warning" role="alert">
                            <p class="alert-heading">Entré la date de sortie du film</p>
                            </div>');
            $isSuccess = false;
            $this->setIsSuccess($isSuccess);
            return $errorData;
        }
        $this->setIsSuccess($isSuccess);
    }

    public function select($id)
    {
        // $this->setId($id);

        // $request = ->prepare('SELECT movies.id, movies.name, movies.director, movies.release_date, movies.duration ,movies.image, phases.phase, movies.id_phase
        //                                     FROM phases 
        //                                     JOIN movies ON phases.id = movies.id_phase 
        //                                     WHERE movies.id= :id');
        // $request->bindValue("id", $this->getId(), PDO::PARAM_INT);
        // $result = $request->execute();   
        
        // $result->fetch(PDO::FETCH_ASSOC);

        // return $result;
    }

}


?> 