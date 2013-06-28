<?php
class Swordsman{
    
    var $name;
    var $health;
    var $strength;
    var $defense;
    var $speed;
    var $luck;
    
    public function __construct($name){
       
        if (strlen($name) > 30){
            throw new \Exception('Combatants name be 30 characters or less.');            
        }
        
        $this->name = $name;   
        
    }
    
    
}

