<?php
require_once ("../../include/initialize.php");
 	 if (!isset($_SESSION['ADMIN_USERID'])){
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

	case 'toggle' :
	doToggle();
	break;
 
	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){
			// Validate required fields
			if ($_POST['COMPANYID'] == "None" || 
				$_POST['CATEGORY'] == "None" || 
				empty($_POST['OCCUPATIONTITLE']) || 
				empty($_POST['REQ_NO_EMPLOYEES']) || 
				empty($_POST['SALARIES']) || 
				empty($_POST['DURATION_EMPLOYEMENT']) || 
				empty($_POST['QUALIFICATION_WORKEXPERIENCE']) || 
				empty($_POST['JOBDESCRIPTION']) || 
				$_POST['PREFEREDSEX'] == "None" || 
				empty($_POST['SECTOR_VACANCY'])) {
				
				message("All fields are required!","error");
				redirect('index.php?view=add');
			} else {	
				// Validate company exists
				$sql = "SELECT * FROM tblcompany WHERE COMPANYID = {$_POST['COMPANYID']}";
				$mydb->setQuery($sql);
				$company = $mydb->loadSingleResult();
				
				if (!$company) {
					message("Invalid company selected!","error");
					redirect('index.php?view=add');
				}
				
				// Validate category exists
				$sql = "SELECT * FROM tblcategory WHERE CATEGORYID = {$_POST['CATEGORY']}";
				$mydb->setQuery($sql);
				$cat = $mydb->loadSingleResult();
				
				if (!$cat) {
					message("Invalid category selected!","error");
					redirect('index.php?view=add');
				}
				
				$_POST['CATEGORY'] = $cat->CATEGORY;
				$job = New Jobs();
				$job->COMPANYID							= $_POST['COMPANYID']; 
				$job->CATEGORY							= $_POST['CATEGORY']; 
				$job->OCCUPATIONTITLE					= $_POST['OCCUPATIONTITLE'];
				$job->REQ_NO_EMPLOYEES					= $_POST['REQ_NO_EMPLOYEES'];
				$job->SALARIES							= $_POST['SALARIES'];
				$job->DURATION_EMPLOYEMENT				= $_POST['DURATION_EMPLOYEMENT'];
				$job->QUALIFICATION_WORKEXPERIENCE		= $_POST['QUALIFICATION_WORKEXPERIENCE'];
				$job->JOBDESCRIPTION					= $_POST['JOBDESCRIPTION'];
				$job->PREFEREDSEX						= $_POST['PREFEREDSEX'];
				$job->SECTOR_VACANCY					= $_POST['SECTOR_VACANCY']; 
				$job->DATEPOSTED						= date('Y-m-d H:i');
				$job->JOBSTATUS							= 'Active'; // Set default status
				
				if($job->create()) {
					message("New Job Vacancy created successfully!", "success");
					redirect("index.php");
				} else {
					$error = $mydb->getError();
					message("Error creating job vacancy: " . $error, "error");
					redirect('index.php?view=add');
				}
			}
		}
	}

	function doEdit(){
		global $mydb;
		if(isset($_POST['save'])){
			if ( $_POST['COMPANYID'] == "None") {
				$messageStats = false;
				message("All field is required!","error");
				redirect('index.php?view=add');
			}else{	
				$sql = "SELECT * FROM tblcategory where CATEGORYID = {$_POST['CATEGORY']}";
				$mydb->setQuery($sql);
				$cat = $mydb->loadSingleResult();
				$_POST['CATEGORY']=$cat->CATEGORY;
				$job = New Jobs();
				$job->COMPANYID							= $_POST['COMPANYID']; 
				$job->CATEGORY							= $_POST['CATEGORY']; 
				$job->OCCUPATIONTITLE					= $_POST['OCCUPATIONTITLE'];
				$job->REQ_NO_EMPLOYEES					= $_POST['REQ_NO_EMPLOYEES'];
				$job->SALARIES							= $_POST['SALARIES'];
				$job->DURATION_EMPLOYEMENT				= $_POST['DURATION_EMPLOYEMENT'];
				$job->QUALIFICATION_WORKEXPERIENCE		= $_POST['QUALIFICATION_WORKEXPERIENCE'];
				$job->JOBDESCRIPTION					= $_POST['JOBDESCRIPTION'];
				$job->PREFEREDSEX						= $_POST['PREFEREDSEX'];
				$job->SECTOR_VACANCY					= $_POST['SECTOR_VACANCY']; 
				$job->update($_POST['JOBID']);

				message("Job Vacancy has been updated!", "success");
				redirect("index.php");
			}
		}
	}

	function doDelete(){
		$id = $_GET['id'];
		$job = New Jobs();
		$job->delete($id);
		message("Job Vacancy has been Deleted!","info");
		redirect('index.php');
	}

	function doToggle(){
		global $mydb;
		$id = $_GET['id'];
		
		// Get current status
		$sql = "SELECT JOBSTATUS FROM tbljob WHERE JOBID = $id";
		$mydb->setQuery($sql);
		$result = $mydb->loadSingleResult();
		
		if($result) {
			$new_status = ($result->JOBSTATUS == 'Active') ? 'Inactive' : 'Active';
			
			// Update status
			$sql = "UPDATE tbljob SET JOBSTATUS = '$new_status' WHERE JOBID = $id";
			$mydb->setQuery($sql);
			
			if($mydb->executeQuery()) {
				message("Job status has been updated to " . $new_status, "success");
			} else {
				message("Error updating job status!", "error");
			}
		} else {
			message("Job not found!", "error");
		}
		
		redirect('index.php');
	}
?>