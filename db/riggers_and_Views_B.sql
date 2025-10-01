drop trigger if exists voter_after_person;
delimiter \\
create trigger voter_after_person
after insert on person_info 
for each row

begin 

insert voter(V_id, V_name, ifVoted, CitizenNum) values 
(default, concat(new.FirstName, new.LastName), false, new.CitizenNum);

end \\

delimiter ;

 drop trigger if exists update_voter_status;
delimiter \\

create trigger update_voter_Status
 after insert on ballot
 for each row
begin
update voter set ifVoted = 1 
where V_id= new.V_id;

end \\

delimiter ;

-- This event update the voter table ifvoted to 0. 
drop event if exists Changed_status;
set global event_scheduler = on;
delimiter //
create event Changed_status
on schedule every 3 year
starts '2016-08-15'
do begin
 update voter
 set ifVoted = 0
 where ifVoted = 1;
  end //
 delimiter ;
 
 #Person_info
insert into person_info (CitizenNum, FirstName, LastName, Gender, Race, Date_Of_Birth, Username, Password, SSN) 
values 
(222550009, 'Abdi', 'Farhiya', 'F', 'African american', '1992-12-03', 'Farhiya1', '12345', 222550009),
(222550010, 'Alexander', 'Kayla', 'F', 'african american', '1982-12-03','alexander12', '12345', 222550010),
(222550011, 'Appel', 'Jayne', 'F', 'African american', '1972-2-22', 'Appel', '12345', 222550011),
(222550012,'Augustus', 'Seimone','F','African American','1990-10-11','Augustus','12345',222550012),
(222550013,'Ajavon', 'Matee','F','African American','1962-10-10','ajavon','12345',222550013),
(222550014, 'Achonwa', 'Natalie', 'F', 'Asian', '1992-12-12', '12Achonwa', '12345', 222550014),
(222550015, 'Adams', 'Danielle', 'F', 'Asian', '1982-12-23','Adams1234', '12345', 222550015),
(222550016, 'Allen', 'Rebecca','F', 'Asian', '1972-2-22', 'Allen1234', '12345', 222550016),
(222550017,'Ayayi', 'Valeriane','F','African American','1990-10-11','Ayayi1234','12345',222550017),
(222550018,'Bass', 'Mistie', 'F','African American','1962-10-10','Bass1234','12345',222550018),
(222550019, 'Baugh', 'Vicki', 'F', 'Asian', '1992-12-12', 'Baugh12', '12345', 222550019),
(222550020, 'Beard', 'Alana', 'F', 'Asian', '1982-12-23','Beard123', '12345', 222550020),
(222550021, 'Bentley', 'Alex', 'F', 'Asian', '1972-2-22', 'Bentley123', '12345', 222550021),
(222550022,'Bias', 'Tiffany', 'F','African American','1990-10-11','Bias123','12345',222550022),
(222550023,'Bird', 'Sue','F','African American','1962-10-10','Bird12','12345',222550023),
(222550024, 'Bishop', 'Abby', 'F', 'White', '1992-12-12', 'Bishop1', '12345', 222550024),
(222550025, 'Bone', 'Kelsey', 'F', 'Asian', '1982-12-23','Bone', '12345', 222550025),
(222550026, 'Bonner', 'DeWanna', 'F', 'White', '1972-2-22', 'Bonner', '12345', 222550026),
(222550027,'Boyd', 'Brittany','F','African American','1990-10-11','Boyd','12345',222550027),
(222550028,'Bradford', 'Crystal','F','African American','1962-10-10','Bradford1','12345',222550028),
(222550029, 'Breland', 'Jessica', 'F', 'White', '1992-12-12', 'Breland1', '12345', 222550029),
(222550030, 'Brunson', 'Rebekkah', 'F', 'Asian', '1982-12-23','Brunson1', '12345', 222550030),
(222550031, 'Carson', 'Essence', 'F', 'White', '1972-2-22', 'Carson', '12345', 222550031),
(222550032,'Carter', 'Sydney','F','African American','1990-10-11','Carter12342','12345',222550032),
(222550033,'Cash', 'Swin','F','African American','1962-10-10','Cashmoney','12345',222550033),
(222550034,'Catchings', 'Tamika', 'F', 'Asian', '1992-12-12', 'Catchgs17', '12345', 222550034),
(222550035, 'Christmas', 'Karima', 'F', 'Asian', '1982-12-23','Christmas17', '12345', 222550035),
(222550036, 'Christon', 'Shameka', 'F', 'White', '1972-2-22', 'Christon18', '12345', 222550036),
(222550037,'Clarendon', 'Layshia','F','African American','1990-10-11','Clarendon19','12345',222550037),
(222550038,'Clark', 'Alysha', 'F','Asian','1962-10-10','Clark54','12345',222550038),
(222550039, 'Cloud', 'Natasha', 'F', 'African american', '1992-12-03', 'CloudI', '12345', 222550039),
(222550040, 'Coleman', 'Marissa', 'F', 'african american', '1982-12-03','10Coleman', '12345', 222550040),
(222550041, 'Colson', 'Sydney', 'F', 'African american', '1972-2-22', '12345Colson', '12345', 222550041),
(222550042,'Cortijo', 'Carla','F','African American','1990-10-11','Aug12Cortijoustus','12345',222550042),
(222550043,'Cruz', 'Anna','F','African American','1962-10-10','12Cruz','12345',222550043),
(222550044, 'Currie', 'Monique', 'F', 'Asian', '1992-12-12', 'Currie123', '12345', 222550044),
(222550045, 'Dabovic', 'Ana', 'F', 'Asian', '1982-12-23','Dantas38', '12345', 222550045),
(222550046, 'Dantas', 'Damiris','F', 'Asian', '1972-2-22', 'Dantas', '12345', 222550046),
(222550047,'Delle Donne', 'Elena','F','African American','1990-10-11','Elena','12345',222550047),
(222550048,'DeSouza', 'Erika', 'F','African American','1962-10-10','DeSouza','12345',222550048),
(222550049, 'Diggins', 'Skylar', 'F', 'Asian', '1992-12-12', 'Skylar34', '12345', 222550049),
(222550050, 'Dolson', 'Stefanie', 'F', 'Asian', '1982-12-23','Dolson213', '12345', 222550050),
(222550051, 'Dos Santos', 'Clarissa', 'F', 'Asian', '1972-2-22', 'Clarissa21', '12345', 222550051),
(222550052,'Dupree', 'Candice', 'F','African American','1990-10-11','Dupree213','12345',222550052),
(222550053,'Faris', 'Kelly','F','African American','1962-10-10','Faris21','12345',222550053),
(222550054, 'Faulkner', 'Jamierra', 'F', 'White', '1992-12-12', 'Faulkner1', '12345', 222550054),
(222550055, 'Fowles', 'Sylvia', 'F', 'Asian', '1982-12-23','noFowles', '12345', 222550055),
(222550056, 'Francis', 'Cayla', 'F', 'White', '1972-2-22', 'Francis12', '12345', 222550056),
(222550057,'Gatling', 'Markeisha','F','African American','1990-10-11','Bosayd','12345',222550057),
(222550058,'Gray', 'Chelsea','F','African American','1962-10-10','Bradfwford1','12345',222550058),
(222550059, 'Greene', 'Kalana', 'F', 'White', '1992-12-12', 'Greene', '12345', 222550059),
(222550060, 'Gemelos', 'Jacki', 'F', 'Asian', '1982-12-23','Gemelosehj', '12345', 222550060),
(222550061, 'Gray', 'Reshanda', 'F', 'White', '1972-2-22', 'Gray281h', '12345', 222550061),
(222550062,'Griner', 'Brittney','F','African American','1990-10-11','Grinerwo','12345',222550062),
(222550063,'Goodrich', 'Angel','F','African American','1962-10-10','Goodrich54','12345',222550063),
(222550064, 'Greene', 'Nikki', 'F', 'Asian', '1992-12-12', 'Greene213', '12345', 222550064),
(222550065, 'Hamby', 'Dearica', 'F', 'Asian', '1982-12-23','Hamby34', '12345', 222550065),
(222550066, 'Hamson', 'Jennifer', 'F', 'White', '1972-2-22', 'Hamson21', '12345', 222550066),
(222550067,'Harden', 'Alex','F','African American','1990-10-11','Harden12','12345',222550067),
(966631689, 'Admin', 'Admin', 'M', 'NA', 'na', 'Admin187', 'password187', 600329904);

