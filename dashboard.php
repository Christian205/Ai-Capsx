<?php
// filepath: c:\xampp\htdocs\ctpg\dashboard.php

session_start();
$loginSuccess = isset($_GET['login']) && $_GET['login'] === 'success';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
    <link rel="icon" type="image" href="logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=w" />
</head>
<body>

<script>
        // Check if login was successful
        const loginSuccess = <?php echo $loginSuccess ? 'true' : 'false'; ?>;

        if (loginSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
    </script>

    <div class="container">
        <div class="form-box" id="Capstone">
            <div class="container">
                <div class="form-content">
                    <img src="ctpg.png" alt="Capstone Title Generator Logo" class="logo1">
                    <h3>Generate Here!</h3>
                    <input type="text" id="topic" class="text" placeholder="Input your topic or a full title" required>

                    <select id="generate" name="generate">
                        <option>--Choose What to Generate--</option>
                        <option value="Generate Title">Generate Title</option>
                        <option value="Generate Proposal">Generate Proposal</option>
                    </select>
                    
                    <select id="fields" name="fields">
                        <option>--Select a Field--</option>
                        <option value="None">None</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                        <option value="Artificial Intelligence & Machine Learning">Artificial Intelligence & Machine Learning</option>
                        <option value="Data Science & Analytics">Data Science & Analytics</option>
                        <option value="Robotics & Automation">Robotics & Automation</option>
                        <option value="Renewable Energy & Sustainability">Renewable Energy & Sustainability</option>
                        <option value="Internet of Things (IoT)">Internet of Things (IoT)</option>
                        <option value="Cloud Computing">Cloud Computing</option>
                        <option value="Human-Computer Interaction">Human-Computer Interaction</option>
                        <option value="Game Development">Game Development</option>
                        <option value="Augmented & Virtual Reality">Augmented & Virtual Reality</option>
                        <option value="Software Engineering">Software Engineering</option>
                        <option value="Civil & Structural Engineering">Civil & Structural Engineering</option>
                        <option value="Aerospace & Aviation">Aerospace & Aviation</option>
                        <option value="Biomedical Engineering">Biomedical Engineering</option>
                        <option value="Psychology & Behavioral Science">Psychology & Behavioral Science</option>
                    </select>
                   
                    <button id="submit" onclick="generateTitle(), showForm('title-box')" name="submit">
                        <span class="material-symbols-outlined">wand_stars</span>&nbsp;
                          Generate
                    </button>

                   <div class="button-group">
                        <button id="delete" onclick="deleteTitles();">
                            <span class="material-symbols-outlined">delete</span>
                            &nbsp;Delete
                        </button>

                        <button id="copy" onclick="copyToClipboard();">
                            <span class="material-symbols-outlined">content_copy</span>
                            &nbsp;Copy
                        </button>
                        
                        <button id="download" onclick="downloadTitles();">
                            <span class="material-symbols-outlined">download</span>
                           &nbsp;Download
                        </button>   

                    </div>
                </div>
            </div>
                         <button id="logout" onclick="window.location.href='logout.php'">
                              <span class="material-symbols-outlined">logout</span>
                       </button>

                         <footer>
                             <br>
                                <p>&copy; 2025 Capstone Title Generator</p>
                                <p>Developed by: Carl Christian & John Benedict</p>
                                <p>Powered by: <a href="https://gemini.google.com/app">Gemini</a></p>
                                <br>
                        </footer>
            
        </div>

        <div class="result-box" id="title-box">
            <div class="title-box">
                <img src="ctpg.png" alt="Capstone Title Generator Logo" class="logo1">
                <h3>Your Capstone Title/Proposal are: </h3>
                <div class="loader" id="loader" style="display: none;"></div>
                <ol id="title-list"></ol>
                <span id="generated-titles"></span>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
    
    <script>
      window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
    </script>
    <script>
        // Disable right-click
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Disable specific keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
            if (e.key === 'F12' || 
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) || 
                (e.ctrlKey && e.key === 'U')) {
                e.preventDefault();
            }
        });
    </script>
   
    <script defer src="/_vercel/insights/script.js"></script>
</body>
</html>