
--1 STATES--

CREATE TABLE states(
state_abbrev varchar(6) PRIMARY KEY,
state_full varchar(40)
);
COPY states FROM '/home/darpan/Desktop/Nursing Home Compare/Abbrev_state.csv' DELIMITER ',';


--2 Provider info--

CREATE TABLE provider_info (
provnum varchar(6) PRIMARY KEY,
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
phone varchar(10),
county_ssa varchar(3),
county_name varchar(30),
ownership varchar(50),
bedcert int,
restot int,
certification varchar(50),
inhosp varchar(3),
lbn varchar(100),
participation_date date,
ccrc_facil varchar(3),
sff varchar(3),
oldsurvey varchar(3),
chow_last_12mos varchar(3),
resfamcouncil varchar(10),
sprinkler_status varchar(30),
overall_rating int,
overall_rating_fn varchar(30),
survey_rating int,
survey_rating_fn varchar(30),
quality_rating int,
quality_rating_fn varchar(30),
staffing_rating int,
staffing_rating_fn varchar(30),
rn_staffing_rating int,
rn_staffing_rating_fn varchar(30),
staffing_flag varchar(30),
pt_staffing_flag varchar(30),
aidhrd numeric,
vochrd numeric,
rnhrd numeric,
totlichrd numeric,
tothrd numeric,
pthrd numeric,
exp_aide numeric,
exp_lpn numeric,
exp_rn numeric,
exp_total numeric,
adj_aide numeric,
adj_lpn numeric,
adj_rn numeric,
adj_total numeric,
cycle_1_defs varchar(10),
cycle_1_nfromdefs varchar(10),
cycle_1_nfromcomp varchar(10),
cycle_1_defs_score varchar(10),
cycle_1_survey_date date,
cycle_1_numrevis varchar(10),
cycle_1_revisit_score varchar(10),
cycle_1_total_score varchar(10),
cycle_2_defs varchar(10),
cycle_2_nfromdefs varchar(10),
cycle_2_nfromcomp varchar(10),
cycle_2_defs_score varchar(10),
cycle_2_survey_date date,
cycle_2_numrevis varchar(10),
cycle_2_revisit_score varchar(10),
cycle_2_total_score varchar(10),
cycle_3_defs varchar(10),
cycle_3_nfromdefs varchar(10),
cycle_3_nfromcomp varchar(10),
cycle_3_defs_score varchar(10),
cycle_3_survey_date date,
cycle_3_numrevis varchar(10),
cycle_3_revisit_score varchar(10),
cycle_3_total_score varchar(10),
weighted_all_cycles_score varchar(10),
incident_cnt int,
cmplnt_cnt int,
fine_cnt int,
fine_tot int,
payden_cnt int,
tot_penalty_cnt int,
filedate date,
CONSTRAINT chk_1 CHECK (inhosp IN ('n', 'N', 'y', 'Y', 'YES','Yes', 'yes', 'NO', 'No', 'no', '')),
CONSTRAINT chk_2 CHECK (ccrc_facil IN ('n', 'N', 'y', 'Y', 'YES','Yes', 'yes', 'NO', 'No', 'no', '')),
CONSTRAINT chk_3 CHECK (sff IN ('n', 'N', 'y', 'Y', 'YES','Yes', 'yes', 'NO', 'No', 'no', '')),
CONSTRAINT chk_4 CHECK (oldsurvey IN ('n', 'N', 'y', 'Y', 'YES','Yes', 'yes', 'NO', 'No', 'no', '')),
CONSTRAINT chk_5 CHECK (chow_last_12mos IN ('n', 'N', 'y', 'Y', 'YES','Yes', 'yes', 'NO', 'No', 'no', '')),
CONSTRAINT chk_6 CHECK (resfamcouncil IN ('Resident', 'Family', 'Both', 'None', '')),
CONSTRAINT chk_7 CHECK (sprinkler_status IN ('Data Not Available', 'Yes', 'No', 'Partial', '')),
CONSTRAINT chk_8 CHECK (overall_rating IN (1, 2, 3, 4, 5, null)),
CONSTRAINT chk_9 CHECK (survey_rating IN (1, 2, 3, 4, 5, null)),
CONSTRAINT chk_10 CHECK (quality_rating IN (1, 2, 3, 4, 5, null)),
CONSTRAINT chk_11 CHECK (staffing_rating IN (1, 2, 3, 4, 5, null)),
CONSTRAINT chk_12 CHECK (rn_staffing_rating IN (1, 2, 3, 4, 5, null)),
CONSTRAINT fk FOREIGN KEY (state) REFERENCES states(state_abbrev) ON DELETE CASCADE
);
COPY provider_info FROM '/home/darpan/Desktop/Nursing Home Compare/ProviderInfo_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE provider_info
DROP fine_cnt,
DROP fine_tot,
DROP payden_cnt,
DROP tot_penalty_cnt,
DROP cycle_1_defs,
DROP cycle_1_nfromdefs,
DROP cycle_1_nfromcomp,
DROP cycle_2_defs,
DROP cycle_2_nfromdefs,
DROP cycle_2_nfromcomp,
DROP cycle_3_defs,
DROP cycle_3_nfromdefs,
DROP cycle_3_nfromcomp;

