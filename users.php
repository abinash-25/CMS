<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

if (isset($_GET['delete'])) {
    if ($stm = $connect->prepare('DELETE FROM users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();
        
        set_message("User " . $_GET['delete'] . " has been deleted");
        header('Location: users.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}

if ($stm = $connect->prepare('SELECT * FROM users')) {
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
        include('includes/header.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4">Users Management</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Edit | Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($record = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['username']); ?></td>
                        <td><?php echo htmlspecialchars($record['email']); ?></td>
                        <td><?php echo ($record['active'] == 1) ? 'Active' : 'Inactive'; ?></td>
                        <td>
                            <a href="users_edit.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-warning btn-sm">Edit</a> | 
                            <a href="users.php?delete=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="users_add.php" class="btn btn-success">Add New User</a>
        </div>
    </div>
</div>
<?php
    } else {
        echo 'No users found';
    }
    
    $stm->close();
} else {
    echo 'Could not prepare statement!';
}

include('includes/footer.php');
?>