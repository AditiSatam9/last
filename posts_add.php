<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_file'])) {
    $month1 = $_POST['month1'];
    $month2 = $_POST['month1'];
    $year = $_POST['year'];
    $volume = $_POST['volume'];
    $issue = $_POST['issue'];

    // Ensure the 'uploads' directory exists and is writable
    $uploads_dir = 'uploads';
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true); // Create the directory if it does not exist
    }

    // Ensure the year subdirectory exists
    $year_dir = $uploads_dir . '/' . $year;
    if (!is_dir($year_dir)) {
        mkdir($year_dir, 0777, true); // Create the directory if it does not exist
    }

    // Create the dynamic file name based on form inputs
    $pdf_file = 'sirb' . $issue . '.pdf';
    $pdf_file_path = $year_dir . '/' . $pdf_file;

    // Move the uploaded file to the year subdirectory
    if (move_uploaded_file($_FILES['URL']['tmp_name'], $pdf_file_path)) {
        $mmyy = "{$month1}-{$year}";

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO sirb (URL, issue, mmyy, volno, mm1, mm2, yy) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$pdf_file, $issue, $mmyy, $volume, $month1, $month2, $year]);

        // Log the transaction
        $user = $_SESSION['username'];
        $action = 'Add';
        $description = "Added file with issue: $issue, volume: $volume, year: $year";
        $log_stmt = $pdo->prepare("INSERT INTO transaction_log (action, user, description) VALUES (?, ?, ?)");
        $log_stmt->execute([$action, $user, $description]);

        set_message("A new post added by " . $_SESSION['username']);
        $stmt->closeCursor();

        header("Location: posts.php?message=File added successfully");
        exit();
    } else {
        echo "Failed to upload the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Add New File</title>
</head>
<body>
    <div class="container">
        <h2>Add New File</h2>

        <!-- Form to add new file -->
        <form id="addFileForm" method="post" action="posts_add.php" enctype="multipart/form-data">
            <label for="month1">Month:</label><br>
            <select id="month" name="month1" required onchange="updateIssue()">
                <option value="">Select Month</option>
                <option value="Jan">Jan</option>
                <option value="Feb">Feb</option>
                <option value="Mar">Mar</option>
                <option value="Apr">Apr</option>
                <option value="May">May</option>
                <option value="Jun">Jun</option>
                <option value="Jul">Jul</option>
                <option value="Aug">Aug</option>
                <option value="Sep">Sep</option>
                <option value="Oct">Oct</option>
                <option value="Nov">Nov</option>
                <option value="Dec">Dec</option>
            </select><br><br>

            <?php
            $current_year = date('Y');
            $year_range = range($current_year - 14, $current_year);
            ?>

            <label for="year">Year:</label><br>
            <select id="year" name="year" required>
                <option value="">Select Year</option>
                <?php foreach ($year_range as $yr): ?>
                    <option value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="volume">Volume:</label><br>
            <input type="number" id="volume" name="volume" required><br><br>

            <label for="issue">Issue:</label><br>
            <input type="number" id="issue" name="issue" required readonly><br><br>

            <label for="pdf_file">PDF File:</label><br>
            <input type="file" id="pdf_file" name="URL" accept="application/pdf" required><br><br>

            <button type="submit" name="add_file">Upload File</button>
        </form>
    </div>

    <script>
        function updateIssue() {
            const monthSelect = document.getElementById('month');
            const issueInput = document.getElementById('issue');
            const monthToIssue = {
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
</body>
</html>
