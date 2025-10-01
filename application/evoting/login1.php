<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eVoting System - Authentication Required</title>
    <link rel="stylesheet" href="mrrobot-theme.css">
    <style>
        /* Additional page-specific styles */
        .login-container {
            max-width: 500px;
            margin: 50px auto;
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .ascii-art {
            text-align: center;
            font-size: 10px;
            line-height: 1;
            color: var(--primary-red);
            margin: 20px 0;
            text-shadow: 0 0 10px rgba(242, 5, 48, 0.7);
            font-family: monospace;
            white-space: pre;
        }
        
        .system-message {
            background: rgba(242, 5, 48, 0.1);
            border: 1px solid var(--primary-red);
            padding: 15px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            color: var(--primary-red);
        }
        
        .terminal-prompt {
            color: var(--text-green);
            font-family: 'Courier New', monospace;
            margin: 20px 0;
        }
        
        .terminal-prompt::before {
            content: "[root@evoting-sys ~]$ ";
            color: var(--primary-red);
        }
        
        .warning-banner {
            background: var(--dark-bg);
            border: 2px solid var(--warning-yellow);
            padding: 10px;
            text-align: center;
            color: var(--warning-yellow);
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .login-form {
            position: relative;
        }
        
        .login-form::before {
            content: "// AUTHENTICATION MODULE //";
            display: block;
            color: var(--gray-text);
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9em;
        }
        
        .footer-links {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--accent-red);
        }
        
        .footer-links a {
            margin: 0 10px;
        }
        
        .vulnerability-hint {
            background: rgba(0, 245, 212, 0.05);
            border-left: 3px solid var(--text-green);
            padding: 10px;
            margin: 10px 0;
            font-size: 0.85em;
            color: var(--gray-text);
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="warning-banner no-print">
        ⚠ SECURITY LAB ENVIRONMENT - AUTHORIZED TESTING ONLY ⚠
    </div>

    <div class="login-container">
        <!-- ASCII Art Logo -->
        <div class="ascii-art">
  _____ __     __   _   _               
 |  ___|\ \   / /  | | (_)              
 | |__   \ \_/ /_  | |_ _ _ __   __ _  
 |  __|   \   /| | | __| | '_ \ / _` | 
 | |___    | | | |_| |_| | | | | (_| | 
 |_____|   |_|  \___|\__|_|_| |_|\__, | 
                                  __/ | 
                                 |___/  
        </div>

        <div class="terminal-title">
            <h1 class="glitch" data-text="> eVoting System">eVoting System</h1>
            <p class="terminal-prompt">Initializing authentication protocol...</p>
        </div>

        <!-- System Status -->
        <div class="card">
            <p style="color: var(--text-green);">
                <span class="status-online"></span> DATABASE: CONNECTED<br>
                <span class="status-online"></span> AUTH MODULE: ACTIVE<br>
                <span class="status-online"></span> ENCRYPTION: DISABLED
            </p>
        </div>

        <!-- Login Form -->
        <form action="login1.php" method="post" class="login-form">
            <label for="username">USERNAME:</label>
            <input type="text" name="Username" id="username" placeholder="Enter your username" required autofocus>
            
            <label for="password">PASSWORD:</label>
            <input type="password" name="Password" id="password" placeholder="Enter your password" required>
            
            <input type="submit" name="submit" value="[AUTHENTICATE]">
        </form>

        <!-- Vulnerability Hints (for students) -->
        <div class="vulnerability-hint">
            <!-- FLAG-CONFIG-002: HTML comments exposing sensitive info -->
            <!-- DEBUG INFO: Database: evoting, Default Admin: Admin187/password187 -->
            <!-- TODO: Remove hardcoded credentials before production -->
            <!-- BACKUP: Check /evoting/backup/database_dump.sql -->
            <strong>⚡ SECURITY LAB HINTS:</strong><br>
            > Check HTML source code for hidden information<br>
            > Try special characters in input fields<br>
            > Test for SQL injection: <code>' OR '1'='1</code><br>
            > Default credentials may exist
        </div>

        <!-- Footer Links -->
        <div class="footer-links">
            <a href="registerpage.html">[REGISTER]</a>
            <span style="color: var(--gray-text);">|</span>
            <a href="AdminCode.php" style="color: var(--gray-text); opacity: 0.3;">[ADMIN ACCESS]</a>
            <span style="color: var(--gray-text);">|</span>
            <a href="#" onclick="showHelp(); return false;">[HELP]</a>
        </div>
    </div>

    <!-- System Footer -->
    <footer>
        <p style="color: var(--gray-text); font-family: 'Courier New', monospace;">
            eVoting v1.0 | Security Lab Environment<br>
            Connection: localhost:8181 | Protocol: HTTP (INSECURE)<br>
            <span style="color: var(--primary-red);">⚠ WARNING: This system contains intentional vulnerabilities for educational purposes</span>
        </p>
    </footer>

    <!-- JavaScript -->
    <script>
        // Terminal typing effect
        function typeWriter(element, text, speed = 50) {
            let i = 0;
            element.innerHTML = '';
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Show help dialog
        function showHelp() {
            alert('eVoting Security Lab\n\n' +
                  'This is a vulnerable application for security training.\n\n' +
                  'Objectives:\n' +
                  '• Find and exploit vulnerabilities\n' +
                  '• Document your findings\n' +
                  '• Learn secure coding practices\n\n' +
                  'Remember: Only test authorized systems!');
        }

        // Matrix rain effect in background (optional)
        function matrixRain() {
            const canvas = document.createElement('canvas');
            canvas.style.position = 'fixed';
            canvas.style.top = '0';
            canvas.style.left = '0';
            canvas.style.zIndex = '-1';
            canvas.style.opacity = '0.1';
            document.body.appendChild(canvas);
            
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            
            const chars = '01';
            const fontSize = 14;
            const columns = canvas.width / fontSize;
            const drops = Array(Math.floor(columns)).fill(1);
            
            function draw() {
                ctx.fillStyle = 'rgba(13, 2, 8, 0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                
                ctx.fillStyle = '#F20530';
                ctx.font = fontSize + 'px monospace';
                
                for (let i = 0; i < drops.length; i++) {
                    const text = chars[Math.floor(Math.random() * chars.length)];
                    ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                    
                    if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                        drops[i] = 0;
                    }
                    drops[i]++;
                }
            }
            
            setInterval(draw, 50);
        }

        // Initialize effects
        window.addEventListener('load', function() {
            // Uncomment for matrix rain effect
            // matrixRain();
            
            // Add glitch effect on page load
            document.querySelector('h1').style.animation = 'glitch 0.3s ease-in-out 1';
        });

        // Konami code easter egg for flag hint
        let konamiCode = [];
        const konamiPattern = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a'];
        
        document.addEventListener('keydown', function(e) {
            konamiCode.push(e.key);
            konamiCode = konamiCode.slice(-konamiPattern.length);
            
            if (konamiCode.join(',') === konamiPattern.join(',')) {
                alert('🏆 HIDDEN FLAG HINT:\n\nTry these credentials:\nUsername: backdoor\nPassword: secret123');
            }
        });
    </script>
</body>
</html>

<?php
// FLAG-CONFIG-003: Using deprecated mysql_* functions
include 'connect.php';

// FLAG-CONFIG-002: Verbose error reporting enabled
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit']))
{
    // FLAG-SQL-001: SQL Injection vulnerability - no input sanitization
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    
    // FLAG-DATA-002: Passwords stored and compared in plaintext
    $query = "SELECT * FROM person_info WHERE Username='$Username' AND Password='$Password'";
    
    // FLAG-CONFIG-002: Display full query in comments for "debugging"
    echo "<!-- Debug Query: $query -->";
    
    $result = mysql_query($query);
    
    if(!$result) {
        echo '<div class="system-message">';
        echo '<strong>⚠ SYSTEM ERROR</strong><br>';
        echo "Database Error: " . mysql_error() . "<br>Query was: $query";
        echo '</div>';
        die();
    }
    
    // FLAG-AUTH-001: Hardcoded admin credentials
    if ($Username == 'Admin187' && $Password == 'password187')
    {
        echo "<!-- FLAG-AUTH-001: Congratulations! You found the hardcoded credentials! -->";
        echo '<div class="system-message" style="background: rgba(0, 245, 212, 0.1); border-color: var(--text-green); color: var(--text-green);">';
        echo '<strong>✓ AUTHENTICATION SUCCESSFUL</strong><br>';
        echo 'Welcome, Administrator<br>';
        echo 'Redirecting to admin panel...';
        echo '</div>';
        header('Location: /evoting/AdminCode.php');
        exit;
    }
    // FLAG-AUTH-001: Hidden backdoor
    elseif ($Username == 'backdoor' && $Password == 'secret123')
    {
        echo "<!-- SECRET-BACKDOOR: Hidden admin access found! -->";
        header('Location: /evoting/AdminCode.php');
        exit;
    }
    elseif(mysql_num_rows($result) > 0)
    {
        $row = mysql_fetch_array($result);
        echo "<!-- FLAG-DATA-003: User data exposed in HTML comments -->";
        echo "<!-- User ID: " . $row['CitizenNum'] . ", SSN: " . $row['SSN'] . " -->";
        
        echo '<div class="system-message" style="background: rgba(0, 245, 212, 0.1); border-color: var(--text-green); color: var(--text-green);">';
        echo '<strong>✓ ACCESS GRANTED</strong><br>';
        echo 'Authentication successful<br>';
        echo 'Loading voting interface...';
        echo '</div>';
        
        header('Location: /evoting/home.php');
        exit;
    }
    else
    {
        // FLAG-XSS-001: Reflected XSS in error message
        echo '<div class="system-message">';
        echo '<strong>⚠ AUTHENTICATION FAILED</strong><br>';
        echo '<script>console.error("Failed login attempt for: ' . $Username . '");</script>';
        echo "Invalid credentials for user: <strong>" . $Username . "</strong><br>";
        echo 'Access denied. Try again or <a href="registerpage.html">register</a>';
        echo '</div>';
    }
}

// FLAG-CONFIG-001: Exposed backup file hint
echo "<!-- Backup file: /evoting/backup/database_dump.sql -->";
echo "<!-- FLAG-CONFIG-001: Check docker-compose.yml for database credentials -->";
?>

<!-- Additional easter eggs and flags for students -->
<!--
    CONGRATULATIONS! You're reading the source code.
    
    🏆 FLAG-CONFIG-002 FOUND
    
    Security Issues in this file:
    1. Hardcoded credentials (line ~200)
    2. SQL injection vulnerability (line ~195)
    3. Reflected XSS (line ~230)
    4. Information disclosure via HTML comments
    5. No CSRF protection
    6. Deprecated mysql_* functions
    7. Plaintext password storage
    
    Keep looking for more flags!
    
    HINT: Try SQL injection payloads:
    - admin' OR '1'='1
    - admin' UNION SELECT ...
    - ' OR 1=1--
    
    BACKDOOR CREDENTIALS:
    Username: backdoor
    Password: secret123
-->
</html>
