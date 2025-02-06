-- Schema evoting
DROP SCHEMA IF EXISTS evoting ;

-- Schema evoting

CREATE SCHEMA IF NOT EXISTS evoting DEFAULT CHARACTER SET utf8 ;
USE evoting ;

-- Table Deceased
DROP TABLE IF EXISTS Deceased ;

CREATE TABLE IF NOT EXISTS Deceased (
  dead_SSN INT primary key unique NOT NULL,
  FirstName VARCHAR(45) not NULL,
  LastName VARCHAR(45) not NULL,
  Date_Of_Death VARCHAR(45) not NULL);
  
-- Table person_info
DROP TABLE IF EXISTS person_info ;

CREATE TABLE IF NOT EXISTS person_info (
  CitizenNum INT primary key unique NOT NULL,
  FirstName VARCHAR(45) not NULL,
  LastName VARCHAR(45) noT NULL,
  Gender CHAR(1) DEFAULT NULL,
  Race VARCHAR(45) DEFAULT NULL,
  Date_Of_Birth varchar(11) NULL,
  Username VARCHAR(60) unique NOT NULL,
  Password VARCHAR(60) NOT NULL,
  SSN INT unique NOT NULL,
  INDEX FK_CitizenNum_Voter (CitizenNum ASC));

-- Table resident_info
DROP TABLE IF EXISTS resident_info ;

CREATE TABLE IF NOT EXISTS resident_info (
  Resident_Id INT primary key unique NOT NULL auto_INCREMENT,
  CitizenNum INT unique NOT NULL,
  Street VARCHAR(45) not NULL,
  City VARCHAR(45) not NULL,
  State VARCHAR(45) not NULL,
  ZipCode INT(11) not NULL,
  County VARCHAR(45) not NULL,
  Phone VARCHAR(15) NULL,
CONSTRAINT FK_person_Info
    FOREIGN KEY (CitizenNum)
    REFERENCES person_info (CitizenNum) );

-- Table voter
DROP TABLE IF EXISTS voter ;

CREATE TABLE IF NOT EXISTS voter (
  V_id INT primary key unique NOT NULL AUTO_INCREMENT,
  V_name VARCHAR(220) not NULL,
  ifVoted TINYINT(1) NULL,
  CitizenNum INT(11) NOT NULL,
  INDEX FK_Ballot_Vid_idx (V_id ASC),
CONSTRAINT FK_CitizenNum_Voter
    FOREIGN KEY (CitizenNum)
    REFERENCES person_info (CitizenNum));

-- Table district_info
DROP TABLE IF EXISTS district_info;

CREATE TABLE IF NOT EXISTS district_info (
  State_Num INT(11) primary key unique NOT NULL AUTO_INCREMENT,
  State_Name VARCHAR(60) NOT NULL,
  City_Zone INT(11) NOT NULL,
  District_Num INT(11) NOT NULL);

-- Table polling_station
DROP TABLE IF EXISTS polling_station ;

CREATE TABLE IF NOT EXISTS polling_station (
station_id int primary key not null AUTO_INCREMENT,
polling_ZipCode int unique not null,
  Address VARCHAR(60) not NULL,
  State_Num INT(11) not NULL,
  INDEX FK_PollingStationNum_District_Info_idx (State_Num ASC),
CONSTRAINT FK_PollingStationNum_District_Info
    FOREIGN KEY (State_Num)
    REFERENCES district_info (State_Num));

-- Table party
DROP TABLE IF EXISTS party ;

CREATE TABLE IF NOT EXISTS party (
  Party_id INT primary key unique NOT NULL,
  Party_Name VARCHAR(45) NULL);

-- Table candidate
DROP TABLE IF EXISTS candidate ;

CREATE TABLE IF NOT EXISTS candidate (
  C_id INT primary key unique NOT NULL AUTO_INCREMENT,
  C_name VARCHAR(220) not NULL,
  Title VARCHAR(45) not NULL,
  Term YEAR not NULL,
  Description TEXT not NULL,
  Location VARCHAR(45) not NULL,
  Party_id INT NOT NULL,
  INDEX party_id_fk_Pary_idx (Party_id ASC),
  CONSTRAINT party_id_fk_Pary
    FOREIGN KEY (Party_id)
    REFERENCES party (Party_id));


-- Table ballot
DROP TABLE IF EXISTS ballot ;

CREATE TABLE IF NOT EXISTS ballot (
  Ballot_id INT primary key unique NOT NULL AUTO_INCREMENT,
  V_id INT NOT NULL,
  Party_id INT NOT NULL,
  Date_of_Vote YEAR NOT NULL,
  C_id int, 
  State_Num INT(11),
  President_Selection VARCHAR(220) NULL,
CONSTRAINT FK_Voter_Vid
    FOREIGN KEY (V_id)
    REFERENCES voter (V_id),
CONSTRAINT FK_party_partyid
    FOREIGN KEY (party_id)
    REFERENCES party (party_id),
CONSTRAINT FK_candidate_cid
    FOREIGN KEY (c_id)
    REFERENCES candidate (c_id),
CONSTRAINT FK_district_State_Num
    FOREIGN KEY (State_Num)
    REFERENCES district_info (State_Num));

