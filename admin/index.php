<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

if(isset($_POST['email'])){

    $query = 'SELECT * 
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.md5($_POST['password']).'"
            AND active = "Yes"
            LIMIT 1';

            //run the query:

            $result = mysqli_query($connect,$query);

            //if we get a matching record:

            if(mysqli_num_rows($result) > 0) {
                //fetch that record as an array
                $record = mysqli_fetch_assoc($result);
                //for basic security throw the id of the matching user we just found into a session along with the email in case we need later

                $_SESSION['id'] = $record['id'];
                $_SESSION['email'] = $_POST['email'];


                //redirect to the dashboard
                header('location: dashboard.php');
                die();


            }


}

include('includes/header.php');

?>

<section class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Login</h3>
    <form method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>

      <div class="mb-3">
        <label for="passwd" class="form-label">Password</label>
        <input type="password" class="form-control" id="passwd" name="password" placeholder="Enter your password">
      </div>

      <div class="d-grid">
        <input type="submit" class="btn btn-primary" value="Login">
      </div>
    </form>
  </div>
</section>

<?php

include('includes/footer.php');

?>