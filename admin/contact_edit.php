<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    set_message('Invalid contact ID.', 'warning');
    header('Location: contact.php');
    exit;
}
$id = (int)$_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    $query = "UPDATE contact SET address='$address', phone='$phone', email='$email' WHERE id=$id";
    if (mysqli_query($connect, $query)) {
        set_message('Contact info updated successfully!', 'confirmation');
        header('Location: contact.php');
        exit;
    } else {
        set_message('Error updating contact info.', 'warning');
    }
}

// Fetch contact info
$query = "SELECT * FROM contact WHERE id=$id LIMIT 1";
$result = mysqli_query($connect, $query);
$contact = mysqli_fetch_assoc($result);
if (!$contact) {
    set_message('Contact entry not found.', 'warning');
    header('Location: contact.php');
    exit;
}

include('includes/header.php');
?>

<h1 class="mb-4">Edit Contact Info</h1>
<form method="post" class="card p-4 shadow" style="max-width: 600px;">
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($contact['address']); ?>" required>
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Update Contact</button>
  <a href="contact.php" class="btn btn-secondary ms-2">Cancel</a>
</form>

<?php
include('includes/footer.php');
?> 