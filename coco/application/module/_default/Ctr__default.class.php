<?php
class Ctr__default extends Ctr_controleur {

    public function __construct($action) {
		parent::__construct("_default",$action);
        $a = "a_$action";
        $this->$a();
    }
    
    public function a_index() {
        require $this->gabarit;   
    }

}

?>