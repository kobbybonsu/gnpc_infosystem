<?php

// @author: Kwabena Gyekye Ohene-Bonsu

	include_once("adb.php");
	
	class query_functions extends adb{
		function query_functions(){
			adb::adb();
		}
		/**
		*@return if successful true else false
		*/

		function search_device($name){
			$query="SELECT he_id, he_device_model, he_serial_no, ghi_hardware_type.ht_id, ghi_hardware_type.hardware_name,
                		device_name, supplier_name, repairer_name, he_warranty_exdate, ghi_status.s_id, ghi_status.status, ghi_repairs.r_id, ghi_repairs.repair_status,
                		repair_comments, start_repair_date, end_repair_date, DATE_FORMAT(date_registered, '%d %b %Y') as date_registered, date_of_manufacture, he_user_name,
                		ghi_departments.d_id, ghi_departments.dep_name, start_dispatch_date, end_dispatch_date
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                WHERE device_name LIKE '%$name%'
                OR he_device_model LIKE '%$name%'
				OR he_serial_no LIKE '%$name%'
				ORDER BY hardware_name";
					
			if(!$this->query($query)){
				echo "not working";
				return false;
			}
			return $this->fetch();
		}

		function getNumDesktops(){
			$query="SELECT count(*) as 'numDesktops' FROM ghi_hardware_entry WHERE he_type=1 AND he_status=1";
			return $this->query($query);
		}

		function getLeaveType(){
			$query="SELECT * FROM lms_leave_type ORDER BY t_id";
			return $this->query($query);
		}

		function see_device_in_status($he_types,$he_status){
			$query="SELECT ghi_hardware_type.hardware_name, he_device_model, he_serial_no, ghi_status.status,
                		device_name, supplier_name, repairer_name, DATE_FORMAT(date_of_manufacture, '%d %b %Y') as date_of_manufacture, 
                		DATE_FORMAT(he_warranty_exdate, '%d %b %Y') as he_warranty_exdate
                		FROM ghi_hardware_entry
                		INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                		INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                		INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                		INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                		WHERE he_status='$he_status' AND he_type='$he_types'
                		ORDER BY status";
						
				if(!$this->query($query)){
					echo "not working";
					return false;
				}
				return $this->fetch();
		}

		function see_device_in_department($he_dep_ref,$he_type){
			$query="SELECT  ghi_departments.dep_name, supplier_name, repairer_name, he_user_name, device_name, ghi_hardware_type.hardware_name,
                                he_device_model, he_serial_no
                        FROM ghi_hardware_entry
                        INNER JOIN ghi_hardware_type ON (ghi_hardware_type.ht_id=ghi_hardware_entry.he_type)
                        INNER JOIN ghi_status ON (ghi_status.s_id=ghi_hardware_entry.he_status)
                        INNER JOIN ghi_repairs ON (ghi_repairs.r_id=ghi_hardware_entry.he_repair_status)
                        INNER JOIN ghi_departments ON (ghi_departments.d_id=ghi_hardware_entry.he_dep_ref)
                        WHERE he_dep_ref='$he_dep_ref' AND he_type='$he_type'
                        ORDER BY dep_name";
						
				if(!$this->query($query)){
					echo "not working";
					return false;
				}
				return $this->fetch();
		}
		
	}
?>