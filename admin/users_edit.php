<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

//check if the form is submitted and then submit the data to the db via $query

if(isset($_POST['first'])){
    $query = 'UPDATE users SET 
                first = "'. $_POST['first'] .'" ,
                last = "'. $_POST['last'] .'" ,
                email = "'. $_POST['email'] .'" ,
            
                active = "'. $_POST['active'] .'"
                WHERE id = "'.$_GET['id'] .'" ' ;

                mysqli_query($connect, $query);               
               
                //before we redirect we gonna check if new password has been provided wgonna run a second update

                if(isset($_POST['password'])){

                     $query = 'UPDATE users SET (
                password = "'.md5( $_POST['first'] ).'" 
                )';


                }
                set_message("user has been updated","confirmation");
                header('Location: users.php');
            

}
include('includes/header.php');
?>

<h2>Edit User</h2>
<?php
$query = 'SELECT * FROM users WHERE id = "' . $_GET["id"] . '" LIMIT 1';
$result = mysqli_query($connect, $query);
$record = mysqli_fetch_assoc($result);
?>
<div class="container mt-4" style="max-width: 600px;">
    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first" name="first" 
                       value="<?php echo $record['first']; ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last" name="last" 
                       value="<?php echo $record['last']; ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="<?php echo $record['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" 
                   placeholder="Leave blank to keep current password">
            <div class="form-text">Leave blank to keep current password</div>
        </div>

        <div class="mb-4">
            <label for="active" class="form-label">Status</label>
            <select class="form-select" id="active" name="active" required>
                <?php
                $values = array('Yes', 'No');
                foreach($values as $key => $value) {
                    echo '<option value="'.$value.'"';
                    if($record['active'] == $value) echo ' selected';
                    echo '>'.$value.'</option>';
                }
                ?>
            </select>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="users.php" class="btn btn-outline-secondary me-md-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>
    </form>
</div>

<?php

include('includes/footer.php');

?>