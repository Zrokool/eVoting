# eVoting Security Lab - Vulnerable Web Application

## 🎯 Purpose
This is an **intentionally vulnerable** web application designed for educational purposes to teach web application security testing and exploitation techniques.

## ⚠️ WARNING
**DO NOT deploy this application on any public-facing server or production environment!**
This application contains serious security vulnerabilities by design.

## 🏆 Security Challenges & Flags

### Level 1: SQL Injection Vulnerabilities
**FLAG-SQL-001**: Found in `login1.php` - Basic authentication bypass
**FLAG-SQL-002**: Found in `electioninfo2016.php` - Voting manipulation
**FLAG-SQL-003**: Found in `MyPollingStation.php` - Data extraction
**FLAG-SQL-004**: Found in `AdminCodeStuff.php` - Batch query injection
**FLAG-SQL-005**: Found in `DeleteUser.php` - Cascading deletion exploit

### Level 2: Authentication & Session Issues
**FLAG-AUTH-001**: Hardcoded admin credentials in `login1.php`
**FLAG-AUTH-002**: Missing session validation across multiple pages
**FLAG-AUTH-003**: Session fixation vulnerability in authentication flow
**FLAG-AUTH-004**: No brute force protection on login

### Level 3: Cross-Site Scripting (XSS)
**FLAG-XSS-001**: Reflected XSS in search/input fields
**FLAG-XSS-002**: Stored XSS in candidate information
**FLAG-XSS-003**: DOM-based XSS in analytics pages
**FLAG-XSS-004**: XSS in error messages

### Level 4: Broken Access Control
**FLAG-BAC-001**: Direct access to admin pages without authentication
**FLAG-BAC-002**: Voter can vote multiple times
**FLAG-BAC-003**: User can modify other users' data
**FLAG-BAC-004**: Election results can be manipulated

### Level 5: Security Misconfiguration
**FLAG-CONFIG-001**: Exposed database credentials in connect.php
**FLAG-CONFIG-002**: Verbose error messages revealing system info
**FLAG-CONFIG-003**: Deprecated MySQL functions (mysql_* instead of mysqli_*)
**FLAG-CONFIG-004**: No HTTPS enforcement
**FLAG-CONFIG-005**: Directory listing enabled

### Level 6: Sensitive Data Exposure
**FLAG-DATA-001**: SSN stored in plaintext
**FLAG-DATA-002**: Passwords stored without hashing
**FLAG-DATA-003**: PII exposed in URLs
**FLAG-DATA-004**: Database backup accessible

### Level 7: CSRF & Logic Flaws
**FLAG-CSRF-001**: Vote submission without CSRF token
**FLAG-CSRF-002**: User deletion without verification
**FLAG-CSRF-003**: Admin actions without CSRF protection
**FLAG-LOGIC-001**: Race condition in vote counting
**FLAG-LOGIC-002**: Integer overflow in citizen numbers

### Level 8: Advanced Exploitation
**FLAG-ADV-001**: Second-order SQL injection
**FLAG-ADV-002**: Blind SQL injection timing attacks
**FLAG-ADV-003**: File inclusion vulnerability
**FLAG-ADV-004**: Command injection potential

## 📚 Vulnerability Categories

### 1. SQL Injection Examples
```sql
-- Login bypass
Username: admin' OR '1'='1
Password: anything

-- Data extraction
ZipCode: 28223' UNION SELECT username,password,1,2,3,4 FROM person_info--

-- Vote manipulation
president: '; UPDATE ballot SET President_Selection='Hacker' WHERE 1=1--
```

### 2. Authentication Bypass
```php
// Hardcoded credentials
Username: Admin187
Password: password187

// Session manipulation
// Access admin pages directly without login
```

### 3. XSS Payloads
```html
<!-- Reflected XSS -->
<script>alert('FLAG-XSS-001')</script>

<!-- Stored XSS in candidate description -->
<img src=x onerror=alert('FLAG-XSS-002')>
```

## 🔧 Setup Instructions

### Prerequisites
- Docker & Docker Compose
- Kali Linux (recommended) or any Linux distribution
- Burp Suite Community Edition / OWASP ZAP

### Installation
```bash
# Clone the repository
git clone <your-repo>
cd evoting-security-lab

# Start the vulnerable application
docker-compose up -d

# Initialize the database
docker-compose exec db mysql -uroot -proot_password evoting < db/EvotingA.sql
docker-compose exec db mysql -uroot -proot_password evoting < db/Triggers\ and\ Views\ B.sql

# Access the application
http://localhost:8181/evoting/login1.php
```

### Database Setup
```bash
# Access MySQL container
docker-compose exec db mysql -uroot -proot_password

# Create database and import
CREATE DATABASE IF NOT EXISTS evoting;
USE evoting;
SOURCE /docker-entrypoint-initdb.d/init.sql;
```

## 🎓 Learning Objectives

### Students will learn to:
1. **Identify** SQL injection vulnerabilities
2. **Exploit** authentication weaknesses
3. **Discover** XSS attack vectors
4. **Bypass** access controls
5. **Extract** sensitive data
6. **Manipulate** application logic
7. **Use** security testing tools (Burp, ZAP, SQLMap)
8. **Document** findings professionally
9. **Recommend** security fixes
10. **Understand** OWASP Top 10

