<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

// if(isset($_SESSION['id'])){
//     header('Location: dashboard.php');
//     die();
// }


include('includes/header.php');



if (isset($_POST['username'])) {
    if ($stm = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ? AND active = 1'))
    {
        $hashed = SHA1($_POST['password']);
        $username = $_POST['username'];

        // Bind parameters using bindValue (alternative method)
        $stm->bindValue(1, $username, PDO::PARAM_STR);
        $stm->bindValue(2, $hashed, PDO::PARAM_STR);

        // Execute statement
        $stm->execute();

        
         // Fetch the user
         $user = $stm->fetch(PDO::FETCH_ASSOC);
        

        if ($user){
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

        if ($user['role'] == "admin") {
            $_SESSION['is_admin'] = true; // Set admin session flag
            set_message("You have succesfully logged in " . $_SESSION['username']);
             header('Location: dashboard2.php');
            die();
        } 
       if ($user['role'] == "user") {
            $_SESSION['is_admin'] = false; // Clear admin session flag for non-admin users
            set_message("You have succesfully logged in " . $_SESSION['username']);
             header('Location: dashboard.php');
            die();
        }
            
        $stm->close();

    } else {
        echo 'Could not prepare statement!';
    }


    }}

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                   
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                
                    <label class="form-label" for="password">Password</label><br>
                    <input type="password" id="password"  name="password" class="form-control" />
                    
                </div>

   

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>

    </div>
</div>


<?php
include('includes/footer.php');
?>