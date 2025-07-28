<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

?>

<h2>Manage Testimonials</h2>

<?php
$query = 'SELECT * 
          FROM testimonials
          ORDER BY created_at ';
$result = mysqli_query($connect, $query);
?>

<div class="container mt-4" style="max-width: 1200px;">
    <div class="row g-4">
        <?php while($record = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <small class="text-muted">ID: <?php echo $record['id']; ?></small>
                        <span class="badge bg-info">
                            <?php echo $record['created_at']; ?>
                        </span>
                    </div>
                    <h5 class="card-title mb-2"><?php echo $record['name']; ?></h5>
                    <p class="text-muted mb-1"><strong>Email:</strong> <?php echo $record['email']; ?></p>
                    <p class="mb-3"><?php echo $record['message']; ?></p>
                    <div class="mt-auto">
                        <div class="btn-group w-100" role="group">
                            <a href="testimonials_edit.php?id=<?php echo $record['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="testimonials_delete.php?delete=<?php echo $record['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this testimonial?');">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <a href="testimonials_add.php" class="btn btn-primary">Add Testimonial</a>
    </div>
</div>


<?php
include('includes/footer.php');
?>