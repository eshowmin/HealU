<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_doc']))
		{
			$doc_fname=$_POST['ad_fname'];
			$doc_lname=$_POST['ad_lname'];
			$doc_number=$_GET['ad_id'];
            $doc_email=$_POST['ad_email'];
            $doc_pwd=$_POST['ad_pwd'];
            // $doc_pwd=sha1(md5($_POST['doc_pwd']));
            $doc_dpic=$_FILES["ad_dpic"]["name"];
		    move_uploaded_file($_FILES["ad_dpic"]["tmp_name"],"../admin/assets/images/users/".$_FILES["ad_dpic"]["name"]);

            //sql to insert captured values
			$query="UPDATE his_receptionist SET ad_fname=?, ad_lname=?,  ad_email=?, ad_pwd=?, ad_dpic=? WHERE ad_id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssss', $doc_fname, $doc_lname, $doc_email, $doc_pwd, $doc_dpic, $doc_number);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Receptionist Details Updated";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Receptionist</a></li>
                                            <li class="breadcrumb-item active">Manage Receptionists</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Receptionist Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <?php
                            $doc_number=$_GET['ad_id'];
                            $ret="SELECT  * FROM his_receptionist WHERE ad_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$doc_number);
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
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">First Name</label>
                                                    <input type="text" required="required" value="<?php echo $row->ad_fname;?>" name="ad_fname" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Last Name</label>
                                                    <input required="required" type="text" value="<?php echo $row->ad_lname;?>" name="ad_lname" class="form-control"  id="inputPassword4">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Email</label>
                                                <input required="required" type="email" value="<?php echo $row->ad_email;?>" class="form-control" name="ad_email" id="inputAddress">
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">Password</label>
                                                    <input required="required"  type="password" name="ad_pwd" class="form-control" id="inputCity">
                                                </div> 
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">Profile Picture</label>
                                                    <input required="required"  type="file" name="ad_dpic" class="btn btn-success form-control"  id="inputCity">
                                                </div>
                                            </div>                                            

                                            <button type="submit" name="update_doc" class="ladda-button btn btn-success" data-style="expand-right">Update Receptionist</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <?php }?>

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