#decease
insert into deceased values 
(999667777, 'tennis', 'woods', '1890-12-30'),
(999557777, 'mustang', 'charlotte', '1900-11-10'),
(999557666, 'head', 'fedder', '1900-10-10'),
(666557666, 'wilson', 'niner', '1900-9-10'),
(966657666, 'left', 'babolt', '1900-11-11'),
(999566666, 'right', 'one', '1930-11-10');

#Person_info
insert into person_info (CitizenNum, FirstName, LastName, Gender, Race, Date_Of_Birth, Username, Password, SSN) 
values 
(235630009, 'mike', 'jones', 'M', 'White', '1992-12-12', 'mjones', 'teamss', 125326564),
(235630012, 'smith', 'sam',  'M', 'White', '1982-12-23','samsmith', 'awerty', 125327682),
(235630011, 'james', 'jones', 'M', 'White', '1972-2-22', 'jones12', 'qwerty', 125326941),
(111111111,'Almaz','yilma','M','African American','1990-10-11','ay1978','pass123',362413),
(111111112,'Ali','Yasir','M','African American','1962-10-10','Ali1962','pass234',062070),
(111111113,'Amal','Maow','F','African American','1988-04-04','Amal187','pass456',002010),
(111111114,'Balqis','Amir','F','African American','1986-04-04 ','Baliz01','pass789',1026107),
(111111115,'Zack','Amir','M','White','1990-04-04 ','Zack103','pass101',2223331),
(111111116,'Abe', 'Amir','M','American Indian','1990-04-03 ','abe203','pass403',2223332),
(111111117,'Beck','Amir','M','American Indian','1950-03-04 ','Beck03','pass909',2223333),
(111111118,'Candy','Amir','M','American Indian','1980-11-11 ','Candy03','pass808',2223534),
(111111119,'Sandy','Amir','M','American Indian','1970-12-11 ','Sandy01','pass707',2223634),
(111111120,'Dandy','Amir','M','American Indian','1960-12-04 ','Dandy02','pass714',2223734),
(111111121,'Fanny','Amir','M','American Indian','1950-11-07 ','Fanny03','pass801',2223834),
(111111122,'Foxxy','Amir','M','American Indian','1930-02-03 ','Foxxy03','pass601',2223934),
(111111123,'John','Amir','M','American Indian','1987-11-04 ','John03','pass601',2223339),
(111111124,'Gabe','Amir','M','American Indian','1966-09-06 ','Gabe06','pass701',2223330),
(111111125,'Bob','Amir','M','American Indian','1962-07-07 ','Bob07','pass701',2453334),
(111111126,'Bean','Amir','M','American Indian','1984-08-08 ','Bean08','pass301',2653334),
(111111127,'Beth','Amir','M','American Indian','1977-07-04 ','Beth08','pass201',2227734),
(704678123, 'norma', 'jones', 'f', 'American Indian', '1987-03-12', 'njones', 'jones123', 074678123),
(704687123, 'norm', 'jones', 'M', 'American Indian', '1988-11-19', 'njones1', 'njones123', 076478123),
(704678132, 'network', 'guide', 'M', 'American Indian', '1967-03-12', 'guide1', 'heart', 075678123),
(704699123, 'index', 'phone', 'f', 'American Indian', '1988-06-22', 'iphone', 'hearrt', 074678003),
(707778123, 'axel', 'van', 'f', 'Pacific Islander', '1927-03-12', 'axel2', 'heartw', 074670103),
(775678123, 'annie', 'taylor', 'f', 'Pacific Islander', '1987-03-26', 'anntay', 'mine1', 075578123),
(004678123, 'taylor', 'union', 'F', 'Pacific Islander', '1957-10-22', 'unitay', 'tayuni', 074672323),
(095678123, 'lenovo', 'citizen', 'f', 'Pacific Islander', '1987-03-01', 'lcitizen', 'comp', 078878123),
(096678123, 'china', 'jones', 'f', 'Pacific Islander', '1987-03-12', 'cjones', 'cjones23', 074678333),
(534678123, 'marker', 'degree', 'f', 'Pacific Islander', '1982-08-23', 'redblue', 'blue3', 064678123),
(324678123, 'apple', 'titan', 'M', 'Pacific Islander', '1967-04-15', 'redapple', 'beer', 604678123),
(512678123, 'jameca', 'smith', 'f', 'Pacific Islander', '1954-01-18', 'jamout', 'water', 074678883),
(453678123, 'prince', 'polo', 'f', 'Pacific Islander', '1987-03-12', 'purplerain', 'peepee', 097678123),
(867530910, 'kitten', 'star', 'f', 'Pacific Islander', '1977-08-17', 'minikit', 'yumyum', 554678123),
(997530910, 'juan', 'farve',  'M', 'White', '1956-09-15', 'mexico32', 'farve21', 551178123),
(997630910, 'rockell', 'rivera', 'f', 'White', '1972-10-07', 'rara', 'runny', 554228123),
(997531210, 'walker', 'smith', 'M', 'White', '1962-12-18', 'titans', 'tennes', 554679523),
(997582910, 'patric', 'star', 'f', 'White', '1991-04-27', 'sponge', 'bob', 554629123),
(993882910, 'wonder', 'honeywell', 'M', 'White', '1992-05-28', 'bread', 'money', 554867912),
(990882910, 'raulph', 'raven', 'M', 'White', '1990-05-29', 'pimp21', 'pass', 554644423),
(997582019, 'padro', 'martin', 'M', 'White', '1946-01-30', 'oldpadro', 'napo', 554629321),
(997592810, 'duglas', 'bear', 'M', 'White', '1994-10-01', 'blurbear', 'living', 552428213),
(997565310, 'marcus', 'night', 'M', 'White', '1993-06-02', 'micnight', 'singa', 554620153),
(822630009, 'mat', 'harrison', 'M', 'African american', '1992-12-12', 'hairson', 'champ', 3345326564),
(823630012, 'barnes', 'mat', 'M', 'african american', '1982-12-23','barnes21', 'fisher', 363327682),
(824630011, 'steph', 'curry', 'M', 'African american', '1972-2-22', 'lilsteph', 'for3', 338626941),
(825111111,'kobe','bryant','M','African American','1990-10-11','beanbryant','laker24',330362413),
(826111112,'harden','james','M','African American','1962-10-10','cooking','dance',337062070),
(827630009, 'westbrook', 'russel', 'M', 'Asian', '1992-12-12', 'thunder', 'oneman', 334656564),
(828630012, 'rose', 'derrick', 'M', 'Asian', '1982-12-23','bulls', 'hurt', 333286485),
(829630011, 'lebron', 'james','M', 'Asian', '1972-2-22', 'james6', 'norings', 335338941),
(830111129,'micheal','jordan','M','African American','1990-10-11','jumpman','6rings',333549281),
(811221112,'rudy','gay', 'M','African American','1962-10-10','uconn','ncaa1',333657483),
(835230009, 'chris', 'bosh', 'M', 'Asian', '1992-12-12', 'reptar', 'heat6', 333231450),
(835240012, 'dwyane', 'wade', 'M', 'Asian', '1982-12-23','getup3', 'heat3', 333876574),
(835250011, 'chris', 'anderson', 'M', 'Asian', '1972-2-22', 'birdman', 'block', 333787584),
(811261111,'Biyombo','Bismack', 'M','African American','1990-10-11','bigmac','1bigmac',333872123),
(811271112,'dj','augustin','M','African American','1962-10-10','pgdj','spin',333908374),
(835280009, 'luke', 'walten', 'M', 'White', '1992-12-12', 'lwalter', 'nopoints', 333549807),
(835290012, 'asik', 'omer', 'M', 'Asian', '1982-12-23','aomer', 'amer', 333847561),
(835300981, 'darell', 'arthur', 'M', 'White', '1972-2-22', 'darthur', 'books', 333309273),
(811111201,'brandon','bass','M','African American','1990-10-11','bassfisher','bass',333152623),
(811111222,'nicolas','batum','M','African American','1962-10-10','blazers','noshow',333427586),
(835632309, 'aron', 'bayless', 'M', 'White', '1992-12-12', 'payless', 'teamss', 333978675),
(835632412, 'trevor', 'booker', 'M', 'Asian', '1982-12-23','nobuckets', 'awerty', 333255768),
(835632511, 'jordan', 'clarkson', 'M', 'White', '1972-2-22', 'rookie', 'qwerty', 333758923),
(811112611,'rakeem','christmas','M','African American','1990-10-11','merry','pass123',333731143),
(811153612,'norris','cole','M','African American','1962-10-10','benchriding','pass234',333419867),
(835630329, 'jamal', 'crawford', 'M', 'Asian', '1992-12-12', 'handles', 'teamss', 335326364),
(835630012, 'stephen', 'curry', 'M', 'Asian', '1982-12-23','allday', 'awerty', 372877382),
(888630011, 'tyreke', 'evans', 'M', 'White', '1972-2-22', 'bully', 'qwerty', 372326941),
(838111341,'kenneth','faried','M','African American','1990-10-11','blockparty','pass123',332362413),
(811137512,'pau','Gasol', 'M','Asian','1962-10-10','marc','pass234',330624070);


