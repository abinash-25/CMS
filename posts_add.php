<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

if (isset($_POST['title'])) {
    if ($stm = $connect->prepare('INSERT INTO posts (title, content, author, date) VALUES (?, ?, ?, ?)')) {
        $stm->bind_param('ssis', $_POST['title'], $_POST['content'], $_SESSION['id'],  $_POST['date']);
        $stm->execute();
        $stm->close();

        set_message("A new post " . $_SESSION['username'] . " has been added");
        header('Location: posts.php');
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}

include('includes/header.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="display-4">Add Post</h1>
            
            <form method="post">
                <!-- Title input -->
                <div class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" />
                    <label class="form-label" for="title">Title</label>
                </div>

                <!-- Content input -->
                <div class="form-outline mb-4">
                    <textarea name="content" id="content" class="form-control" rows="5"></textarea>
                    <label class="form-label" for="content">Content</label>
                </div>

                <!-- Date input -->
                <div class="form-outline mb-4">
                    <input type="date" id="date" name="date" class="form-control" />
                    <label class="form-label" for="date">Date</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Add Post</button>
            </form>
        </div>
    </div>
</div>

<!-- Include TinyMCE JavaScript -->
<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',  // Initialize TinyMCE on the textarea
        height: 300           // Optional: Set the height of the editor
    });
</script>

<?php
include('includes/footer.php');
?>
