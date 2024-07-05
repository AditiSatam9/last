<?php
include('includes/database.php'); // Include database connection
include('includes/config.php');
include('includes/functions.php');
secure();
include('includes/header.php');

try {
    // Check if delete button is clicked and parameters are set
    if (isset($_GET['sirb_id'])) {
        $id = $_GET['sirb_id'];
        
        // Fetch the file details to get the year and URL
        $fetch_sql = "SELECT yy, URL FROM sirb WHERE sirb_id = :id";
        $fetch_stmt = $pdo->prepare($fetch_sql);
        $fetch_stmt->bindParam(':id', $id);
        $fetch_stmt->execute();
        $file = $fetch_stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $year = $file['yy'];
            $fileURL = $file['URL'];
            
            // Delete the file from the server
            $filePath = "uploads/{$year}/{$fileURL}";
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Delete the record from the database
            $delete_sql1 = "DELETE FROM sirb WHERE sirb_id = :id";
            $delete_stmt1 = $pdo->prepare($delete_sql1);
            $delete_stmt1->bindParam(':id', $id);
            $delete_stmt1->execute();

            // Check if the year directory is empty and delete it if it is
            $yearDir = "uploads/{$year}";
            if (is_dir($yearDir) && count(glob("{$yearDir}/*")) === 0) {
                rmdir($yearDir); // Remove the empty year directory
            }

            // Log the transaction
            $user = $_SESSION['username'];
            $action = 'Delete';
            $description = "Deleted file with ID: $id, year: $year, URL: $fileURL";
            $log_stmt = $pdo->prepare("INSERT INTO transaction_log (action, user, description) VALUES (?, ?, ?)");
            $log_stmt->execute([$action, $user, $description]);

            // Redirect to posts.php
            header("Location: posts.php?message=File deleted successfully");
            exit();
        } else {
            // If file does not exist, redirect to posts.php
            header("Location: posts.php?message=File deleted successfully");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "PDO exception failed: " . $e->getMessage();
}
?>
