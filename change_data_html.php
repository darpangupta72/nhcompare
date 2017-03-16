<?php
$name= '';$usertype='s';
 session_start();
 if(!isset($_SESSION['username'])){
 //    header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];
        $usertype=$_SESSION['usertype'];}
?>

<html>
    <head>
        <title>EDIT DATABASE</title>
    
         <style>
            li{list-style: none; }
            body{
                    background-color: #FFFFFF;
                    background: url(123.jpg) center;
                }
            h1, h2, h3, h5, h6 {
                 padding: 0;
                 margin-bottom: 0;
            }

            h4{   
                margin-top: 0.15cm;
                margin-bottom: 0.4cm;
            }
        </style>
            <?php 
                require_once('styling.php');
            ?>
        
    </head>
    
    <body>
        <center>
            <h2> <font color=#000000>NURSING HOME COMPARE</font></h2>
            <h4> <i><font color=#000000 >A system to compare nursing homes across USA</font></i></h4><hr>
        </center>
        <?php
            require_once 'logout_home.php';
        ?>
        <div style=" position: absolute; top: 25%; left: 38%">
            <ul>
                <form action = "change_data_html.php" method="POST">
                    Operation: <select name="type" id="type">
                            <option value = "insert">Insert</option>
                            <option value = "delete">Delete</option>
                            <option value = "update">UPDATE</option>
                        </select>
                    Type: <select name="table" id="table">
                            <option value = "provider_info">Nursing Home</option>
                            <option value = "ownership">Owners</option>
                            <option value = "casper_contacts">State Coordinators</option>
                            <option value = "deficiencies">Deficiencies</option> 

                        </select>
                    &emsp;&emsp;<input type="submit" value="SUBMIT">
                </form>
            </ul>            
        </div>
    </body>
</html>


<?php

