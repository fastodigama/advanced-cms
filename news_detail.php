<?php
include('admin/includes/config.php');
include('admin/includes/database.php');
include('admin/includes/functions.php');

include('admin/includes/header.php');

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM news WHERE id = ? AND publish_date <= CURDATE()')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $result = $stm->get_result();
        $news = $result->fetch_assoc();
        $stm->close();

        if ($news) {
?>

<div class="container mt-5">
    <h1 class="display-4"><?php echo htmlspecialchars($news['title']); ?></h1>
    <p class="text-muted">Published: <?php echo $news['publish_date']; ?></p>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
        </div>
    </div>
    <a href="news.php" class="btn btn-secondary mt-3">Back to News</a>
</div>

<?php
        } else {
            echo '<div class="container mt-5"><p>News article not found or not yet published.</p></div>';
        }
    } else {
        echo 'Could not prepare statement!';
    }
} else {
    echo '<div class="container mt-5"><p>No news ID provided.</p></div>';
}

include('admin/includes/footer.php');
?>