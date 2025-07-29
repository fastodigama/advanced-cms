<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    $query = "INSERT INTO contact (address, phone, email) VALUES ('$address', '$phone', '$email')";
    if (mysqli_query($connect, $query)) {
        set_message('Contact info added successfully!', 'confirmation');
        header('Location: contact.php');
        exit;
    } else {
        set_message('Error adding contact info.', 'warning');
    }
}

include('includes/header.php');
?>

<h1 class="mb-4">Add Contact Info</h1>
<form method="post" class="card p-4 shadow" style="max-width: 600px;">
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" required>
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <button type="submit" class="btn btn-primary mt-4">Add Contact</button>
  <a href="contact.php" class="btn btn-secondary ms-2 mt-4">Cancel</a>
</form>

<?php
include('includes/footer.php');
?> 