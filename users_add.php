<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed = sha1($password); // Use more secure hashing methods for production (e.g., password_hash())
    $active = $_POST['active'];
    $admin = $_POST['role'];

    if ($stm = $pdo->prepare('INSERT INTO users (username, email, password, active, role) VALUES (?, ?, ?, ?, ?)')) {
        $stm->bindValue(1, $username, PDO::PARAM_STR);
        $stm->bindValue(2, $email, PDO::PARAM_STR);
        $stm->bindValue(3, $hashed, PDO::PARAM_STR);
        $stm->bindValue(4, $active, PDO::PARAM_INT);
        $stm->bindValue(5, $admin, PDO::PARAM_STR);

        $stm->execute();

        set_message("A new user " . $_SESSION['username'] . " has been added");
        header('Location: users.php');
        exit(); // Use exit() instead of die() for better practice
    } else {
        echo 'Could not prepare statement!';
    }
}
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
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="display-4 text-center mb-4">Add User</h1>
                    <form method="post">
                        <!-- Username input -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>

                        <!-- Email input -->
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <!-- Password input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input style = "margin-top : 20px" type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <!-- Active select -->
                        <div class="form-group">
                            <label for="active">Status</label>
                            <select style = "margin-top : 20px" name="active" class="form-control" id="active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- Admin select -->
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select style = "margin-top : 20px" name="role" class="form-control" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <!-- Submit button -->
                        <div class="text-center">
                            <button style = "margin-top : 20px" type="submit" class="btn btn-primary btn-block">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
