<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if (isset($_GET['media_id'])) {
    $media_id = $_GET['media_id'];

    // Optionally remove the file from disk if it's an image
    $query = 'SELECT media_path, media_type FROM media WHERE id = "' . $media_id . '"';
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && $row['media_type'] === 'image') {
        if (file_exists($row['media_path'])) {
            unlink($row['media_path']);
        }
    }

    // Now delete the database record
    $query = 'DELETE FROM media WHERE id = "' . $media_id . '" LIMIT 1';
    mysqli_query($connect, $query);

    set_message("Media has been deleted.","warning");
}

header('Location: events.php');
exit();
?>
