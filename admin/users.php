<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

if(isset($_GET['delete'])){
    $query = 'DELETE FROM users
    WHERE id = "'. $_GET['delete']. '"
    LIMIT 1';
    mysqli_query($connect,$query);

    //redurect to users page but before set an message

    set_message("User has been deleted");
    header('Location: users.php');
    die();
}
include('includes/header.php');
?>

<div class="container mt-4" style="max-width: 800px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Users</h2>
        <a href="users_add.php" class="btn btn-primary">Add User</a>
    </div>

    <?php
    $query = 'SELECT * FROM users ORDER BY last, first';
    $result = mysqli_query($connect,$query);
    ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($record = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $record['first']; ?></td>
                    <td><?php echo $record['last']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td>
                        <span class="badge <?php echo $record['active'] == '1' || $record['active'] == 'Active' ? 'bg-success' : 'bg-warning'; ?>">
                            <?php echo $record['active']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="users_edit.php?id=<?php echo $record['id']; ?>" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                        <a href="users.php?delete=<?php echo $record['id']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php

include('includes/footer.php');

?>