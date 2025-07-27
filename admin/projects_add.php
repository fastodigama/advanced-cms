<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

//check if the form is submitted and then submit the data to the db via $query

if(isset($_POST['title'])){
    $query = 'INSERT INTO projects (
                title,
                content,
                type,
                date,
                url
                )VALUES(
                "'.$_POST['title'].'",
                "'.$_POST['content'].'",
                "'.$_POST['type'].'",
                "'.$_POST['date'].'",
                "'.$_POST['url'].'"
                )';

                mysqli_query($connect, $query);
                set_message("A new project has been added","confirmation");

                header('Location: projects.php');
            

}
include('includes/header.php');


?>
<div class="container mt-4" style="max-width: 600px;">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Add Project</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Choose type...</option>
                            <?php
                            $values = array('Graphic Design', 'Website');
                            foreach($values as $key => $value) {
                                echo '<option value="'.$value.'">'.$value.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter project description..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="https://example.com">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">Clear</button>
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

include('includes/footer.php');

?>