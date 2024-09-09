<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

if (isset($_POST['username'])) {
    if ($stm = $connect->prepare('UPDATE users SET username = ?, email = ?, active = ? WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['active'], $_GET['id']);
        $stm->execute();
        $stm->close();

        if (isset($_POST['password'])) {
            if ($stm = $connect->prepare('UPDATE users SET password = ? WHERE id = ?')) {
                $hashed = SHA1($_POST['password']);
                $stm->bind_param('si', $hashed, $_GET['id']);
                $stm->execute();
                $stm->close();
            } else {
                echo 'Could not prepare password update statement!';
            }
        }

        set_message("User " . $_GET['id'] . " has been updated");
        header('Location: users.php');
        die();
    } else {
        echo 'Could not prepare user update statement!';
    }
}

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            include('includes/header.php');
            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-4">Edit User</h1>

                        <form method="post">
                            <!-- Username input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required />
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <!-- Active select -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <select name="active" class="form-select" id="active" required>
                                    <option value="1" <?php echo ($user['active'] == 1) ? "selected" : ""; ?>>Active</option>
                                    <option value="0" <?php echo ($user['active'] == 0) ? "selected" : ""; ?>>Inactive</option>
                                </select>
                                <label class="form-label" for="active">Status</label>
                            </div>

                            <!-- Submit button -->
                            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        $stm->close();
    } else {
        echo 'Could not prepare statement!';
    }
} else {
    echo "No user selected";
    die();
}

include('includes/footer.php');
?>
