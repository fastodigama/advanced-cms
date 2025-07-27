<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

// Handle image upload
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

    $event_id = $_GET['id'];

    $allowedTypes = ['image/png' => 'png', 'image/jpg' => 'jpg', 'image/jpeg' => 'jpeg', 'image/gif' => 'gif'];
    $type = $allowedTypes[$_FILES['photo']['type']] ?? false;

    if ($type) {
        $targetDir = 'uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Ensure uploads directory exists
        }

        $filename = time() . '_' . basename($_FILES['photo']['name']);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            $query = "INSERT INTO media (event_id, media_type, media_path) VALUES ('$event_id', 'image', '$targetFile')";
            mysqli_query($connect, $query);
            set_message("Photo has been uploaded","confirmation");
        }
    }

    header('Location: events.php');
    die();
}

// Handle YouTube link
if (isset($_POST['youtube_url']) && !empty($_POST['youtube_url'])) {
    $url = mysqli_real_escape_string($connect, $_POST['youtube_url']);
    $event_id = $_GET['id'];

    $query = "INSERT INTO media (event_id, media_type, media_path) VALUES ('$event_id', 'youtube', '$url')";
    mysqli_query($connect, $query);

    set_message("YouTube link has been added","confirmation");
    header('Location: events.php');
    die();
}

include('includes/header.php');

?>

<h2>Add Media</h2>

<?php
$query = 'SELECT * FROM events WHERE id = "' . $_GET["id"] . '" LIMIT 1';
$result = mysqli_query($connect, $query);
$record = mysqli_fetch_assoc($result);

// Fetch related media
$media_query = 'SELECT * FROM media WHERE event_id = "' . $_GET['id'] . '"';
$media_result = mysqli_query($connect, $media_query);
?>

<h4>Event: <?php echo htmlentities($record['title']); ?></h4>

<form method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light w-50 mb-5">
  <div class="mb-3">
    <label for="photo" class="form-label">Upload Photo:</label>
    <input type="file" name="photo" id="photo" class="form-control">
  </div>
  <div class="mb-3">
    <label for="youtube_url" class="form-label">YouTube Link:</label>
    <input type="url" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h3>Current Media</h3>
<div class="d-flex flex-wrap">

<?php while ($media = mysqli_fetch_assoc($media_result)): ?>
    <?php if ($media['media_type'] === 'image'): ?>
        <div class="d-inline-block me-3 mb-3 text-center">
            <img src="<?php echo $media['media_path']; ?>" 
                 class="img-thumbnail" 
                 style="height: 75px; object-fit: cover;">
            <div>
                <a href="events_media_delete.php?media_id=<?php echo $media['id']; ?>" class="small text-danger">Delete</a>
            </div>
        </div>
    <?php elseif ($media['media_type'] === 'youtube'): ?>
        <?php 
            // Extract the video ID from the YouTube URL
            preg_match('/v=([^&]+)/', $media['media_path'], $matches);
            $videoId = $matches[1] ?? '';
        ?>
        <div class="d-inline-block me-3 mb-3 text-center" style="width: 200px;">
            <a href="<?php echo $media['media_path']; ?>" target="_blank">
                <img src="https://img.youtube.com/vi/<?php echo $videoId; ?>/hqdefault.jpg" 
                     class="img-thumbnail" 
                     style="height: 100px; object-fit: cover;">
            </a>
            <div>
                <a href="events_media_delete.php?media_id=<?php echo $media['id']; ?>" class="small text-danger">Delete</a>
            </div>
        </div>
    <?php endif; ?>
<?php endwhile; ?>


</div>

<?php include('includes/footer.php'); ?>