#Resident_info
insert into resident_info (Resident_Id, CitizenNum, Street, City, State, ZipCode, County, Phone) values 
(1,111111111,'9505 Black Oak Road','Greensboroo','NC',28216,'Harris','7044582344'),
(2,111111112,'9507 Sanders Blv', 'Charlotte','NC',28216,'Mecklenburg','7042316923'),
(default,111111113,'9506 Valley Fair','Charlotte','NC',28223,'Harris','7043037719'),
(default,111111114,'9505 City Fair Dr. ','Apex','NC',28223,'Rowan','7044583338'), 
(default,111111115,'789 Botttomline Road','Greensboroo','NC',28216,'Harris','7042212344'),
(default,111111116,'846 grand mac Road','Greensboroo','NC',28216,'Harris','7042242344'),
(default,111111117,'100 acc Road','Greensboroo','NC',28216,'Harris','7042262344'),
(default,111111118,'1000 residents Road','Greensboroo','NC',28216,'Harris','7042622344'),
(default,111111119,'1010 morrison street','raleigh','NC',28216,'Harris','8905452344'),
(default,111111120,'2323 hokies street','raleigh','NC',28216,'Harris','8905432344'),
(default,111111121,'3434 brokie street','raleigh','NC',28216,'Harris','8907542344'),
(default,111111122,'955 club street','raleigh','NC',28216,'Harris','8904582344'),
(default,111111123,'957 brewer ave','Charlotte','NC',28216,'Harris','7744566544'),
(default,111111124,'8572 standford ave','Charlotte','NC',28216,'Harris','7744587254'),
(default,111111125,'1827 stanford ave','Charlotte','NC',28216,'Harris','7744594944'),
(default,111111126,'3954 summet ave','Charlotte','NC',28216,'Harris','7745658344'),
(default,111111127,'4545 wilson blvd','Matthews','NC',28216,'Harris','7044581131'),
(default, 235630009, '201 university', 'charlotte', 'NC', 28223, 'meck', '323-742-3234'),
(default, 235630012, '542 datacall ave', 'charlotte', 'NC', 28216, 'meck', '323-321-3234'),
(default, 235630011, '321 recreation way', 'charlotte', 'NC', 28223, 'meck', '323-742-8753'),
(default ,704678123,'100 RED Oak Road','medora','ND',58645,'Cheteau','234458234'),
(default ,704687123,'203 green forest Road','cloumbia','SC',29201,'rock','9602132344'),
(default ,704678132,'102 hidden tree Road','massitina','MA',1430,'Harris','1434587744'),
(default ,704699123,'103 summer eve Road','Wilson','AL',36106,'Bishop','5853282321'),
(default ,707778123,'238 test break street','Tusclusa','AL',36117,'protect','7125454344'),
(default ,775678123,'213 highlight zone street','fairbanks','AK',99709,'neck','7044582344'),
(default ,004678123,'308 blackboard charge street','central','AK',99730,'stuart','7044582344'),
(default ,095678123,'832 penville street','phoenix','AZ',85040,'census','4739093344'),
(default ,096678123,'777 spring scent ave','creek','AZ',85331,'axel','8984345656'),
(default ,534678123,'234 hat falls ave','gravette','AR',72736,'totas','7674359944'),
(default ,324678123,'345 rock nest ave','decatur','AR',72722,'dotson','7673328344'),
(default ,512678123,'543 loc nest ave','markleeville','CA',96120,'water','8036781212'),
(default ,453678123,'1023 spade chew circuit','san andrews','CA',95249,'montia','8032516753'),
(default ,867530910,'2738 wells corner circuit','denver','CO',80204,'moeny','5845438790'),
(default ,997530910,'8263 fargo circuit','denver','CO',80202,'intern','5844582344'),
(default ,997630910,'3645 expo circuit','hartford','CT',6106,'milford','8604367554'),
(default ,997531210,'6547 blacksburg blvd','greenwich','CT',6830,'Harris','8603346574'),
(default ,997582910,'0192 charlotte blvd','dover','DE',19904,'pools','5594432111'),
(default ,993882910,'9283 rush blvd','Tallahassee','FL',32399,'springs','5047861144'),
(default ,990882910,'8475 onoff blvd','Atlanta','GA',30334,'washington','4043035444'),
(default ,997582019,'4373 johns lane','hilo','HI',96720,'waves','0032436564'),
(default ,997592810,'5421 haydens lane','boise','ID',83704,'benjamin','5553337788'),
(default ,997565310,'7843 deputy lane','chicago','IL',60601,'chiraq','6678642233'),
(default ,822630009,'123 cone Road','Markleeville','CA',96120,'roan','920128234'),
(default ,823630012,'234 tryon Road','Markleeville','CA',96120,'catawab','9201348234'),
(default ,824630011,'345 valley Road','Markleeville','CA',96120,'roan','920148234'),
(default ,825111111,'456 dell Road','Markleeville','CA',96120,'roan','920158234'),
(default ,826111112,'213 primetime street','Markleeville','CA',96120,'roan','9201658234'),
(default ,827630009,'223 project street','Markleeville','CA',96120,'catawab','9201728234'),
(default ,828630012,'343 section street','Markleeville','CA',96120,'catawab','920188234'),
(default ,829630011,'567 applied street','Markleeville','CA',96120,'catawab','920198234'),
(default ,830111129,'543 database street','Markleeville','CA',96120,'catawab','9202058234'),
(default ,811221112,'753 trans street','Markleeville','CA',96120,'catawab','9202118234'),
(default ,835230009,'364 burgerking blvd','Markleeville','CA',96120,'catawab','920228234'),
(default ,835240012,'987 dominos blvd','Markleeville','CA',96120,'king moutain','920238234'),
(default ,835250011,'578 mcdonalds blvd','Markleeville','CA',96120,'king moutain','9202438234'),
(default ,811261111,'643 wendys blvd','Markleeville','CA',96120,'king moutain','9202538234'),
(default ,811271112,'356 stars blvd','Markleeville','CA',96120,'king moutain','9202618234'),
(default ,835280009,'276 ford blvd','Markleeville','CA',96120,'king moutain','9202718234'),
(default ,835290012,'846 skateboar blvd','San Andreas','CA',95249,'catawab','9202818234'),
(default ,835300981,'763 tomcat blvd','San Andreas','CA',95249,'king moutain','9202918234'),
(default ,811111201,'283 xampp Road','San Andreas','CA',95249,'catawab','9203018234'),
(default ,811111222,'145 grove Road','San Andreas','CA',95249,'king moutain','9203118234'),
(default ,835632309,'163 hills ave','San Andreas','CA',95249,'catawab','9203218234'),
(default ,835632412,'198 blue hills ave','San Andreas','CA',95249,'roan','9203328234'),
(default ,835632511,'262 circuit ave','San Andreas','CA',95249,'catawab','9203418234'),
(default ,811112611,'343 standford ave','San Andreas','CA',95249,'catawab','9203518234'),
(default ,811153612,'521 stanford ave','San Andreas','CA',95249,'catawab','9203618234'),
(default ,835630329,'647 michigan ave','San Andreas','CA',95249,'catawab','9203718234'),
(default ,835630012,'357 ohio Road','San Andreas','CA',95249,'king moutain','9203818234'),
(default ,888630011,'195 vale Road','San Andreas','CA',95249,'roan','9203918234'),
(default ,838111341,'909 yale Oak Road','San Andreas','CA',95249,'roan','9204018234'),
(default ,811137512,'690 duke Road','San Andreas','CA',95249,'roan','9204218234');