create table t(provnum varchar(6), zip varchar(5));
insert into t select provnum, zip from provider_info;
alter table provider_info drop zip;
alter table provider_info add column zip varchar(5);
update provider_info set zip = t.zip from t where provider_info.provnum = t.provnum;
drop table t;

ALTER TABLE provider_info
DROP overall_rating_fn,
DROP survey_rating_fn,
DROP quality_rating_fn,
DROP staffing_rating_fn,
DROP rn_staffing_rating_fn,
DROP staffing_flag,
DROP pt_staffing_flag;


--3 DEFICIENCIES--

CREATE TABLE deficiencies (
provnum varchar(6),
provname varchar(80),
address varchar(100),
city varchar(30),
state varchar(2),
zip varchar(5),
survey_date_output date,
SurveyType varchar(10),
defpref varchar(2),
tag varchar(4),
tag_desc varchar(300),
scope varchar(2),
defstat varchar(50),
statdate date,
cycle_no int,
standard char(1),
complaint char(1),
filedate date,
CONSTRAINT chk_cycle CHECK (cycle_no IN (1, 2, 3, null)),
CONSTRAINT chk_standard CHECK (standard IN ('n', 'N', 'y', 'Y', '')),
CONSTRAINT chk_complaint CHECK (complaint IN ('n', 'N', 'y', 'Y', '')),
CONSTRAINT pk PRIMARY KEY (provnum, survey_date_output, tag),
CONSTRAINT fk FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE
);
COPY deficiencies FROM '/home/darpan/Desktop/Nursing Home Compare/Deficiencies_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE deficiencies 
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--4 AREAWISE COORDINATORS--

CREATE TABLE casper_contacts(
state varchar(6),
email varchar(45),
phone varchar(25),
CONSTRAINT pk_cc PRIMARY KEY (state, email),
CONSTRAINT fk FOREIGN KEY (state) REFERENCES states(state_abbrev) ON DELETE CASCADE
);
COPY casper_contacts FROM '/home/darpan/Desktop/Nursing Home Compare/Nursing_Home_Compare_-_CASPER_Contacts.csv' DELIMITER ',' CSV HEADER;


--5 OWNERSHIP--

CREATE TABLE ownership (
provnum varchar(6),
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
role_desc varchar(50),
owner_type varchar(15),
owner_name varchar(80),
owner_percent varchar(50),
association_date varchar(20),
filedate date,
CONSTRAINT fk FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE
);
COPY ownership FROM '/home/darpan/Desktop/Nursing Home Compare/Ownership_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE ownership 
DROP provname, DROP address, DROP city, DROP state, DROP zip;

--6 PENALTIES--

CREATE TABLE penalties (
provnum varchar(6),
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
penalty_date date,
penalty_type varchar(15),
fine_amt numeric,
payden_strt_dt date,
payden_days int,
filedate date,
CONSTRAINT chk_type CHECK (penalty_type IN ('Fine', 'Payment Denial', '')),
CONSTRAINT fk FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE
);
COPY penalties FROM '/home/darpan/Desktop/Nursing Home Compare/Penalties_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE penalties
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--7 QualityMsrClaims--

