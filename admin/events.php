<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {
    $query = 'DELETE FROM events WHERE id = "' . $_GET['delete'] . '" LIMIT 1';
    mysqli_query($connect, $query);

    set_message("Event has been deleted","warning");
    header('Location: events.php');
    die();
}

include('includes/header.php');

?>

<h2>Manage Events</h2>

<?php
$query = 'SELECT * FROM events ORDER BY event_date DESC';
$result = mysqli_query($connect, $query);
?>

<div class="container mt-4" style="max-width: 1200px;">
    <div class="row g-4">
        <?php while ($record = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm" >
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <small class="text-muted">ID: <?php echo $record['id']; ?></small>
                            <span class="badge bg-info">
                                <?php echo $record['event_date']; ?>
                            </span>
                        </div>

                        <h5 class="card-title"><?php echo $record['title']; ?></h5>
                        <p class="text-muted mb-3"><?php echo $record['description']; ?></p>
                        <p class="text-muted mb-3"><strong>Location:</strong> <?php echo $record['location']; ?></p>

                        <?php
                        $mediaQuery = 'SELECT media_type, media_path FROM media WHERE event_id = "' . $record['id'] . '"';
                        $mediaResult = mysqli_query($connect, $mediaQuery);

                        while ($media = mysqli_fetch_assoc($mediaResult)) {
                            if ($media['media_type'] === 'image') {
                                echo '<img src="' . $media['media_path'] . '" 
                                           class="img-thumbnail me-2 mb-2" 
                                           style="height: 75px; object-fit: cover; cursor: pointer;" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#imageModal" 
                                           onclick="document.getElementById(\'modalImage\').src = \'' . $media['media_path'] . '\';">';
                            } elseif ($media['media_type'] === 'youtube') {
                                preg_match('/v=([^&]+)/', $media['media_path'], $matches);
                                $videoId = $matches[1] ?? '';
                                if ($videoId) {
                                    echo '<iframe width="100%" height="180" src="https://www.youtube.com/embed/' . $videoId . '" 
                                        frameborder="0" allowfullscreen class="mb-2"></iframe>';
                                } else {
                                    echo '<p class="text-muted small">YouTube link: <a href="' . $media['media_path'] . '" target="_blank">' . $media['media_path'] . '</a></p>';
                                }
                            }
                        }
                        ?>

                        <div class="mt-auto">
                            <div class="btn-group w-100" role="group">
                                <a href="events_media.php?id=<?php echo $record['id']; ?>" 
                                   class="btn btn-sm btn-outline-primary">Media</a>
                                <a href="events_edit.php?id=<?php echo $record['id']; ?>" 
                                   class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="events.php?delete=<?php echo $record['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <a href="events_add.php" class="btn btn-primary">Add Event</a>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <img src="" id="modalImage" class="w-100" style="max-height: 90vh; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

<?php
include('includes/footer.php');
?>
