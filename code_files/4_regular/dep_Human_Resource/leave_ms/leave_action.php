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
			requestLeave();
			break;
		case 4:
			see_all_my_requests();
			break;
		case 5:
			getDepartment();
			break;
		case 6:
			dispatchHardware();
			break;
		case 8:
			get_it_admin_by_id();
			break;

		// default:
		// 	echo "{";
		// 	echo jsonn("result", 0). ",";
		// 	echo jsons("message","unknown command");
		// 	echo "}";
	}

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

	function get_request_by_id($id){

		$db = new adb();
		$db -> connect();

		$result = "SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, DATE_FORMAT(start_repair_date, '%d %b %Y') as start_repair_date, DATE_FORMAT(end_repair_date, '%d %b %Y') as end_repair_date, 
                		DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, DATE_FORMAT(start_dispatch_date, '%d %b %Y') as start_dispatch_date, DATE_FORMAT(end_dispatch_date, '%d %b %Y') as end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_id='$id'";

		if(!$db->query($result)){
				return false;
			}

		return $db -> fetch();
	}

	function requestLeave() {
		if(isset($_POST['submit'])){
		
		$he_device_model  = filter_input(INPUT_POST, "he_device_model", FILTER_SANITIZE_STRING);
		$he_serial_no  = filter_input(INPUT_POST, "he_serial_no", FILTER_SANITIZE_STRING);
		$he_type = $_REQUEST["he_type"];
		$supplier_name  = filter_input(INPUT_POST, "supplier_name", FILTER_SANITIZE_STRING);
		$date_of_manufacture = $_REQUEST["date_of_manufacture"];
		$he_warranty_exdate = $_REQUEST["he_warranty_exdate"];

		$db = new adb();
		$db -> connect();

		if ($he_device_model == "" || $he_serial_no == "" || $he_warranty_exdate == "") {
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

		$query = "INSERT INTO ghi_hardware_entry SET he_device_model='$he_device_model', he_serial_no='$he_serial_no', he_type='$he_type', 
					he_repair_status='3', he_status='2', supplier_name='$supplier_name', date_of_manufacture='$date_of_manufacture', he_dep_ref='17', 
					he_warranty_exdate='$he_warranty_exdate', date_registered=CURDATE()";
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

	function see_all_my_requests($id){
		$id = $_REQUEST['id'];
		$db = new adb();
		$db -> connect();

                $sql = "SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, start_repair_date, end_repair_date, DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, DATE_FORMAT(start_dispatch_date, '%d %b %Y') as start_dispatch_date, end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_serial_no='$id'
                		ORDER BY status"; 
                $result = mysql_query ($sql); //run the query
		if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}

		if(mysql_num_rows($result) > 0){
			echo "<center><div align='center' class='alert alert-info' role='alert'><i class='glyphicon glyphicon-alert'></i>
        	<b>Device History</b></div></center>";
        echo "<table class='table table-striped'>";
            echo "<thead><tr>";
                echo "<th>USER</th>";
                echo "<th>DEPARTMENT</th>";
                echo "<th>STATUS</th>";
                echo "<th>DATE OF DISPATCH</th>";
                echo "<th>DEVICE INFO</th>";
            echo "</tr></thead>";
		    echo "<tbody>";
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['he_user_name'] . "</td>";
			echo "<td>" . $row['dep_name'] . "</td>";
			echo "<td>" . $row['status'] . "</td>";
			echo "<td>" . $row['start_dispatch_date'] . "</td>";
			echo "<td><a href='device_unit_details.php?id=$row[he_id]'>Device_Info</a></td>";
			echo "</tr>";
		}
		echo "</tbody>
			</table>";
			mysql_free_result($result);

		}

		else{
        	echo "<center><div align='center' class='alert alert-danger' role='alert'>
        	<i class='glyphicon glyphicon-alert'></i><b>This Device Has No History</b></div></center>";
    	}
	}

	function see_all_repairs(){

		$db = new adb();
		$db -> connect();

		$num_rec_per_page=50;
                
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $num_rec_per_page;

                $sql = "SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, start_repair_date, end_repair_date, DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, start_dispatch_date, end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_repair_status !=3
                		ORDER BY repair_status LIMIT $start_from, $num_rec_per_page"; 
                $result = mysql_query ($sql); //run the query
		if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}

		if(mysql_num_rows($result) > 0){
			echo "<center><div align='center' class='alert alert-warning' role='alert'><i class='glyphicon glyphicon-alert'></i>
        	<b>All Devices With Repair History</b></div></center>";
        echo "<table class='table table-striped'>";
            echo "<thead><tr>";
                echo "<th>TYPE</th>";
                echo "<th>MODEL</th>";
                echo "<th>SERIAL NUMBER</th>";
                echo "<th>STATUS</th>";
                echo "<th>REPAIR DETAILS</th>";
            echo "</tr></thead>";
		    echo "<tbody>";
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['hardware_name'] . "</td>";
			echo "<td>" . $row['he_device_model'] . "</td>";
			echo "<td>" . $row['he_serial_no'] . "</td>";
			echo "<td>" . $row['repair_status'] . "</td>";
			echo "<td><a href='repair_update.php?id=$row[he_id]'>Repairs</a></td>";
			echo "</tr>";
		}
		echo "</tbody>
			</table>";
			mysql_free_result($result);

			$sql = "SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, start_repair_date, end_repair_date, DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, start_dispatch_date, end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_repair_status !=3
                		ORDER BY repair_status"; 
                    $rs_result = mysql_query($sql); //run the query
                    $total_records = mysql_num_rows($rs_result);  //count number of records
                    $total_pages = ceil($total_records / $num_rec_per_page); 

                    echo "<center><nav><ul class='pagination pagination'>";
                    echo "<li><a href='hardware_history.php?page=1' aria-label='Previous'>
                    <span aria-hidden='true'>&laquo; First</span></a></li>"; // Goto 1st page  

                    for ($i=1; $i<=$total_pages; $i++) { 
                                echo "<li><a href='hardware_history.php?page=".$i."'>".$i."</a></li>"; 
                    }
                    echo "<li><a href='hardware_history.php?page=$total_pages' aria-label='Next'>
                    <span aria-hidden='true'>Last &raquo;</span></a></li>   "; // Goto last page
                    echo "</ul></nav></center>";

		}

		else{
        	echo "<center><div align='center' class='alert alert-success' role='alert'>
        	<i class='glyphicon glyphicon-alert'></i><b>No Device Has Undergone Repairs</b></div></center>";
    	}
	}

	function see_all_expired_devices(){

		$db = new adb();
		$db -> connect();

		$num_rec_per_page=50;
                
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $num_rec_per_page;

                $sql = "SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, DATE_FORMAT(he_warranty_exdate, '%d %b %Y') as he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, start_repair_date, end_repair_date, DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, start_dispatch_date, end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_warranty_exdate <= CURDATE()
                		ORDER BY he_warranty_exdate ASC LIMIT $start_from, $num_rec_per_page"; 
                $result = mysql_query ($sql); //run the query
		if($result === FALSE) { 
		    die(mysql_error()); // TODO: better error handling
		}

		if(mysql_num_rows($result) > 0){
			echo "<center><div align='center' class='alert alert-warning' role='alert'><i class='glyphicon glyphicon-alert'></i>
        	<b>All Devices With Expired Warranty</b></div></center>";
        echo "<table class='table table-striped'>";
            echo "<thead><tr>";
                echo "<th>TYPE</th>";
                echo "<th>MODEL</th>";
                echo "<th>SERIAL NUMBER</th>";
                echo "<th>WARRANTY EX-DATE</th>";
                echo "<th>DETAILS</th>";
            echo "</tr></thead>";
		    echo "<tbody>";
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['hardware_name'] . "</td>";
			echo "<td>" . $row['he_device_model'] . "</td>";
			echo "<td>" . $row['he_serial_no'] . "</td>";
			echo "<td>" . $row['he_warranty_exdate'] . "</td>";
			echo "<td><a href='hardware_details.php?id=$row[he_id]'>View_Details</a></td>";
			echo "</tr>";
		}
		echo "</tbody>
			</table>";
			mysql_free_result($result);

			$sql = "SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, start_repair_date, end_repair_date, DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, start_dispatch_date, end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_warranty_exdate <= CURDATE()
                		ORDER BY he_warranty_exdate ASC"; 
                    $rs_result = mysql_query($sql); //run the query
                    $total_records = mysql_num_rows($rs_result);  //count number of records
                    $total_pages = ceil($total_records / $num_rec_per_page); 

                    echo "<center><nav><ul class='pagination pagination'>";
                    echo "<li><a href='hardware_history.php?page=1' aria-label='Previous'>
                    <span aria-hidden='true'>&laquo; First</span></a></li>"; // Goto 1st page  

                    for ($i=1; $i<=$total_pages; $i++) { 
                                echo "<li><a href='hardware_history.php?page=".$i."'>".$i."</a></li>"; 
                    }
                    echo "<li><a href='hardware_history.php?page=$total_pages' aria-label='Next'>
                    <span aria-hidden='true'>Last &raquo;</span></a></li>   "; // Goto last page
                    echo "</ul></nav></center>";

		}

		else{
        	echo "<center><div align='center' class='alert alert-success' role='alert'>
        	<i class='glyphicon glyphicon-alert'></i><b>No Device Has An Expired Warranty</b></div></center>";
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