CREATE TABLE qualitymsrclaims(
provnum varchar(6),
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
msr_cd int,
msr_descr varchar(200),
stay_type varchar(15),
score_obs numeric,
score_exp numeric,
score_fin numeric,
extra varchar(120),
five_star_msr char(1),
measure_period varchar(15),
filedate date,
CONSTRAINT chk_type CHECK (stay_type IN ('Short Stay', 'Long Stay', '')),
CONSTRAINT chk_star CHECK (five_star_msr IN ('n', 'N', 'y', 'Y', '')),
CONSTRAINT pk_qc PRIMARY KEY (provnum, msr_cd),
CONSTRAINT fk FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE
);
COPY qualitymsrclaims FROM '/home/darpan/Desktop/Nursing Home Compare/QualityMsrClaims_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE qualitymsrclaims
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--8 State Averages--

CREATE TABLE stateavgs(
state varchar(6) PRIMARY KEY,
c1_hlth_defs_cnt numeric,
c1_fs_defs_cnt numeric,
c2_hlth_defs_cnt numeric,
c2_fs_defs_cnt numeric,
c3_hlth_defs_cnt numeric,
c3_fs_defs_cnt numeric,
aidhrd numeric,
vochrd numeric,
rnhrd numeric,
totlichrd numeric,
tothrd numeric,
pthrd numeric,
fine_cnt numeric,
fine_tot numeric,
qm401 numeric,
qm402 numeric,
qm403 numeric,
qm404 numeric,
qm405 numeric,
qm406 numeric,
qm407 numeric,
qm408 numeric,
qm409 numeric,
qm410 numeric,
qm411 numeric,
qm415 numeric,
qm419 numeric,
qm424 numeric,
qm425 numeric,
qm426 numeric,
qm430 numeric,
qm434 numeric,
qm451 numeric,
qm452 numeric,
qm471 numeric,
qm521 numeric,
qm522 numeric,
qm523 numeric,
file_date date,
CONSTRAINT fk FOREIGN KEY (state) REFERENCES states(state_abbrev) ON DELETE CASCADE
);
COPY stateavgs FROM '/home/darpan/Desktop/Nursing Home Compare/StateAverages_Download.csv' DELIMITER ',' CSV HEADER;


--9 Survey Summary--

CREATE TABLE surveysummary(
provnum varchar(6),
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
cycle_no int,
h_survey_date date,
f_survey_date date,
h_tot_defcncy int,
f_tot_defcncy boolean,
h_ss_max varchar(5),
f_ss_max int,
h_ij_n int,
f_ij_n int,
h_severe_n int,
f_severe_n int,
h_ssubstndrd_qoc_n int,
h_administration_n int,
h_environmental_n int,
h_mistreat_n int,
h_nutrition_n int,
h_pharmacy_n int,
h_quality_care_n int,
h_res_asmnt_n int,
h_res_rights_n int,
f_construction_n int,
f_corridor_doors_n int,
f_electrical_n int,
f_eplan_n int,
f_exit_egress_n int,
f_exit_access_n int,
f_fire_alarm_n int,
f_furnishings_n int,
f_hazard_area_n int,
f_illumination_n int,
f_interior_n int,
f_labs_n int,
f_medical_gas_n int,
f_misc_n int,
f_service_equipment_n int,
f_smoke_control_n int,
f_smoking_rgn_n int,
f_sprinkler_n int,
f_vert_openings_n int,
filedate date
CONSTRAINT chk_cycle CHECK (cycle_no IN (1, 2, 3, null)),
CONSTRAINT pk_ss PRIMARY KEY (provnum, cycle_no),
CONSTRAINT fk FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE
);
COPY surveysummary FROM '/home/darpan/Desktop/Nursing Home Compare/SurveySummary_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE surveysummary
DROP provname, 
DROP address, 
DROP city, 
DROP state, 
DROP zip,
DROP f_construction_n,
DROP f_corridor_doors_n,
DROP f_electrical_n,
DROP f_eplan_n,
DROP f_exit_egress_n,
DROP f_exit_access_n,
DROP f_fire_alarm_n,
DROP f_furnishings_n,
DROP f_hazard_area_n,
DROP f_illumination_n,
DROP f_interior_n,
DROP f_labs_n,
DROP f_medical_gas_n,
DROP f_misc_n,
DROP f_service_equipment_n,
DROP f_smoke_control_n,
DROP f_smoking_rgn_n,
DROP f_sprinkler_n,
DROP f_vert_openings_n,
DROP f_survey_date,
DROP f_tot_defcncy,
DROP f_ss_max,
DROP f_ij_n,
DROP f_severe_n,
DROP H_tot_defcncy,
DROP H_ss_max,
DROP H_ij_n,
DROP H_severe_n;


