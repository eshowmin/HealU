<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_presc']))
		{
            $pat_id = $_GET['pres_number'];
			$pat_fname=$_POST['pres_pat_age'];
			$pat_lname=$_POST['pres_pat_name'];
			
			
            // $pres_pat_type = $_POST['pres_pat_type'];
            // $pres_pat_addr = $_POST['pres_pat_addr'];
          
            $pres_pat_ailment = $_POST['pres_pat_ailment'];
            $pres_drug_name = $_POST['pres_drug_name'];
            $pres_meal_time = $_POST['pres_meal_time'];
            $pres_take_for = $_POST['pres_take_for'];
            $pres_when_eat = $_POST['pres_when_eat'];
            $pres_test_name = $_POST['pres_test_name'];
            //sql to insert captured values
			$query="UPDATE  his_prescriptions  SET pres_pat_age=?, pres_pat_name=?,pres_drug_name=?,pres_meal_time=?,pres_take_for=?,pres_when_eat=?,pres_test_name=?,pres_pat_ailment=?  WHERE pres_number = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssssss', $pat_fname, $pat_lname,$pres_drug_name,$pres_meal_time,$pres_take_for,$pres_when_eat,$pres_test_name,$pres_pat_ailment, $pat_id);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Prescription Details Updated";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">
    
    <!--Head-->
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
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Prescriptions</a></li>
                                            <li class="breadcrumb-item active">Manage Prescriptions</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Prescription Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <!--LETS GET DETAILS OF SINGLE PATIENT GIVEN THEIR ID-->
                        <?php
                $pres_number = $_GET['pres_number'];
                $ret="SELECT  * FROM his_prescriptions WHERE pres_number=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pres_number);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Fill all fields</h4>
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Patient Name</label>
                                                    <input type="text" required="required" 
                                                    readonly
                                                    value="<?php echo $row->pres_pat_name;?>" name="pres_pat_name" class="form-control" id="inputEmail4" placeholder="Patient's Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Age</label>
                                                    <input required="required" type="number" 
                                                    readonly
                                                    value="<?php echo $row->pres_pat_age;?>" name="pres_pat_age" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Prescription ID</label>
                                                <input required="required" type="text" readonly value="<?php echo $row->pres_pat_number;?>" 
                                                name="pres_pat_number" class="form-control" id="inputPassword4" placeholder="Prescription ID">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Patient Address</label>
                                                <input required="required" type="text" readonly value="<?php echo $row->pres_pat_addr;?>" 
                                                name="pres_pat_addr" class="form-control" id="inputPassword4" placeholder="Patient`s Address">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Patient Type</label>
                                                <input required="required" readonly type="text" value="<?php echo $row->pres_pat_type;?>" 
                                                name="pres_pat_type" class="form-control" id="inputPassword4" placeholder="Patient`s Type">
                                            </div>

                                        </div>
                                        <div class="form-group col-md-">
                                                <label for="inputPassword4" class="col-form-label">Patient Ailment</label>
                                                <input required="required" readonly type="text" value="<?php echo $row->pres_pat_ailment;?>" 
                                                name="pres_pat_ailment" class="form-control" id="inputPassword4" placeholder="Patient`s Ailment">
                                            </div>
                                        <hr>
                                        <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4" class="col-form-label">Drug Name</label>
                                                    <input type="text" required="required" 
                                                    value="<?php echo $row->pres_drug_name;?>" name="pres_drug_name" class="form-control" id="inputEmail4" placeholder="Drug Name">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Meal Time</label>
                                                    <select name="pres_meal_time"
                                                    class="form-control"
                                                    >
                                                    <option value="<?php echo $row->pres_meal_time;?>"><?php echo $row->pres_meal_time;?></option>
                                            <option value="1-0-1">1-0-1</option>
                                            <option value="1-1-1">1-1-1</option>
                                            <option value="0-0-1">0-0-1</option>
                                            <option value="1-0-0">1-0-0</option>
                                            <option value="0-1-0">0-1-0</option>
                                            <option value="0-1-1">0-1-1</option>
                                            <option value="1-1-0">1-1-0</option>
                                                </select>
                                                   
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Take For</label>
                                                    <select name="pres_take_for"
                                                    class="form-control"
                                                    >
                                                    <option value="<?php echo $row->pres_take_for;?>"><?php echo $row->pres_take_for;?></option>
                                                    <option value="3 days">3 days</option>
                                            <option value="7 days">7 days</option>
                                            <option value="15 days">15 days</option>
                                            <option value="30 days">30 days</option>
                                                </select>
                                                
                                                </div>
                                            </div>
                                        <div class="form-row">
                                                
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">When To Eat</label>
                                                    <select name="pres_when_eat"
                                                    class="form-control"
                                                    >
                                                    <option value="<?php echo $row->pres_when_eat;?>"><?php echo $row->pres_when_eat;?></option>
                                                    <option value="After Meal">After Meal</option>
                                            <option value="Before Meal">Before Meal</option>
                                                </select>
                                                   
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Test Name</label>
                                                    <select name="pres_test_name"
                                                    class="form-control"
                                                    >
                                                    <option value="<?php echo $row->pres_test_name;?>"><?php echo $row->pres_test_name;?></option>
                                                    <option value="None">Choose</option>
                                                    <option value="Blood Tests">Blood Tests</option>
                                            <option value="X-Rays">X-Rays</option>
                                            <option value="ECG">ECG</option>
                                            <option value="MRI (Magnetic Resonance Imaging)">MRI (Magnetic Resonance Imaging)</option>
                                            <option value="Basic Metabolic Panel (BMP)">Basic Metabolic Panel (BMP)</option>
                                            <option value="Thyroid Test(s)">Thyroid Test(s)</option>
                                            <option value="Complete Blood Count (CBC) ">Complete Blood Count (CBC) </option>
                                                </select>
                                                
                                                </div>
                                            </div>
                                        
                                            <!-- <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Date Of Birth</label>
                                                    <input type="text" required="required" value="<?php echo $row->pat_dob;?>" name="pat_dob" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Age</label>
                                                    <input required="required" type="text" value="<?php echo $row->pat_age;?>" name="pat_age" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                                </div>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Address</label>
                                                <input required="required" type="text" value="<?php echo $row->pat_addr;?>" class="form-control" name="pat_addr" id="inputAddress" placeholder="Patient's Addresss">
                                            </div> -->

                                            <!-- <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                    <input required="required" type="text" value="<?php echo $row->pat_phone;?>" name="pat_phone" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Ailment</label>
                                                    <input required="required" type="text" value="<?php echo $row->pat_ailment;?>" name="pat_ailment" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState" class="col-form-label">Patient's Type</label>
                                                    <select id="inputState" required="required" name="pat_type" class="form-control">
                                                        <option>Choose</option>
                                                        <option>InPatient</option>
                                                        <option>OutPatient</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2" style="display:none">
                                                    
                                                    <label for="inputZip" class="col-form-label">Patient Number</label>
                                                    <input type="text"  value="<?php echo $patient_number;?>" class="form-control" id="inputZip">
                                                </div>
                                            </div> -->

                                            <button type="submit" name="update_presc" class="ladda-button btn btn-success" data-style="expand-right">Update Prescription</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <?php  }?>
                        <!-- end row -->

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

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>