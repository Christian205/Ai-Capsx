<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Student Register</title>
</head>
<body>
    <div class="container">
        <div class="image-section">
            <img src="illus.jpg" alt="Illustration" class="illustration">
        </div>
        <div class="form-section">
            <h1>STUDENT REGISTRATION</h1>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <label for="name">Enter Your Name</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="input-group">
                    <label for="course">Enter Your Course/Section</label>
                    <input type="text" id="course" name="course" required>
                </div>

                <div class="input-group">
                    <label for="studentid">Enter Your Student ID</label>
                    <input type="number" id="studentid" name="studentid" required>
                </div>

                <div class="input-group">
                    <label for="email">Enter Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required>
                        <img src="hidden.png" alt="Show Password" id="togglePassword" class="toggle-password">
                    </div>
                </div>

                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="/ctpg/log/login.php">Login here</a></p>
        </div>
    </div>

    <style>
    /* Style for the password wrapper */
    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-wrapper input {
        width: 100%;
        padding-right: 40px; /* Add space for the toggle icon */
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        width: 25px;
        height: 25px;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    .toggle-password:hover {
        opacity: 0.7;
    }
    </style>

    <script>
        // JavaScript to toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the image
            this.src = type === 'password' ? 'hidden.png' : 'eye.png';
            this.alt = type === 'password' ? 'Show Password' : 'Hide Password';
        });
    </script>

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "ctpg");

    if (!$conn) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Database Error',
                text: 'Database connection failed: " . mysqli_connect_error() . "',
                timer: 3000,
                timerProgressBar: true
            });
        </script>";
        exit;
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Name = mysqli_real_escape_string($conn, $_POST['username']);
        $CourseSection = mysqli_real_escape_string($conn, $_POST['course']);
        $StudentID = mysqli_real_escape_string($conn, $_POST['studentid']);

        // Validate student ID format
        if (!preg_match('/^[0-9]{6}$/', $StudentID)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Student ID',
                    text: 'Student ID format should be 6 digits.',
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>";
            exit;
        }

        // Check if student ID already exists
        $checkQuery = "SELECT * FROM ctpg_users WHERE StudentID = '$StudentID'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Student ID',
                    text: 'Student ID already exists. Please use a different one.',
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>";
            exit;
        }

        $Email = mysqli_real_escape_string($conn, $_POST['email']);
        // Validate email format
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.',
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>";
            exit;
        }

        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM ctpg_users WHERE Email = '$Email'";
        $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
        if (mysqli_num_rows($checkEmailResult) > 0) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Email',
                    text: 'Email already exists. Please use a different one.',
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>";
            exit;
        }

        $Password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Validate password strength
        if (strlen($_POST['password']) < 8) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must be at least 8 characters long.',
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>";
            exit;
        }

        // Insert data into the database
        $query = "INSERT INTO ctpg_users (Name, `Course&Section`, StudentID, Email, Password) VALUES ('$Name', '$CourseSection', '$StudentID', '$Email', '$Password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'You have successfully registered!',
                    timer: 3000,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '../log/login.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: 'An error occurred: " . mysqli_error($conn) . "',
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</body>
</html>