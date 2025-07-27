<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

if(isset($_GET['delete'])){
    $query = 'DELETE FROM testimonials WHERE id = ' . $_GET['delete'];
    mysqli_query($connect, $query);
    set_message('Testimonial has been deleted');
    header('Location: testimonials.php');
}

include('includes/footer.php'); 
?>

