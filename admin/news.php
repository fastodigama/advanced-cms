<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if ($stm = $connect->prepare('SELECT * FROM news ORDER BY publish_date DESC')) {
    $stm->execute();
    $result = $stm->get_result();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="display-1">News Management</h1>
            <a href="news_add.php" class="btn btn-primary mb-3">Add New Article</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Publish Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($news = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($news['title']); ?></td>
                            <td><?php echo htmlspecialchars(substr($news['content'], 0, 100)) . '...'; ?></td>
                            <td><?php echo $news['publish_date']; ?></td>
                            <td>
                                <a href="news_edit.php?id=<?php echo $news['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete_news.php?id=<?php echo $news['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    $stm->close();
} else {
    echo 'Could not prepare statement!';
}
include('includes/footer.php');
?>