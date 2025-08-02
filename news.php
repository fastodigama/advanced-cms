<?php
include('admin/includes/config.php');
include('admin/includes/database.php');
include('admin/includes/functions.php');

include('admin/includes/header.php');

if ($stm = $connect->prepare('SELECT * FROM news WHERE publish_date <= CURDATE() ORDER BY publish_date DESC')) {
    $stm->execute();
    $result = $stm->get_result();
?>

<div class="container mt-5">
    <h1 class="display-4 text-center">Latest News</h1>
    <div class="row">
        <?php while ($news = $result->fetch_assoc()) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars(substr($news['content'], 0, 150)) . '...'; ?></p>
                        <p class="card-text"><small class="text-muted">Published: <?php echo $news['publish_date']; ?></small></p>
                        <a href="news_detail.php?id=<?php echo $news['id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
    $stm->close();
} else {
    echo 'Could not prepare statement!';
}
include('admin/includes/footer.php');
?>