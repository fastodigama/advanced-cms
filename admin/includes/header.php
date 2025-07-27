<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <title>Assignment 2 PHP CMS</title>
</head>
<body>
    <header id="header">
        <h2 id="site-name"><a href="index.php" target="_blank" rel="noopener noreferrer">Advanced CMS</a></h2>
        <nav id="main-navigation">
            <ul class="inline-menu">
                <li><a href="dashboard.php">Admin Dashboard</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="testimonials.php">Testimonials</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
            
            
        </nav>
    </header>

    <!-- START PAGE LAYOUT -->

    <div class="page-wrapper">
        <aside class="sidebar">
            <?php
            include('includes/sidebar.php');
            ?>
    </aside>

    <main id="main-content">
    
    <?php get_message(); ?>