#Resident_info
insert into resident_info (Resident_Id, CitizenNum, Street, City, State, ZipCode, County, Phone) values 
(default ,222550009,'123 cone Road','Atlanta','GA',30334,'decab','4043270011'),
(default ,222550010,'234 tryon Road','Atlanta','GA',30334,'decab','4043250011'),
(default ,222550011,'345 valley Road','Atlanta','GA',30334,'decab','4044270011'),
(default ,222550012,'456 dell Road','Atlanta','GA',30334,'decab','4043220011'),
(default ,222550013,'213 primetime street','Atlanta','GA',30334,'decab','4043270111'),
(default ,222550014,'223 project street','Atlanta','GA',30334,'decab','4043270015'),
(default ,222550015,'343 section street','Atlanta','GA',30334,'decab','4043270041'),
(default ,222550016,'567 applied street','Atlanta','GA',30334,'decab','4043270311'),
(default ,222550017,'543 database street','Atlanta','GA',30334,'decab','4043272011'),
(default ,222550018,'753 trans street','Atlanta','GA',30334,'decab','4043270012'),
(default ,222550019,'364 burgerking blvd','Topeka','KS',66612,'king harris','440228234'),
(default ,222550020,'987 dominos blvd','Topeka','KS',66612,'king harris','440238234'),
(default ,222550021,'578 mcdonalds blvd','Topeka','KS',66612,'king harris','4402438234'),
(default ,222550022,'643 wendys blvd','Topeka','KS',66612,'king harris','4402538234'),
(default ,222550023,'356 stars blvd','Topeka','KS',66612,'king harris','4402618234'),
(default ,222550024,'276 ford blvd','Topeka','KS',66612,'king harris','4402718234'),
(default ,222550025,'846 skateboar blvd','Kittery','ME',3904,'apex','4002818234'),
(default ,222550026,'763 tomcat blvd','Kittery','ME',3904,'apex','4002918234'),
(default ,222550027,'283 xampp Road','Kittery','ME',3904,'apex','4003018234'),
(default ,222550028,'145 grove Road','Kittery','ME',3904,'apex','4003118234'),
(default ,222550029,'163 hills ave','Kittery','ME',3904,'apex','4003218234'),
(default ,222550030,'198 blue hills ave','Dover','DE',19904,'Crystal','7703328234'),
(default ,222550031,'262 circuit ave','Dover','DE',19904,'Crystal','7703418234'),
(default ,222550032,'343 standford ave','Dover','DE',19904,'Crystal','7703518234'),
(default ,222550033,'521 stanford ave','Dover','DE',19904,'Crystal','7703618234'),
(default ,222550034,'647 michigan ave','Dover','DE',19904,'Crystal','7703718234'),
(default ,222550035,'357 ohio Road','Dover','DE',19904,'Crystal','7703818234'),
(default ,222550036,'195 vale Road','Southampton','NY',6390,'lucky','8203918234'),
(default ,222550037,'909 yale Oak Road','Southampton','NY',6390,'lucky','8204018234'),
(default ,222550038,'690 duke Road','Southampton','NY',6390,'lucky','8204218234'),
(default ,222550039,'123 cone Road','Southampton','NY',6390,'lucky','820128234'),
(default ,222550040,'234 tryon Road','Southampton','NY',6390,'lucky','8201348234'),
(default ,222550041,'345 valley Road','Southampton','NY',6390,'lucky','820148234'),
(default ,222550042,'456 dell Road','Southampton','NY',6390,'lucky','820158234'),
(default ,222550043,'213 primetime street','Southampton','NY',6390,'lucky','8201658234'),
(default ,222550044,'223 project street','Southampton','NY',6390,'lucky','8201728234'),
(default ,222550045,'343 section street',' Stafford','VA',20136,'purple','757188234'),
(default ,222550046,'567 applied street',' Stafford','VA',20136,'purple','757198234'),
(default ,222550047,'543 database street',' Stafford','VA',20136,'purple','7572058234'),
(default ,222550048,'753 trans street',' Stafford','VA',20136,'purple','7572118234'),
(default ,222550049,'364 burgerking blvd',' Stafford','VA',20136,'purple','757228234'),
(default ,222550050,'987 dominos blvd',' Stafford','VA',20136,'purple','757238234'),
(default ,222550051,'578 mcdonalds blvd',' Stafford','VA',20136,'purple','7572438234'),
(default ,222550052,'643 wendys blvd',' Stafford','VA',20136,'purple','7572538234'),
(default ,222550053,'356 stars blvd','  Cheyenne',' WY',82001,'phat','9242618234'),
(default ,222550054,'276 ford blvd','  Cheyenne',' WY',82001,'phat','9244718234'),
(default ,222550055,'846 skateboar blvd',' Cheyenne',' WY',82001,'phat','9242818234'),
(default ,222550056,'763 tomcat blvd',' Cheyenne',' WY',82001,'phat','9242918234'),
(default ,222550057,'283 xampp Road',' Cheyenne',' WY',82001,'phat','9243018234'),
(default ,222550058,'145 grove Road',' Cheyenne',' WY',82001,'phat','9243118234'),
(default ,222550059,'163 hills ave',' Cheyenne',' WY',82001,'phat','9243218234'),
(default ,222550060,'198 blue hills ave',' Cheyenne',' WY',82001,'phat','9243328234'),
(default ,222550061,'262 circuit ave','Worthington','OH',43025,'havelock','9163418234'),
(default ,222550062,'343 standford ave','Worthington','OH',43025,'havelock','9163518234'),
(default ,222550063,'521 stanford ave','Worthington','OH',43025,'havelock','9163618234'),
(default ,222550064,'647 michigan ave','Worthington','OH',43025,'havelock','9163718234'),
(default ,222550065,'357 ohio Road','Worthington','OH',43025,'havelock','9163818234'),
(default ,222550066,'195 vale Road','Frankfort','KY',40601,'newport','9163918234'),
(default ,222550067,'909 yale Oak Road','Frankfort', 'KY',40601,'newport','9164018234');


