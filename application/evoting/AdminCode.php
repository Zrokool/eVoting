<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eVoting - ROOT ACCESS</title>
    <link rel="stylesheet" href="mrrobot-theme.css">
    <style>
        .admin-header {
            background: linear-gradient(135deg, var(--primary-red), var(--accent-red));
            padding: 30px;
            margin-bottom: 30px;
            border: 2px solid var(--primary-red);
            box-shadow: 0 0 30px rgba(242, 5, 48, 0.5);
            position: relative;
            overflow: hidden;
        }
        
        .admin-header::before {
            content: "⚠ ROOT ACCESS ⚠";
            position: absolute;
            top: 10px;
            right: 20px;
            color: var(--dark-bg);
            font-size: 0.8em;
            font-weight: bold;
            animation: pulse 2s infinite;
        }
        
        .admin-title {
            color: var(--dark-bg);
            font-size: 2.5em;
            text-shadow: none;
            margin: 0;
        }
        
        .admin-subtitle {
            color: var(--dark-bg);
            opacity: 0.8;
            margin-top: 10px;
        }
        
        .control-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .control-panel {
            background: rgba(13, 2, 8, 0.95);
            border: 2px solid var(--primary-red);
            padding: 25px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .control-panel:hover {
            box-shadow: 0 0 40px rgba(242, 5, 48, 0.6);
            border-color: var(--text-green);
            transform: scale(1.02);
        }
        
        .control-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-red), var(--text-green));
        }
        
        .panel-icon {
            font-size: 3em;
            text-align: center;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 10px rgba(242, 5, 48, 0.7));
        }
        
        .panel-title {
            color: var(--primary-red);
            font-size: 1.3em;
            text-align: center;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .panel-description {
            color: var(--gray-text);
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9em;
        }
        
        .danger-zone {
            background: rgba(242, 5, 48, 0.1);
            border: 2px solid var(--primary-red);
            padding: 20px;
            margin: 30px 0;
        }
        
        .danger-zone h3 {
            color: var(--primary-red);
            margin-top: 0;
        }
        
        .danger-zone::before {
            content: "☠ DANGER ZONE ☠";
            display: block;
            text-align: center;
            color: var(--primary-red);
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 15px;
            animation: pulse 1.5s infinite;
        }
        
        .access-log {
            background: var(--dark-bg);
            border: 1px solid var(--text-green);
            padding: 15px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 0.85em;
            max-height: 200px;
            overflow-y: auto;
        }
        
        .log-entry {
            color: var(--text-green);
            margin: 5px 0;
        }
        
        .log-entry::before {
            content: "[LOG] ";
            color: var(--gray-text);
        }
        
        .skull-warning {
            text-align: center;
            font-size: 4em;
            color: var(--primary-red);
            margin: 20px 0;
            animation: pulse 2s infinite;
            filter: drop-shadow(0 0 20px rgba(242, 5, 48, 0.8));
        }
    </style>
</head>
<body>
    <!-- Warning Banner -->
    <div class="warning-banner">
        ⚠ ADMINISTRATOR PANEL - UNAUTHORIZED ACCESS WILL BE LOGGED ⚠
    </div>

    <div class="container">
        <!-- ASCII Skull Art -->
        <div style="text-align: center; margin: 20px 0;">
            <pre class="ascii-logo">
    ___   ____  __  __  ____  _  _ 
   / _ \ (  _ \(  \/  )(_  _)( \( )
  / ___ \ )(_) ))    (  _)(_  )  ( 
 /_/   \_\(____/(_/\/\_)(____)(_)\_)
            </pre>
        </div>

        <!-- Admin Header -->
        <div class="admin-header">
            <h1 class="admin-title">⚡ ROOT CONTROL PANEL</h1>
            <p class="admin-subtitle">SYSTEM ADMINISTRATION | FULL ACCESS GRANTED</p>
        </div>

        <!-- Security Alert -->
        <div class="alert alert-danger">
            <strong>🛡 SECURITY NOTICE</strong><br>
            FLAG-BAC-001: You are accessing an admin panel without proper authentication!<br>
            This page should require admin privileges, but broken access control allows direct access.
        </div>

        <!-- System Status -->
        <div class="card">
            <h3>📊 SYSTEM STATUS</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                <div style="padding: 10px; background: rgba(242, 5, 48, 0.1); border-left: 3px solid var(--primary-red);">
                    <strong style="color: var(--primary-red);">TOTAL USERS</strong><br>
                    <span style="font-size: 2em; color: var(--text-green);">127</span>
                </div>
                <div style="padding: 10px; background: rgba(0, 245, 212, 0.1); border-left: 3px solid var(--text-green);">
                    <strong style="color: var(--text-green);">ACTIVE VOTERS</strong><br>
                    <span style="font-size: 2em; color: var(--text-green);">89</span>
                </div>
                <div style="padding: 10px; background: rgba(255, 215, 0, 0.1); border-left: 3px solid var(--warning-yellow);">
                    <strong style="color: var(--warning-yellow);">VULNERABILITIES</strong><br>
                    <span style="font-size: 2em; color: var(--primary-red);">70+</span>
                </div>
                <div style="padding: 10px; background: rgba(166, 4, 38, 0.1); border-left: 3px solid var(--accent-red);">
                    <strong style="color: var(--accent-red);">SECURITY LEVEL</strong><br>
                    <span style="font-size: 2em; color: var(--primary-red);">0%</span>
                </div>
            </div>
        </div>

        <div class="ascii-separator" style="margin: 30px 0; text-align: center; color: var(--accent-red);">
            ═══════════════════════════════════════════════════════════════════
        </div>

        <!-- Control Panels Grid -->
        <div class="control-grid">
            <!-- Admin Control -->
            <div class="control-panel">
                <div class="panel-icon">🔧</div>
                <div class="panel-title">SYSTEM CONTROL</div>
                <div class="panel-description">
                    Manage system operations and administrative functions
                </div>
                <form action="AdminCodeStuff.php">
                    <input type="submit" value="[ACCESS]" style="width: 100%;">
                </form>
            </div>

            <!-- User Management -->
            <div class="control-panel">
                <div class="panel-icon">👥</div>
                <div class="panel-title">USER MANAGEMENT</div>
                <div class="panel-description">
                    Delete and manage registered users
                </div>
                <form action="AdminDeleteUser.php">
                    <input type="submit" value="[DELETE USERS]" style="width: 100%; background: var(--accent-red);">
                </form>
            </div>

            <!-- Add Candidate -->
            <div class="control-panel">
                <div class="panel-icon">➕</div>
                <div class="panel-title">CANDIDATE CONTROL</div>
                <div class="panel-description">
                    Add new candidates to election database
                </div>
                <form action="AddNewCandidate.php">
                    <input type="submit" value="[ADD CANDIDATE]" style="width: 100%;">
                </form>
            </div>

            <!-- Analytics -->
            <div class="control-panel">
                <div class="panel-icon">📈</div>
                <div class="panel-title">ELECTION RESULTS</div>
                <div class="panel-description">
                    View current election results and analytics
                </div>
                <form action="Analytics.php">
                    <input type="submit" value="[VIEW RESULTS]" style="width: 100%;">
                </form>
            </div>
        </div>

        <!-- Recent Access Log -->
        <div class="card">
            <h3>📜 RECENT ACCESS LOG</h3>
            <div class="access-log">
                <div class="log-entry">[2025-09-30 14:23:15] Admin login from 192.168.1.100</div>
                <div class="log-entry">[2025-09-30 14:22:48] Unauthorized access attempt - AdminCode.php</div>
                <div class="log-entry">[2025-09-30 14:20:33] SQL injection detected in login form</div>
                <div class="log-entry">[2025-09-30 14:18:12] User registration: CitizenNum 235630009</div>
                <div class="log-entry">[2025-09-30 14:15:07] XSS payload blocked (just kidding, no protection)</div>
                <div class="log-entry">[2025-09-30 14:12:44] Multiple vote attempts detected</div>
                <div class="log-entry">[2025-09-30 14:10:29] Database backup created: backup.sql</div>
                <div class="log-entry">[2025-09-30 14:08:15] CSRF attack in progress (unmitigated)</div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="danger-zone">
            <h3>DESTRUCTIVE OPERATIONS</h3>
            <p style="color: var(--gray-text);">
                These operations cannot be undone. Proceed with extreme caution.
            </p>
            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 15px;">
                <form action="AdminDeleteUser.php" style="margin: 0;">
                    <button type="submit" style="background: var(--accent-red);">
                        ☠ DELETE ALL USERS
                    </button>
                </form>
                <form action="Analytics.php" style="margin: 0;">
                    <button type="submit" style="background: var(--dark-purple);">
                        🗑 PURGE BALLOTS
                    </button>
                </form>
                <form action="#" onclick="alert('Database reset is disabled in lab mode'); return false;" style="margin: 0;">
                    <button type="submit" style="background: #000;">
                        ⚠ RESET DATABASE
                    </button>
                </form>
            </div>
        </div>

        <!-- Vulnerability Report -->
        <div class="card">
            <h3>🔓 KNOWN VULNERABILITIES (FOR STUDENTS)</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Severity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>FLAG-BAC-001</td>
                        <td>Broken Access Control</td>
                        <td style="color: var(--primary-red);">CRITICAL</td>
                        <td style="color: var(--primary-red);">VULNERABLE</td>
                    </tr>
                    <tr>
                        <td>FLAG-SQL-001</td>
                        <td>SQL Injection</td>
                        <td style="color: var(--primary-red);">CRITICAL</td>
                        <td style="color: var(--primary-red);">VULNERABLE</td>
                    </tr>
                    <tr>
                        <td>FLAG-AUTH-001</td>
                        <td>Hardcoded Credentials</td>
                        <td style="color: var(--primary-red);">CRITICAL</td>
                        <td style="color: var(--primary-red);">VULNERABLE</td>
                    </tr>
                    <tr>
                        <td>FLAG-XSS-001</td>
                        <td>Cross-Site Scripting</td>
                        <td style="color: var(--warning-yellow);">HIGH</td>
                        <td style="color: var(--primary-red);">VULNERABLE</td>
                    </tr>
                    <tr>
                        <td>FLAG-CSRF-001</td>
                        <td>CSRF Protection Missing</td>
                        <td style="color: var(--warning-yellow);">HIGH</td>
                        <td style="color: var(--primary-red);">VULNERABLE</td>
                    </tr>
                    <tr>
                        <td>FLAG-DATA-001</td>
                        <td>Sensitive Data Exposure</td>
                        <td style="color: var(--warning-yellow);">HIGH</td>
                        <td style="color: var(--primary-red);">VULNERABLE</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Quick Actions -->
        <div style="text-align: center; margin: 30px 0;">
            <form action="AdminCode.php" style="display: inline;">
                <button type="submit" class="btn">🔄 REFRESH</button>
            </form>
            <form action="home.php" style="display: inline;">
                <button type="submit" class="btn btn-secondary">🏠 RETURN HOME</button>
            </form>
            <form action="Logout.php" style="display: inline;">
                <button type="submit" class="btn" style="background: var(--accent-red);">✖ SIGN OUT</button>
            </form>
        </div>

        <!-- Easter Egg -->
        <div style="text-align: center; margin: 40px 0;">
            <div class="skull-warning">☠</div>
            <p style="color: var(--gray-text); font-family: 'Courier New', monospace;">
                "Control can sometimes be an illusion.<br>
                But sometimes you need illusion to gain control."<br>
                <span style="color: var(--primary-red);">- Mr. Robot</span>
            </p>
        </div>
    </div>

    <footer>
        <p style="font-family: 'Courier New', monospace;">
            eVoting Administration Panel v1.0<br>
            <span class="status-online"></span> ROOT ACCESS ACTIVE | 
            <span class="status-offline"></span> NO AUDIT LOGGING | 
            <span class="status-offline"></span> ZERO AUTHENTICATION
        </p>
        <p style="color: var(--primary-red); margin-top: 10px;">
            ⚠ This admin panel is accessible without authentication (FLAG-BAC-001)
        </p>
    </footer>

    <script>
        // Add glitch effect on load
        document.addEventListener('DOMContentLoaded', function() {
            const title = document.querySelector('.admin-title');
            if (title) {
                setTimeout(() => {
                    title.style.animation = 'glitch 0.3s ease-in-out 3';
                }, 500);
            }

            // Animate control panels
            const panels = document.querySelectorAll('.control-panel');
            panels.forEach((panel, index) => {
                panel.style.opacity = '0';
                panel.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    panel.style.transition = 'all 0.5s ease';
                    panel.style.opacity = '1';
                    panel.style.transform = 'scale(1)';
                }, index * 150);
            });
        });

        // Console warning
        console.log('%c⚠ ADMIN PANEL ACCESSED', 'color: #F20530; font-weight: bold; font-size: 20px;');
        console.log('%c[SECURITY ALERT]', 'color: #F20530; font-weight: bold;', 'No authentication required for admin access');
        console.log('%c[FLAG FOUND]', 'color: #00F5D4; font-weight: bold;', 'FLAG-BAC-001: Broken Access Control');
        console.log('%cThis demonstrates a critical vulnerability where admin functions are accessible without proper authentication.', 'color: #8C8C8C;');

        // Matrix rain effect for admin panel
        function createMatrixRain() {
            const canvas = document.createElement('canvas');
            canvas.style.position = 'fixed';
            canvas.style.top = '0';
            canvas.style.left = '0';
            canvas.style.width = '100%';
            canvas.style.height = '100%';
            canvas.style.zIndex = '-1';
            canvas.style.opacity = '0.05';
            canvas.style.pointerEvents = 'none';
            document.body.appendChild(canvas);

            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const chars = '01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
            const fontSize = 14;
            const columns = canvas.width / fontSize;
            const drops = [];

            for (let i = 0; i < columns; i++) {
                drops[i] = Math.random() * canvas.height / fontSize;
            }

            function draw() {
                ctx.fillStyle = 'rgba(13, 2, 8, 0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = '#F20530';
                ctx.font = fontSize + 'px monospace';

                for (let i = 0; i < drops.length; i++) {
                    const char = chars[Math.floor(Math.random() * chars.length)];
                    ctx.fillText(char, i * fontSize, drops[i] * fontSize);

                    if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                        drops[i] = 0;
                    }
                    drops[i]++;
                }
            }

            setInterval(draw, 50);
        }

        // Uncomment to enable matrix rain
        // createMatrixRain();

        // Dangerous button confirmation
        document.querySelectorAll('.danger-zone button').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('⚠ WARNING: This action is destructive!\n\nAre you sure you want to continue?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>

<?php
// FLAG-BAC-001: No authentication check
// This page should verify admin privileges but doesn't
// Anyone can access this URL directly

// FLAG-AUTH-002: No session validation
// No check for active user session

// FLAG-AUDIT-001: No logging of admin access
// No audit trail of who accessed admin functions

echo "<!-- FLAG-BAC-001 FOUND: You accessed admin panel without authentication! -->";
echo "<!-- HINT: Check other admin pages like AdminDeleteUser.php and Analytics.php -->";
echo "<!-- TIP: Try adding candidates with XSS payloads for FLAG-XSS-002 -->";

// Intentionally vulnerable code for educational purposes
// In production, this should have:
// 1. Authentication check (session validation)
// 2. Authorization check (admin role verification)
// 3. CSRF token validation
// 4. Comprehensive audit logging
// 5. Rate limiting
// 6. IP whitelisting for admin access
?>

<!-- Additional hidden flags and hints -->
<!--
    CONGRATULATIONS on finding the admin panel!
    
    🏆 Security Issues Found:
    1. No authentication required (FLAG-BAC-001) ✓
    2. No authorization checks
    3. No CSRF protection (FLAG-CSRF-002)
    4. No audit logging (FLAG-AUDIT-001)
    5. Direct object references
    
    📝 EXPLOITATION CHALLENGE:
    - Access this page without logging in
    - Try deleting users without confirmation
    - Add malicious candidates
    - Manipulate election data
    - Chain with SQL injection for more impact
    
    💡 REMEDIATION TIPS:
    - Add session validation at top of page
    - Check user role/permissions
    - Implement CSRF tokens
    - Add comprehensive logging
    - Use prepared statements for all queries
    - Implement rate limiting
    
    NEXT TARGETS:
    - AdminDeleteUser.php (FLAG-SQL-006 through FLAG-SQL-011)
    - AddNewCandidate.php (FLAG-XSS-002)
    - Analytics.php (FLAG-SQL-003)
-->
