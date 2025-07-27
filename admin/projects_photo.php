<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

//check if the form is submitted and then submit the data to the db via $query

if(isset($_FILES['photo'])){
    switch($_FILES['photo']['type']){
        case 'image/png': $type ='png'; break;
        case 'image/jpg': $type ='jpg'; break;
        case 'image/jpeg': $type ='jpeg'; break;
        case 'image/gif': $type ='gif'; break;
        default : header('Location: projects.php');
         }

        $photo = 'data:image/'.$type.';base64,'.base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
        
    $query = 'UPDATE projects SET 
                photo = "'. $photo .'" 
                
                WHERE id = "'.$_GET['id'] .'" ' ;

                mysqli_query($connect, $query);               
               
                

                
                set_message("Photo has been updated","confirmation");
                header('Location: projects.php');
            

}
include('includes/header.php');

?>

<h2>Edit Photo</h2>
<?php

//this to pre populate the fields with existing values
$query = 'SELECT * FROM projects WHERE id = "' . $_GET["id"] . '" LIMIT 1';
$result = mysqli_query($connect, $query);
$record = mysqli_fetch_assoc($result);
?>
<form method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light w-50 mx-auto">
  <div class="mb-3">
    <label for="photo" class="form-label">Upload Photo:</label>
    <input type="file" name="photo" id="photo" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Add Photo</button>
</form>


<?php

include('includes/footer.php');

?>