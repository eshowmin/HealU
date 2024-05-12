<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];
  if(isset($_POST['add_patient']))
		{
            $pat_id = $_GET['pat_id'];
			$doc_name=$_POST['doc_name'];
			$doc_dept=$_POST['doc_dept'];
			$assign_doc_date=$_POST['assign_doc_date'];
            $assign_doc_time=$_POST['assign_doc_time'];
			$doc_charge=$_POST['doc_charge'];
			$status=$_POST['status'];
            // assign_doc_date=?,doc_charge=?, assign_doc_time=?
            // $assign_doc_date, $assign_doc_time,$doc_charge,
            //sql to insert captured values
			$query="UPDATE  his_patients  SET doc_name=?, doc_dept=? ,assign_doc_date=?, assign_doc_time=?,doc_charge=?,status=? WHERE pat_id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssi',  $doc_name,$doc_dept,$assign_doc_date, $assign_doc_time,$doc_charge,$status,$pat_id);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Assigned Doctor.";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php');?>


<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include("assets/inc/nav.php");?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("assets/inc/sidebar.php");?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <!--Get Details Of A Single User And Display Them Here-->
        <?php
                // $pat_number=$_GET['pat_number'];
                $pat_id=$_GET['pat_id'];
                $ret="SELECT  * FROM his_patients WHERE pat_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$pat_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
            {
                $mysqlDateTime = $row->pat_date_joined;
            ?>
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                        <li class="breadcrumb-item active">View Patients</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?>'s Profile</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <div class="card-box text-center">
                                <img src="assets/images/patients.jpeg" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">


                                <div class="text-left mt-3">

                                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"><?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"><?php echo $row->pat_phone;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2"><?php echo $row->pat_addr;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Date Of Birth :</strong> <span class="ml-2"><?php echo $row->pat_dob;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Age :</strong> <span class="ml-2"><?php echo $row->pat_age;?> Years</span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Ailment :</strong> <span class="ml-2"><?php echo $row->pat_ailment;?></span></p>
                                    <hr>
                                    <p class="text-muted mb-2 font-13"><strong>Date Recorded :</strong> <span class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($mysqlDateTime));?></span></p>
                                    <hr>
                                    




                                </div>

                            </div> <!-- end card-box -->

                        </div> <!-- end col-->

                        <?php }?>
                        <div class="col-lg-8 col-xl-8">
                            <div class="card-box">
                                <ul class="nav nav-pills navtab-bg nav-justified">
                                    <li class="nav-item">
                                        <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Assign Doctor
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                            Vitals
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            PDF
                                        </a>
                                    </li>
                                </ul>
                                <!--Medical History-->
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="aboutme">
                                        <ul class="list-unstyled timeline-sm" style="padding-left: 0;">
                                        <form method="post">
                                            <?php
                                                    // $pres_pat_number =$_GET['pat_number'];
                                                    $ret="SELECT  * FROM his_docs";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    // $stmt->bind_param('i',$pres_pat_number );
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    
                                                    while($row=$res->fetch_object())
                                                        {
                                                    // $mysqlDateTime = $row->pres_date; //trim timestamp to date

                                                ?>
                                                <li>
                                                    
                                                 <div class="form-row">
                                            
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Doctor Department</label>
                                                <select id="inputState" required="required" name="doc_dept" class="form-control">
                                                    <option >Choose Department</option>
                                                    <?php
                                                    $ret="SELECT  * FROM his_docs";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    while($row=$res->fetch_object())
                                                        {
                                                   
                                                ?>
                                            
                                                <option value="<?php echo $row->doc_dept; ?>"><?php echo $row->doc_dept; ?></option>
                                            
                                            <?php } ?>
                                                </select>
                                            </div>
                                            <!-- <div  -->
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Doctor Name</label>
                                                <select id="inputState" required="required" name="doc_name" class="form-control">
                                                    <option >Choose Doctor</option>
                                                    <?php
                                                    $ret="SELECT  * FROM his_docs";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    while($row=$res->fetch_object())
                                                        {
                                                   
                                                ?>
                                            
                                                <option value="<?php echo $row->doc_fname; ?> <?php echo $row->doc_lname; ?>
                                                "><?php echo $row->doc_fname; ?> <?php echo $row->doc_lname; ?>
                                                </option>
                                            
                                            <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Date</label>
                                                <input type="date" required="required" name="assign_doc_date"
                                                class="form-control" id="inputEmail4" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Time</label>
                                                <select id="inputState" required="required" name="assign_doc_time" class="form-control">
                                                    <option >Choose Time</option>
                                                <option value="8 AM">8 AM </option>
                                                <option value="10 AM">10 AM </option>
                                                <option value="12 PM">12 PM </option>
                                                <option value="6 PM">6 PM </option>
                                                <option value="8 PM">8 PM </option>
                                            
                                            
                                                </select>
                                            </div>
                                          
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Doctor Charge</label>
                                                <input type="number" required="required" 
                                                class="form-control" id="inputEmail4" 
                                                name="doc_charge"
                                                placeholder="Doctor Charge">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Status</label>
                                                <select id="inputState" required="required" name="status" class="form-control">
                                                    <option>Choose Status</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Unpaid">Unpaid</option>
                                               
                                                </select>
                                            </div>
                                            
                                            <button type="submit" name="add_patient" class="ladda-button btn btn-primary" data-style="expand-right">Assign Doctor</button>
                                                       
                                            <!-- </div> -->
                                        </div>
                                        </li>
                                        </form>
                                            <!-- <li class="timeline-sm-item">
                                                <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($mysqlDateTime));?></span>
                                                <h5 class="mt-0 mb-1"><?php echo $row->pres_pat_ailment;?></h5>
                                                <h5>
                                                    Patient Prescription
                                                </h5>
                                                <p class="text-muted mt-2">
                                                    <?php echo $row->pres_date;?>
                                                </p>
                                                <p><a href="./invoice/prescription.php?pres_id=<?php echo $row->pres_id ;?>&&pres_number=<?php echo $row->pres_number ;?>">See Prescription</a></p>

                                            </li> -->
                                            <?php }?>
                                        </ul>

                                    </div> <!-- end tab-pane -->
                                    <!-- end Prescription section content -->

                                    
                                    <!-- end vitals content-->

                                    <div class="tab-pane " id="settings">
                                        <ul class="list-unstyled timeline-sm" style="padding-left: 0;">
                                        
                                            <?php
                                                    $pres_pat_number =$_GET['pat_id'];
                                                    $ret="SELECT  * FROM his_patients WHERE pat_id = '$pres_pat_number'";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    // $stmt->bind_param('i',$pres_pat_number );
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    
                                                    while($row=$res->fetch_object())
                                                        {
                                                    // $mysqlDateTime = $row->pres_date; //trim timestamp to date

                                                ?>
                                                <li>
                                                    
                                                 <div class="form-row">
                                            
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Patient Bills</label>
                                                
                                            </div>
                                           
                                            
                                           
                                            <p> <a href="./invoice/receptionist_billing.php?pat_id=<?php echo $row->pat_id;?>" class="badge badge-success"><i class="mdi mdi-check-box-outline"></i> Billings</a></p>
                                            <!-- </div> -->
                                        </div>
                                        </li>
                                        
                                            <!-- <li class="timeline-sm-item">
                                                <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($mysqlDateTime));?></span>
                                                <h5 class="mt-0 mb-1"><?php echo $row->pres_pat_ailment;?></h5>
                                                <h5>
                                                    Patient Prescription
                                                </h5>
                                                <p class="text-muted mt-2">
                                                    <?php echo $row->pres_date;?>
                                                </p>
                                                <p><a href="./invoice/prescription.php?pres_id=<?php echo $row->pres_id ;?>&&pres_number=<?php echo $row->pres_number ;?>">See Prescription</a></p>

                                            </li> -->
                                            <?php }?>
                                        </ul>

                                    </div>
                                </div>
                                <!-- end lab records content-->

                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->
                </div>
                <!-- end row-->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <?php include('assets/inc/footer.php');?>
        <!-- end Footer -->

    </div>


    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>


</html>