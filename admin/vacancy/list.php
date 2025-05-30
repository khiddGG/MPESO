<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>
	<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Vacancies  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> Add Job Vacancy</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>

   		 <div class="row">
   		 	<div class="col-lg-12">
   		 		<div class="btn-group">
   		 			<a href="index.php" class="btn btn-default">All</a>
   		 			<a href="index.php?status=Active" class="btn btn-success">Active</a>
   		 			<a href="index.php?status=Inactive" class="btn btn-warning">Inactive</a>
   		 		</div>
   		 	</div>
   		 </div>
   		 <br>
	 		    <form action="controller.php?action=delete" Method="POST">  	
			     <div class="table-responsive">					
				<table id="dash-table" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>Company Name</th> 
				  		<th>Occupation Title</th> 
				  		<th>Required Employees</th> 
				  		<th>Salary</th> 
				  		<th>Duration</th> 
				  		<th>Qualification</th> 
				  		<th>Job Description</th> 
				  		<th>Preferred Sex</th> 
				  		<th>Sector</th> 
				  		<th>Status</th> 
				  		<th width="10%" align="center">Action</th>
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		$status = isset($_GET['status']) ? $_GET['status'] : '';
				  		$sql = "SELECT * FROM `tbljob` j, `tblcompany` c WHERE j.COMPANYID=c.COMPANYID";
				  		if($status) {
				  			$sql .= " AND j.JOBSTATUS='$status'";
				  		}
				  		$sql .= " ORDER BY j.DATEPOSTED DESC";
				  		$mydb->setQuery($sql);
				  		$cur = $mydb->loadResultList(); 
						foreach ($cur as $result) {
				  		echo '<tr>';
				  			echo '<td>' . $result->COMPANYNAME.'</td>';
				  			echo '<td>' . $result->OCCUPATIONTITLE.'</td>';
				  			echo '<td>' . $result->REQ_NO_EMPLOYEES.'</td>';
				  			echo '<td>' . $result->SALARIES.'</td>';
				  			echo '<td>' . $result->DURATION_EMPLOYEMENT.'</td>';
				  			echo '<td>' . substr($result->QUALIFICATION_WORKEXPERIENCE, 0, 50) . '...</td>';
				  			echo '<td>' . substr($result->JOBDESCRIPTION, 0, 50) . '...</td>';
				  			echo '<td>' . $result->PREFEREDSEX.'</td>';
				  			echo '<td>' . substr($result->SECTOR_VACANCY, 0, 50) . '...</td>';
				  			echo '<td><span class="label label-'.($result->JOBSTATUS=='Active' ? 'success' : 'warning').'">' . $result->JOBSTATUS.'</span></td>';
				  		echo '<td align="center">
				  			<a title="'.($result->JOBSTATUS=='Active' ? 'Deactivate' : 'Activate').'" href="controller.php?action=toggle&id='.$result->JOBID.'" class="btn btn-'.($result->JOBSTATUS=='Active' ? 'warning' : 'success').' btn-xs"><span class="fa fa-'.($result->JOBSTATUS=='Active' ? 'ban' : 'check').' fw-fa"></span></a>
				  			<a title="Edit" href="index.php?view=edit&id='.$result->JOBID.'" class="btn btn-primary btn-xs"><span class="fa fa-edit fw-fa"></span></a>
				  			<a title="Delete" href="controller.php?action=delete&id='.$result->JOBID.'" class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure you want to delete this job vacancy?\')"><span class="fa fa-trash-o fw-fa"></span></a>
				  		</td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
				</div>
			</form>
	
 <div class="table-responsive">	 