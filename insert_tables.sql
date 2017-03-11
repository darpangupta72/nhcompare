--1 DEFICIENCIES--

CREATE TABLE Deficiencies (
provnum varchar(8),
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
survey_date_output date,
SurveyType varchar(10),
defpref varchar(2),
tag numeric,
tag_desc varchar(500),
scope varchar(2),
defstat varchar(50),
statdate date,
cycle_no int,
standard varchar(2),
complaint varchar(2),
filedate date);
Copy Deficiencies from '/home/darpan/Desktop/Nursing Home Compare/Deficiencies_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE Deficiencies 
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--2 HEALTH DEFICIENCIES--

CREATE TABLE Health_Deficiencies (
federal_provider_no varchar(8),
provider_name varchar(80),
survey_date date,
deficiency_prefix varchar(2),
def_tag numeric,
def_desc varchar(500),
scope_sev_code varchar(2),
def_corrected varchar(50),
correction_date date,
inspection_cycle int,
standard boolean ,
complaint boolean,
provider_state varchar(3),
prov_location varchar(100),
process_date date);
Copy Health_Deficiencies from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Health_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--3 INSPECTION CYCLE 1--

CREATE TABLE Inspection_Cycle_1_Deficiencies (
federal_provider_no varchar(8),
provider_name varchar(80),
survey_date date,
deficiency_prefix varchar(2),
def_tag numeric,
def_desc varchar(500),
scope_sev_code varchar(2),
def_corrected varchar(50),
correction_date date,
standard boolean ,
complaint boolean,
provider_state varchar(3),
prov_location varchar(100),
process_date date);
Copy Inspection_Cycle_1_Deficiencies from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Inspection_Cycle_1_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--4 INSPECTION CYCLE 2--

CREATE TABLE Inspection_Cycle_2_Deficiencies (
federal_provider_no varchar(8),
provider_name varchar(80),
survey_date date,
deficiency_prefix varchar(2),
def_tag numeric,
def_desc varchar(500),
scope_sev_code varchar(2),
def_corrected varchar(50),
correction_date date,
standard boolean ,
complaint boolean,
provider_state varchar(3),
prov_location varchar(100),
process_date date);
Copy Inspection_Cycle_2_Deficiencies from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Inspection_Cycle_2_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--5 INSPECTION CYCLE 3--

CREATE TABLE Inspection_Cycle_3_Deficiencies (
federal_provider_no varchar(8),
provider_name varchar(80),
survey_date date,
deficiency_prefix varchar(2),
def_tag numeric,
def_desc varchar(500),
scope_sev_code varchar(2),
def_corrected varchar(50),
correction_date date,
standard boolean ,
complaint boolean,
provider_state varchar(3),
prov_location varchar(100),
process_date date);
Copy Inspection_Cycle_3_Deficiencies from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Inspection_Cycle_3_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--6 NURSING HOME COMPARE--

CREATE TABLE CASPER_CONTACTS(
State varchar(20),
Email_Add varchar(45),
Phone varchar(25)
);
COPY CASPER_CONTACTS FROM '/home/darpan/Desktop/Nursing Home Compare/Nursing_Home_Compare_-_CASPER_Contacts.csv' DELIMITER ',' CSV HEADER;


--7 OWNERSHIP--

CREATE TABLE OWNERSHIP (
PROVNUM varchar(8),
PROVNAME varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
ROLE_DESC varchar(60),
OWNER_TYPE varchar(40),
OWNER_NAME varchar(80),
OWNER_PERCENTAGE varchar(50),
ASSOCIATION_DATE varchar(20),
filedate date);
Copy OWNERSHIP from '/home/darpan/Desktop/Nursing Home Compare/Ownership_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE ownership 
DROP PROVNAME, DROP address, DROP city, DROP state, DROP zip;

--8 PENALTIES--

CREATE TABLE Penalties (
PROVNUM varchar(8),
PROVNAME varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
penalty_date date,
penalty_type varchar(15),
fine_amt numeric,
payden_strt_dt date,
payden_days numeric,
filedate date);
Copy Penalties from '/home/darpan/Desktop/Nursing Home Compare/Penalties_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE Penalties
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--9 PENALTY COUNTS--

CREATE TABLE Penalty_Count (
PROVNUM varchar(8),
PROVNAME varchar(80),
state varchar(2),
no_fines numeric,
total_fine_amt varchar(15),
no_denial numeric,
no_penalty numeric,
pLocation varchar(150),
process_date date);
Copy Penalty_Count from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Penalty_Counts.csv' DELIMITER ',' CSV HEADER;


