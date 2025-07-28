<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {
    $delete_id = mysqli_real_escape_string($connect, $_GET['delete']);
    $query = 'DELETE FROM event_registrations WHERE id = "' . $delete_id . '" LIMIT 1';
    if (mysqli_query($connect, $query)) {
        set_message("Registration has been deleted", "warning");
    } else {
        set_message("Could not delete registration", "error");
    }
    header('Location: event_registrations.php');
    die();
}

include('includes/header.php');

$query = "SELECT er.*, e.title as event_title, e.event_date, e.location 
          FROM event_registrations er 
          JOIN events e ON er.event_id = e.id 
          ORDER BY er.registered_at DESC";
$result = mysqli_query($connect, $query);
?>

<h2>Event Registrations</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>
    <a href="registrations_add.php" class="btn btn-primary">Add Registration</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Event</th>
                <th>Participant Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Event Date</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($row['event_title']); ?></strong><br>
                            <small class="text-muted">📍 <?php echo htmlspecialchars($row['location']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>
                            <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>">
                                <?php echo htmlspecialchars($row['email']); ?>
                            </a>
                        </td>
                        <td>
                            <?php if ($row['phone']): ?>
                                <a href="tel:<?php echo htmlspecialchars($row['phone']); ?>">
                                    <?php echo htmlspecialchars($row['phone']); ?>
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Not provided</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date('M j, Y', strtotime($row['event_date'])); ?>
                        </td>
                        <td>
                            <?php echo date('M j, Y g:i A', strtotime($row['registered_at'])); ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="registrations_edit.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="event_registrations.php?delete=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Are you sure you want to delete this registration?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">
                        <div class="py-4">
                            <h5>No registrations found</h5>
                            <p class="text-muted">No one has registered for events yet.</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if (mysqli_num_rows($result) > 0): ?>
    <div class="mt-3">
        <p class="text-muted">
            <strong>Total Registrations:</strong> <?php echo mysqli_num_rows($result); ?>
        </p>
    </div>
<?php endif; ?>

<?php include('includes/footer.php'); ?>