#Ballot table  
INSERT INTO ballot (ballot_id, V_id, Party_id, Date_of_vote, C_id, State_Num, President_Selection) VALUES 
(default,50075,200,2012, 14, 15,'Bernie Sanders'), 
(default,50076,200,2012, 14, 15,'Bernie Sanders'), 
(default,50077,200,2012, 14, 15,'Bernie Sanders'), 
(default,50078,200,2012, 14, 15,'Bernie Sanders'), 
(default,50079,200,2012, 15, 15,'Ben Carson'), 
(default,50080,200,2012, 15, 15,'Ben Carson'), 
(default,50081,200,2012, 16, 15,'Chris Christie'), 
(default,50082,200,2012, 14, 15,'Bernie Sanders'), 
(default,50083,200,2012, 15, 15,'Ben Carson'), 
(default,50084,200,2012, 14, 15,'Bernie Sanders'), 
(default,50085,200,2012, 16, 21,'Chris Christie'), 
(default,50086,200,2012, 14, 21,'Bernie Sanders'), 
(default,50087,200,2012, 15, 21,'Ben Carson'), 
(default,50088,200,2012, 14, 21,'Bernie Sanders'), 
(default,50089,200,2012, 15, 21,'Ben Carson'), 
(default,50090,200,2012, 14, 21,'Bernie Sanders'), 
(default,50091,200,2012, 15, 24,'Ben Carson'), 
(default,50092,200,2012, 16, 24,'Chris Christie'), 
(default,50093,200,2012, 14, 24,'Bernie Sanders'), 
(default,50094,200,2012, 14, 24,'Bernie Sanders'), 
(default,50095,200,2012, 14, 24,'Ben Carson'), 
(default,50096,200,2012, 14, 13,'Bernie Sanders'), 
(default,50097,200,2012, 14, 13,'Ben Carson'), 
(default,50098,200,2012, 14, 13,'Bernie Sanders'), 
(default,50099,200,2012, 15, 13,'Ben Carson'), 
(default,50100,200,2012, 14, 13,'Bernie Sanders'), 
(default,50101,200,2012, 14, 13,'Bernie Sanders'), 
(default,50102,200,2012, 14, 36,'Bernie Sanders'), 
(default,50103,200,2012, 15, 36,'Ben Carson'), 
(default,50104,200,2012, 14, 36,'Bernie Sanders'),
(default,50105,200,2012, 14, 36,'Bernie Sanders'), 
(default,50106,200,2012, 14, 36,'Bernie Sanders'), 
(default,50107,200,2012, 14, 36,'Bernie Sanders'), 
(default,50108,200,2012, 14, 36,'Bernie Sanders'), 
(default,50109,200,2012, 15, 36,'Ben Carson'), 
(default,50110,200,2012, 15, 36,'Ben Carson'), 
(default,50111,200,2012, 16, 46,'Chris Christie'), 
(default,50112,200,2012, 14, 46,'Bernie Sanders'), 
(default,50113,200,2012, 15, 46,'Ben Carson'), 
(default,50114,200,2012, 14, 46,'Bernie Sanders'), 
(default,50115,200,2012, 16, 46,'Chris Christie'), 
(default,50116,200,2012, 14, 46,'Bernie Sanders'), 
(default,50117,200,2012, 15, 46,'Ben Carson'), 
(default,50118,200,2012, 14, 46,'Bernie Sanders'), 
(default,50119,200,2012, 15, 50,'Ben Carson'), 
(default,50120,200,2012, 14, 50,'Bernie Sanders'), 
(default,50121,200,2012, 15, 50,'Ben Carson'), 
(default,50122,200,2012, 16, 50,'Chris Christie'), 
(default,50123,200,2012, 14, 50,'Bernie Sanders'), 
(default,50124,200,2012, 14, 50,'Bernie Sanders'), 
(default,50125,200,2012, 14, 50,'Ben Carson'), 
(default,50126,200,2012, 14, 50,'Bernie Sanders'),
(default,50127,200,2012, 14, 37,'Ben Carson'), 
(default,50128,200,2012, 14, 37,'Bernie Sanders'), 
(default,50129,200,2012, 15, 37,'Ben Carson'), 
(default,50130,200,2012, 14, 37,'Bernie Sanders'), 
(default,50131,200,2012, 14, 37,'Bernie Sanders'), 
(default,50132,200,2012, 14, 22,'Bernie Sanders'), 
(default,50133,200,2012, 15, 22,'Ben Carson');

