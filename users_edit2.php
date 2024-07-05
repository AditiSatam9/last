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

<style>
    /* Global styles */
    body {
        background-color: #f8f9fa; /* Light gray background */
        color: #343a40; /* Dark text color */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 50%;
        margin: 0 auto;
        padding-top: 2rem;
    }

    .form-outline {
        width: 100%;
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-outline input,
    .form-outline select {
        width: calc(100% - 2rem);
        padding: 0.5rem 1rem;
        background-color: #ffffff; /* White background */
        border: 1px solid #ced4da; /* Light gray border */
        color: #495057; /* Dark text color */
        border-radius: 0.25rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-outline input:focus,
    .form-outline select:focus {
        outline: none;
        border-color: #ffc107; /* Yellow border on focus */
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .form-outline label {
        position: absolute;
        top: 0.5rem;
        left: 1rem;
        color: #6c757d; /* Medium gray label color */
        pointer-events: none;
        transition: top 0.2s ease, left 0.2s ease, color 0.2s ease;
    }

    .form-outline input:focus ~ label,
    .form-outline input:not(:placeholder-shown) ~ label,
    .form-outline select:focus ~ label,
    .form-outline select:not(:placeholder-shown) ~ label {
        top: -0.5rem;
        left: 1rem;
        color: #ffc107; /* Yellow label color on focus */
        font-size: 1rem;
        background-color: transparent;
        padding: 0 0.25rem;
    }

    .form-outline select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .btn-primary {
        background-color: #007bff; /* Blue primary button */
        color: #fff; /* White text */
        border: none;
        padding: 0.75rem 1rem;
        cursor: pointer;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    .btn-block {
        display: block;
        width: 100%;
    }

    .row.justify-content-center {
        margin: 0;
    }

    .col-md-6 {
        padding: 0 15px;
    }

    /* Go back link styles */
    .goback-container {
        text-align: left;
        margin-left: 30px;
        margin-top: 30px;
        display: flex;
        align-items: center;
    }

    .goback-link {
        text-decoration: none;
        color: #007bff; /* Blue link color */
        padding: 10px 20px;
        border: 1px solid #007aff; /* Blue border */
        border-radius: 4px;
        background-color: #fff; /* White background */
        display: inline-block;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    .goback-link:hover {
        background-color: #007aff; /* Blue background on hover */
        color: #fff; /* White text on hover */
    }
</style>


<div class="goback-container">
    <a class="goback-link" href="users.php">Go Back</a>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Edit User</h1>

            <form method="post">
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $user['username'] ?>" />
                    <label class="form-label" for="username">Username</label>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email'] ?>" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Active select -->
                <div class="form-outline mb-4">
                    <select name="active" class="form-select" id="active">
                        <option <?php echo ($user['active'] == 1) ? "selected" : ""; ?> value="1">Active</option>
                        <option <?php echo ($user['active'] == 0) ? "selected" : ""; ?> value="0">Inactive</option>
                    </select>
                </div>

                <!-- Role select -->
                <div class="form-outline mb-4">
                    <select name="role" class="form-select" id="role">
                        <option value="admin" <?php echo ($user['role'] == 'admin') ? "selected" : ""; ?>>Admin</option>
                        <option value="user" <?php echo ($user['role'] == 'user') ? "selected" : ""; ?>>User</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Update user</button>
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
