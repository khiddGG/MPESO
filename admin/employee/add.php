<?php 
 if(!isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/index.php");
   }

  $autonum = New Autonumber();
  $res = $autonum->set_autonumber('employeeid');
?> 

 <section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                 <h2 class="page-header">Add New Employee</h2>
            </div>
               
            <div class="row">
                <div class="features">
 
                  <form class="form-horizontal span6  wow fadeInDown" action="controller.php?action=add" method="POST">

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "EMPLOYEEID">Employee ID:</label>

                        <div class="col-md-8"> 
                           <input class="form-control input-sm" id="EMPLOYEEID" name="EMPLOYEEID" placeholder=
                              "Employee ID" type="text" value="<?php echo $res->AUTO; ?>" readonly>
                        </div>
                      </div>
                    </div>           
                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "FNAME">Firstname:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder=
                              "Firstname" type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "MNAME">Middle Name:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="MNAME" name="MNAME" placeholder=
                              "Middle Name" type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "LNAME">Lastname:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder=
                              "Lastname" type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "ADDRESS">Address:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="ADDRESS" name="ADDRESS" placeholder=
                              "Address" type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "BIRTHDATE">Date of Birth:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm datepicker" id="BIRTHDATE" name="BIRTHDATE" placeholder=
                              "Date of Birth" type="text" value="" required>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "BIRTHPLACE">Place of Birth:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="BIRTHPLACE" name="BIRTHPLACE" placeholder=
                              "Place of Birth" type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "TELNO">Contact No.:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="TELNO" name="TELNO" placeholder=
                              "Contact No." type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "CIVILSTATUS">Civil Status:</label>

                        <div class="col-md-8">
                           <select class="form-control input-sm" name="CIVILSTATUS" id="CIVILSTATUS">
                              <option value="Single">Single</option>
                              <option value="Married">Married</option>
                              <option value="Widow">Widow</option>
                           </select>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "SEX">Sex:</label>

                        <div class="col-md-8">
                           <select class="form-control input-sm" name="SEX" id="SEX">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "POSITION">Position:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="POSITION" name="POSITION" placeholder=
                              "Position" type="text" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "DATEHIRED">Hired Date:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm datepicker" id="DATEHIRED" name="DATEHIRED" placeholder=
                              "Hired Date" type="text" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "EMP_EMAILADDRESS">Email Address:</label>

                        <div class="col-md-8">
                           <input class="form-control input-sm" id="EMP_EMAILADDRESS" name="EMP_EMAILADDRESS" placeholder=
                              "Email Address" type="email" value="">
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "COMPANYID">Company:</label>

                        <div class="col-md-8">
                           <select class="form-control input-sm" name="COMPANYID" id="COMPANYID">
                              <option value="">Select Company</option>
                              <?php 
                                $mydb->setQuery("SELECT * FROM tblcompany");
                                $cur = $mydb->loadResultList();

                                foreach ($cur as $result) {
                                  echo '<option value='.$result->COMPANYID.'>'.$result->COMPANYNAME.'</option>';
                                }
                              ?>
                           </select>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "idno"></label>

                        <div class="col-md-8">
                           <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
 </section>

 <script>
 $(document).ready(function() {
     $('.datepicker').datepicker({
         format: 'yyyy-mm-dd',
         autoclose: true,
         todayHighlight: true
     });
 });
 </script>
 