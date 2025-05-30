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

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){

		if ($_POST['U_NAME'] == "" OR $_POST['U_USERNAME'] == "" OR $_POST['U_PASS'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$user = New User();
			// Validate USERID format
			if (!preg_match('/^[A-Za-z0-9]+$/', $_POST['user_id'])) {
				message("Invalid User ID format. Only letters and numbers are allowed.", "error");
				redirect('index.php?view=add');
			}
			
			// Check if username already exists
			if ($user->find_user("", $_POST['U_USERNAME']) > 0) {
				message("Username already exists!", "error");
				redirect('index.php?view=add');
			}

			// Handle profile picture upload
			$piclocation = '';
			if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
				$errofile = $_FILES['photo']['error'];
				$type = $_FILES['photo']['type'];
				$temp = $_FILES['photo']['tmp_name'];
				$myfile = $_FILES['photo']['name'];
				$location = "photos/".$myfile;

				// Validate file type
				$allowed = array('image/jpeg', 'image/png', 'image/gif');
				if(!in_array($type, $allowed)) {
					message("Invalid file type. Only JPG, PNG and GIF are allowed.", "error");
					redirect('index.php?view=add');
				}

				// Validate file size (2MB max)
				if($_FILES['photo']['size'] > 2097152) {
					message("File size too large. Maximum size is 2MB.", "error");
					redirect('index.php?view=add');
				}

				// Move uploaded file
				if(move_uploaded_file($temp, $location)) {
					$piclocation = $location;
				} else {
					message("Error uploading file.", "error");
					redirect('index.php?view=add');
				}
			}
			
			$user->USERID 			= $_POST['user_id'];
			$user->FULLNAME 		= $_POST['U_NAME'];
			$user->USERNAME			= $_POST['U_USERNAME'];
			$user->PASS				= sha1($_POST['U_PASS']);
			$user->ROLE				= $_POST['U_ROLE'];
			$user->PICLOCATION		= $piclocation;
			
			if ($user->create()) {
				$autonum = New Autonumber(); 
				$autonum->auto_update('userid');
				message("The account [". $_POST['U_NAME'] ."] created successfully!", "success");
				redirect("index.php");
			} else {
				message("Error creating user account!", "error");
				redirect('index.php?view=add');
			}
		}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){


			$user = New User(); 
			$user->FULLNAME 		= $_POST['U_NAME'];
			$user->USERNAME			= $_POST['U_USERNAME'];
			$user->PASS				=sha1($_POST['U_PASS']);
			$user->ROLE				= $_POST['U_ROLE'];
			$user->update($_POST['USERID']);

			


			if (isset($_GET['view'])) {
				# code...
				  message("Profile has been updated!", "success");
				redirect("index.php?view=view");
			}else{ 
				message("[". $_POST['U_NAME'] ."] has been updated!", "success");
				redirect("index.php");
			}
		}
	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User has been deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


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
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->PICLOCATION 			= $location;
						$user->update($_SESSION['ADMIN_USERID']);
						redirect("index.php?view=view");
						 
							
					}
			}
			 
		}
 
?>