<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if ($_POST) {
    $event_id = mysqli_real_escape_string($connect, $_POST['event_id']);
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    
    $check_query = "SELECT id FROM event_registrations WHERE event_id = '$event_id' AND email = '$email'";
    $check_result = mysqli_query($connect, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $error = "This email is already registered for this event";
    } else {
        $query = "INSERT INTO event_registrations (event_id, name, email, phone) 
                  VALUES ('$event_id', '$name', '$email', '$phone')";
        
        if (mysqli_query($connect, $query)) {
            set_message("Registration has been added successfully", "confirmation");
            header('Location: event_registrations.php');
            die();
        } else {
            $error = "Registration could not be added: " . mysqli_error($connect);
        }
    }
}

include('includes/header.php');

$events_query = "SELECT id, title, event_date FROM events ORDER BY event_date DESC";
$events_result = mysqli_query($connect, $events_query);
?>

<h2>Add Registration</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group mb-3">
        <label for="event_id">Event *</label>
        <select name="event_id" id="event_id" class="form-control" required>
            <option value="">Select an event</option>
            <?php while ($event = mysqli_fetch_assoc($events_result)): ?>
                <option value="<?php echo $event['id']; ?>">
                    <?php echo htmlspecialchars($event['title']); ?> 
                    (<?php echo date('M j, Y', strtotime($event['event_date'])); ?>)
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="name">Participant Name *</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email Address *</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Add Registration">
        <a href="event_registrations.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php include('includes/footer.php'); ?>
