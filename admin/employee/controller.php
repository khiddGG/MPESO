<?php
require_once ("../../include/initialize.php");

// Enable error reporting and logging
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/laragon/logs/php.log');
error_reporting(E_ALL);

// Custom error logging function
function writeToLog($message) {
    $logFile = __DIR__ . '/employee_errors.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

if(!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break; 
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;
   
   
    case 'addfiles' :
	doAddFiles();
	break;

	case 'checkid' :
	Check_StudentID();
	break;
	

	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){
			writeToLog("Starting employee creation process");
			
			// Get autonumber for employee ID
			$autonum = New Autonumber();
			$res = $autonum->set_autonumber('employeeid');
			
			// Map form fields to database columns
			$form_data = array(
				'FNAME' => $_POST['FNAME'] ?? '', // First Name
				'MNAME' => $_POST['MNAME'] ?? '', // Middle Name
				'LNAME' => $_POST['LNAME'] ?? '', // Last Name
				'ADDRESS' => $_POST['ADDRESS'] ?? '', // Address
				'SEX' => $_POST['SEX'] ?? '', // Sex
				'BIRTHDATE' => date('Y-m-d', strtotime($_POST['BIRTHDATE'] ?? '')), // Date of Birth
				'BIRTHPLACE' => $_POST['BIRTHPLACE'] ?? '', // Place of Birth
				'TELNO' => $_POST['TELNO'] ?? '', // Contact No.
				'CIVILSTATUS' => $_POST['CIVILSTATUS'] ?? '', // Civil Status
				'POSITION' => $_POST['POSITION'] ?? '', // Position
				'DATEHIRED' => date('Y-m-d', strtotime($_POST['DATEHIRED'] ?? date('Y-m-d'))), // Hired Date
				'EMP_EMAILADDRESS' => $_POST['EMP_EMAILADDRESS'] ?? '', // Email Address
				'COMPANYID' => $_POST['COMPANYID'] ?? '' // Company Name
			);

			// Validate required fields
			$required_fields = array('FNAME', 'LNAME', 'MNAME', 'ADDRESS', 'TELNO', 'BIRTHDATE', 
								   'BIRTHPLACE', 'CIVILSTATUS', 'POSITION', 'EMP_EMAILADDRESS', 'COMPANYID');
			
			$missing_fields = array();
			foreach($required_fields as $field) {
				if(empty($form_data[$field])) {
					$missing_fields[] = $field;
				}
			}

			if(!empty($missing_fields)) {
				writeToLog("Missing required fields: " . implode(", ", $missing_fields));
				echo "<script>alert('The following fields are required: " . implode(", ", $missing_fields) . "');</script>";
				echo "<script>window.location='index.php?view=add';</script>";
				return;
			}

			// Validate company exists
			$sql = "SELECT * FROM tblcompany WHERE COMPANYID = '{$form_data['COMPANYID']}'";
			$mydb->setQuery($sql);
			$company = $mydb->loadSingleResult();
			
			if (!$company) {
				writeToLog("Invalid company selected: " . $form_data['COMPANYID']);
				echo "<script>alert('Invalid company selected!');</script>";
				echo "<script>window.location='index.php?view=add';</script>";
				return;
			}

			// Validate email format
			if(!filter_var($form_data['EMP_EMAILADDRESS'], FILTER_VALIDATE_EMAIL)) {
				writeToLog("Invalid email format: " . $form_data['EMP_EMAILADDRESS']);
				echo "<script>alert('Invalid email format!');</script>";
				echo "<script>window.location='index.php?view=add';</script>";
				return;
			}

			// Calculate age
			$birthdate = new DateTime($form_data['BIRTHDATE']);
			$today = new DateTime();
			$age = $birthdate->diff($today)->y;
			
			if($age < 20) {
				writeToLog("Invalid age: $age (must be 20 or older)");
				echo "<script>alert('Age must be 20 years or older!');</script>";
				echo "<script>window.location='index.php?view=add';</script>";
				return;
			}

			try {
				// Create employee record
				$emp = new Employee();
				$emp->EMPLOYEEID = $res->AUTO; // Use autonumber for employee ID
				writeToLog("Generated EMPLOYEEID: " . $emp->EMPLOYEEID);
				
				// Map form data to employee object
				$emp->FNAME = trim($form_data['FNAME']);
				$emp->LNAME = trim($form_data['LNAME']);
				$emp->MNAME = trim($form_data['MNAME']);
				$emp->ADDRESS = trim($form_data['ADDRESS']);
				$emp->BIRTHDATE = trim($form_data['BIRTHDATE']);
				$emp->BIRTHPLACE = trim($form_data['BIRTHPLACE']);
				$emp->AGE = $age;
				$emp->SEX = trim($form_data['SEX']);
				$emp->CIVILSTATUS = trim($form_data['CIVILSTATUS']);
				$emp->TELNO = trim($form_data['TELNO']);
				$emp->EMP_EMAILADDRESS = trim($form_data['EMP_EMAILADDRESS']);
				$emp->CELLNO = trim($form_data['TELNO']); // Using TELNO for CELLNO if not provided
				$emp->POSITION = trim($form_data['POSITION']);
				$emp->WORKSTATS = 'Regular'; // Default value
				$emp->EMPPHOTO = 'default.jpg'; // Default value
				$emp->EMPUSERNAME = $emp->EMPLOYEEID; // Use EMPLOYEEID as username
				$emp->EMPPASSWORD = sha1($emp->EMPLOYEEID); // Use EMPLOYEEID as initial password
				$emp->DATEHIRED = trim($form_data['DATEHIRED']);
				$emp->COMPANYID = trim($form_data['COMPANYID']);

				writeToLog("Attempting to create employee with data: " . print_r($emp, true));

				if($emp->create()) {
					// Update autonumber
					$autonum->auto_update('employeeid');
					
					writeToLog("Employee created successfully with ID: " . $emp->EMPLOYEEID);
					echo "<script>alert('New Employee [" . $emp->EMPLOYEEID . "] created successfully!');</script>";
					echo "<script>window.location='index.php';</script>";
				} else {
					writeToLog("Failed to create employee. Database error: " . $mydb->getError());
					echo "<script>alert('Error creating employee! Please check the logs for details.');</script>";
					echo "<script>window.location='index.php?view=add';</script>";
				}
			} catch(Exception $e) {
				writeToLog("Exception in doInsert: " . $e->getMessage());
				echo "<script>alert('Error creating employee: " . addslashes($e->getMessage()) . "');</script>";
				echo "<script>window.location='index.php?view=add';</script>";
			}
		}
	}

	function doEdit(){
	if(isset($_POST['save'])){
		// Validate required fields
		$required_fields = array('FNAME', 'LNAME', 'MNAME', 'ADDRESS', 'TELNO', 'BIRTHDATE', 
							   'BIRTHPLACE', 'CIVILSTATUS', 'POSITION', 'EMP_EMAILADDRESS', 'COMPANYID');
		
		$missing_fields = array();
		foreach($required_fields as $field) {
			if(empty($_POST[$field])) {
				$missing_fields[] = $field;
			}
		}

		if(!empty($missing_fields)) {
			message("The following fields are required: " . implode(", ", $missing_fields), "error");
			redirect('index.php?view=edit&id='.$_POST['EMPLOYEEID']);
			return;
		}

		// Validate email format
		if(!filter_var($_POST['EMP_EMAILADDRESS'], FILTER_VALIDATE_EMAIL)) {
			message("Invalid email format!", "error");
			redirect('index.php?view=edit&id='.$_POST['EMPLOYEEID']);
			return;
		}

		// Validate birthdate and age
		$birthdate = date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');
		$age = date_diff(date_create($birthdate), date_create('today'))->y;

		if($age < 20) {
			message("Invalid age. 20 years old and above is allowed.", "error");
			redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);
			return;
		}

		try {
			$datehired = !empty($_POST['EMP_HIREDDATE']) ? 
						date_format(date_create($_POST['EMP_HIREDDATE']), 'Y-m-d') : 
						date('Y-m-d');

			$emp = New Employee(); 
			$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
			$emp->FNAME				= $_POST['FNAME']; 
			$emp->LNAME				= $_POST['LNAME'];
			$emp->MNAME 	   		= $_POST['MNAME'];
			$emp->ADDRESS			= $_POST['ADDRESS'];  
			$emp->BIRTHDATE	 		= $birthdate;
			$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];  
			$emp->AGE			    = $age;
			$emp->SEX 				= $_POST['optionsRadios']; 
			$emp->TELNO				= $_POST['TELNO'];
			$emp->CIVILSTATUS		= $_POST['CIVILSTATUS']; 
			$emp->POSITION			= trim($_POST['POSITION']);
			// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
			// $emp->DIVISIONID		= $_POST['DIVISIONID'];
			$emp->EMP_EMAILADDRESS		= $_POST['EMP_EMAILADDRESS'];
			$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
			$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
			$emp->DATEHIRED			=  @$datehired;
			$emp->COMPANYID			= $_POST['COMPANYID']; 
			$emp->update($_POST['EMPLOYEEID']);


			$user = New User(); 
			$u_res = $user->single_user($_POST['EMPLOYEEID']);

			if (isset($u_res)) {
				# code...
				$user->FULLNAME 		= $_POST['FNAME'] . ' ' .$_POST['LNAME'];
				$user->USERNAME			= $_POST['LNAME'];
				$user->PASS				= sha1($_POST['EMPLOYEEID']); 
				$user->update($_POST['EMPLOYEEID']);
			}else{
				$user = New User();
				$user->USERID 			= $_POST['EMPLOYEEID'];
				$user->FULLNAME 		= $_POST['FNAME'] . ' ' .$_POST['LNAME'];
				$user->USERNAME			= $_POST['LNAME'];
				$user->PASS				= sha1($_POST['EMPLOYEEID']);
				$user->ROLE				= 'Employee';
				$user->create();
			}
 

		message("Employee has been updated!", "success");
		// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
       redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);
    	} catch(Exception $e) {
    		message("An error occurred: " . $e->getMessage(), "error");
    		redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);
    	}


	}

} 
	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","error");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$subj = New Student();
		// 	$subj->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$emp = New Employee();
	 		 	$emp->delete($id);
			 
		
		// }
			message("Employee(s) already Deleted!","success");
			redirect('index.php');
		// }

		
	}

 
 
  function UploadImage(){
			$target_dir = "../../employee/photos/";
			$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
			if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $imageFileType != "gif" ) {
				 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
					return  date("dmYhis") . basename($_FILES["picture"]["name"]);
				}else{
					echo "Error Uploading File";
					exit;
				}
			}else{
					echo "File Not Supported";
					exit;
				}
} 

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photo/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photo/" . $myfile);
		 	
					 

						$stud = New Student();
						$stud->StudPhoto	= $location;
						$stud->studupdate($_POST['StudentID']);
						redirect("index.php?view=view&id=". $_POST['StudentID']);
						 
							
					}
			}
			 
		}

 
?>