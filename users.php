<!-- use the css from the above code as a reference, definitely use the same bootstrap and use a light theme instead of dark and apply the clean bootstrap + css deign i bright pallet to the following code
  -->
<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_GET['delete'])) {
    // Delete user if delete parameter is set
    $deleteId = $_GET['delete'];
    $stm = $pdo->prepare('DELETE FROM users WHERE id = ?');

    if ($stm) {
        $stm->bindValue(1, $deleteId, PDO::PARAM_INT);
        $stm->execute();

        set_message("User with ID {$deleteId} has been deleted");
        header('Location: users.php');
        exit();
    } else {
        echo 'Could not prepare delete statement!';
    }
}

if ($stm = $pdo->prepare('SELECT * FROM users')){
    $stm->execute();


    $result = $stm->fetchAll(PDO::FETCH_ASSOC);


    
    if ($result){
  


?>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <h1 class="display-1" style="text-align: center;">Users management</h1>

          <!-- Search Bar -->
<!--            
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          Custom CSS
    <style>
        /* Adjust as needed */
        .container {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 0;
        }
    </style>
          <div class="form-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by Username">
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#searchInput').on('keyup', function(){
                var searchText = $(this).val().toLowerCase();
                $('#userTable tbody tr').each(function(){
                    var usernameText = $(this).find('td:first').text().toLowerCase();
                    if(usernameText.includes(searchText)){
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script> -->


<style>
    .btn-light {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #f0f0f0; /* Light grey background */
        color: #333; /* Dark text color */
        border: 1px solid #ccc; /* Light grey border */
        border-radius: 4px; /* Rounded corners */
        text-decoration: none; /* Remove underline */
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    .btn-light:hover {
        background-color: #e0e0e0; /* Slightly darker background on hover */
        color: #333; /* Dark text color on hover */
        border-color: #aaa; /* Darker border color on hover */
    }
</style>

<a href="users_add.php" class="btn-light">Add new user</a>





        <table id="example2" class="table table-striped table-hover" style="width:100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete </th>
            <th>Reset </th>
                

         </tr>
         </thead>
         <tbody>


         <?php foreach ($result as $record) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($record['id']); ?> </td>
                                <td><?php echo htmlspecialchars($record['username']); ?> </td>
                                <td><?php echo htmlspecialchars($record['email']); ?> </td>
                                <td><?php echo htmlspecialchars($record['active']); ?> </td>
                                <td><?php echo htmlspecialchars($record['role']); ?> </td>
                                <td>
                                <button class= " rounded-button" style=" color: #fff; border: none; padding: 5px 10px; cursor: pointer; margin-right: 5px;" onclick="location.href='users_edit.php?id=<?php echo htmlspecialchars($record['id']); ?>'">Edit</button></td>
<td> <button class= " rounded-button2" style="color: #fff; border: none; padding: 5px 10px; cursor: pointer; text-decoration: none;" onclick="showDeleteModal('<?php echo htmlspecialchars($record['id']); ?>')">Delete</button></td>
<td> <button class= " rounded-button" style=" color: #fff; border: none; padding: 5px 10px; cursor: pointer; margin-right: 5px;" onclick="location.href='reset.php?id=<?php echo htmlspecialchars($record['id']); ?>'">Reset</button></td>

<!-- Modal structure (hidden by default) -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="background-color: #fff; width: 300px; margin: 15% auto; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
        <p style="color: #000;">Are you sure you want to delete this user?</p>
        <div style="text-align: center;">
            <button class= " rounded-button" style="background-color: #dc3545; color: #fff; border: none; padding: 5px 10px; cursor: pointer; text-decoration: none; margin-right: 10px;" onclick="deleteUser('<?php echo htmlspecialchars($record['id']); ?>')">Delete</button>
            <button class= " rounded-button2 "style="background-color: #6c757d; color: #fff; border: none; padding: 5px 10px; cursor: pointer; text-decoration: none;" onclick="hideDeleteModal()">Cancel</button>
        </div>
    </div>
</div>


<script>
    function showDeleteModal(userId) {
        var modal = document.getElementById('deleteModal');
        modal.style.display = 'block';
        // Store the user ID in a data attribute for later use
        modal.setAttribute('data-user-id', userId);
    }

    function hideDeleteModal() {
        var modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
        // Clear the stored user ID
        modal.removeAttribute('data-user-id');
    }

    function deleteUser(userId) {
        // Construct the delete URL using the stored user ID
        var deleteUrl = 'users.php?delete=' + encodeURIComponent(userId);
        // Redirect to delete URL
        location.href = deleteUrl;
    }
</script>


</td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                    


                </div>
            </div>
        </div>
        
<script>
 new DataTable('#example2');

 </script>
<?php
   } else 
   {
    echo 'No users found';
   }

    
   $stm->closeCursor();

} else {
   echo 'Could not prepare statement!';
}
include('includes/footer.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
    <link href="DataTables/datatables.css" rel="stylesheet">
    <script src="bootstrap-4.0.0-dist/js/bootstrap.js"></script>
    <script src="jquery-3.7.1.min.js"></script>
<script src="DataTables/datatables.js"></script>


    <title>SIR Bulletin User CMS</title>
</head>
<body>
</body>

</html>