## 🛠️ Testing Tools

### Recommended Tools
- **Burp Suite**: Web proxy and scanner
- **OWASP ZAP**: Automated vulnerability scanner
- **SQLMap**: Automated SQL injection tool
- **Nikto**: Web server scanner
- **Nmap**: Port scanner
- **Metasploit**: Exploitation framework
- **John the Ripper**: Password cracker

### Tool Usage Examples
```bash
# SQLMap - test login form
sqlmap -u "http://localhost:8181/evoting/login1.php" \
  --forms --batch --risk=3 --level=5

# Nikto scan
nikto -h http://localhost:8181/evoting/

# Nmap scan
nmap -sV -sC localhost -p 8181,3306

# Burp Suite proxy
# Configure browser to use 127.0.0.1:8080
# Intercept and modify requests
```

## 📝 Challenge Hints

### SQL Injection Hints
- Look for user input that goes directly into SQL queries
- Try boolean-based injection: `' OR '1'='1`
- Test for union-based injection: `' UNION SELECT ...`
- Check for blind SQL injection with timing: `'; WAITFOR DELAY '00:00:05'--`

### Authentication Hints
- Check source code for hardcoded credentials
- Test session cookies for predictability
- Try accessing admin pages directly
- Look for session validation logic

### XSS Hints
- Test all input fields with `<script>alert(1)</script>`
- Check URL parameters for reflection
- Look for stored data that's displayed to users
- Test file upload fields

### Access Control Hints
- Try changing user IDs in URLs
- Access restricted pages directly
- Modify POST data to access other users' data
- Check for privilege escalation paths

## 🎯 Scoring System

### Point Values
- SQL Injection: 100-200 points each
- Authentication Bypass: 150-250 points
- XSS: 75-150 points each
- Access Control: 100-200 points each
- Data Exposure: 125-175 points each
- Advanced Exploits: 250-500 points each

### Bonus Points
- Document with screenshots: +50 points
- Provide remediation code: +100 points
- Create automated exploit: +150 points
- Chain multiple vulnerabilities: +200 points

## 🔒 Security Fix Examples

### SQL Injection Fix
```php
// VULNERABLE CODE
$query = "SELECT * FROM person_info WHERE Username='$Username' AND Password='$Password'";

// SECURE CODE
$stmt = $db->prepare("SELECT * FROM person_info WHERE Username=? AND Password=?");
$stmt->bind_param("ss", $Username, $Password);
$stmt->execute();
```

### XSS Prevention
```php
// VULNERABLE CODE
echo "Welcome " . $_POST['name'];

// SECURE CODE
echo "Welcome " . htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
```

### Password Hashing
```php
// VULNERABLE CODE
INSERT INTO person_info (..., Password, ...) VALUES (..., '$Password', ...);

// SECURE CODE
$hashed = password_hash($Password, PASSWORD_BCRYPT);
INSERT INTO person_info (..., Password, ...) VALUES (..., ?, ...);
```

## 📊 Progress Tracking

### Flag Submission
Students should document each flag found with:
1. Flag identifier
2. Vulnerability type
3. Exploitation method
4. Screenshot evidence
5. Affected file/function
6. Remediation recommendation

### Report Template
```markdown
## Vulnerability Report

**Flag**: FLAG-SQL-001
**Severity**: Critical
**Type**: SQL Injection
**Location**: login1.php, lines 15-20

### Description
[Detailed description]

### Proof of Concept
[Step-by-step reproduction]

### Impact
[Business and technical impact]

### Remediation
[Specific fix recommendations]
```

## 🚀 Advanced Challenges

### Chain Exploits
1. SQL Injection → Session Hijacking → Admin Access
2. XSS → Cookie Stealing → Account Takeover
3. CSRF → Vote Manipulation → Election Fraud
4. File Upload → RCE → Full System Compromise

### Capture the Secret Flags
Hidden flags require chaining multiple vulnerabilities:
- **SECRET-FLAG-001**: Requires SQL injection + privilege escalation
- **SECRET-FLAG-002**: Requires XSS + CSRF + admin access
- **SECRET-FLAG-003**: Requires all OWASP Top 10 exploits

## 📖 Additional Resources

### OWASP References
- OWASP Top 10: https://owasp.org/www-project-top-ten/
- Testing Guide: https://owasp.org/www-project-web-security-testing-guide/
- Cheat Sheets: https://cheatsheetseries.owasp.org/


## ⚖️ Legal & Ethical Notice

**IMPORTANT**: 
- Only use this application in isolated lab environments
- Never test these techniques on systems you don't own
- Unauthorized access to computer systems is illegal
- This is for educational purposes only
- Follow responsible disclosure practices
- Obtain proper authorization before any security testing

## 🤝 Contributing

To add more vulnerabilities or improve the lab:
1. Create new intentional vulnerabilities
2. Add corresponding flags and documentation
3. Provide hints and solutions
4. Test thoroughly in isolated environment

## 📄 License

Educational Use Only - Not for Production owned by Hikma Foundation. 

---

**Remember**: With great power comes great responsibility. Use these skills ethically and legally.
