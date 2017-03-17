-- averages --

CREATE VIEW provinfo_count AS
SELECT state, COUNT(*) FROM provider_info
GROUP BY state;

CREATE VIEW def_state AS 
SELECT deficiencies.provnum, state, cycle_no, standard, complaint
FROM provider_info JOIN deficiencies ON deficiencies.provnum = provider_info.provnum;

CREATE VIEW count_standard_1 AS 
SELECT state, COUNT(*) as standard FROM def_state
WHERE standard IN ('y', 'Y') AND cycle_no = 1
GROUP BY state;	

CREATE VIEW count_standard_2 AS 
SELECT state, COUNT(*) as standard FROM def_state
WHERE standard IN ('y', 'Y') AND cycle_no = 2
GROUP BY state;	

CREATE VIEW count_standard_3 AS 
SELECT state, COUNT(*) as standard FROM def_state
WHERE standard IN ('y', 'Y') AND cycle_no = 3
GROUP BY state;	

CREATE VIEW count_standard AS
SELECT count_standard_1.state, count_standard_1.standard AS st_1, count_standard_2.standard AS st_2, count_standard_3.standard AS st_3
FROM count_standard_1, count_standard_2, count_standard_3
WHERE count_standard_1.state = count_standard_2.state AND count_standard_2.state = count_standard_3.state;

CREATE VIEW count_complaint_1 AS 
SELECT state, COUNT(*) as complaint FROM def_state
WHERE complaint IN ('y', 'Y') AND cycle_no = 1
GROUP BY state;	

CREATE VIEW count_complaint_2 AS 
SELECT state, COUNT(*) as complaint FROM def_state
WHERE complaint IN ('y', 'Y') AND cycle_no = 2
GROUP BY state;	

CREATE VIEW count_complaint_3 AS 
SELECT state, COUNT(*) as complaint FROM def_state
WHERE complaint IN ('y', 'Y') AND cycle_no = 3
GROUP BY state;	

CREATE VIEW count_complaint AS
SELECT count_complaint_1.state, count_complaint_1.complaint AS c_1, count_complaint_2.complaint AS c_2, count_complaint_3.complaint AS c_3
FROM count_complaint_1, count_complaint_2, count_complaint_3
WHERE count_complaint_1.state = count_complaint_2.state AND count_complaint_2.state = count_complaint_3.state;

CREATE VIEW count_both AS
SELECT count_standard.state, st_1, st_2, st_3, c_1, c_2, c_3
FROM count_standard JOIN count_complaint ON count_standard.state = count_complaint.state;

CREATE VIEW avg_both AS
SELECT count_standard.state, st_1 / count :: numeric AS st_1, st_2 / count :: numeric AS st_2, st_3 / count :: numeric AS st_3, 
c_1 / count :: numeric AS c_1, c_2 / count :: numeric AS c_2, c_3 / count :: numeric AS c_3
FROM count_standard, count_complaint, provinfo_count
WHERE count_standard.state = provinfo_count.state AND count_complaint.state = provinfo_count.state;


CREATE VIEW pen_state AS 
SELECT penalties.provnum, state, fine_amt
FROM provider_info JOIN penalties ON penalties.provnum = provider_info.provnum AND penalty_type = 'Fine';

CREATE VIEW count_pen AS
SELECT state, COUNT(*), SUM(fine_amt)
FROM pen_state
GROUP BY state;

CREATE VIEW avg_pen AS
SELECT count_pen.state,  count_pen.count / provinfo_count.count :: numeric AS num, sum / provinfo_count.count :: numeric AS sum
FROM provinfo_count, count_pen
WHERE count_pen.state = provinfo_count.state;

CREATE VIEW averages AS
SELECT avg_pen.state, st_1, st_2, st_3, c_1, c_2, c_3, num, sum
FROM avg_both, avg_pen
WHERE avg_pen.state = avg_both.state;

DROP VIEW provinfo_count, def_state, count_standard_1, count_standard_2, count_standard_3, count_standard, count_complaint_1,
count_complaint_2, count_complaint_3, count_complaint, count_both, avg_both, pen_state, count_pen, avg_pen;


-- prov_agg_penalties --

CREATE VIEW prov_agg_penalties AS SELECT sub4.provnum, penalty_count, total_fine, no_of_fines, no_of_payden FROM 
(SELECT sub1.provnum, penalty_count,total_fine,no_of_fines FROM 
	(SELECT provnum, count(*) as penalty_count,sum(fine_amt) as total_fine from penalties group by provnum) 
	as sub1 LEFT OUTER JOIN (SELECT provnum, count(*) as no_of_fines FROM penalties WHERE penalty_type='Fine' 
		group by provnum) as sub2 ON sub1.provnum=sub2.provnum) 
as sub4 LEFT OUTER JOIN (SELECT provnum, count(*) as no_of_payden from penalties 
	WHERE penalty_type='Payment Denial' group by provnum) as sub3 ON sub4.provnum=sub3.provnum;
SELECT * from prov_agg_penalties where provnum='$provnum';  4.843ms


-- prov_agg_deficiencies -- 

CREATE VIEW prov_agg_deficiencies AS SELECT sub1.provnum,sub1.cycle_no,total_deficiencies,standard_def,complaint_def, scope, 
scope_count FROM (SELECT provnum, cycle_no, count(*) as total_deficiencies FROM deficiencies GROUP BY provnum,cycle_no) 
as sub1, (SELECT provnum,cycle_no,count(*) as standard_def FROM deficiencies WHERE UPPER(standard) ='Y' GROUP BY provnum,cycle_no) 
as sub2, (SELECT provnum,cycle_no,count(*) as complaint_def FROM deficiencies WHERE UPPER(complaint) ='Y' GROUP BY provnum,cycle_no) 
as sub3, (SELECT provnum, cycle_no,scope, count(*) as scope_count FROM deficiencies GROUP BY provnum, cycle_no,scope) as sub4 
WHERE sub1.provnum=sub2.provnum AND sub2.provnum=sub3.provnum AND sub3.provnum=sub4.provnum AND sub1.cycle_no=sub2.cycle_no AND 
sub2.cycle_no=sub3.cycle_no AND sub3.cycle_no=sub4.cycle_no;