--10 QualityMsrMDS--

CREATE TABLE qualitymsrmds(
provnum varchar(6),
provname varchar(80),
address varchar(70),
city varchar(30),
state varchar(2),
zip numeric,
msr_cd int,
msr_descr varchar(200),
stay_type varchar(15),
q1_measure_score numeric,
q1ms_fn varchar(120),
q2_measure_score numeric,
q2ms_fn varchar(120),
q3_measure_score numeric,
q3ms_fn varchar(120),
q4_measure_score numeric,
q4ms_fn varchar(120),
avg_score numeric,
avgs_fn varchar(120),
five_star_msr char,
q1 varchar(8),
q2 varchar(8),
q3 varchar(8),
q4 varchar(8),
filedate date,
CONSTRAINT chk_type CHECK (stay_type IN ('Short Stay', 'Long Stay', '')),
CONSTRAINT chk_star CHECK (five_star_msr IN ('n', 'N', 'y', 'Y', '')),
CONSTRAINT pk_qm PRIMARY KEY (provnum, msr_cd),
CONSTRAINT fk FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE
);
COPY qualitymsrmds FROM '/home/darpan/Desktop/Nursing Home Compare/QualityMsrMDS_Download.csv' DELIMITER ',' CSV HEADER;

ALTER TABLE qualitymsrmds
DROP provname, DROP address, DROP city, DROP state, DROP zip;


--11 Login--

CREATE TABLE login(
username varchar(45) PRIMARY KEY,
password varchar(150),
type char,
CONSTRAINT chk_type CHECK (type IN ('s', 'a', 'n', 'u'))
);

INSERT INTO login
VALUES ('superuser', 'superuser', 's');

INSERT INTO login
SELECT email, email, 'a'
FROM casper_contacts;

INSERT INTO login
SELECT provnum, provnum, 'n'
FROM provider_info;

--12 FEEDBACK TABLE--

CREATE TABLE feedback(
feedback_id serial primary key,
username varchar(45),
provnum varchar(6),
score int,
score_desc varchar(250),
time timestamp default CURRENT_TIMESTAMP,

CONSTRAINT fk1 FOREIGN KEY (provnum) REFERENCES provider_info(provnum) ON DELETE CASCADE,
CONSTRAINT fk2 FOREIGN KEY (username) REFERENCES login(username) ON DELETE CASCADE,
CONSTRAINT chk CHECK (score IN (1, 2, 3, 4, 5, null))
);

CREATE OR REPLACE FUNCTION update_column()
        RETURNS TRIGGER AS '
  BEGIN
    NEW.time = NOW();
    RETURN NEW;
  END;
' LANGUAGE 'plpgsql';
 
CREATE TRIGGER update_modtime BEFORE UPDATE
  ON feedback FOR EACH ROW EXECUTE PROCEDURE
  update_column();

--11 HEALTH DEFICIENCIES--

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
COPY Health_Deficiencies FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Health_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--12 INSPECTION CYCLE 1--

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
COPY Inspection_Cycle_1_Deficiencies FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Inspection_Cycle_1_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--13 INSPECTION CYCLE 2--

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
COPY Inspection_Cycle_2_Deficiencies FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Inspection_Cycle_2_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--14 INSPECTION CYCLE 3--

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
COPY Inspection_Cycle_3_Deficiencies FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Inspection_Cycle_3_Deficiencies.csv' DELIMITER ',' CSV HEADER;


--15 PENALTY COUNTS--

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
COPY Penalty_Count FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Penalty_Counts.csv' DELIMITER ',' CSV HEADER;


--16 Star Rating--

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
COPY Star_Rating FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Star_Ratings.csv' DELIMITER ',' CSV HEADER;


--17 Quality Measure Short Stay--

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
COPY Q_Measure_Short_Stay FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Quality_Measures_-_Short_Stay.csv' DELIMITER ',' CSV HEADER;


--18 Quality Measure Long Stay--

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
COPY Q_Measure_Long_Stay FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Quality_Measures_-_Long_Stay.csv' DELIMITER ',' CSV HEADER;


--19 Staffing--

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
COPY Staffing FROM 'C:\Users\Pranjal Kumar\Documents\Study\Semester-6\COL362-DatabaseManagement\Assignments\Assignment3\Staffing.csv' DELIMITER ',' CSV HEADER;


