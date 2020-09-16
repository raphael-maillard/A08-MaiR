<?php

class CheckdataActors{

    // Attributs for actors
    private $firstName;
    private $lastName;
    private $dob;
    private $role;
    private $isSuccess;

    // Getters 

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    
    // Setters

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }

    public function setIsSuccess(string $isSuccess)
    {
        $this->isSuccess = $isSuccess;
    }

    // Methods


}



?>