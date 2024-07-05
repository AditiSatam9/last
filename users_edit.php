<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $hashed = SHA1($_POST['password']);
    $active = $_POST['active'];
    $id = $_GET['id'];
    $admin = $_POST['role'];

    if ($stm = $pdo->prepare('UPDATE users SET username = ?, email = ?, password = ?, active = ?, role = ? WHERE id = ?')) {
        $stm->bindValue(1, $username, PDO::PARAM_STR);
        $stm->bindValue(2, $email, PDO::PARAM_STR);
        $stm->bindValue(3, $hashed, PDO::PARAM_STR);
        $stm->bindValue(4, $active, PDO::PARAM_INT);
        $stm->bindValue(5, $admin, PDO::PARAM_STR);
        $stm->bindValue(6, $id, PDO::PARAM_INT);

        $stm->execute();
        $stm->closeCursor();

        set_message("A user with id: " . $_GET['id'] . " has been updated");
        header('Location: users.php');
        die();

    } else {
        echo 'Could not prepare user update statement!';
    }
}

if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    if ($stm = $pdo->prepare('SELECT * FROM users WHERE id = ?')) {
        $stm->bindValue(1, $deleteId, PDO::PARAM_INT);
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

<div class="container mt-5 bg-light">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1 text-dark">Edit User</h1>

            <form method="post">
                <!-- Username input -->
                <div class="mb-4">
                    <label for="username" class="form-label text-dark">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $user['username'] ?>" />
                </div>
                <!-- Email input -->
                <div class="mb-4">
                    <label for="email" class="form-label text-dark"  >Email address</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email'] ?>" />
                </div>

                <!-- Password input -->
                <!-- <div class="mb-4">
                    <label for="password" class="form-label text-dark" style= "margin-top : 10 px" >Password</label>
                    <input type="password" id="password" name="password" class="form-control" />
                </div> -->

                <!-- Active select -->
                <div class="mb-4">
                    <label for="active" class="form-label text-dark" >Status</label>
                    <select style= "margin-top : 20px" name="active" class="form-select" id="active">
                        <option value="1" <?php echo ($user['active'] == 1) ? "selected" : ""; ?>>Active</option>
                        <option value="0" <?php echo ($user['active'] == 0) ? "selected" : ""; ?>>Inactive</option>
                    </select>
                </div>

                <!-- Role select -->
                <div class="mb-4">
                    <label for="role" class="form-label text-dark"  >Role</label>
                    <select style= "margin-top : 20px" name="role" class="form-select" id="role">
                        <option value="admin" <?php echo ($user['role'] == 'admin') ? "selected" : ""; ?>>Admin</option>
                        <option value="user" <?php echo ($user['role'] == 'user') ? "selected" : ""; ?>>User</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" style= "margin-top : 20px" class="btn btn-dark btn-block">Update user</button>
            </form>
        </div>
    </div>
</div>

<?php
        }
        $stm->closeCursor();
    } else {
        echo 'Could not prepare statement!';
    }
} else {
    echo "No user selected";
    die();
}

include('includes/footer.php');
?>
