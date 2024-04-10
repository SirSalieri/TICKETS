<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: unauthorized_page.html");
    exit();
}
?>

<body>
    <h2><?= $article_id ? 'Edit Article' : 'Add New Article'; ?></h2>
    <form action="<?= $article_id ? "edit_article.php?id=" . htmlspecialchars($article_id) : "edit_article.php"; ?>" method="post">
        <?php if ($article_id): ?>
            <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($article_id); ?>">
        <?php endif; ?>
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article_data['title'] ?? ''); ?>" required><br><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50" required><?php echo htmlspecialchars($article_data['content'] ?? ''); ?></textarea><br><br>
        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($article_data['category'] ?? ''); ?>" required><br><br>
        <label for="image_url">Image URL:</label><br>
        <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($article_data['image_url'] ?? ''); ?>"><br><br>
        <input type="submit" value="<?= $article_id ? 'Update Article' : 'Add Article'; ?>">
    </form>
</body>


<div id="add-article-section" style="display: none;">
            <h2>Add New Article</h2>
            <form method="post" action="add_article_handler.php"> <!-- This should be the actual PHP file that will handle the article addition -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" name="category">
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL:</label>
                    <input type="text" class="form-control" id="image_url" name="image_url">
                </div>
                <button type="submit" class="btn btn-success">Add Article</button>
                <button type="button" class="btn btn-link" onclick="showSearchArticlesForm()">Edit Existing Article</button>
            </form>
        </div>