--10 QualityMsrClaims--

CREATE TABLE QualityMsrClaims(
PROVNUM varchar(8),
PROVNAME varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
MSR_CD numeric,
MSR_DESCR varchar(200),
Stay_type varchar(15),
Score_Obs numeric,
Score_exp numeric,
Score_fin numeric,
extra varchar(120),
FIVE_STAR_MSR boolean,
MEASURE_PERIOD varchar(15),
filedate date);
Copy QualityMsrClaims from '/home/darpan/Desktop/Nursing Home Compare/QualityMsrClaims_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE qualitymsrclaims
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--11 Star Rating--

CREATE TABLE Star_Rating (
PROVNUM varchar(8),
PROVNAME varchar(80),
state varchar(2),
overall_rating numeric,
OR_footnote varchar(40),
Health_Inspec_rating numeric,
HIR_footnote varchar(40),
QM_rating numeric,
QMR_footnote varchar(40),
Staff_rating numeric,
SR_footnote varchar(40),
RN_Staff_rating numeric,
RNS_footnote varchar(40),
sLocation varchar(150),
process_date date);
Copy Star_Rating from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Star_Ratings.csv' DELIMITER ',' CSV HEADER;


--12 Quality Measure Short Stay--

CREATE TABLE Q_Measure_Short_Stay (
PROVNUM varchar(8),
PROVNAME varchar(80),
state varchar(2),
Measure_code numeric,
Measure_desc varchar(150),
Res_type varchar(20),
Q1_Measure_Score varchar(15),
Q1MS_footnote varchar(100),
Q2_Measure_Score varchar(15),
Q2MS_footnote varchar(100),
Q3_Measure_Score varchar(15),
Q3MS_footnote varchar(100),
Q4_Measure_Score varchar(15),
Average_Score varchar(15),
AvgS_footnote varchar(100),
Used_in_QMFSR boolean,
Q1 varchar(8),
Q2 varchar(8),
Q3 varchar(8),
qLocation varchar(150),
process_date date);
Copy Q_Measure_Short_Stay from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Quality_Measures_-_Short_Stay.csv' DELIMITER ',' CSV HEADER;


--13 Quality Measure Long Stay--

CREATE TABLE Q_Measure_Long_Stay (
PROVNUM varchar(8),
PROVNAME varchar(80),
state varchar(2),
Measure_code numeric,
Measure_desc varchar(150),
Res_type varchar(20),
Q1_Measure_Score varchar(15),
Q1MS_footnote varchar(100),
Q2_Measure_Score varchar(15),
Q2MS_footnote varchar(100),
Q3_Measure_Score varchar(15),
Q3MS_footnote varchar(100),
Q4_Measure_Score varchar(15),
Q4MS_footnote varchar(100),
Average_Score varchar(15),
AvgS_footnote varchar(100),
Used_in_QMFSR boolean,
Q1 varchar(8),
Q2 varchar(8),
Q3 varchar(8),
Q4 varchar(8),
qlsLocation varchar(150),
process_date date);
Copy Q_Measure_Long_Stay from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Quality_Measures_-_Long_Stay.csv' DELIMITER ',' CSV HEADER;


--14 State Averages--

CREATE TABLE StateAverage(
state varchar(8),
C1_Hlth_Defs_cnt numeric,
C1_FS_Defs_cnt numeric,
C2_Hlth_Defs_cnt numeric,
C2_FS_Defs_cnt numeric,
C3_Hlth_Defs_cnt numeric,
C3_FS_Defs_cnt numeric,
aidhrd numeric,
vochrd numeric,
rnhrd numeric,
totlichrd numeric,
tothrd numeric,
pthrd numeric,
Fine_Cnt numeric,
Fine_tot numeric,
QM401 numeric,
QM402 numeric,
QM403 numeric,
QM404 numeric,
QM405 numeric,
QM406 numeric,
QM407 numeric,
QM408 numeric,
QM409 numeric,
QM410 numeric,
QM411 numeric,
QM415 numeric,
QM419 numeric,
QM424 numeric,
QM425 numeric,
QM426 numeric,
QM430 numeric,
QM434 numeric,
QM451 numeric,
QM452 numeric,
QM471 numeric,
QM521 numeric,
QM522 numeric,
QM523 numeric,
file_date date);
Copy StateAverage from '/home/darpan/Desktop/Nursing Home Compare/StateAverages_Download.csv' DELIMITER ',' CSV HEADER;


--15 Survey Summary--

