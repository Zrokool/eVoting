select  Date_of_Vote, count(voter.V_id) as total_votes, President_selection as Name
    from voter join
    ballot on
    voter.V_id = ballot.V_id
    where Date_of_Vote = '2012'
    group by president_selection;
    
    
# Displays who for per state, in this case State num 7.
select State_Name, ballot.state_num, president_selection, ballot.party_id, count(president_selection) as Votes
from ballot join district_info on ballot.State_Num = district_info.State_Num
where Date_of_Vote = 2012 and ballot.state_num = 7
group by president_selection 
having count(president_selection)=(select max(Votes)
from(select count(president_selection) as Votes
from ballot
where Date_of_Vote = 2012 and ballot.state_num = 7
group by president_selection
order by votes desc)t);

# General Gender to Vote Ratio  
select gender, concat(firstname,' ',lastname) as fullname, president_selection
from evoting.person_info join evoting.voter on person_info.citizennum = voter.citizennum join evoting.ballot on voter.v_id=ballot.V_id
where gender = 'f'
order by fullname;

select gender, concat(firstname,' ',lastname) as fullname, president_selection
from evoting.person_info join evoting.voter on person_info.citizennum = voter.citizennum join evoting.ballot on voter.v_id=ballot.V_id
where gender = 'm'
order by fullname;
    
select count(president_selection) female_count, president_selection
from evoting.person_info join evoting.voter on person_info.citizennum = voter.citizennum join evoting.ballot on voter.v_id=ballot.V_id
where gender='f'
group by president_selection
order by count(president_selection) desc;

select count(president_selection) as male_count, president_selection
from evoting.person_info join evoting.voter on person_info.citizennum = voter.citizennum join evoting.ballot on voter.v_id=ballot.V_id
where gender='m'
group by president_selection
order by count(president_selection) desc;

# Displays All the candidates their parties and number of votes 
select party_name, president_selection, count(*) as votes
from evoting.ballot join evoting.party on evoting.ballot.party_id=party.party_id
WHERE Date_of_Vote = 2016
group by president_selection;
