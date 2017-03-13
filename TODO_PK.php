1. Center alignment of input form in screen 5.
2. Fix Log OUt button.
DONE 3. add hyperlinks for 2 types of feedback on search_nh_details.php and go to 7a or 7b
DONE 4. implement session to send provnum by get to 6 from 5: $_GET['provnum']
DONE 5. create table for user feedback (name: feedback, columns: feedback_id (self_incrementing) primary key, username, provnum varchar(5), score (1-5),score_desc(250), 		 time timestamp)
6. make home button on left of logout on all screens which takes user (type - 't') to resp. welcome screen

IF TIME
1. deficiencies of details screen for user
2. functionalities to process data on diff. screens
3. calculation of features from different which where orig. in provider_info (google docs)


Functionality to be implemented

5. Search Nursing Homes
	Data to be printed: provnum(hyperlink to 6 - "search_nh_details.php"), provname, overall_rating,survey_rating,quality_rating,staffing_rating,rn_staffing_rating,weighted_all_cycles_score, user_score
	calc. user_score from feedback 
	PK  - padding on left and right to separate table from screen margins
	type,field,order
	order:
	'' - overall_rating, ...
	'x' - order by x and then rem. acc to case ''
6. Give additional details for the selected nh and give hyperlinks for giving feedback (7a) or viewing feedback (7b) for this nh; 7a only for users
details for screen 6: receive provnum by get
 	data to be printed: provnum provname, address city state zip, County: county_name county_ssa, Phone no.: phone, Ownership Type: ownership
 						<leave space>
 						make padded table of other details: 
 						 overall_rating,survey_rating,quality_rating,staffing_rating,rn_staffing_rating,weighted_all_cycles_score, user_score, bedcert, restot, certification, inhosp, ccrc_facil, sff, resfamcouncil, sprinkler_status, cycle_1_defscore, 2,3, cycle_1_revisit_score, 2, 3, cycle_1_total_score, 2, 3, incident_cnt, cmplnt_cnt, filedate

7a. form to give feedback: give_feedback_html.php calls give_feedback.php, POST params 'username', 'provnum', 'score', 'score_desc'
	dropdown for score
	username from session, provnum from get
	score_desc from textbox with 250 word limit
7b. view feedback for <this> nh: view_feedback.php, GET params 'provnum'
	provnum from get

8. screen for table penalties: come to "penalties.php" from nhwelcome with POST param 'username'
	get username from session for nh
	data to be printed: provnum provname, address city state zip, County: county_name county_ssa, Phone no.: phone, Ownership Type: ownership 
						(from provider_info)
 						<leave space>
 						make padded table of other details: select pnlty_date, pnlty_type, fine_amt, payden_strt_dt, payden_days, filedate from penalties where provnum = '$provnum'
 	* this is basic. build functionalities on top of this to process data.

9. StateAverages??

10. screen to report staffing info to nh: come to "staff_info.php" from nhwelcome with POST param 'username'
	get username from session for nh
 	data to be printed: provnum provname, address city state zip, County: county_name county_ssa, Phone no.: phone, Ownership Type: ownership 
						(from provider_info)
 						<leave space>
 						make padded table of other details: staffing_rating, rn_staffing_rating, aidhrd, vochrd, rnhrd, totlichrd, tothrd, pthrd, exp_aid, exp_lpn, exp_m, exp_total, adj_aid, adj_lpn, adj_m, adj_total, filedate 

11. screen to show deficiencies to nh: come to "deficiencies.php" from nhwelcome with POST param 'username'
	get username from session for nh
	data to be printed: provnum provname, address city state zip, County: county_name county_ssa, Phone no.: phone, Ownership Type: ownership 
						(from provider_info)
 						<leave space>
 						make padded table of other details: defpref, tag (hyperlinks to tag_desc on same page), scope, defstat, statedata, cycle, standard,complaint, filedate

12. login management screen: come to "login_manage_html.php" calls "login_manage.php" from admin welcome screen (pk: insert centre tag to display errors in centre)
							 "login_manage.php" receives POST params : command (insert/delete), username, password, type

ORDER
DONE 0. DG - delete columns fn from provider_info
DONE 1. PK - create table as in point 5 topmost
DONE 2. PK - send "search_nh.php" a order param for order by clause 
DONE 2. DG - Screen 5 add columns to be printed and order them
DONE 3. PK - align input form in screen 5 push the output table downwards. Rest table formatting to be done later
DONE 4. DG - create blank(with the header) .php files for screens 6,7b,8,10,11
DONE 2,4. PK - Add hyperlink to screen 5 as written above.

--SCREEN 5 COMPLETES--

DONE 5. DG - Screen 6 creation
DONE 5. PK - hyperlinks for feedback on 6 and goto 7a , 7b with get params
DONE 6. PK - Form creation in "give_feedback_html.php" to send params in "give_feedback.php"
DONE 6. DG - do "give_feedback.php" to insert into feedback.

--SCREEN 6 , 7a COMPLETE--

DONE 7. DG - do 7b

--SCREEN 7b COMPLETE--

DONE 8. DG - Take username(assume nh) from $_SESSION['username'] 8,DONE 10, DONE 11
DONE 9. PK - login management screen send params to login_manage.php
9. DG - do "login_manage.php"
10. DG - In screen 8 , 10, 11 when $provnum='' then currently empty result is being printed change this to blank i.e. no result (no of rows functionality).