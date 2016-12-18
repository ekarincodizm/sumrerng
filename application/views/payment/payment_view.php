<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-12">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="active" id="login-form-link">รายการการชำระเงิน</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12" >
                                <form method="post" action="<?php echo base_url(); ?>index.php/Payment_controller/search_payment">
                                    <table class="table table-bordered" >
                                        <tr>
                                            <td><input type="date" id="start_date" name="start_date" class="form-control" placeholder="วันที่เริ่มต้น"></td>
                                            <td><input type="date" id="end_date" name="end_date" class="form-control" placeholder="วันที่สิ้นสุด"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="table_id" name="table_id" class="form-control" placeholder="รหัสโต๊ะ"></td>
                                            <td><input type="text" id="table_name" name="table_name" class="form-control" placeholder="ชื่อโต๊ะ"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button  type="submit" class="btn btn-success">ค้นหา</button>
                                                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" >
                                    <table class="table table-hover" >
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>
                                                <th class="text-center">รหัสการชำระ</th>
                                                <th class="text-center">วันที่จ่าย</th>
                                                <th class="text-center">เวลา</th>
                                                <th class="text-center">จำนวนเงิน(บาท)</th>
                                                <th class="text-center">เลขที่ Order</th>
                                                <th class="text-center">รหัสโต๊ะ</th>
                                                <th class="text-center">ชื่อโต๊ะ</th>
                                                <th class="text-center">แก้ไขวันที่</th>
                                                <th class="text-center">พิมพ์ใบเสร็จ</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $count = 0;
                                        $sumQty = 0;
                                        $sumPrice = 0;
                                        $sumPriceAll = 0;
                                        foreach ($payment as $row) {
                                            $count++;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count; ?></td>
                                                <td class="text-center"><?php echo $row['payment_id']; ?></td>
                                                <td class="text-center"><?php echo $row['payment_date']; ?></td>
                                                <td class="text-center"><?php echo $row['payment_time']; ?></td>
                                                <td class="text-center"><?php echo $row['payment_money']; ?></td>
                                                <td class="text-center"><?php echo $row['order_hd_id']; ?></td>
                                                <td class="text-center"><?php echo $row['table_id']; ?></td>
                                                <td class="text-center"><?php echo $row['table_name']; ?></td>
                                                <td class="text-center"><?php echo $row['update_date']; ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url(); ?>index.php/Payment_controller/print_payment/<?php echo $row['payment_id']; ?>" target="_blank"   class="btn btn-warning">Print</a>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                        <tr>
                                            <td colspan="10">
                                                <a href="<?php echo base_url(); ?>index.php/Main_controller">
                                                    <span class="btn-menu-orange">
                                                        <h4>กลับเมนูหลัก</h4>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    