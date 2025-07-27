<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

if(isset($_GET['id'])){
    $query = 'SELECT * FROM testimonials WHERE id = ' . $_GET['id'];
    $result = mysqli_query($connect, $query);
    $record = mysqli_fetch_assoc($result);
}

if(isset($_POST['name'])){
    if($_POST['name']){
        $query = 'UPDATE testimonials SET name = "' . $_POST['name'] . '", email = "' . $_POST['email'] . '", message = "' . $_POST['message'] . '" WHERE id = ' . $_GET['id'];
        mysqli_query($connect, $query);
        set_message('Testimonial has been updated');
        header('Location: testimonials.php');
    }
}   
?>  

<h2>Edit Testimonial</h2>
<?php
if(isset($error)){
    echo '<p class="error">' . $error . '</p>';
}
?>

<div class="container mt-4" style="max-width: 600px;">
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($record['name']); ?>">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($record['email']); ?>">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message:</label>
          <textarea class="form-control" name="message" id="message" rows="4"><?php echo htmlspecialchars($record['message']); ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Done</button>
      </form>
    </div>
  </div>
</div>     


