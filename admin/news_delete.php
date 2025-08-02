<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('DELETE FROM news WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $stm->close();

        set_message("News article deleted successfully");
        header('Location: news.php');
        die();
    } else {
        echo 'Could not prepare statement!';
    }
} else {
    set_message("No news ID provided!");
    header('Location: news.php');
    die();
}
?>