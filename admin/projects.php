<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if(isset($_GET['delete'])){
    $query = 'DELETE FROM projects
    WHERE id = "'. $_GET['delete']. '"
    LIMIT 1';
    mysqli_query($connect,$query);

    //redurect to users page but before set an message

    set_message("User has been deleted");
    header('Location: projects.php');
    die();
}
include('includes/header.php');

?>

<h2>Manage Projects</h2>

<?php

$query = 'SELECT *
          FROM projects
          ORDER BY date ';

$result = mysqli_query($connect,$query);
?>

<div class="container mt-4" style="max-width: 1200px;">
   

    <div class="row g-4">
        <?php while($record = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <?php if($record['photo']): ?>
                <img src="<?php echo $record['photo']; ?>" 
                     class="card-img-top" 
                     style="height: 150px; object-fit: cover;" 
                     alt="Project Photo">
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <small class="text-muted">ID: <?php echo $record['id']; ?></small>
                        <span class="badge <?php echo $record['type'] == 'Website' ? 'bg-primary' : 'bg-success'; ?>">
                            <?php echo $record['type']; ?>
                        </span>
                    </div>
                    
                    <h5 class="card-title"><?php echo $record['title']; ?></h5>
                    <p class="text-muted mb-3"><?php echo $record['date']; ?></p>
                    
                    <div class="mt-auto">
                        <div class="btn-group w-100" role="group">
                            <a href="projects_photo.php?id=<?php echo $record['id']; ?>" 
                               class="btn btn-sm btn-outline-primary">Photo</a>
                            <a href="projects_edit.php?id=<?php echo $record['id']; ?>" 
                               class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="projects.php?delete=<?php echo $record['id']; ?>" 
                               class="btn btn-sm btn-outline-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php endwhile; ?>
         <div class="d-flex justify-content-between align-items-center mb-4">
       
        <a href="projects_add.php" class="btn btn-primary">
            Add Project
        </a>
    </div>
    </div>
</div>


<?php

include('includes/footer.php');

?>