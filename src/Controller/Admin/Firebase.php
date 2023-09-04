<?php 

class Firebase {

    public function send($registration_ids, $message) {
// print_r($registration_ids); 
// print_r($message); die;
        $fields = array(
           'registration_ids' => $registration_ids,
            'notification' => $message,
        );
        return $this->sendPushNotification($fields);
    }
   
    /*
    * This function will make the actuall curl request to firebase server
    * and then the message is sent 
    */
    private function sendPushNotification($fields) {
        //importing the constant files
        require_once 'Config.php';
        
        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        //building headers for the request

        $headers = array(
            'Authorization: key=' .FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // print_r($headers);die;

        
        //Initializing curl to open a connection
        $ch = curl_init();
        // print_r($ch);die;
 
        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);
        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //disabling ssl Firebase support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //adding the fields in json format 
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        //finally executing the curl request 
        $result = curl_exec($ch);
        // echo 'tesg';die;
        // print_r($result);die;

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        //Now close the connection
        curl_close($ch);
 
        //and return the result 
        return $result;
    }
}


?>
