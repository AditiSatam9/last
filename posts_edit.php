<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

try {
    // Check if POST request is made and update_file button is clicked
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_file'])) {
        $id = $_POST['id'];
        $month1 = $_POST['month'];
        $year = $_POST['year'];
        $volume = $_POST['volume'];
        $issue = $_POST['issue'];
        $pdf_file = $_FILES['pdf_file']['name'];
        $pdf_file_tmp_name = $_FILES['pdf_file']['tmp_name'];
        $pdf_file_error = $_FILES['pdf_file']['error'];
        $pdf_file_size = $_FILES['pdf_file']['size'];
        $pdf_file_type = $_FILES['pdf_file']['type'];

        // Fetch old file details
        $stmt = $pdo->prepare("SELECT * FROM sirb WHERE sirb_id = ?");
        $stmt->execute([$id]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set old and new directory and file names
        $old_directory = 'uploads/' . $file['yy'];
        $new_directory = 'uploads/' . $year;

        // Old file path and new file details
        $old_file_path = $old_directory . '/' . $file['URL'];
        $new_file_name = 'sirb' . $issue . '.pdf';  // New file name based on issue
        $new_file_path = $new_directory . '/' . $new_file_name;

        // Set the new mmyy value
        $new_mmyy = "{$month1}-{$year}";

        // Update database
        $stmt = $pdo->prepare("UPDATE sirb SET mm1 = ?, mm2 = ?, yy = ?, volno = ?, issue = ?, mmyy = ?, URL = ? WHERE sirb_id = ?");
        $stmt->execute([$month1, $month1, $year, $volume, $issue, $new_mmyy, $new_file_name, $id]);

        // Handle file upload
        if ($pdf_file) {
            if ($pdf_file_error === 0) {
                // Ensure the new directory exists
                if (!is_dir($new_directory)) {
                    mkdir($new_directory, 0777, true);
                }

                // Move the uploaded PDF file to the new directory
                move_uploaded_file($pdf_file_tmp_name, $new_file_path);

                // Remove the old file if it exists
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            } else {
                // Handle errors (e.g., file upload issues)
                echo "Error uploading the PDF file.";
            }
        } else {
            // If no new file is uploaded, rename the old file if the issue number changed
            if ($file['URL'] !== $new_file_name) {
                // Ensure the new directory exists
                if (!is_dir($new_directory)) {
                    mkdir($new_directory, 0777, true);
                }

                // Rename the old PDF file to the new name
                rename($old_file_path, $new_file_path);
            }

            // If the year has changed, move the file to the new directory
            if ($file['yy'] !== $year) {
                // Ensure the new directory exists
                if (!is_dir($new_directory)) {
                    mkdir($new_directory, 0777, true);
                }

                // Move the PDF file from the old directory to the new one
                rename($old_file_path, $new_file_path);
            }
        }

        // Check if the old directory is empty and delete it if it is
        if ($file['yy'] !== $year) {
            if (is_dir_empty($old_directory)) {
                rmdir($old_directory); // Remove the old directory if empty
            }
        }

        // Log the transaction
        $user = $_SESSION['username'];
        $action = 'Update';
        $description = "Updated file with ID: $id, new month: $month1, new year: $year, new volume: $volume, new issue: $issue, new file name: $new_file_name";
        $log_stmt = $pdo->prepare("INSERT INTO transaction_log (action, user, description) VALUES (?, ?, ?)");
        $log_stmt->execute([$action, $user, $description]);

        // Redirect back to posts.php after update
        header("Location: posts.php?message=File updated successfully");
        exit();
    }

    // Fetch file details based on ID from URL parameter
    if (isset($_GET['sirb_id'])) {
        $id = $_GET['sirb_id'];
        $stmt = $pdo->prepare("SELECT * FROM sirb WHERE sirb_id = ?");
        $stmt->execute([$id]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Redirect to posts.php if ID is not provided
        header("Location: posts.php?message=File updated successfully");
        exit();
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Function to check if a directory is empty
function is_dir_empty($dir) {
    if (!is_readable($dir)) return false;
    return (count(scandir($dir)) == 2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit File</title>
    <script>
        function setIssueBasedOnMonth() {
            var monthSelect = document.getElementById("month");
            var issueInput = document.getElementById("issue");
            var monthToIssue = {
                'Jan': '01',
                'Feb': '02',
                'Mar': '03',
                'Apr': '04',
                'May': '05',
                'Jun': '06',
                'Jul': '07',
                'Aug': '08',
                'Sep': '09',
                'Oct': '10',
                'Nov': '11',
                'Dec': '12'
            };
            issueInput.value = monthToIssue[monthSelect.value] || '';
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Edit File</h2>

        <!-- Form to edit file details -->
        <form method="post" action="posts_edit.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $file['sirb_id']; ?>">

            <label for="month">Month:</label><br>
            <select id="month" name="month" onchange="setIssueBasedOnMonth()" required>
                <option value="">Select Month</option>
                <option value="Jan" <?php if ($file['mm1'] == 'Jan') echo 'selected'; ?>>Jan</option>
                <option value="Feb" <?php if ($file['mm1'] == 'Feb') echo 'selected'; ?>>Feb</option>
                <option value="Mar" <?php if ($file['mm1'] == 'Mar') echo 'selected'; ?>>Mar</option>
                <option value="Apr" <?php if ($file['mm1'] == 'Apr') echo 'selected'; ?>>Apr</option>
                <option value="May" <?php if ($file['mm1'] == 'May') echo 'selected'; ?>>May</option>
                <option value="Jun" <?php if ($file['mm1'] == 'Jun') echo 'selected'; ?>>Jun</option>
                <option value="Jul" <?php if ($file['mm1'] == 'Jul') echo 'selected'; ?>>Jul</option>
                <option value="Aug" <?php if ($file['mm1'] == 'Aug') echo 'selected'; ?>>Aug</option>
                <option value="Sep" <?php if ($file['mm1'] == 'Sep') echo 'selected'; ?>>Sep</option>
                <option value="Oct" <?php if ($file['mm1'] == 'Oct') echo 'selected'; ?>>Oct</option>
                <option value="Nov" <?php if ($file['mm1'] == 'Nov') echo 'selected'; ?>>Nov</option>
                <option value="Dec" <?php if ($file['mm1'] == 'Dec') echo 'selected'; ?>>Dec</option>
            </select><br><br>

            <label for="year">Year:</label><br>
            <select id="year" name="year" required>
                <option value="">Select Year</option>
                <?php
                $current_year = date('Y');
                $year_range = range($current_year - 14, $current_year);
                foreach ($year_range as $yr) {
                    $selected = ($file['yy'] == $yr) ? 'selected' : '';
                    echo "<option value='{$yr}' {$selected}>{$yr}</option>";
                }
                ?>
            </select><br><br>

            <label for="volume">Volume:</label><br>
            <input type="number" id="volume" name="volume" value="<?php echo $file['volno']; ?>" required><br><br>

            <label for="issue">Issue:</label><br>
            <input type="number" id="issue" name="issue" value="<?php echo $file['issue']; ?>" required readonly><br><br>

            <label for="new_pdf_file">New PDF File:</label><br>
            <input type="file" id="new_pdf_file" name="pdf_file" accept="application/pdf"><br><br>

            <button type="submit" name="update_file">Update File</button>
        </form>
    </div>
    <script>
        // Set the issue value based on the selected month on page load
        setIssueBasedOnMonth();
    </script>
</body>
</html>