if(isset($_POST['type'])&&isset($_POST['table'])){

    $command=$_POST['type'];$table=$_POST['table'];
    echo "<div style=\" position: absolute; top: 35%; margin-left: 38%; margin-right:70%;\"><ul>";
    echo "<form action = \"change_data_html.php\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"type\" value='$command'>";
    echo "<input type=\"hidden\" name=\"table\" value='$table'>";
    if($command=='insert'){
        if($table=='provider_info') {
             echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>"; 
            echo "<li>Provider Name: <input type=\"text\" name=\"provname\"></li>"; 
            echo "<li>Address: <input type=\"text\" name=\"address\"></li>"; 
            echo "<li>City: <input type=\"text\" name=\"city\"></li>"; 
            echo "<li>State: <input type=\"text\" name=\"state\" value='AL'></li>"; 
            echo "<li>Zip: </li><li> <input type=\"text\" name=\"zip\"></li>"; 
            echo "<li>Phone: <input type=\"text\" name=\"phone\"></li>"; 
            echo "<li>County Code: <input type=\"text\" name=\"county_ssa\"></li>"; 
            echo "<li>County Name: <input type=\"text\" name=\"county_name\"></li>"; 
            echo "<li>Ownership: <input type=\"text\" name=\"ownership\"></li>"; 
            echo "<li>Count of certified Beds: <input type=\"text\" name=\"bedcert\" value='2'></li>"; 
            echo "<li>Total no. of residents: <input type=\"text\" name=\"restot\" value='3'></li>"; 
            echo "<li>certification: <input type=\"text\" name=\"certification\"></li>"; 
            echo "<li>In hospital: <input type=\"text\" name=\"inhosp\"></li>"; 
            echo "<li>Legal Business Name: <input type=\"text\" name=\"lbn\"></li>"; 
            echo "<li>Participation Date: <input type=\"text\" name=\"participation_date\" value='1990-07-01'></li>"; 
            echo "<li>CCRC facility: <input type=\"text\" name=\"ccrc_facil\"></li>"; 
            echo "<li>SFF: <input type=\"text\" name=\"sff\"></li>"; 
            echo "<li>Oldsurvey: <input type=\"text\" name=\"oldsurvey\"></li>"; 
            echo "<li>Change Ownership: <input type=\"text\" name=\"chow_last_12mos\"></li>"; 
            echo "<li>Resident Family Council: <input type=\"text\" name=\"resfamcouncil\"></li>"; 
            echo "<li>Sprinkler Status: <input type=\"text\" name=\"sprinkler_status\"></li>"; 
            echo "<li>Overall Rating: <input type=\"text\" name=\"overall_rating\" value='3'></li>"; 
            echo "<li>Survey Rating: <input type=\"text\" name=\"survey_rating\" value='3'></li>"; 
            echo "<li>Quality Rating: <input type=\"text\" name=\"quality_rating\" value='3'></li>"; 
            echo "<li>Staffing Rating: <input type=\"text\" name=\"staffing_rating\" value='3'></li>"; 
            echo "<li>RN_Staffing Rating: <input type=\"text\" name=\"rn_staffing_rating\" value='3'></li>"; 
            echo "<li>aidhrd: <input type=\"text\" name=\"aidhrd\" value='3.0'></li>"; 
            echo "<li>vochrd: <input type=\"text\" name=\"vochrd\" value='3.0'></li>"; 
            echo "<li>rnhrd: <input type=\"text\" name=\"rnhrd\" value='3.0'></li>"; 
            echo "<li>totlichrd: <input type=\"text\" name=\"totlichrd\" value='3.0'></li>"; 
            echo "<li>tothrd: <input type=\"text\" name=\"tothrd\" value='3.0'></li>"; 
            echo "<li>pthrd: <input type=\"text\" name=\"pthrd\" value='3.0'></li>"; 
            echo "<li>exp_aide: <input type=\"text\" name=\"exp_aide\" value='3.0'></li>"; 
            echo "<li>exp_lpn: <input type=\"text\" name=\"exp_lpn\" value='3.0'></li>"; 
            echo "<li>exp_rn: <input type=\"text\" name=\"exp_rn\" value='3.0'></li>"; 
            echo "<li>exp_total: <input type=\"text\" name=\"exp_total\" value='3.0'></li>"; 
            echo "<li>adj_aide: <input type=\"text\" name=\"adj_aide\" value='3.0'></li>"; 
            echo "<li>adj_lpn: <input type=\"text\" name=\"adj_lpn\" value='3.0'></li>"; 
            echo "<li>adj_rn: <input type=\"text\" name=\"adj_rn\" value='3.0'></li>"; 
            echo "<li>adj_total: <input type=\"text\" name=\"adj_total\" value='3.0'></li>"; 
            echo "<li>Cycle_1_defs_score: <input type=\"text\" name=\"cycle_1_defs_score\"></li>"; 
            echo "<li>cycle_1_survey_date: <input type=\"text\" name=\"cycle_1_survey_date\" value='1990-07-01'></li>"; 
            echo "<li>cycle_1_numrevis: <input type=\"text\" name=\"cycle_1_numrevis\"></li>"; 
            echo "<li>cycle_1_revisit_score: <input type=\"text\" name=\"cycle_1_revisit_score\"></li>"; 
            echo "<li>cycle_1_total_score: <input type=\"text\" name=\"cycle_1_total_score\"></li>"; 
            echo "<li>cycle_2_defs_score: <input type=\"text\" name=\"cycle_2_defs_score\"></li>"; 
            echo "<li>Cycle 2 survey date: <input type=\"text\" name=\"cycle_2_survey_date\" value='1990-07-01'></li>"; 
            echo "<li>Cycle 2 numrevis: <input type=\"text\" name=\"cycle_2_numrevis\"></li>"; 
            echo "<li>Cycle 2 revisit score: <input type=\"text\" name=\"cycle_2_revisit_score\"></li>"; 
            echo "<li>Cycle 2 total score: <input type=\"text\" name=\"cycle_2_total_score\"></li>"; 
            echo "<li>Cycle 3 defs score: <input type=\"text\" name=\"cycle_3_defs_score\"></li>"; 
            echo "<li>Cycle 3 survey date: <input type=\"text\" name=\"cycle_3_survey_date\" value='1990-07-01'></li>"; 
            echo "<li>Cycle 3 numrevis: <input type=\"text\" name=\"cycle_3_numrevis\"></li>"; 
            echo "<li>Cycle 3 revisit score: <input type=\"text\" name=\"cycle_3_revisit_score\"></li>"; 
            echo "<li>Cycle 3 total score: <input type=\"text\" name=\"cycle_3_total_score\"></li>"; 
            echo "<li>weighted_all_cycles_score: <input type=\"text\" name=\"weighted_all_cycles_score\"></li>"; 
            echo "<li>Incident Count: <input type=\"text\" name=\"incident_cnt\" value='3'></li>"; 
            echo "<li>Complaint Count: <input type=\"text\" name=\"cmplnt_cnt\" value='3'></li>"; 
            echo "<li>File Date: <input type=\"text\" name=\"filedate\" value='1990-07-01'></li>"; 
        }
        
        else if($table=='ownership'){
            echo "<li>Owner ID: <input type=\"text\" name=\"ownerID\"></li>";
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";
            echo "<li>Role: <input type=\"text\" name=\"role_desc\"></li>";
            echo "<li>Owner Type: <input type=\"text\" name=\"owner_type\"></li>";
            echo "<li>Owner Name: <input type=\"text\" name=\"owner_name\"></li>";
            echo "<li>Owner Percent: <input type=\"text\" name=\"owner_percent\"></li>";
            echo "<li>Association date: <input type=\"text\" name=\"association_date\"></li>";
            echo "<li>File Date: <input type=\"text\" name=\"filedate\"></li>";
            }

        else if($table=='casper_contacts'){
            echo "<li>State: <input type=\"text\" name=\"state\"></li>";
            echo "<li>Email: <input type=\"text\" name=\"email\"></li>";
            echo "<li>Phone: <input type=\"text\" name=\"phone\"></li>";
        }

        else if($table=='deficiencies'){
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";
            echo "<li>Survey Date: <input type=\"text\" name=\"survey_date_output\"></li>";
            echo "<li>Survey Type: <input type=\"text\" name=\"SurveyType\"></li>";
            echo "<li>Deficiency prefix: <input type=\"text\" name=\"defpref\"></li>";
            echo "<li>Tag: <input type=\"text\" name=\"tag\"></li>";
            echo "<li>Tag Description: <input type=\"text\" name=\"tag_desc\"></li>";
            echo "<li>Scope: <input type=\"text\" name=\"scope\"></li>";
            echo "<li>Deficiency Status: <input type=\"text\" name=\"defstat\"></li>";
            echo "<li>Status Date: <input type=\"text\" name=\"statdate\"></li>";
            echo "<li>Cycle NO: <input type=\"text\" name=\"cycle_no\"></li>";
            echo "<li>Standard: <input type=\"text\" name=\"standard\"></li>";
            echo "<li>Complaint: <input type=\"text\" name=\"complaint\"></li>";
            echo "<li>File Date: <input type=\"text\" name=\"filedate\"></li>";
        }
    }
    else if($command=='delete'){
        if($table=='casper_contacts'){
            echo "<li>State: <input type=\"text\" name=\"state\"></li>";
            echo "<li>Email: <input type=\"text\" name=\"email\"></li>";
        }
        
        else if($table=='ownership'){
            echo "<li>Owner ID: <input type=\"text\" name=\"ownerID\"></li>";
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";
        }

        else if($table=='deficiencies'){
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";
            echo "<li>Survey Date: <input type=\"text\" name=\"survey_date_output\"></li>";
            echo "<li>Tag: <input type=\"text\" name=\"tag\"></li>";
        }

        else if($table=='provider_info'){
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";
        } 
    }

    else if($command=='update'){
        if($table=='casper_contacts'){
            echo "<li>State: <input type=\"text\" name=\"state\"></li>";
            echo "<li>Email: <input type=\"text\" name=\"email\"></li>";

            echo "<br><br>ONLY FOLLOWING CAN BE UPDATED<br>";
            echo "<li>New Phone: <input type=\"text\" name=\"phone\"></li>";

        }
        
        else if($table=='ownership'){
            echo "<li>Owner ID: <input type=\"text\" name=\"ownerID\"></li>";
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";

            echo "<br><br>ONLY FOLLOWING CAN BE UPDATED<br>";
            echo "<li>New Role: <input type=\"text\" name=\"role_desc\"></li>";
            echo "<li>New Owner Percent: <input type=\"text\" name=\"owner_percent\"></li>";
            
        }

        else if($table=='deficiencies'){
            echo "<br><br>UPDATE IN DEFICIENCIES IS NOT ALLOWED!!<br>"; 
        }

        else if($table=='provider_info'){
            echo "<li>Provider No: <input type=\"text\" name=\"provnum\"></li>";

            echo "<br><br>ONLY FOLLOWING CAN BE UPDATED<br>";
            echo "<li>New Phone: <input type=\"text\" name=\"phone\"></li>";

        } 
    }

     echo "<li><center><button name=\"command\" value=\"submit\">SUBMIT</button></center></li>";            
        echo "</form></center></ul></div>";
    
    
}    

