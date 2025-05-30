    <section id="content">
        <div class="container content">      
     
 <?php
 if (isset($_GET['search'])) {
     # code...
    $jobid = $_GET['search'];
 }else{
     $jobid = '';

 }
    $sql = "SELECT * FROM `tblcompany` c,`tbljob` j 
            WHERE c.`COMPANYID`=j.`COMPANYID` 
            AND j.`JOBSTATUS`='Active' 
            AND JOBID LIKE '%" . $jobid ."%' 
            ORDER BY DATEPOSTED DESC" ;
    $mydb->setQuery($sql);
    $cur = $mydb->loadResultList();

    if(count($cur) > 0) {
        foreach ($cur as $result) {
            # code...
 
 // `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `PREFEREDSEX`, `SECTOR_VACANCY`, `DATEPOSTED`
  ?> 
           <div class="container">
             <div class="mg-available-rooms">
                    <h5 class="mg-sec-left-title">Date Posted :  <?php echo date_format(date_create($result->DATEPOSTED),'M d, Y'); ?></h5>
                        <div class="mg-avl-rooms">
                            <div class="mg-avl-room">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="#"><span class="fa fa-building-o" style="font-size: 50px"></span></a>
                                    </div>
                                    <div class="col-sm-10">
                                        <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;"><?php echo $result->OCCUPATIONTITLE ;?> 
                                        </div> 
                                        <div class="row contentbody">
                                            <div class="col-sm-6">
                                                <ul>
                                                    <li><i class="fp-ht-bed"></i>Required No. of Employee's : <?php echo $result->REQ_NO_EMPLOYEES; ?></li>
                                                    <li><i class="fp-ht-food"></i>Salary : <?php echo number_format($result->SALARIES,2);  ?></li>
                                                    <li><i class="fa fa-sun-"></i>Duration of Employment : <?php echo $result->DURATION_EMPLOYEMENT; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <ul>
                                                    <li><i class="fp-ht-tv"></i>Prefered Sex : <?php echo $result->PREFEREDSEX; ?></li>
                                                    <li><i class="fp-ht-computer"></i>Sector of Vacancy : <?php echo $result->SECTOR_VACANCY; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>Qualification/Work Experience :</p>
                                                 <ul style="list-style: none;"> 
                                                    <li><?php echo $result->QUALIFICATION_WORKEXPERIENCE ;?></li> 
                                                </ul> 
                                            </div>
                                            <div class="col-sm-12"> 
                                                <p>Job Description:</p>
                                                <ul style="list-style: none;"> 
                                                     <li><?php echo $result->JOBDESCRIPTION ;?></li> 
                                                </ul> 
                                             </div>
                                            <div class="col-sm-12">
                                                <p>Employer :  <?php echo  $result->COMPANYNAME; ?></p> 
                                                <p>Location :  <?php echo  $result->COMPANYADDRESS; ?></p>
                                            </div>
                                        </div>
                                          <a href="<?php echo web_root; ?>index.php?q=apply&job=<?php echo $result->JOBID;?>&view=personalinfo" class="btn btn-main btn-next-tab">Apply Now !</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
            </div>                        
<?php  } 
    } else {
        echo '<div class="container">
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> This job is no longer available or has been removed.
                </div>
                <a href="'.web_root.'index.php?q=hiring" class="btn btn-primary">Back to Job Listings</a>
              </div>';
    }
?>    </div>
    </section> 