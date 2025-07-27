<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if (isset($_POST['title'])) {
    $query = 'UPDATE events SET 
                title = "'. $_POST['title'] .'" ,
                description = "'. $_POST['description'] .'" ,
                event_date = "'. $_POST['event_date'] .'" ,
                location = "'. $_POST['location'] .'"
              WHERE id = "'. $_GET['id'] .'" ';

    mysqli_query($connect, $query);

    set_message("Event has been updated","confirmation");
    header('Location: events.php');
    die();
}

include('includes/header.php');

?>

<h2>Edit Event</h2>

<?php
$query = 'SELECT * FROM events WHERE id = "' . $_GET["id"] . '" LIMIT 1';
$result = mysqli_query($connect, $query);
$record = mysqli_fetch_assoc($result);
?>

<div class="container mt-4" style="max-width: 600px;">
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Event Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="<?php echo $record['title']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?php echo $record['description']; ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" 
                       value="<?php echo $record['event_date']; ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" 
                       value="<?php echo $record['location']; ?>">
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="events.php" class="btn btn-outline-secondary me-md-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Event</button>
        </div>
    </form>
</div>

<?php

include('includes/footer.php');

?>