#voter
insert into voter (V_id, V_name, ifVoted, CitizenNum) values 
(50001,'Almaz yilma',1,111111111), 
(default,'Ali Yasir',1,111111112),
(default,'Amal Maow',1,111111113),
(default,'Balqis Amir',1,111111114),
(default,'Zack Amir',1,111111115),
(default,'Abe Amir',1,111111116),
(default,'Beck Amir',1,111111117),
(default,'Candy Amir',1,111111118),
(default,'Sandy Amir',1,111111119),
(default,'Dandy Amir',1,111111120),
(default,'Fanny Amir',1,111111121),
(default,'Foxxy Amir',1,111111122),
(default,'John Amir',1,111111123),
(default,'Gab Amir',1,111111124),
(default,'Bob Amir',1,111111125),
(default,'Bean Amir',1,111111126),
(default,'Beth Amir',1,111111127),
(default, 'mike jones', 1, 235630009),
(default, 'smith sam', 1, 235630012),
(default, 'james jones', 1, 235630011),
(default,'norma jones',1,704678123), 
(default,'norm jones',1,704687123),
(default,'network guide',1,704678132), 
(default,'index phone',1,704699123),
(default,'axel van',1,707778123), 
(default,'annie taylor',1,775678123),
(default,'taylor union',1,004678123), 
(default,'lenovo citizen',1,095678123),
(default,'china jones',1,096678123), 
(default,'mark degree',1,534678123),
(default,'apple titan',1,324678123), 
(default,'jameca smith',1,512678123),
(default,'prince polo',1,453678123), 
(default,'kitten star',1,867530910),
(default,'juan farve',1,997530910), 
(default,'rockell rivera',1,997630910),
(default,'walker smith',1,997531210), 
(default,'patric star',1,997582910),
(default,'wonder honeywell',1,993882910), 
(default,'raulph raven',1,990882910),
(default,'padro martin',1,997582019), 
(default,'duglas bear',1,997592810),
(default,'marcus night',1,997565310),
(default,'mat harrison',1,822630009), 
(default,'barnes mat',1,823630012),
(default,'steph curry',1,824630011),
(default,'kobe bryant',1,825111111),
(default,'harden james',1,826111112),
(default,'westbrook russel',1,827630009),
(default,'rose derrick',1,828630012),
(default,'lebron james',1,829630011),
(default,'micheal jordan',1,830111129),
(default,'rudy gay',1,811221112),
(default,'chris bosh',1,835230009),
(default,'dwyane wade',1,835240012),
(default,'chris anderson',1,835250011),
(default,'Biyombo Bismack',1,811261111),
(default,'dj augustin',1,811271112),
(default,'luke walten',1,835280009),
(default,'asik omer',1,835290012),
(default,'darell arthur',1,835300981),
(default,'brandon bass',1,811111201),
(default,'nicolas batum',1,811111222),
(default,'aron bayless',1,835632309),
(default,'trevor booker',1,835632412),
(default,'jordan clarkson',1,835632511),
(default,'rakeem christmas',1,811112611),
(default,'norris cole',1,811153612),
(default,'jamal crawford',1,835630329),
(default,'stephen curry',1,835630012),
(default,'tyreke evans',1,888630011),
(default,'kenneth faried',1,838111341),
(default,'pau Gasol',1,811137512);


