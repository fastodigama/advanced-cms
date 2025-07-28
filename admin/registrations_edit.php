<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

$id = mysqli_real_escape_string($connect, $_GET['id'] ?? 0);

if ($_POST) {
    $event_id = mysqli_real_escape_string($connect, $_POST['event_id']);
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    
    $query = "UPDATE event_registrations 
              SET event_id = '$event_id', name = '$name', email = '$email', phone = '$phone' 
              WHERE id = '$id' LIMIT 1";
    
    if (mysqli_query($connect, $query)) {
        set_message("Registration has been updated successfully", "confirmation");
        header('Location: event_registrations.php');
        die();
    } else {
        $error = "Registration could not be updated: " . mysqli_error($connect);
    }
}

$registration_query = "SELECT * FROM event_registrations WHERE id = '$id'";
$registration_result = mysqli_query($connect, $registration_query);
$registration = mysqli_fetch_assoc($registration_result);

if (!$registration) {
    set_message("Registration not found", "warning");
    header('Location: event_registrations.php');
    die();
}

include('includes/header.php');

$events_query = "SELECT id, title, event_date FROM events ORDER BY event_date DESC";
$events_result = mysqli_query($connect, $events_query);
?>

<h2>Edit Registration</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group mb-3">
        <label for="event_id">Event *</label>
        <select name="event_id" id="event_id" class="form-control" required>
            <option value="">Select an event</option>
            <?php while ($event = mysqli_fetch_assoc($events_result)): ?>
                <option value="<?php echo $event['id']; ?>" 
                        <?php echo ($event['id'] == $registration['event_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($event['title']); ?> 
                    (<?php echo date('M j, Y', strtotime($event['event_date'])); ?>)
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="name">Participant Name *</label>
        <input type="text" name="name" id="name" class="form-control" 
               value="<?php echo htmlspecialchars($registration['name']); ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email Address *</label>
        <input type="email" name="email" id="email" class="form-control" 
               value="<?php echo htmlspecialchars($registration['email']); ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control" 
               value="<?php echo htmlspecialchars($registration['phone']); ?>">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Update Registration">
        <a href="event_registrations.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php include('includes/footer.php'); ?>
