<?php
// Clase para conertir objeto en texto

class testClass
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        try 
        {
            return (string) $this->name;
        } 
        catch (Exception $exception) 
        {
            return '';
        }
    }
}

?>