CREATE TABLE SurveySummary(
PROVNUM varchar(8),
PROVNAME varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
cycle_no numeric,
H_survey_date date,
F_survey_date date,
H_tot_defcncy numeric,
F_tot_defcncy boolean,
H_ss_max varchar(5),
F_ss_max boolean,
H_ij_n numeric,
F_ij_n boolean,
H_severe_n numeric,
F_severe_n boolean,
H_ssubstndrd_qoc_n numeric,
H_administration_n numeric,
H_environmental_n numeric,
H_mistreat_n numeric,
H_nutrition_n numeric,
H_pharmacy_n numeric,
H_quality_care_n numeric,
H_res_asmnt_n numeric,
H_res_rights_n numeric,
F_CONSTRUCTION_N boolean,
F_CORRIDOR_DOORS_N boolean,
F_ELECTRICAL_N boolean,
F_EMERGENCY_PLAN_N boolean,
F_EXIT_EGRESS_N boolean,
F_EXIT_ACCESS_N boolean,
F_FIRE_ALARM_N boolean,
F_FURNISHINGS_N boolean,
F_HAZARD_AREA_N boolean,
F_ILLUMINATION_N boolean,
F_INTERIOR_N boolean,
F_LABORATORIES_N boolean,
F_MEDICAL_GAS_N boolean,
F_MISCELLANEOUS_N boolean,
F_SERVICE_EQUIPMENT_N boolean,
F_SMOKE_CONTROL_N boolean,
F_SMOKING_REG_N boolean,
F_SPRINKLER_N boolean,
F_VERT_OPENINGS_N boolean,
filedate date);
Copy SurveySummary from '/home/darpan/Desktop/Nursing Home Compare/SurveySummary_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE surveysummary
DROP provname, DROP address, DROP city, DROP state, DROP zip;

ALTER TABLE surveysummary
DROP F_CONSTRUCTION_N,
DROP F_CORRIDOR_DOORS_N,
DROP F_ELECTRICAL_N,
DROP F_EMERGENCY_PLAN_N,
DROP F_EXIT_EGRESS_N,
DROP F_EXIT_ACCESS_N,
DROP F_FIRE_ALARM_N,
DROP F_FURNISHINGS_N,
DROP F_HAZARD_AREA_N,
DROP F_ILLUMINATION_N,
DROP F_INTERIOR_N,
DROP F_LABORATORIES_N,
DROP F_MEDICAL_GAS_N,
DROP F_MISCELLANEOUS_N,
DROP F_SERVICE_EQUIPMENT_N,
DROP F_SMOKE_CONTROL_N,
DROP F_SMOKING_REG_N,
DROP F_SPRINKLER_N,
DROP F_VERT_OPENINGS_N,
DROP F_survey_date,
DROP F_tot_defcncy,
DROP F_ss_max,
DROP F_ij_n,
DROP F_severe_n,
DROP H_tot_defcncy,
DROP H_ss_max,
DROP H_ij_n,
DROP H_severe_n;

--16 QualityMsrMDS--

CREATE TABLE QualityMsrMDS(
PROVNUM varchar(8),
PROVNAME varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
MSR_CD numeric,
MSR_DESCR varchar(200),
Stay_type varchar(15),
Q1_Measure_Score numeric,
Q1MS_fn varchar(120),
Q2_Measure_Score numeric,
Q2MS_fn varchar(120),
Q3_Measure_Score numeric,
Q3MS_fn varchar(120),
Q4_Measure_Score numeric,
Q4MS_fn varchar(120),
Avg_Score numeric,
AvgS_fn varchar(120),
FIVE_STAR_MSR boolean,
Q1 varchar(8),
Q2 varchar(8),
Q3 varchar(8),
Q4 varchar(8),
filedate date);
Copy QualityMsrMDS from '/home/darpan/Desktop/Nursing Home Compare/QualityMsrMDS_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE qualitymsrmds
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--17 Provider info--

