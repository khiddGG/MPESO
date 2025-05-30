<?php
	 if(!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

?> 
	<div class="row">
    <div class="col-lg-12">
            <h1 class="page-header">List of Applicants</h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
                
 
						<form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">   		
							<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

							  <thead>
							  	<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Contact No.</th>
									<th>Address</th>
									<th>Status</th>
									<th width="14%" >Action</th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php   
							  		$mydb->setQuery("SELECT * FROM `tblapplicants` ORDER BY APPLICANTID DESC");
							  		$cur = $mydb->loadResultList();

									foreach ($cur as $result) { 
							  		echo '<tr>';
							  		echo '<td>'. $result->APPLICANTID.'</td>';
							  		echo '<td>'. $result->FNAME . ' ' . $result->LNAME.'</td>';
							  		echo '<td>'. $result->EMAILADDRESS.'</td>';
							  		echo '<td>'. $result->CONTACTNO.'</td>';
							  		echo '<td>'. $result->ADDRESS.'</td>';
							  		
							  		// Get application status
							  		$sql = "SELECT COUNT(*) as total FROM `tbljobregistration` WHERE APPLICANTID = '{$result->APPLICANTID}'";
							  		$mydb->setQuery($sql);
							  		$applied = $mydb->loadSingleResult();
							  		$status = $applied->total > 0 ? '<span class="label label-success">Applied</span>' : '<span class="label label-warning">Not Applied</span>';
							  		echo '<td>'. $status.'</td>';
							  		
					  				echo '<td align="center" >    
					  		             <a title="View" href="index.php?view=view&id='.$result->APPLICANTID.'"  class="btn btn-info btn-xs  ">
					  		             <span class="fa fa-info fw-fa"></span> View</a> 
					  		             <a title="Remove" href="controller.php?action=delete&id='.$result->APPLICANTID.'"  class="btn btn-danger btn-xs  ">
					  		             <span class="fa fa-trash-o fw-fa"></span> Remove</a> 
					  					 </td>';
							  		echo '</tr>';
							  	} 
							  	?>
							  </tbody>
								
							</table>
 
							 
							</form>
       
                 
 