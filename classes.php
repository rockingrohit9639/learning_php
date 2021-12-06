<?php 

    class Player {
        // Properties
        public $name;
        public $speed = 3;

        // Methods
        // function set_name($name){
        //     $this->name = $name; 
        // }

        function __construct($name)
        {
            $this->name = $name;
        }

        function get_name(){
            return $this->name;
        }

        function get_speed() {
            return $this->speed;
        }
    }

    $player1 = new Player("Rohit");
    echo $player1->get_name();


?>