<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

//check if the form is submitted and then submit the data to the db via $query

if(isset($_POST['title'])){
    $query = 'UPDATE projects SET 
                title = "'. $_POST['title'] .'" ,
                content = "'. $_POST['content'] .'" ,
                url = "'. $_POST['url'] .'" ,
                date = "'. $_POST['date'] .'" ,
            
                type = "'. $_POST['type'] .'"
                WHERE id = "'.$_GET['id'] .'" ' ;

                mysqli_query($connect, $query);               
               
                

                
                set_message("Project has been updated",confirmation);
                header('Location: projects.php');
            

}
include('includes/header.php');

?>

<h2>Edit Project</h2>
<?php

//this to pre populate the fields with existing values
$query = 'SELECT * FROM projects WHERE id = "' . $_GET["id"] . '" LIMIT 1';
$result = mysqli_query($connect, $query);
$record = mysqli_fetch_assoc($result);
?>
<div class="container mt-4" style="max-width: 600px;">
    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?php echo $record['title']; ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <?php
                    $values = array('Graphic Design', 'Website');
                    foreach($values as $key => $value) {
                        echo '<option value="'.$value.'"';
                        if($record['type'] == $value) echo ' selected';
                        echo '>'.$value.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" 
                      placeholder="Enter project description..."><?php echo $record['content']; ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" 
                       value="<?php echo $record['date']; ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control" id="url" name="url" 
                       value="<?php echo $record['url']; ?>" placeholder="https://example.com">
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="projects.php" class="btn btn-outline-secondary me-md-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Project</button>
        </div>
    </form>
</div>
<?php

include('includes/footer.php');

?>