#Party
insert into party values 
(100,'Republican Party'),
(200,'Democratic Party'),
(300,'Independent Party'),
(400,'Libertarian Party'),
(500,'Green Party Party'),
(600,'Constitution Party');

#Candidate
INSERT INTO candidate VALUES 
(11,'Hilary Clinton','President',2016,'Oh! I Missed White House (^_^)! Former US Secretary of State Hillary Clinton','Newyork',200),
(12,'D. Trump','President.',2016,'Mr. Mean himself... No Mercy, Power Hungry human...everybody is a looser','California',100),
(13,'Mr. Robot','President',2016,'Please vote for me! I am awesome','North Carolina',300),
(default, 'Bernie Sanders','President',2012,'I think people should be a little bit careful underestimating me. FROM THE LEFTMr. Sanders has drawn enthusiasm among voters who were craving a more liberal option in the Democratic mix. ','Maryland',200),
(default, 'Ben Carson','President',2012,'I am probably never going to be politically correct because I am not a politician. POLITICAL NOVICEMr. Carson gained attention from conservatives in 2013 for a speech at the National Prayer Breakfast that was highly critical of President Obama. ','Texas',100),
(default, 'Chris Christie','President',2012,'HIGH STAKES IN GRANITE STATE: Mr. Christie has held more than a dozen town halls in New Hampshire as part of his charm offensive to woo the states critical primary voters.','South Carolina', 400),
(default, 'John Kasich','President',2008,'GETTING TO KNOW YOU: Analysts say a critical early test will be whether Mr. Kasich can raise his poll numbers enough to land a spot in the first Republican debate.','Ohio',600),
(default, 'Scott Walker','President',2008,'Today I believe that I am being called to lead by helping to clear the field in this race so that a positive conservative message can rise to the top of the field.','Wisconsin',100),
(default, 'Mitt Romney','President',2008,'I did not want to make it more difficult for someone else to emerge who may have a better chance of becoming the president.','Texas',200);

