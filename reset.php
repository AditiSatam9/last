<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['password']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $password = $_POST['password'];

    // Hash the password using sha1
    $hashed_password = sha1($password);

    // Update the user's password in the database
    if ($stm = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')) {
        $stm->bindValue(1, $hashed_password, PDO::PARAM_STR);
        $stm->bindValue(2, $id, PDO::PARAM_INT);

        if ($stm->execute()) {
            set_message("Password updated successfully for user with ID: {$id}");
            header('Location: users.php');
            exit();
        } else {
            echo 'Failed to update password!';
        }
    } else {
        echo 'Could not prepare password update statement!';
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($stm = $pdo->prepare('SELECT * FROM users WHERE id = ?')) {
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if ($user) {
?>

<div class="goback-container bg-light" style="margin-left: 30px; margin-top: 30px; display: flex; align-items: center;">
    <button class="btn btn-dark goback-link" onclick="location.href='users.php';" style="display: flex; align-items: center;">
        <svg width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16" style="margin-right: 5px; transform: scaleX(-1);">
            <path fill-rule="evenodd" d="M10.354 4.354a.5.5 0 0 1 0 .708l-4.5 4.5a.5.5 0 0 1-.708-.708L9.293 5.5 5.146 1.354a.5.5 0 1 1 .708-.708l4.5 4.5z"/>
        </svg>
        <span style="font-size: 14px; color: white;">Go Back</span>
    </button>
</div>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-1">Reset User Password</h1>

                        <form method="post" action="">

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" />
                                <label class="form-label" for="password">New Password</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" style="margin-top: 20px; margin-left: 8px " class="btn btn-primary btn-block">Update Password</button>
                        </form>

                    </div>
                </div>
            </div>
<?php
        } else {
            echo 'User not found.';
        }
        $stm->closeCursor();
    } else {
        echo 'Could not prepare statement!';
    }
} else {
    echo "No user selected";
}

include('includes/footer.php');
?>