CREATE TABLE Provider_info (
PROVNUM varchar(6),
PROVNAME varchar(80),
ADDRESS varchar(70),
CITY varchar(30),
STATE varchar(2),
ZIP numeric,
PHONE varchar(10),
COUNTY_SSA varchar(3),
COUNTY_NAME varchar(30),
OWNERSHIP varchar(50),
BEDCERT numeric,
RESTOT numeric,
CERTIFICATION varchar(50),
INHOSP boolean,
LBN varchar(100),
PARTICIPATION_DATE date,
CCRC_FACIL boolean,
SFF boolean,
OLDSURVEY boolean,
CHOW_LAST_12MOS boolean,
resfamcouncil varchar(10),
sprinkler_status varchar(30),
overall_rating varchar(1),
overall_rating_fn varchar(30),
survey_rating varchar(1),
survey_rating_fn varchar(30),
quality_rating varchar(1),
quality_rating_fn varchar(30),
staffing_rating varchar(1),
staffing_rating_fn varchar(30),
RN_staffing_rating varchar(1),
rn_staffing_rating_fn varchar(30),
STAFFING_FLAG varchar(30),
PT_STAFFING_FLAG varchar(30),
AIDHRD numeric,
VOCHRD numeric,
RNHRD numeric,
TOTLICHRD numeric,
TOTHRD numeric,
PTHRD numeric,
exp_aide numeric,
exp_lpn numeric,
exp_rn numeric,
exp_total numeric,
adj_aide numeric,
adj_lpn numeric,
adj_rn numeric,
adj_total numeric,
cycle_1_defs varchar(15),
cycle_1_nfromdefs varchar(15),
cycle_1_nfromcomp varchar(15),
cycle_1_defs_score varchar(15),
CYCLE_1_SURVEY_DATE date,
CYCLE_1_NUMREVIS varchar(15),
CYCLE_1_REVISIT_SCORE varchar(15),
CYCLE_1_TOTAL_SCORE varchar(15),
cycle_2_defs varchar(15),
cycle_2_nfromdefs varchar(15),
cycle_2_nfromcomp varchar(15),
cycle_2_defs_score varchar(15),
CYCLE_2_SURVEY_DATE date,
CYCLE_2_NUMREVIS varchar(15),
CYCLE_2_REVISIT_SCORE varchar(15),
CYCLE_2_TOTAL_SCORE varchar(15),
cycle_3_defs varchar(15),
cycle_3_nfromdefs varchar(15),
cycle_3_nfromcomp varchar(15),
cycle_3_defs_score varchar(15),
CYCLE_3_SURVEY_DATE date,
CYCLE_3_NUMREVIS varchar(15),
CYCLE_3_REVISIT_SCORE varchar(15),
CYCLE_3_TOTAL_SCORE varchar(15),
WEIGHTED_ALL_CYCLES_SCORE varchar(15),
incident_cnt int,
cmplnt_cnt int,
FINE_CNT int,
FINE_TOT int,
PAYDEN_CNT int,
TOT_PENLTY_CNT int,
FILEDATE date);
Copy Provider_info from '/home/darpan/Desktop/Nursing Home Compare/ProviderInfo_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE provider_info
DROP FINE_CNT,
DROP FINE_TOT,
DROP PAYDEN_CNT,
DROP TOT_PENLTY_CNT,
DROP cycle_1_defs,
DROP cycle_1_nfromdefs,
DROP cycle_1_nfromcomp,
DROP cycle_2_defs,
DROP cycle_2_nfromdefs,
DROP cycle_2_nfromcomp,
DROP cycle_3_defs,
DROP cycle_3_nfromdefs,
DROP cycle_3_nfromcomp;


--18 Staffing--

CREATE TABLE Staffing (
PROVNUM varchar(6),
PROVNAME varchar(80),
STATE varchar(2),
Staff_Rating numeric,
SR_footnote varchar(150),
RN_Staff_Rating numeric,
RNSR_footnote varchar(150),
Reported_Staff_footnote varchar(80),
PT_Staff_footnote varchar(80),
Reported_CNA_Staff_Hours numeric,
Reported_LPN_Staff_Hours numeric,
Reported_RN_Staff_Hours numeric,
Reported_Licensed_Staff_Hours numeric,
Reported_Nurse_Staff_Hours numeric,
Reported_PT_Staff_Hours numeric,
Expected_CNA_Staff_Hours numeric,
Expected_LPN_Staff_Hours numeric,
Expected_RN_Staff_Hours numeric,
Expected_Nurse_Staff_Hours numeric,
Adjusted_CNA_Staff_Hours numeric,
Adjusted_LPN_Staff_Hours numeric,
Adjusted_RN_Staff_Hours numeric,
Adjusted_Nurse_Staff_Hours numeric,
staffLocation varchar(150),
process_date date);
Copy Staffing from 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Staffing.csv' DELIMITER ',' CSV HEADER;

--19 Login--

CREATE TABLE login(
username varchar(20),
password varchar(20),
type char
);

INSERT INTO login
VALUES ('admin', 'admin', 'a');

INSERT INTO login
SELECT provnum, provnum, 'n'
FROM provider_info;