#district_info
INSERT INTO district_info VALUES 
(1,'North Carolian',101,110),
(2,'South Carolina',202,112),
(default,'North Dakota',303,113),
(default,'South Dakota',404,114),
(default,'Massachusetts',505,115),
(default,'Alabama',606,116),
(default,'Alaska',707,117),
(default,'Arizona',808,118),
(default,'Arkansas',909,119),
(default,'California',1101,120),
(default,'Colorado',1202,121),
(default,'Connecticut',1303,122),
(default,'Delaware',1404,123),
(default,'Florida',1505,124),
(default,'Georgia',1606,125),
(default,'Hawaii',1707,126),
(default,'Idaho',1808,127),
(default,'Illinois',1909,128),
(default,'Indiana',2101,129),
(default,'Iowa',303,130),
(default,'Kansas',404,131),
(default,'Kentucky',505,132),
(default,'Louisiana',606,133),
(default,'Maine',707,134),
(default,'Maryland',808,135),
(default,'Michigan',909,136),
(default,'Minnesota',1101,137),
(default,'Mississippi',1202,138),
(default,'Missouri',1303,139),
(default,'Montana',1404,140),
(default,'Nebraska',1505,141),
(default,'Nevada',1606,142),
(default,'New Hampshire',1707,143),
(default,'New Jersey',1808,144),
(default,'New Mexico',1909,145),
(default,'New York',2101,146),
(default,'Ohio',2202,147),
(default,'Oklahoma',2303,148),
(default,'Oregon',2404,149),
(default,'Pennsylvania',2505,150),
(default,'Rhode Island',2606,151),
(default,'Tennessee',2707,152),
(default,'Texas',2808,153),
(default,'Utah',2909,154),
(default,'Vermont',3000,155),
(default,'Virginia',3101,156),
(default,'Washington',3202,157),
(default,'West Virginia ',3303,158),
(default,'Wisconsin',3404,159),
(default,'Wyoming',3505,160);

