<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

// Fetch all files data with pagination
$stmt_files = $pdo->prepare("SELECT * FROM sirb ORDER BY yy, volno, issue");
$stmt_files->execute();
$files = $stmt_files->fetchAll(PDO::FETCH_ASSOC);

// Check for success message in URL
$message = '';
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
    <link href="DataTables/datatables.css" rel="stylesheet">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.js"></script>
    <script src="DataTables/datatables.js"></script>
    <title>SIR Bulletin CMS</title>
    <style>
        /* Custom modal styles */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100% - 1rem);
        }
        .modal-dialog {
            max-width: 400px;
            margin: 1.75rem auto;
        }
        .modal-body {
            text-align: center;
        }
        .modal-footer {
            justify-content: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>SIR Bulletin Content Management System</h2>
        <hr>

        <a href="posts_add.php" class="pdf-button2">Add File</a>
        <a href="transaction_log.php" class="pdf-button2">Transaction Log</a>


        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Cover Image</th>
                <th>Volume</th>
                <th>Issue</th>
                <th>Month</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
            <tr>
                <td>
                    <!-- Trigger Modal -->
                    <a href="#" class="popup-trigger" data-toggle="modal" data-target="#coverImageModal">
                        <div class="cover-image"><img src="images/logo3.png" alt="Cover Image"></div>
                    </a>
                </td>
                <td><div class="volume"><?php echo $file['volno']; ?></div></td>
                <td><div class="issue"><?php echo $file['issue']; ?></div></td>
                <td><div class="month"><?php echo ucfirst($file['mm1']); ?></div></td>
                <td><div class="year"><?php echo $file['yy']; ?></div></td>
                <td>
                    <div class="actions">
                        <a href="uploads/<?php echo $file['yy'] . '/' . $file['URL']; ?>" target="_blank" class="pdf-button2">View PDF</a>
                        <a href="posts_edit.php?sirb_id=<?php echo $file['sirb_id']; ?>" class="pdf-button2">Edit</a>
                        <button type="button" class="pdf-button2 delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $file['sirb_id']; ?>">Delete</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>

    <!-- Modal for Cover Image -->
    <div class="modal fade" id="coverImageModal" tabindex="-1" role="dialog" aria-labelledby="coverImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="modal-image" src="images/logo.png" alt="Cover Image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this file?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmDelete" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="top right">
        <div id="toast-message"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            new DataTable('#example');

            // Set image src for modal
            $('#coverImageModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                modal.find('#modal-image').attr('src', 'images/logo3.png'); // Set the image source for the modal
            });

            // Pass the ID to the delete modal
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var confirmDelete = $('#confirmDelete'); // Delete button inside the modal
                confirmDelete.attr('href', 'posts_delete.php?sirb_id=' + id); // Set the href attribute
            });

            // Show toast notification based on URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                const toast = $('#toast');
                $('#toast-message').text(message);

                // Set toast type based on message content
                if (message.includes('successfully')) {
                    toast.addClass('show success');
                } else if (message.includes('failed')) {
                    toast.addClass('show error');
                } else {
                    toast.addClass('show warning');
                }

                // Remove toast class after animation
                setTimeout(() => {
                    toast.removeClass('show success error warning');
                }, 3000);
                 // Remove the message parameter from the URL
                 const newUrl = window.location.origin + window.location.pathname;
                 window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>
</body>
</html>
