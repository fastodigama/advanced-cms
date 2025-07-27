<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

//check if the form is submitted and then submit the data to the db via $query

if(isset($_POST['first'])){
    $query = 'INSERT INTO users (
                first,
                last,
                email,
                password,
                active
                )VALUES(
                "'.$_POST['first'].'",
                "'.$_POST['last'].'",
                "'.$_POST['email'].'",
                "'.md5($_POST['password']).'",
                "'.$_POST['active'].'"
                )';

                mysqli_query($connect, $query);
                set_message("A new user has been added","confirmation");

                header('Location: users.php');
            

}
include('includes/header.php');

?>
<div class="container mt-4" style="max-width: 600px;">
    <h2>Add User</h2>
    
    <form method="POST">
        <div class="mb-3">
            <label for="first" class="form-label">First</label>
            <input type="text" class="form-control" name="first">
        </div>

        <div class="mb-3">
            <label for="last" class="form-label">Last</label>
            <input type="text" class="form-control" name="last">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Active</label>
            <select class="form-select" name="active">
                <?php
                $values = array('Yes', 'No');
                foreach($values as $key => $value) {
                    echo '<option value="'.$value.'">'.$value.'</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
<?php

include('includes/footer.php');

?>