<?php

class Magik_Messenger{

    /**
     * set the message you want to display on the next page load
     *
     * @param string $message
     */
    public static function setMessage($message)
    {
        $_SESSION['Magik_Messenger']['message'] = $message;
    }


    /**
     * get the message you set from the previous page
     *
     * @return string
     */
    public static function getMessage()
    {
        if(isset($_SESSION['Magik_Messenger']['message'])){
            $message = $_SESSION['Magik_Messenger']['message'];
            unset($_SESSION['Magik_Messenger']);
            return $message;
        }else{
            return '';
        }
    }
}