#check deceased table to ssn before insert into person_info

drop trigger if exists dead_ssn_check;
delimiter //
create trigger dead_ssn_check
 before insert on person_info
 for each row
 begin
 declare dead_ssn int;
 set dead_ssn=1;
 select count(1) into dead_ssn from deceased
 where deceased.dead_ssn= new.ssn;
 if dead_ssn>0 then 
 signal sqlstate '22003'
 set message_text= 'user already exist',
 mysql_errno=1264 ;
 end if;
 
  if(DATE_FORMAT(NOW(),'%y')-DATE_FORMAT(new.Date_Of_Birth,'%y') < 18)
 then 
	signal SQLSTATE 'HY000'
    Set MESSAGE_TEXT = 'You are not 18 or above to register, therefor you cannot vote';
 end if;
 end //
 
 delimiter ;
 
 
 Drop view if exists PresVotes;
Create view PresVotes as
SELECT count(ballot_id) as vote, President_selection
FROM evoting.ballot
where date_of_vote = 2012
group by party_id 
having vote > max(vote)
order by vote desc
limit 1;


# Creating all the vies needed for the Database

# Creating A view to help admin troubleshoot username issues;
drop view if exists Admin_UsernameCheck;

Create View Admin_UsernameCheck AS

SELECT CONCAT( FirstName, ' ',LastName) as Name, Year(Date_of_Birth) BirthYear, ZipCode as Zip, SUBSTRING(SSN, 4) as Last_Four_Of_SSN, Username, Password
FROM evoting.person_info
join evoting.resident_info
	on person_info.CitizenNum = resident_Info.CitizenNum
 Order By FirstName asc;
 
