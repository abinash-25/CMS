<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

if (isset($_POST['title'])) {

    if ($stm = $connect->prepare('UPDATE posts SET title = ?, content = ?, date = ? WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['title'], $_POST['content'], $_POST['date'], $_GET['id']);
        $stm->execute();
        $stm->close();

        set_message("A post with ID " . $_GET['id'] . " has been updated");
        header('Location: posts.php');
        die();
    } else {
        echo 'Could not prepare post update statement!';
    }
}

if (isset($_GET['id'])) {

    if ($stm = $connect->prepare('SELECT * FROM posts WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $result = $stm->get_result();
        $post = $result->fetch_assoc();

        if ($post) {
            include('includes/header.php');
            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-1">Edit Post</h1>

                        <form method="post">
                            <!-- Title input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="title" name="title" class="form-control"
                                    value="<?php echo htmlspecialchars($post['title']); ?>" />
                                <label class="form-label" for="title">Title</label>
                            </div>

                            <!-- Content input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <textarea name="content" id="content" class="form-control"
                                    rows="10"><?php echo $post['content']; ?></textarea>
                                <label class="form-label" for="content">Content</label>
                            </div>

                            <!-- Date input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="date" id="date" name="date" class="form-control"
                                    value="<?php echo $post['date']; ?>" />
                                <label class="form-label" for="date">Date</label>
                            </div>

                            <!-- Submit button -->
                            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Edit Post</button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="js/tinymce/tinymce.min.js"></script>
            <script>
                tinymce.init({
                    selector: '#content',
                    height: 300
                });
            </script>

            <?php
        }
        $stm->close();
    } else {
        echo 'Could not prepare statement!';
    }

} else {
    echo "No post selected";
    die();
}

include('includes/footer.php');
?>
