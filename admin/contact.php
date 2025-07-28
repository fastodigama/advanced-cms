<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');

// Fetch all contact entries
$query = "SELECT * FROM contact";
$result = mysqli_query($connect, $query);
?>

<h1 class="mb-4">Contact Info</h1>

<div class="mb-3">
  <a href="contact_add.php" class="btn btn-primary">Add New Contact</a>
</div>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($contact = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?php echo $contact['id']; ?></td>
          <td><?php echo htmlspecialchars($contact['address']); ?></td>
          <td><?php echo htmlspecialchars($contact['phone']); ?></td>
          <td><?php echo htmlspecialchars($contact['email']); ?></td>
          <td>
            <a href="contact_edit.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a href="contact_delete.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this contact entry?');">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php
include('includes/footer.php');
?>
