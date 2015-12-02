<?php

	include_once("gen.php");
	include_once 'adb.php';
	$cmd=get_datan("cmd");
	
	switch($cmd){
		case 1:
			login();
		break;

		// default:
		// 	echo "{";
		// 	echo jsonn("result", 0). ",";
		// 	echo jsons("message","unknown command");
		// 	echo "}";
	}

	function login(){
		$username = trim(htmlentities($_REQUEST["username"]));
		$password = trim(htmlentities($_REQUEST["password"]));

		$pass = md5($password);
		$salt = md5("datamanagement");
		$pepper = "ikyhtgtbhfdsfsqwnk";

		$thePass = $salt . $pass . $pepper;

		$db = new adb();
		$db -> connect();


		$query = "SELECT * FROM ge_users 
					INNER JOIN ge_departments ON (ge_users.u_department = ge_departments.d_id)
					INNER JOIN ge_groups ON (ge_users.u_group = ge_groups.g_id)
					WHERE username='$username' AND password=MD5('$password')";

		$result = mysql_query($query) or die(mysql_error());
		$num_rows = mysql_num_rows($result);
		$info = mysql_fetch_assoc($result);

		//echo "Got result";
		if($result){
			if($num_rows > 0){
					if ($info['u_group'] == 1) {
						$dep = $info['d_name'];
						$r_dep = str_replace(' ','_',$dep);
						session_start();
						$_SESSION['login'] = "1";
						$_SESSION['u_id'] = $info["u_id"];
						$_SESSION['firstname'] = $info["firstname"];
						$_SESSION['lastname'] = $info["lastname"];
						$_SESSION['username'] = $info["username"];
						$_SESSION['u_group'] = $info["u_group"];
						$_SESSION['u_department'] = $info["u_department"];
						
						header("Location: 1_ce/");
					}

					else if ($info['u_group'] == 2) {
						$dep = $info['d_name'];
						$r_dep = str_replace(' ','_',$dep);
						session_start();
						$_SESSION['login'] = "1";
						$_SESSION['u_id'] = $info["u_id"];
						$_SESSION['firstname'] = $info["firstname"];
						$_SESSION['lastname'] = $info["lastname"];
						$_SESSION['username'] = $info["username"];
						$_SESSION['u_group'] = $info["u_group"];
						$_SESSION['u_department'] = $info["u_department"];

						header("Location: 2_director/dep_".$r_dep."/");
					}

					else if ($info['u_group'] == 3) {
						$dep = $info['d_name'];
						$r_dep = str_replace(' ','_',$dep);
						session_start();
						$_SESSION['login'] = "1";
						$_SESSION['u_id'] = $info["u_id"];
						$_SESSION['firstname'] = $info["firstname"];
						$_SESSION['lastname'] = $info["lastname"];
						$_SESSION['username'] = $info["username"];
						$_SESSION['u_group'] = $info["u_group"];
						$_SESSION['u_department'] = $info["u_department"];
						
						header("Location: 3_manager/dep_".$dep."/");
					}

					else if ($info['u_group'] == 4) {
						$dep = $info['d_name'];
						$r_dep = str_replace(' ','_',$dep);
						session_start();
						$_SESSION['login'] = "1";
						$_SESSION['u_id'] = $info["u_id"];
						$_SESSION['firstname'] = $info["firstname"];
						$_SESSION['lastname'] = $info["lastname"];
						$_SESSION['username'] = $info["username"];
						$_SESSION['u_group'] = $info["u_group"];
						$_SESSION['u_department'] = $info["u_department"];
						
						header("Location: 4_regular/dep_".$r_dep."/");
					}
				
			}
			else{
				?>
				<script>
					alert("Invalid Username or Password!");
			      	window.history.back();
				</script>
				<?php
				// $msg="username or password is incorrect";

			}
		}

		else{
				?>
				<script>
					alert("Invalid Username or Password");
			      window.history.back();
				</script>
				<?php

			}

	}

?>