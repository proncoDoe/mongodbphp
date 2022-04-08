<?php 

function flash($name, $test = ''){

    if(isset($_SESSION[$name])){

        $msg = $_SESSION[$name];
        unset($_SESSION[$name]);

        return $msg;
    }else{

        $_SESSION[$name] = $test;
    }
    
    return '';
}


?>