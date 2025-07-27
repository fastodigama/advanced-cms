<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if (isset($_POST['title'])) {
    $query = 'INSERT INTO events (
                title,
                description,
                event_date,
                location
              ) VALUES (
                "'.$_POST['title'].'",
                "'.$_POST['description'].'",
                "'.$_POST['event_date'].'",
                "'.$_POST['location'].'"
              )';

    mysqli_query($connect, $query);
    set_message("A new event has been added" , "confirmation");
    

    header('Location: events.php');
    die();
}

include('includes/header.php');

?>

<div class="container mt-4" style="max-width: 600px;">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Add Event</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="event_date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">Clear</button>
                    <button type="submit" class="btn btn-primary">Add Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

include('includes/footer.php');

?>