drop view if exists VoterBreakDown;
Create View VoterBreakDown as 
select  President_selection as Name, count(voter.V_id) as TotalVotes
from voter join
ballot on
voter.V_id = ballot.V_id
where Date_of_Vote = '2012'
group by president_selection;



# All Voters 
Drop view if exists Allvoters;
create view Allvoters AS
select v_name, state_name, party_name, President_Selection
from ballot join voter on ballot.v_id = voter.v_id
join party on ballot.party_id = party.party_id 
join district_info on ballot.state_num = district_info.state_num
where date_of_vote=2012
order by v_name;

# List the Candidate Information 
drop view if exists candidatesinfo;
create VIEW candidatesinfo AS 
select candidate.C_name, candidate.Term, party.Party_Name, candidate.Description
from candidate join party on candidate.Party_id = party.Party_id
where candidate.Term = 2016;

 
# Create view who voted democrate DemocraticVotes
drop view if exists DemocraticVotes;
create view DemocraticVotes as
select  voter.V_name as Voter, district_info.State_Name as State, party.Party_Name as Party, ballot.President_Selection as President, 
ballot.Date_of_Vote as Election_year
from voter join ballot on ballot.V_id = voter.V_id join party on ballot.Party_id=party.Party_id join district_info on ballot.State_Num = district_info.State_Num
where party.Party_Name = 'Democratic Party'
order by Voter;