#Polling_Station
INSERT INTO polling_station VALUES 
(800, 28223,'1101 Grams Medow, Charlotte NC ',1),
(801, 28216,'800 UNC Charlotte Drive, Charlotte NC',1),
(default ,58645,'3426 Chateau Rd Medora, ND',3),
(default, 29201, '1205 Pendleton Street Columbia, SC',2),
(default, 1430,' 84B Old Main Street MA',5),
(default, 36106,'3139 Jim Wilson Loop E, AL',6),
(default, 36117,'50 Ocala Drive, AL',6),
(default, 99709,'1800 COLLEGE RD, FAIRBANKS, AK', 7),
(default, 99730,'STEESE HIGHWAY, CENTRAL, AK', 7),
(default, 85040,'2405 E. Broadway Road, AZ',8),
(default, 85331,'33355 N. Cave Creek Road, AZ',8),
(default, 72736,'401 Charlotte St SE, Gravette, AR',9),
(default, 72722,'310 Maple Street, Decatur, AR',9),
(default, 96120, '99 Water Street, Markleeville, CA', 10),
(default, 95249,'891 Mountain Ranch Road, San Andreas, CA', 10),
(default, 80204,'200 W 14th Ave, Denver, CO',11),
(default, 80202,'101 W Colfax Ave, Denver, CO',11),
(default, 06106,'30 Trinity St, Hartford, CT',12),
(default, 06830,'101 Field Point Road, Greenwich, CT',12),
(default, 19904,' 100 Enterprise Pl, Dover, DE', 13),
(default, 32399,'500 South Bronough Street, Tallahassee, FL', 14),
(default, 30334,'2 M.L.K. Jr Dr NW #1104, Atlanta, GA',15),
(default, 96720,'25 Aupuni Street, Suite 1502, Hilo, HI',16),
(default, 83704,'400 North Benjamin Suite 100, Boise, Idaho',17),
(default, 60601,'100 W Randolph St, Chicago, IL',18),
(default, 46204, '302 W Washington St, Indianapolis, IN', 19),
(default, 50319, '321 E 12th St #1, Des Moines, IA', 20),
(default, 66612,'120 SW 10th Avenue Topeka, KS',21),
(default, 40601,'700 Capital Ave., Ste. 148 Frankfort, KY',22),
(default, 70809,'8585 Archives Ave., Baton Rouge, LA',23),
(default, 03904,'00 Rogers Road Kittery, ME',24),
(default, 21401,'44 Calvert Street, Annapolis, Maryland', 25),
(default, 48001,'48701 Van Dyke Ave., Shelby Township, Michigan', 26),
(default, 51360,'527 South Front Street, Mankato Minnesota',27),
(default, 38603,'318 North 7th Street,Columbus, Mississippi',28),
(default, 52542, '11724 NW Plaza Circle, Kansas City, MO', 29),
(default, 59715,'311 W Main St #210, Bozeman, MT',30),
(default, 57078,'1811 West Second Street, Grand Island, NE',31),
(default, 89002, '8872 South Eastern Avenue, Las Vegas, NV', 32),
(default, 03032,'33 Lowell Street, Manchester, NH', 33),
(default, 07001,'504 Broadway, Long Branch, NJ',34),
(default, 87005,'1717 West 2nd Street, Roswell, NM', 35),
(default, 06390,'137 Hampton Road, Southampton, NY',36),
(default, 43025,'250 East Wilson Bridge Road, Worthington, OH',37),
(default, 67950, '10952 NW Expressway, Yukon, OK', 38),
(default, 97002,'621 High Street, Oregon City, OR', 39),
(default, 15007,'6000 Babcock Boulevard, Pittsburgh, PA',40),
(default, 02806,'1070 Main Street, Pawtucket, RI',41),
(default, 37130,'305 West Main Street, Murfreesboro, TN',42),
(default, 73949,'905 South Fillmore Street, Amarillo, TX',43),
(default, 83312, 'Federal Building, Ogden, UT', 44),
(default, 05633, '115 State St, Montpelier, VT', 45),
(default, 20136,'95 Dunn Drive, Stafford, VA',46),
(default, 98002,'22605 SE 56th Street, Issaquah, WA',47),
(default, 24701,'223 Prince Street, Beckley, WV',48),
(default, 53003,'120 Bishops Way, Brookfield, WI',49),
(default, 82001, '309 W 20th St, Cheyenne, WY', 50),
(default, 01003, '94 Pleasant Street, Northampton, MA', 4);

