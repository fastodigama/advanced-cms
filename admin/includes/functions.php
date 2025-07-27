<?php

//create a quick function that will check to see if the user is logged in and if not will send us to login page

function secure() {

    //session id comes from record[id] in index.php file
    if(!isset($_SESSION['id'])){

        set_message('You must first login to view this page');

        header('Location: index.php');
        die();

    }
        
}

function set_message($message, $type = 'warning'){
    //here we set the message to display it in the login page 
    $_SESSION['message'] = $message;

    $_SESSION['message_type'] = $type;
}

function get_message(){

    //here we get the message from set_message and then display it on dashboard
    if(isset($_SESSION['message'])){

        $type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'warning';
        echo '<p class="'.$type.'">'.$_SESSION['message'].'</p>';
        //empty the session so that the message dosent show up in every page
        unset($_SESSION['message']);

        unset($_SESSION['message_type']);
    }
}