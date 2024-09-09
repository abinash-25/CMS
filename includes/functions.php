<?php 
function secure() {
    if(!isset($_SESSION['id'])){
        set_message("Please login first to view this page.");
        header('Location: /');
        die();
    }
}
function set_message($message){
    {
        $_SESSION['message'] = $message;
    }
}
function get_message(){
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}