#View show who voted for republican party
drop view if exists RepublicanVotes;
create view RepublicanVotes as
select   voter.V_name as Voter, district_info.State_Name as State , party.Party_Name as Party, ballot.President_Selection as President, ballot.Date_of_Vote as Election_year
from voter join ballot on voter.V_id = ballot.V_id join  party on party.Party_id =ballot.Party_id join district_info on district_info.State_Num = ballot.State_Num
where party.Party_Name = 'Republican Party'
order by Voter;  
  
# List the state name with is ID number  
drop view if exists FindStateId; #StateInfo;
Create View FindStateId As 
select State_Name, State_Num 
from district_info 
order by State_Name;


#Create view for listing all the PartyType 
drop view if exists PartyType;
create view PartyType as 
Select * 
from party
order by party_name asc;
  
 
#List users polling staions
Drop view if exists users_polling_station_location;
CREATE VIEW  users_polling_station_location as
SELECT State, City, County, polling_ZipCode, Address
FROM resident_info
	JOIN polling_station ON resident_info.ZipCode = polling_station.polling_ZipCode 
	ORDER BY resident_info.State;


# Displays All the candidates in the 2016 elections their parties and number of votes 
Drop view if exists PresidentStats;
create view PresidentStats as
select DISTINCT party_name, president_selection, count(*) as votes
from evoting.ballot join evoting.party on evoting.ballot.party_id=party.party_id
where Date_of_Vote = 2012
group by president_selection with rollup;

Drop view if exists PartyStats;
Create View PartyStats as
select DISTINCT party_name,  count(*) as votes
from evoting.ballot join evoting.party on evoting.ballot.party_id=party.party_id
where Date_of_Vote = 2012 
group by party_name;


# Clalcualtes which states are what party and number votes per state
drop view if exists StateBreakDown;
Create view StateBreakDown as
select state_name, Count(ballot_id) as votes, party_name as party
from ballot join voter on ballot.v_id = voter.v_id
join party on ballot.party_id = party.party_id 
join district_info on ballot.state_num = district_info.state_num
where date_of_vote = 2012
group by ballot.State_Num
order by district_info.State_Name asc;
