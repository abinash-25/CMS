<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

if (isset($_GET['delete'])) {
    if ($stm = $connect->prepare('DELETE FROM posts WHERE id = ?')) {
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();

        set_message("Post ID " . $_GET['delete'] . " has been deleted");
        header('Location: posts.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}

if ($stm = $connect->prepare('SELECT * FROM posts')) {
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
        include('includes/header.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4">Posts Management</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author's ID</th>
                        <th>Content</th>
                        <th>Edit | Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($record = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['title']); ?></td>
                        <td><?php echo htmlspecialchars($record['author']); ?></td>
                        <td><?php echo $record['content']; // Display as HTML ?></td>
                        <td>
                            <a href="posts_edit.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-warning btn-sm">Edit</a> |
                            <a href="posts.php?delete=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="posts_add.php" class="btn btn-primary">Add New Post</a>
        </div>
    </div>
</div>
<?php
    } else {
        echo 'No posts found';
    }

    $stm->close();
} else {
    echo 'Could not prepare statement!';
}

include('includes/footer.php');
?>
