<?php
class Observation {

    private $spotter = "";
    private $amount = 0;
    private $place = "";
    private $description = "";
    private $date = null;
    public $errors = [];

  	function check($name, $value) {
		switch ($name) {
    		case "spotter":
	    		if (strlen($value) > 32) {
					throw new Exception("Name too long!", 1);
				}
    			break;
			case "amount":
				if (!is_numeric($value) || $value < 1) {
					throw new Exception("The amount must be a&nbsp;positive&nbsp;number!", 1);
				}
				break;
			case "place":
				if (!preg_match("/[0-9]{5}/", $value)) {
					throw new Exception("Location not a valid Finnish&nbsp;Zip&nbsp;Code!", 1);
				}
				break;
			case "date":
				if (!preg_match("/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/", $value)) {
					throw new Exception("Date not formatted correctly!", 1);
				}
				break;
			case "description":
				break;
    	}
  	}

    function __set($name, $value) {
    	try {
    		$this -> check($name, $value);
    	} catch (Exception $e) {
    		array_push($this -> errors, $e -> getMessage());
    	}
    	$this -> $name = $value;
	}

  	function __get($name){
  		return $this->$name;
  	}
   
}