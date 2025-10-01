<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eVoting - Command Center</title>
    <link rel="stylesheet" href="mrrobot-theme.css">
    <style>
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .dashboard-card {
            background: rgba(13, 2, 8, 0.9);
            border: 1px solid var(--accent-red);
            padding: 25px;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .dashboard-card:hover {
            border-color: var(--primary-red);
            box-shadow: 0 0 30px rgba(242, 5, 48, 0.4);
            transform: translateY(-5px);
        }
        
        .dashboard-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary-red), var(--accent-red));
        }
        
        .card-icon {
            font-size: 2em;
            margin-bottom: 15px;
            color: var(--primary-red);
            text-shadow: 0 0 10px rgba(242, 5, 48, 0.5);
        }
        
        .card-title {
            color: var(--text-green);
            font-size: 1.2em;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .card-description {
            color: var(--gray-text);
            font-size: 0.9em;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        
        .card-action {
            display: inline-block;
            background: var(--primary-red);
            color: var(--dark-bg);
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border: none;
        }
        
        .card-action:hover {
            background: var(--accent-red);
            box-shadow: 0 0 15px rgba(242, 5, 48, 0.6);
        }
        
        .system-status {
            background: rgba(0, 245, 212, 0.05);
            border: 1px solid var(--text-green);
            padding: 15px;
            margin-bottom: 30px;
        }
        
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .status-item {
            padding: 10px;
            background: rgba(0, 0, 0, 0.3);
        }
        
        .header-banner {
            background: linear-gradient(135deg, var(--accent-red), var(--dark-purple));
            padding: 30px;
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-red);
            position: relative;
            overflow: hidden;
        }
        
        .header-banner::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(242, 5, 48, 0.1) 10px,
                rgba(242, 5, 48, 0.1) 20px
            );
        }
        
        .welcome-text {
            color: var(--dark-bg);
            font-size: 1.5em;
            font-weight: bold;
            text-transform: uppercase;
            position: relative;
            z-index: 1;
        }
        
        .ascii-separator {
            text-align: center;
            color: var(--accent-red);
            margin: 30px 0;
            font-family: monospace;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav>
        <ul>
            <li><a href="home.php" class="active">⌂ HOME</a></li>
            <li><a href="electioninfo2016.php">🗳 VOTE NOW</a></li>
            <li><a href="VoterAnalytics.php">📊 RESULTS</a></li>
            <li><a href="accountinfo.php">⚙ SETTINGS</a></li>
            <li><a href="Logout.php" style="color: var(--primary-red);">✖ LOGOUT</a></li>
        </ul>
    </nav>

    <div class="container">
        <!-- ASCII Art Header -->
        <div style="text-align: center; margin: 20px 0;">
            <pre class="ascii-logo">
██████╗ ███████╗███╗   ███╗ ██████╗  ██████╗██████╗  █████╗  ██████╗██╗   ██╗
██╔══██╗██╔════╝████╗ ████║██╔═══██╗██╔════╝██╔══██╗██╔══██╗██╔════╝╚██╗ ██╔╝
██║  ██║█████╗  ██╔████╔██║██║   ██║██║     ██████╔╝███████║██║      ╚████╔╝ 
██║  ██║██╔══╝  ██║╚██╔╝██║██║   ██║██║     ██╔══██╗██╔══██║██║       ╚██╔╝  
██████╔╝███████╗██║ ╚═╝ ██║╚██████╔╝╚██████╗██║  ██║██║  ██║╚██████╗   ██║   
╚═════╝ ╚══════╝╚═╝     ╚═╝ ╚═════╝  ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝ ╚═════╝   ╚═╝   
            </pre>
        </div>

        <!-- Welcome Banner -->
        <div class="header-banner">
            <div class="welcome-text">
                <span class="cursor">MAKE YOUR VOICE HEARD</span>
            </div>
            <p style="color: var(--dark-bg); margin-top: 10px; position: relative; z-index: 1;">
                ACCESS LEVEL: CITIZEN | SESSION: ACTIVE | ENCRYPTION: DISABLED
            </p>
        </div>

        <!-- System Status -->
        <div class="system-status">
            <h3>⚡ SYSTEM STATUS</h3>
            <div class="status-grid">
                <div class="status-item">
                    <span class="status-online"></span> <strong>DATABASE</strong><br>
                    <span style="color: var(--gray-text); font-size: 0.85em;">Connected: localhost:3306</span>
                </div>
                <div class="status-item">
                    <span class="status-online"></span> <strong>VOTING MODULE</strong><br>
                    <span style="color: var(--gray-text); font-size: 0.85em;">2016 Elections Active</span>
                </div>
                <div class="status-item">
                    <span class="status-offline"></span> <strong>SECURITY</strong><br>
                    <span style="color: var(--primary-red); font-size: 0.85em;">⚠ Multiple Vulnerabilities</span>
                </div>
                <div class="status-item">
                    <span class="status-online"></span> <strong>USER SESSION</strong><br>
                    <span style="color: var(--gray-text); font-size: 0.85em;">Authenticated</span>
                </div>
            </div>
        </div>

        <div class="ascii-separator">
        ═══════════════════════════════════════════════════════════════════
        </div>

        <!-- Main Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Vote Card -->
            <div class="dashboard-card" onclick="location.href='electioninfo2016.php'">
                <div class="card-icon">🗳</div>
                <div class="card-title">CAST YOUR VOTE</div>
                <div class="card-description">
                    Participate in the 2016 Presidential Elections. Your vote matters in determining the future leadership.
                </div>
                <a href="electioninfo2016.php" class="card-action">VOTE NOW →</a>
            </div>

            <!-- Update Info Card -->
            <div class="dashboard-card" onclick="location.href='accountinfo.php'">
                <div class="card-icon">⚙</div>
                <div class="card-title">UPDATE INFORMATION</div>
                <div class="card-description">
                    Modify your residential information to ensure accurate voter registration and polling location.
                </div>
                <a href="accountinfo.php" class="card-action">MANAGE →</a>
            </div>

            <!-- State Info Card -->
            <div class="dashboard-card" onclick="location.href='StateInfo.php'">
                <div class="card-icon">🗺</div>
                <div class="card-title">STATE DIRECTORY</div>
                <div class="card-description">
                    Lookup state identification numbers for voting purposes. Required for ballot submission.
                </div>
                <a href="StateInfo.php" class="card-action">SEARCH →</a>
            </div>

            <!-- Polling Station Card -->
            <div class="dashboard-card" onclick="location.href='MyPollingStation.php'">
                <div class="card-icon">📍</div>
                <div class="card-title">POLLING LOCATIONS</div>
                <div class="card-description">
                    Find your nearest polling station by ZIP code. Get directions and operating hours.
                </div>
                <a href="MyPollingStation.php" class="card-action">LOCATE →</a>
            </div>

            <!-- Results Card -->
            <div class="dashboard-card" onclick="location.href='VoterAnalytics.php'">
                <div class="card-icon">📊</div>
                <div class="card-title">2012 ELECTION RESULTS</div>
                <div class="card-description">
                    View comprehensive analytics and results from the 2012 Presidential Elections.
                </div>
                <a href="VoterAnalytics.php" class="card-action">VIEW →</a>
            </div>

            <!-- Analytics Card -->
            <div class="dashboard-card" onclick="location.href='PostElectionAnalytics.php'">
                <div class="card-icon">📈</div>
                <div class="card-title">CANDIDATE BREAKDOWN</div>
                <div class="card-description">
                    Statistical analysis of voting patterns by candidate for the 2012 elections.
                </div>
                <a href="PostElectionAnalytics.php" class="card-action">ANALYZE →</a>
            </div>

            <!-- State Stats Card -->
            <div class="dashboard-card" onclick="location.href='StateBreakdown.php'">
                <div class="card-icon">🗳</div>
                <div class="card-title">STATE STATISTICS</div>
                <div class="card-description">
                    Explore voting statistics and trends broken down by state for 2012 elections.
                </div>
                <a href="StateBreakdown.php" class="card-action">EXPLORE →</a>
            </div>

            <!-- Party Analysis Card -->
            <div class="dashboard-card" onclick="location.href='StatePartyRatio.php'">
                <div class="card-icon">🏛</div>
                <div class="card-title">PARTY ANALYSIS</div>
                <div class="card-description">
                    View party distribution and voting ratios across different states in 2012.
                </div>
                <a href="StatePartyRatio.php" class="card-action">REVIEW →</a>
            </div>
        </div>

        <div class="ascii-separator">
        ═══════════════════════════════════════════════════════════════════
        </div>

        <!-- Security Notice -->
        <div class="alert alert-warning">
            <strong>⚠ SECURITY LAB NOTICE</strong><br>
            This system contains intentional vulnerabilities for educational purposes. 
            Explore, exploit, document, and learn responsible disclosure practices.
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <h3>QUICK ACTIONS</h3>
            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 15px;">
                <a href="electioninfo2016.php" class="btn">Cast Vote</a>
                <a href="VoterAnalytics.php" class="btn btn-secondary">View Results</a>
                <a href="accountinfo.php" class="btn btn-secondary">Update Info</a>
                <a href="Logout.php" class="btn" style="background: var(--accent-red);">Logout</a>
            </div>
        </div>

        <!-- Easter Egg / Hidden Flag Hint -->
        <!-- FLAG-BAC-001: Try accessing /evoting/AdminCode.php directly -->
        <!-- FLAG-CONFIG-002: Check network tab for exposed API endpoints -->
        <!-- HINT: Press Ctrl+Shift+I to open developer tools -->
    </div>

    <footer>
        <p style="font-family: 'Courier New', monospace;">
            eVoting Democracy Platform v1.0<br>
            <span class="status-online"></span> System Online | 
            <span class="status-offline"></span> Security: Vulnerable | 
            Session: Active
        </p>
        <p style="color: var(--primary-red); margin-top: 10px;">
            ⚠ Educational Environment - Authorized Testing Only
        </p>
    </footer>

    <script>
        // Add terminal-style loading effect
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Add cursor blink effect
            const cursor = document.querySelector('.cursor');
            if (cursor) {
                setInterval(() => {
                    cursor.style.opacity = cursor.style.opacity === '0' ? '1' : '0';
                }, 500);
            }
        });

        // Console easter egg
        console.log('%c[SYSTEM]', 'color: #F20530; font-weight: bold; font-size: 14px;', 'Welcome to eVoting Security Lab');
        console.log('%c[DEBUG]', 'color: #00F5D4; font-size: 12px;', 'Try these commands:');
        console.log('%c  - showFlags()', 'color: #8C8C8C; font-size: 11px;', '// Display available flags');
        console.log('%c  - showHints()', 'color: #8C8C8C; font-size: 11px;', '// Get exploitation hints');
        console.log('%c  - showVulns()', 'color: #8C8C8C; font-size: 11px;', '// List known vulnerabilities');

        // Console commands for students
        function showFlags() {
            console.log('%c[FLAGS AVAILABLE IN THIS APPLICATION]', 'color: #F20530; font-weight: bold;');
            console.log('%cSQL Injection:', 'color: #00F5D4; font-weight: bold;', 'FLAG-SQL-001 through FLAG-SQL-011');
            console.log('%cXSS:', 'color: #00F5D4; font-weight: bold;', 'FLAG-XSS-001 through FLAG-XSS-004');
            console.log('%cAuthentication:', 'color: #00F5D4; font-weight: bold;', 'FLAG-AUTH-001 through FLAG-AUTH-004');
            console.log('%cAccess Control:', 'color: #00F5D4; font-weight: bold;', 'FLAG-BAC-001 through FLAG-BAC-004');
            console.log('%cConfiguration:', 'color: #00F5D4; font-weight: bold;', 'FLAG-CONFIG-001 through FLAG-CONFIG-011');
        }

        function showHints() {
            console.log('%c[EXPLOITATION HINTS]', 'color: #F20530; font-weight: bold;');
            console.log('%c1.', 'color: #00F5D4;', 'Check HTML source code for comments');
            console.log('%c2.', 'color: #00F5D4;', 'Try SQL injection in all input fields');
            console.log('%c3.', 'color: #00F5D4;', 'Test XSS with <script>alert(1)</script>');
            console.log('%c4.', 'color: #00F5D4;', 'Access admin pages directly without auth');
            console.log('%c5.', 'color: #00F5D4;', 'Inspect network requests for sensitive data');
        }

        function showVulns() {
            console.log('%c[KNOWN VULNERABILITIES]', 'color: #F20530; font-weight: bold;');
            console.log('%c⚠', 'color: #FFD700;', 'SQL Injection in login and voting forms');
            console.log('%c⚠', 'color: #FFD700;', 'No CSRF protection on any forms');
            console.log('%c⚠', 'color: #FFD700;', 'XSS in error messages and user input');
            console.log('%c⚠', 'color: #FFD700;', 'Hardcoded credentials in source');
            console.log('%c⚠', 'color: #FFD700;', 'Direct access to admin functions');
            console.log('%c⚠', 'color: #FFD700;', 'Plaintext password storage');
        }

        // Make functions globally available
        window.showFlags = showFlags;
        window.showHints = showHints;
        window.showVulns = showVulns;
    </script>
</body>
</html>

<?php
// FLAG-AUTH-002: No session validation
// Anyone can access this page directly without authentication
// This is intentionally vulnerable for educational purposes

// FLAG-CONFIG-002: Debug information exposure
echo "<!-- DEBUG: User session active, no encryption, vulnerable to hijacking -->";
echo "<!-- FLAG-BAC-001: Try accessing AdminCode.php for admin functions -->";
echo "<!-- FLAG-CONFIG-001: Database connection details in connect.php -->";
?>
