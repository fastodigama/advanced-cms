<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM news WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $result = $stm->get_result();
        $news = $result->fetch_assoc();
        $stm->close();

        if (!$news) {
            set_message("News article not found!");
            header('Location: news.php');
            die();
        }
    } else {
        echo 'Could not prepare statement!';
        die();
    }
} else {
    set_message("No news ID provided!");
    header('Location: news.php');
    die();
}

if (isset($_POST['title'])) {
    if ($stm = $connect->prepare('UPDATE news SET title = ?, content = ?, publish_date = ? WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['title'], $_POST['content'], $_POST['publish_date'], $_GET['id']);
        $stm->execute();
        $stm->close();

        set_message("News article " . $_POST['title'] . " has been updated");
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
            <h1 class="display-1">Edit News</h1>

            <form method="post">
                
                <div class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($news['title']); ?>" required />
                    <label class="form-label" for="title">Title</label>
                </div>

              
                <div class="form-outline mb-4">
                    <textarea id="content" name="content" class="form-control" required><?php echo htmlspecialchars($news['content']); ?></textarea>
                    <label class="form-label" for="content">Content</label>
                </div>

                
                <div class="form-outline mb-4">
                    <input type="date" id="publish_date" name="publish_date" class="form-control" value="<?php echo $news['publish_date']; ?>" required />
                    <label class="form-label" for="publish_date">Publish Date</label>
                </div>

                
                <button type="submit" class="btn btn-primary btn-block">Update News</button>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>