#Ballot table  
INSERT INTO ballot (ballot_id, V_id, Party_id, Date_of_vote, C_id, State_Num, President_Selection) VALUES 
(default,50001,200,2012, 14, 1,'Bernie Sanders'), 
(default,50002,200,2012, 14, 1,'Bernie Sanders'),
(default,50003,100,2012, 15, 1,'Ben Carson'),
(default,50004,300,2012, 16, 1,'Chris Christie'), 
(default,50005,100,2012, 15, 1,'Ben Carson'),
(default,50006,200,2012, 14, 1,'Bernie Sanders'), 
(default,50007,200,2012, 14, 1,'Bernie Sanders'),
(default,50008,200,2012, 14, 1,'Bernie Sanders'),
(default,50009,200,2012, 14, 1,'Bernie Sanders'), 
(default,50010,100,2012, 15, 1,'Ben Carson'),
(default,50011,300,2012, 16, 1,'Chris Christie'), 
(default,50012,200,2012, 14, 1,'Bernie Sanders'),
(default,50013,100,2012, 15, 1,'Ben Carson'),
(default,50014,100,2012, 15, 1,'Ben Carson'), 
(default,50015,200,2012, 14, 1,'Bernie Sanders'),
(default,50016,200,2012, 14, 1,'Bernie Sanders'), 
(default,50017,200,2012, 14, 1,'Bernie Sanders'),
(default,50018,100,2012, 15, 1,'Ben Carson'),
(default,50019,200,2012, 14, 1,'Bernie Sanders'), 
(default,50020,300,2012, 16, 1,'Chris Christie'), 
(default,50021,200,2012, 14, 3,'Bernie Sanders'), 
(default,50022,100,2012, 15, 2,'Ben Carson'),
(default,50023,200,2012, 14, 5,'Bernie Sanders'), 
(default,50024,300,2012, 16, 6,'Chris Christie'),
(default,50025,100,2012, 15, 6,'Ben Carson'), 
(default,50026,200,2012, 14, 7,'Bernie Sanders'),
(default,50027,100,2012, 15, 7,'Ben Carson'), 
(default,50028,200,2012, 14, 8,'Bernie Sanders'),
(default,50029,200,2012, 14, 8,'Bernie Sanders'), 
(default,50030,300,2012, 16, 9,'Chris Christie'),
(default,50031,200,2012, 14, 9,'Bernie Sanders'), 
(default,50032,200,2012, 14, 10,'Bernie Sanders'),
(default,50033,100,2012, 15, 10,'Ben Carson'), 
(default,50034,200,2012, 14, 11,'Bernie Sanders'),
(default,50035,100,2012, 15, 11,'Ben Carson'), 
(default,50036,200,2012, 14, 12,'Bernie Sanders'),
(default,50037,300,2012, 16, 12,'Chris Christie'), 
(default,50038,200,2012, 14, 13,'Bernie Sanders'),
(default,50039,200,2012, 14, 14,'Bernie Sanders'), 
(default,50040,100,2012, 15, 15,'Ben Carson'),
(default,50041,100,2012, 15, 16,'Ben Carson'), 
(default,50042,200,2012, 14, 17,'Bernie Sanders'),
(default,50043,100,2012, 15, 18,'Ben Carson'),
(default,50044,200,2012, 14, 10,'Bernie Sanders'), 
(default,50045,200,2012, 14, 10,'Bernie Sanders'), 
(default,50046,200,2012, 14, 10,'Bernie Sanders'), 
(default,50047,200,2012, 14, 10,'Bernie Sanders'), 
(default,50048,100,2012, 15, 10,'Ben Carson'), 
(default,50049,100,2012, 15, 10,'Ben Carson'), 
(default,50050,300,2012, 16, 10,'Chris Christie'), 
(default,50051,200,2012, 14, 10,'Bernie Sanders'), 
(default,50052,100,2012, 15, 10,'Ben Carson'), 
(default,50053,200,2012, 14, 10,'Bernie Sanders'), 
(default,50054,300,2012, 16, 10,'Chris Christie'), 
(default,50055,200,2012, 14, 10,'Bernie Sanders'), 
(default,50056,100,2012, 15, 10,'Ben Carson'), 
(default,50057,200,2012, 14, 10,'Bernie Sanders'), 
(default,50058,100,2012, 15, 10,'Ben Carson'), 
(default,50059,200,2012, 14, 10,'Bernie Sanders'), 
(default,50060,100,2012, 15, 10,'Ben Carson'), 
(default,50061,300,2012, 16, 10,'Chris Christie'), 
(default,50062,200,2012, 14, 10,'Bernie Sanders'), 
(default,50063,200,2012, 14, 10,'Bernie Sanders'), 
(default,50064,100,2012, 14, 10,'Ben Carson'), 
(default,50065,200,2012, 14, 10,'Bernie Sanders'), 
(default,50066,100,2012, 14, 10,'Ben Carson'), 
(default,50067,200,2012, 14, 10,'Bernie Sanders'), 
(default,50068,100,2012, 15, 10,'Ben Carson'), 
(default,50069,200,2012, 14, 10,'Bernie Sanders'), 
(default,50070,200,2012, 14, 10,'Bernie Sanders'), 
(default,50071,200,2012, 14, 10,'Bernie Sanders'), 
(default,50072,100,2012, 15, 10,'Ben Carson'), 
(default,50073,200,2012, 14, 10,'Bernie Sanders'); 

