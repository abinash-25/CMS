<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1 class="display-1">Dashboard</h1>

            <a href="users.php" class="btn btn-primary">Users Management</a> 
            <a href="posts.php" class="btn btn-primary">Posts Management</a>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>