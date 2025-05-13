<?php
session_start();
session_destroy(); // Destroy all session data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">   
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        // Display SweetAlert notification
        Swal.fire({
            icon: 'success',
            title: 'Logged Out',
            text: 'You have been successfully logged out.',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        }).then(() => {
            // Redirect to the login page after the alert
            window.location.href = 'index.html';
        });
    </script>
</body>
</html>