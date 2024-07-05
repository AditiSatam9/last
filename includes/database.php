<!-- <?php 
// $connect = mysqli_connect('localhost','root', 'test', 'cms');
// if(mysqli_connect_errno()){
//      exit('Failed to connect to MySQL:' . mysqli_connect_error());
   
// } 

?> -->
 <?php
$host = 'localhost';
$dbname = 'cmsc_new';
$username = 'root'; // Update with your MySQL username
$password = 'aditi'; // Update with your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?> 