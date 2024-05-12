
<?php
include('../assets/inc/config.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
                $lab_id=$_GET['pres_id'];
                $lab_number=$_GET['pres_number'];
                $ret="SELECT  * FROM his_prescriptions WHERE pres_id = ?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$lab_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                    $mysqlDateTime = $row->pres_date;
            ?>
        <div class = "invoice-wrapper" id = "print-area">
            <div class = "invoice">
                <div class = "invoice-container">
                    <div class = "invoice-head">
                        <div class = "invoice-head-top">
                            <div class = "invoice-head-top-left text-start">
                                <!-- <img src = "images/logo.png"> -->
                                <img src="../assets/images/HealU.png" alt="" height="">
                            </div>
                            <div class = "invoice-head-top-right text-end">
                                <h3>Prescription</h3>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p><span class = "text-bold">Date</span>: <?php echo $row->pres_date;?></p>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Presc. No:</span>16789</p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                           
                                <ul>
                                    <li class = 'text-bold'>Doctor Info:</li>
                                    <li>Doctor : Afsar Uddin</li>
                                    <li>Patient ID : </li>
                                    <li>Naria, Shariatpur</li>
                                    <li>Bangladesh</li>
                                </ul>
                               
                            </div>
                            <div class = "invoice-head-bottom-right">
                                <ul class = "text-end">
                                    <li class = 'text-bold'>Patient Info:</li>
                                    <li>Patient : <?php echo $row->pres_pat_name;?></li>
                                    <li>Age : <?php echo $row->pres_pat_age;?></li>
                                    <li>Patient ID : <?php echo $row->pres_pat_number;?></li>
                                    <li>Address : <?php echo $row->pres_pat_addr;?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body" style="padding-bottom: 200px;">
                            <div style="width:35%;float:left;padding:10px 0 0 10px"><p>Test : <?php echo $row->pres_test_name;?></p></div>
                            <table style="width:65%;float:right">
                                <thead>
                                    <tr>
                                        <td class = "text-bold">Drug Name</td>
                                        <td class = "text-bold">Meal Time</td>
                                        <td class = "text-bold">Take For</td>
                                        <td class = "text-bold">When To Eat</td>
                                        <!-- <td class = "text-bold">Amount</td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row->pres_drug_name;?></td>
                                        <td><?php echo $row->pres_meal_time;?></td>
                                        <td><?php echo $row->pres_take_for;?></td>
                                        <td><?php echo $row->pres_when_eat;?></td>
                                        <!-- <td class = "text-end">$500.00</td> -->
                                    </tr>
                                    <!-- <tr>
                                        <td>Development</td>
                                        <td>Website Development</td>
                                        <td>$50.00</td>
                                        <td>10</td>
                                        <td class = "text-end">$500.00</td>
                                    </tr>
                                    <tr>
                                        <td>SEO</td>
                                        <td>Optimize the site for search engines (SEO)</td>
                                        <td>$50.00</td>
                                        <td>10</td>
                                        <td class = "text-end">$500.00</td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td colspan="4">10</td>
                                        <td>$500.00</td>
                                    </tr> -->
                                </tbody>                      
                            </table>
                            
                            <div class = "invoice-body-bottom">
                                <!-- <div class = "invoice-body-info-item border-bottom">
                                    <div class = "info-item-td text-end text-bold">Sub Total:</div>
                                    <div class = "info-item-td text-end">$2150.00</div>
                                </div>
                                <div class = "invoice-body-info-item border-bottom">
                                    <div class = "info-item-td text-end text-bold">Tax:</div>
                                    <div class = "info-item-td text-end">$215.00</div>
                                </div>
                                <div class = "invoice-body-info-item">
                                    <div class = "info-item-td text-end text-bold">Total:</div>
                                    <div class = "info-item-td text-end">$21365.00</div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class = "hr"></div>
                    <div>
                    <!-- <table >
                        <tr><p style="width:40%;float:left"><?php echo $row->pres_test_name;?></p>
                        <td><div style="width:2px;height:300px;background-color:gray;float:center"></div></td>
                        <p style="width:58%;float:right">2</p></tr>
                        <tr><td>3</td></tr>
                        <tr><td>4</td></tr>
                    </table> -->
                    </div>
                    <div class = "invoice-foot text-center">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and does not require physical signature.</p>

                        <div class = "invoice-btns">
                            <button type = "button" class = "invoice-btn" onclick="printInvoice()">
                                <span>
                                    <i class="fa-solid fa-print"></i>
                                </span>
                                <span>Print PDF</span>
                            </button>
                            <!-- <button type = "button" class = "invoice-btn">
                                <span>
                                    <i class="fa-solid fa-download"></i>
                                </span>
                                <span>Download</span>
                            </button> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
<?php } ?>
        <script src = "script.js"></script>
    </body>
</html>