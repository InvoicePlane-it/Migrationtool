<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/
session_start();

// ---it---inizio
require_once('../config.php');
require_once('../engine.php');
$base_url = substr($base_url, 0, strrpos($base_url, '/engine/')+1);
// ---it---fine

// Check if all fields have been entered
if (
    isset( $_POST['database_name'] ) &&
    isset( $_POST['database_host'] ) &&
    isset( $_POST['database_user'] ) &&
    isset( $_POST['database_password'] )
) {

    // Check if the tool can connect to the database now
    $connection = mysqli_connect(
        $_POST['database_host'],
        $_POST['database_user'],
        $_POST['database_password'],
        $_POST['database_name']
    );

    if ( mysqli_ping($connection) ) {

        // Connection is working
        // Save the credentials in the session
        $_SESSION['connection'] = array(
            'host' => $_POST['database_host'],
            'user' => $_POST['database_user'],
            'password' => $_POST['database_password'],
            'name' => $_POST['database_name'],
        );

        // Database connection is valid
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Database connection valid.'
        );

        header('location: '.$base_url.'step/backup');
        exit;


    } else {

        // Connection is not working
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'The entered credentials are not correct. Please try again.'
        );

        header('location: '.$base_url.'step/config');
        exit;

    }

} else {

    // Not all fields have been filled out
    $_SESSION['alert'] = array(
        'type' => 'error',
        'message' => 'Please enter all fields.'
    );

    header('location: '.$base_url.'step/config');
    exit;

}