if(isset($_POST['command'])) {
    $command=$_POST['command'];$type=$_POST['type']; $table=$_POST['table'];

    $sql='';
    if($command=='submit'){

    if($type=='insert'){
        if($table=='provider_info') {
            $provnum =$_POST['provnum']; $provname =$_POST['provname']; $address =$_POST['address']; $city =$_POST['city']; $state =$_POST['state']; $zip =$_POST['zip']; 
            $phone =$_POST['phone']; $county_ssa =$_POST['county_ssa']; $county_name =$_POST['county_name']; $ownership =$_POST['ownership']; $bedcert =$_POST['bedcert'];
            $restot =$_POST['restot']; $certification =$_POST['certification']; $inhosp =$_POST['inhosp']; $lbn =$_POST['lbn']; $participation_date =$_POST['participation_date']; 
            $ccrc_facil =$_POST['ccrc_facil']; $sff =$_POST['sff']; $oldsurvey =$_POST['oldsurvey']; $chow_last_12mos =$_POST['chow_last_12mos']; 
            $resfamcouncil =$_POST['resfamcouncil']; $sprinkler_status =$_POST['sprinkler_status']; $overall_rating =$_POST['overall_rating']; $survey_rating =$_POST['survey_rating'];
            $quality_rating =$_POST['quality_rating']; $staffing_rating =$_POST['staffing_rating']; $rn_staffing_rating =$_POST['rn_staffing_rating']; $aidhrd =$_POST['aidhrd']; 
            $vochrd =$_POST['vochrd']; $rnhrd =$_POST['rnhrd']; $totlichrd =$_POST['totlichrd']; $tothrd =$_POST['tothrd']; $pthrd =$_POST['pthrd']; 
            $exp_aide =$_POST['exp_aide']; $exp_lpn =$_POST['exp_lpn']; $exp_rn =$_POST['exp_rn']; $exp_total =$_POST['exp_total']; $adj_aide =$_POST['adj_aide']; 
            $adj_lpn =$_POST['adj_lpn']; $adj_rn =$_POST['adj_rn']; $adj_total =$_POST['adj_total']; $cycle_1_defs_score =$_POST['cycle_1_defs_score']; 
            $cycle_1_survey_date =$_POST['cycle_1_survey_date']; $cycle_1_numrevis =$_POST['cycle_1_numrevis']; $cycle_1_revisit_score =$_POST['cycle_1_revisit_score']; 
            $cycle_1_total_score =$_POST['cycle_1_total_score']; $cycle_2_defs_score =$_POST['cycle_2_defs_score']; $cycle_2_survey_date =$_POST['cycle_2_survey_date']; 
            $cycle_2_numrevis =$_POST['cycle_2_numrevis']; $cycle_2_revisit_score =$_POST['cycle_2_revisit_score']; $cycle_2_total_score =$_POST['cycle_2_total_score']; 
            $cycle_3_defs_score =$_POST['cycle_3_defs_score']; $cycle_3_survey_date =$_POST['cycle_3_survey_date']; $cycle_3_numrevis =$_POST['cycle_3_numrevis']; 
            $cycle_3_revisit_score =$_POST['cycle_3_revisit_score']; $cycle_3_total_score =$_POST['cycle_3_total_score']; 
            $weighted_all_cycles_score =$_POST['weighted_all_cycles_score']; $incident_cnt =$_POST['incident_cnt']; $cmplnt_cnt =$_POST['cmplnt_cnt']; $filedate =$_POST['filedate']; 
        
            $sql="INSERT INTO provider_info(provnum, provname, address, city, state, zip, phone, county_ssa, county_name, ownership, bedcert, restot, certification , inhosp, lbn, participation_date, ccrc_facil, sff, oldsurvey, chow_last_12mos, resfamcouncil, sprinkler_status, overall_rating, survey_rating, quality_rating, staffing_rating, rn_staffing_rating, aidhrd, vochrd, rnhrd, totlichrd, tothrd, pthrd, exp_aide, exp_lpn, exp_rn, exp_total, adj_aide, adj_lpn, adj_rn, adj_total, cycle_1_defs_score, cycle_1_survey_date, cycle_1_numrevis, cycle_1_revisit_score, cycle_1_total_score, cycle_2_defs_score, cycle_2_survey_date, cycle_2_numrevis, cycle_2_revisit_score, cycle_2_total_score, cycle_3_defs_score, cycle_3_survey_date, cycle_3_numrevis, cycle_3_revisit_score, cycle_3_total_score, weighted_all_cycles_score, incident_cnt, cmplnt_cnt, filedate) VALUES ('$provnum', '$provname', '$address', '$city', '$state', '$zip', '$phone', '$county_ssa', '$county_name', '$ownership', '$bedcert', '$restot', '$certification ', '$inhosp', '$lbn', '$participation_date', '$ccrc_facil', '$sff', '$oldsurvey', '$chow_last_12mos', '$resfamcouncil', '$sprinkler_status', '$overall_rating', '$survey_rating', '$quality_rating', '$staffing_rating', '$rn_staffing_rating', '$aidhrd', '$vochrd', '$rnhrd', '$totlichrd', '$tothrd', '$pthrd', '$exp_aide', '$exp_lpn', '$exp_rn', '$exp_total', '$adj_aide', '$adj_lpn', '$adj_rn', '$adj_total', '$cycle_1_defs_score', '$cycle_1_survey_date', '$cycle_1_numrevis', '$cycle_1_revisit_score', '$cycle_1_total_score', '$cycle_2_defs_score', '$cycle_2_survey_date', '$cycle_2_numrevis', '$cycle_2_revisit_score', '$cycle_2_total_score', '$cycle_3_defs_score', '$cycle_3_survey_date', '$cycle_3_numrevis', '$cycle_3_revisit_score', '$cycle_3_total_score', '$weighted_all_cycles_score', '$incident_cnt', '$cmplnt_cnt', '$filedate')";
        }
        
        else if($table=='ownership'){
            $ownerID = $_POST['ownerID'];
            $provnum = $_POST['provnum'];
            $role_desc = $_POST['role_desc'];$owner_type = $_POST['owner_type'];$owner_name = $_POST['owner_name'];$owner_percent = $_POST['owner_percent'];
            $association_date = $_POST['association_date'];$filedate = $_POST['filedate'];

            $sql="INSERT INTO ownership VALUES('$provnum', '$role_desc', '$owner_type', '$owner_name', '$owner_percent', '$association_date', '$filedate')";
        }

        else if($table=='casper_contacts'){
            $state = $_POST['state'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $sql="INSERT INTO casper_contacts VALUES('$state','$email','$phone')";
        }

        else if($table=='deficiencies'){
            $provnum = $_POST['provnum'];
            $survey_date_output = $_POST['survey_date_output'];
            $surveytype = $_POST['SurveyType'];
            $defpref = $_POST['defpref'];
            $teg = $_POST['tag'];
            $teg_desc = $_POST['tag_desc'];
            $scope = $_POST['scope'];
            $defstat = $_POST['defstat'];
            $statdate = $_POST['statdate'];
            $cycle_no = $_POST['cycle_no'];
            $standard = $_POST['standard'];
            $complaint = $_POST['complaint'];
            $filedate = $_POST['filedate'];

            $sql="INSERT INTO deficiencies VALUES('$provnum', '$survey_date_output', '$SurveyType', '$defpref', '$tag', '$tag_desc', '$scope', '$defstat', '$statdate', '$cycle_no', '$standard', '$complaint', '$filedate')";
        }
    }

    else if($type=='delete'){
        if($table=='casper_contacts'){
            $state=$_POST['state'];
            $email=$_POST['email'];

            $sql="DELETE FROM casper_contacts where state='$state' AND email='$email'";
        }
        
        else if($table=='ownership'){
            $ownerID =$_POST['ownerID'];
            $provnum =$_POST['provnum'];

            $sql="DELETE FROM ownership WHERE provnum='$provnum' AND association_date='since'";
        }

        else if($table=='deficiencies'){
            $provnum = $_POST['provnum'];
            $provnum = $_POST['survey_date_output'];
            $tag = $_POST['tag'];
            $sql="DELETE FROM deficiencies WHERE provnum='$provnum' AND survey_date_output='$date' AND tag='$tag'";
        }

        else if($table=='provider_info'){
            $provnum = $_POST['provnum'];
            $sql="DELETE FROM provider_info WHERE provnum='$provnum'";
        } 
    }

    else if($type=='update'){
        if($table=='casper_contacts'){
            $state =$_POST['state'];
            $email =$_POST['email'];
            $phone =$_POST['phone'];

            $sql="UPDATE casper_contacts SET phone='$phone' Where state='$state' AND email='$email'";
        }
        
        else if($table=='ownership'){
            $ownerID =$_POST['ownerID'];
            $provnum =$_POST['provnum'];

            $role_desc =$_POST['role_desc'];
            $owner_percent =$_POST['owner_percent'];

            $sql="UPDATE ownership SET role_desc='$role_desc', owner_percent='$owner_percent' where provnum='$provnum' AND association_date='since'";
            
        }

        else if($table=='deficiencies'){
            echo "<br><br>UPDATE IN DEFICIENCIES IS NOT ALLOWED!!<br>"; 
        }

        else if($table=='provider_info'){
            $provnum =$_POST['provnum'];
            $phone = $_POST['phone'];

           $sql="UPDATE provider_info SET phone='$phone' where provnum='$provnum'";
        } 
    }

    ////RUN SQL QUERY
        require_once 'db_connect.php';
        $conn = pg_connect("$host $port $dbname $credentials");
        $result = pg_query($conn, $sql);
        if(!$result){ echo "Some thing went wrong";}
        else echo "Edit into database succesfull!!";
        pg_close($conn);

}
    switch ($_POST['command']) {
        case 'logout':
            session_unset();
            session_destroy();
            header("Location: login_html.php");
            break;
        case 'home':
            if($usertype == 'a' || $usertype == 's')
                header("Location: admin_welcome_html.php");
            else if($usertype == 'n')
                    header("Location: search_nh_html.php");
                 else
                    header("Location: general_user_html.php");                
            break;   
        default:
            break;
    }
}

?>