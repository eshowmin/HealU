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
                $lab_id=$_GET['pat_id'];
                // $lab_number=$_GET['lab_number'];
                $ret="SELECT  * FROM his_patients WHERE pat_id = ?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$lab_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                    $mysqlDateTime = $row->pat_date_joined;
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
                                <h3>Invoice</h3>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p><span class = "text-bold">Date</span>: <?php echo $row->pat_date_joined;?></p>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Invoice No:</span>16789</p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'>Invoiced To:</li>
                                    <li>Patient : <?php echo $row->pat_fname;?></li>
                                    <li>Patient ID : <?php echo $row->pat_number;?></li>
                                    <li>Naria, Shariatpur</li>
                                    <li>Bangladesh</li>
                                </ul>
                            </div>
                            <div class = "invoice-head-bottom-right">
                                <ul class = "text-end">
                                    <li class = 'text-bold'>Pay To:</li>
                                    <li>HealU Inc.</li>
                                    <li>2705 N. Enterprise</li>
                                    <li>Orange, CA 89438</li>
                                    <li>contact@healuinc.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body">
                            <table>
                                <thead>
                                    <tr>
                                        <!-- <td class = "text-bold">Service</td> -->
                                        <td class = "text-bold">Doctor </td>
                                        <td class = "text-bold">Department</td>
                                        <!-- <td class = "text-bold">QTY</td> -->
                                        <td class = "text-bold">Fees</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td>Design</td> -->
                                        <td><?php echo $row->doc_name;?></td>
                                        <td><?php echo $row->doc_dept;?></td>
                                        <!-- <td>10</td> -->
                                        <td class = "text-end"><?php echo $row->doc_charge;?></td>
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
                                <div class = "invoice-body-info-item border-bottom">
                                    <!-- <div class = "info-item-td text-end text-bold">Sub Total:</div>
                                    <div class = "info-item-td text-end">$2150.00</div> -->
                                </div>
                                <div class = "invoice-body-info-item border-bottom">
                                    <!-- <div class = "info-item-td text-end text-bold">Tax:</div>
                                    <div class = "info-item-td text-end">$215.00</div> -->
                                </div>
                                <div class = "invoice-body-info-item">
                                    <div class = "info-item-td text-end text-bold">Total:</div>
                                    <div class = "info-item-td text-end"><?php echo $row->doc_charge;?></div>
                                </div>
                            </div>
                        </div>
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