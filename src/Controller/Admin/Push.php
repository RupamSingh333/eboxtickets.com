<?php 

class Push {
    //notification title
    private $title;

    //notification message 
    private $text;


    //initializing values in this constructor
    function __construct($title, $text ) {
         $this->title = $title;
         $this->text = $text; 


    }
    
    //getting the push notification
    public function getPush() {
        $res = array();
        $res['title'] = $this->title;
        $res['text'] = $this->text;
        return $res;
    }
 
}


?>
