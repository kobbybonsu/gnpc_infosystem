<?php

// @author: Kwabena Gyekye Ohene-Bonsu

	include_once("gen.php");
	include_once 'adb.php';
	$cmd=get_datan("cmd");
	
	switch($cmd){
		case 2:
			getLeaveType();
			break;
		case 3:
			get_request_by_id($id);
			break;
		case 4:
			send_leave_request();
			break;
		case 5:
			see_all_my_requests($id);
			break;
		case 6:
			check_my_days_left($id);
			break;
		case 7:
			update_leave_request($id);
			break;

		// default:
		// 	echo "{";
		// 	echo jsonn("result", 0). ",";
		// 	echo jsons("message","unknown command");
		// 	echo "}";
	}

	//Command: 2
	function getLeaveType() {
		include ("query_functions.php");
		$gnpc = new query_functions();
		$gnpc -> getLeaveType();

		$row = $gnpc ->fetch();
		if (!$row) {
			echo "{";
			echo jsonn("result", 0). ",";
			echo jsons("message", "no leave type found");
			echo "}";
			return;
		}

		echo "{";
		echo '"gnpc_dms":';
		$det=Array();
		do
		{
			array_push($det, $row);
			$row=$gnpc->fetch();
		}
		while($row);
		print_r(json_encode($det));
		echo "}";
	}

	//Command: 3
	function get_request_by_id($id){

		$db = new adb();
		$db -> connect();

		$result = "SELECT * FROM gnpc_lms.lms_requests
                		INNER JOIN gnpc_employees.ge_users ON (ge_users.u_id=lms_requests.employee_ref)
                		INNER JOIN lms_leave_type ON (lms_leave_type.t_id=lms_requests.leave_type_ref)
                		INNER JOIN lms_request_status ON (lms_request_status.rs_id=lms_requests.request_status_ref)
                		WHERE r_id='$id'";

		if(!$db->query($result)){
				return false;
			}

		return $db -> fetch();
	}

	//Command: 4
	function send_leave_request() {
		if(isset($_POST['submit'])){
			$employee_ref = $_REQUEST["employee_ref"];
			$leave_type_ref = $_REQUEST["leave_type_ref"];
			$num_days_left = $_REQUEST["num_days_left"];
			$job_title  = filter_input(INPUT_POST, "job_title", FILTER_SANITIZE_STRING);
			$num_days_requested  = filter_input(INPUT_POST, "num_days_requested", FILTER_SANITIZE_STRING);
			$commencement_date = $_REQUEST["commencement_date"];
			$end_date = $_REQUEST["end_date"];
			$resumption_date = $_REQUEST["resumption_date"];
			$officer_taking_over  = filter_input(INPUT_POST, "officer_taking_over", FILTER_SANITIZE_STRING);
			$leave_address  = filter_input(INPUT_POST, "leave_address", FILTER_SANITIZE_SPECIAL_CHARS);
			$contact  = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_STRING);
			$email  = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

			$db = new adb();
			$db -> connect();
		
			if ($leave_type_ref == 1) {

				if ($num_days_requested > $num_days_left) {
					?>
						<script>
							alert("Sorry, The Number Of Leave Days Requested Is More Than Your Leave Days Left!");
							window.history.back();
						</script>
					<?php
				}

				else {

					if ($job_title == "" || $num_days_requested == "" || $officer_taking_over == "") {
						?>
							<script>
								alert("ERROR: Make sure all fields are filled!");
								window.history.back();
							</script>
							<?php
					}

					else {
						$query1 = "SET FOREIGN_KEY_CHECKS=0";
					mysql_query($query1);

					$query = "INSERT INTO lms_requests SET leave_type_ref='$leave_type_ref', job_title='$job_title', num_days_requested='$num_days_requested',
								employee_ref='$employee_ref', leave_address='$leave_address', request_status_ref='1', num_days_left='$num_days_left', commencement_date='$commencement_date', 
								end_date='$end_date', resumption_date='$resumption_date', contact='$contact', email='$email', officer_taking_over='$officer_taking_over',
								hod_endorsement='0', hr_verification='0', hr_dir_approval='0', request_date=CURDATE()";
					$result = mysql_query($query) or die(mysql_error());
					$query2 = "SET FOREIGN_KEY_CHECKS=1";
					mysql_query($query2);
					
					
					if($result == 1){
						?>
							<script>
								alert("Leave Request Submitted!");
								window.location.href="send_leave_request.php";
							</script>
							<?php
					} 

					else {
							?>
							<script>
								alert("ERROR: Make sure all fields are filled!");
								window.history.back();
							</script>
							<?php
						}
					}
				}
			}

			else {

				if ($job_title == "" || $num_days_requested == "" || $officer_taking_over == "") {
					?>
						<script>
							alert("ERROR: Make sure all fields are filled!");
							window.history.back();
						</script>
						<?php
				}

				else {
					$query1 = "SET FOREIGN_KEY_CHECKS=0";
				mysql_query($query1);

				$query = "INSERT INTO lms_requests SET leave_type_ref='$leave_type_ref', job_title='$job_title', num_days_requested='$num_days_requested',
							employee_ref='$employee_ref', leave_address='$leave_address', request_status_ref='1', num_days_left='$num_days_left', commencement_date='$commencement_date', 
							end_date='$end_date', resumption_date='$resumption_date', contact='$contact', email='$email', officer_taking_over='$officer_taking_over',
							hod_endorsement='0', hr_verification='0', hr_dir_approval='0', request_date=CURDATE()";
				$result = mysql_query($query) or die(mysql_error());
				$query2 = "SET FOREIGN_KEY_CHECKS=1";
				mysql_query($query2);
				
				
				if($result == 1){
					?>
						<script>
							alert("Leave Request Submitted!");
							window.location.href="send_leave_request.php";
						</script>
						<?php
				} else {
							?>
							<script>
								alert("ERROR: Make sure all fields are filled!");
								window.history.back();
							</script>
							<?php
						}
					}
			}
		}
	}

	//Command: 5
	function see_all_my_requests($id){
		$id = $_SESSION['u_id'];
		$db = new adb();
		$db -> connect();

                $sql = "SELECT * FROM gnpc_lms.lms_requests
                		INNER JOIN gnpc_employees.ge_users ON (ge_users.u_id=lms_requests.employee_ref)
                		INNER JOIN lms_leave_type ON (lms_leave_type.t_id=lms_requests.leave_type_ref)
                		INNER JOIN lms_request_status ON (lms_request_status.rs_id=lms_requests.request_status_ref)
                		WHERE u_id='$id'"; 
                $result = mysql_query ($sql); //run the query
		if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}

		if(mysql_num_rows($result) > 0){
			echo "<center><div align='center' class='alert alert-info' role='alert'><i class='glyphicon glyphicon-alert'></i>
        	<b>Your Leave Requests</b></div></center>";
        echo "<table class='table table-striped'>";
            echo "<thead><tr>";
                echo "<th>REQUEST DATE</th>";
                echo "<th>DAYS REQUESTED</th>";
                echo "<th>OFFICER TAKING OVER</th>";
                echo "<th>LEAVE TYPE</th>";
                echo "<th>STATUS</th>";
                echo "<th>REQUEST DETAILS</th>";
            echo "</tr></thead>";
		    echo "<tbody>";
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . date("d-M-Y", strtotime($row['request_date'])) . "</td>";
			echo "<td>" . $row['num_days_requested'] . "</td>";
			echo "<td>" . $row['officer_taking_over'] . "</td>";
			echo "<td>" . $row['t_name'] . "</td>";
			echo "<td>" . $row['status'] . "</td>";
			echo "<td><a href='request_details.php?id=$row[u_id]'>Details</a></td>";
			echo "</tr>";
		}
		echo "</tbody>
			</table>";
			mysql_free_result($result);

		}

		else{
        	echo "<center><div align='center' class='alert alert-danger' role='alert'>
        	<i class='glyphicon glyphicon-alert'></i><b>You Have No Leave Requests Recorded</b></div></center>";
    	}
	}

	//Command: 6
	function check_my_days_left($id){
		$id = $_SESSION['u_id'];
		$db = new adb();
		$db -> connect();

		$my_num_days = 0;

		$sql = "SELECT * FROM gnpc_lms.lms_requests
                		INNER JOIN gnpc_employees.ge_users ON (ge_users.u_id=lms_requests.employee_ref)
                		INNER JOIN lms_leave_type ON (lms_leave_type.t_id=lms_requests.leave_type_ref)
                		INNER JOIN lms_request_status ON (lms_request_status.rs_id=lms_requests.request_status_ref)
                		WHERE r_id='$id' AND year(request_date) = year(CURDATE()) AND request_status_ref = 4
                		ORDER BY request_date DESC LIMIT 1";

		$result = mysql_query ($sql); //run the query
		if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}

		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)){
				$my_num_days = $row['num_days_left'];
				echo $my_num_days;

			}
				mysql_free_result($result);

		}

		else{

	        	$sql = "SELECT * FROM gnpc_lms.lms_official_leave_days
	                		INNER JOIN gnpc_employees.ge_users ON (ge_users.u_group=lms_official_leave_days.d_id)
	                		WHERE u_id='$id' AND ge_users.u_group=lms_official_leave_days.d_id";

			$result = mysql_query ($sql); //run the query
			if($result === FALSE) { 
			    die(mysql_error()); // TODO: better error handling
			}

			if(mysql_num_rows($result) > 0){
				while($row = mysql_fetch_array($result)){
					$my_num_days = $row['leave_days'];
					echo $my_num_days;

				}
					mysql_free_result($result);

			}

			else{

	        	echo "0";

	    	}


    	}
	}

	//Command: 7
	function update_leave_request($id) {
		//Update
		$id = $_REQUEST["id"];
		if(isset($_POST['submit'])){
			
			
			$leave_type_ref = $_REQUEST["leave_type_ref"];
			$num_days_left = $_REQUEST["num_days_left"];
			$job_title  = filter_input(INPUT_POST, "job_title", FILTER_SANITIZE_STRING);
			$num_days_requested  = filter_input(INPUT_POST, "num_days_requested", FILTER_SANITIZE_STRING);
			$commencement_date = $_REQUEST["commencement_date"];
			$end_date = $_REQUEST["end_date"];
			$resumption_date = $_REQUEST["resumption_date"];
			$officer_taking_over  = filter_input(INPUT_POST, "officer_taking_over", FILTER_SANITIZE_STRING);
			$leave_address  = filter_input(INPUT_POST, "leave_address", FILTER_SANITIZE_SPECIAL_CHARS);
			$contact  = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_STRING);
			$email  = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

			$db = new adb();
			$db -> connect();
		
			if ($leave_type_ref == 1) {

				if ($num_days_requested > $num_days_left) {
					?>
						<script>
							alert("Sorry, The Number Of Leave Days Requested Is More Than Your Leave Days Left!");
							window.history.back();
						</script>
					<?php
				}

				else {

					if ($job_title == "" || $num_days_requested == "" || $officer_taking_over == "") {
						?>
							<script>
								alert("ERROR: Make sure all fields are filled!");
								window.history.back();
							</script>
							<?php
					}

					else {
						$query1 = "SET FOREIGN_KEY_CHECKS=0";
					mysql_query($query1);

					$query = "UPDATE lms_requests SET leave_type_ref='$leave_type_ref', job_title='$job_title', num_days_requested='$num_days_requested',
								leave_address='$leave_address', num_days_left='$num_days_left', commencement_date='$commencement_date', 
								end_date='$end_date', resumption_date='$resumption_date', contact='$contact', email='$email', officer_taking_over='$officer_taking_over'
								WHERE r_id='$id'";
					$result = mysql_query($query) or die(mysql_error());
					$query2 = "SET FOREIGN_KEY_CHECKS=1";
					mysql_query($query2);
					
					
					if($result == 1){
						?>
							<script>
								alert("Leave Request Updated!");
								window.location.href="display_leave_requests.php";
							</script>
							<?php
					} else {
								?>
								<script>
									alert("ERROR: Make sure all fields are filled!");
									window.history.back();
								</script>
								<?php
							}
						}
				}
			}

			else {

				if ($job_title == "" || $num_days_requested == "" || $officer_taking_over == "") {
					?>
						<script>
							alert("ERROR: Make sure all fields are filled!");
							window.history.back();
						</script>
						<?php
				}

				else {
					$query1 = "SET FOREIGN_KEY_CHECKS=0";
				mysql_query($query1);

				$query = "UPDATE lms_requests SET leave_type_ref='$leave_type_ref', job_title='$job_title', num_days_requested='$num_days_requested',
								leave_address='$leave_address', num_days_left='$num_days_left', commencement_date='$commencement_date', 
								end_date='$end_date', resumption_date='$resumption_date', contact='$contact', email='$email', officer_taking_over='$officer_taking_over'
							WHERE r_id='$id'";
				$result = mysql_query($query) or die(mysql_error());
				$query2 = "SET FOREIGN_KEY_CHECKS=1";
				mysql_query($query2);
				
				
				if($result == 1){
					?>
						<script>
							alert("Leave Request Updated!");
							window.location.href="display_leave_requests.php";
						</script>
						<?php
				} else {
							?>
							<script>
								alert("ERROR: Make sure all fields are filled!");
								window.history.back();
							</script>
							<?php
						}
					}
			}
		}

		//Cancel
		if(isset($_POST['cancel'])){
			// $id = $_REQUEST["id"];

			$db = new adb();
			$db -> connect();

			$query1 = "SET FOREIGN_KEY_CHECKS=0";
			mysql_query($query1);

			$query = "SELECT * FROM lms_requests
						WHERE r_id='$id' AND request_status_ref=1";
			$result = mysql_query($query) or die(mysql_error());
			$query2 = "SET FOREIGN_KEY_CHECKS=1";
			mysql_query($query2);
			
			
			if($result == 1){
				$query1 = "SET FOREIGN_KEY_CHECKS=0";
				mysql_query($query1);

				$query = "UPDATE lms_requests SET request_status_ref=6
							WHERE r_id='$id'";
				$result = mysql_query($query) or die(mysql_error());
				$query2 = "SET FOREIGN_KEY_CHECKS=1";
				mysql_query($query2);
				
				
				if($result == 1){
					?>
						<script>
							alert("Your Leave Request Has Been Cancelled!");
							window.location.href="display_leave_requests.php";
						</script>
						<?php
				} 

				else {
						?>
						<script>
							alert("ERROR: Unable to Cancel Leave Request!");
							window.history.back();
						</script>
						<?php
					}
			} 

			else {
					?>
					<script>
						alert("ERROR: This Request Is Either Cancelled Or Endorsed By Your H.O.D!");
						window.history.back();
					</script>
					<?php
				}
		}
	}

	function see_all_holidays(){

		$db = new adb();
		$db -> connect();

        $sql = "SELECT h_id, h_name, DATE_FORMAT(h_date, '%d %b %Y') as h_dates
        		FROM lms_holidays
        		WHERE h_date >= CURDATE()
        		ORDER BY h_date"; 
                $result = mysql_query ($sql); //run the query
		if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}

		if(mysql_num_rows($result) > 0){
        echo "<table class='table table-striped'>";
            echo "<thead><tr>";
                echo "<th>HOLIDAY</th>";
                echo "<th>DATE</th>";
            echo "</tr></thead>";
		    echo "<tbody>";
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['h_name'] . "</td>";
			echo "<td>" . $row['h_dates'] . "</td>";
			echo "</tr>";
		}
		echo "</tbody>
			</table>";
			mysql_free_result($result);

		}

		else{
        	echo "<center><div align='center' class='alert alert-danger' role='alert'>
        	<i class='glyphicon glyphicon-alert'></i><b>No Holidays Recorded In The System</b></div></center>";
    	}
	}

?>