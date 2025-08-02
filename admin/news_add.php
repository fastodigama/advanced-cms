<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['title'])) {
    if ($stm = $connect->prepare('INSERT INTO news (title, content, publish_date, created_at) VALUES (?, ?, ?, NOW())')) {
        $stm->bind_param('sss', $_POST['title'], $_POST['content'], $_POST['publish_date']);
        $stm->execute();
        $stm->close();

        set_message("News article " . $_POST['title'] . " has been added");
        header('Location: news.php');
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Add News</h1>

            <form method="post">
               
                <div class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" required />
                    <label class="form-label" for="title">Title</label>
                </div>

                
                <div class="form-outline mb-4">
                    <textarea id="content" name="content" class="form-control" required></textarea>
                    <label class="form-label" for="content">Content</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="date" id="publish_date" name="publish_date" class="form-control" required />
                    <label class="form-label" for="publish_date">Publish Date</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Add News</button>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>