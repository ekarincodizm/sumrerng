<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-12">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="active" id="login-form-link">รายการสั่งอาการ</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12" >
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="text-right"><h3>เลขที่ Order : </h3></td>
                                            <td class="text-left"><h3><?php echo $order[0]['order_hd_id']; ?></h3></td>
                                            <td class="text-right"><h3>วันที่ Order : </h3></td>
                                            <td class="text-left"><h3><?php echo $order[0]['ordder_hd_date']; ?>&nbsp;<?php echo $order[0]['order_time']; ?></h3></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><h3>เลขที่โต๊ะ : </h3></td>
                                            <td class="text-left"><h3><?php echo $order[0]['order_hd_table_id']; ?></h3></td>
                                            <td class="text-right"><h3>ชื่อโต๊ะ : </h3></td>
                                            <td class="text-left"><h3><?php echo $order[0]['order_hd_table_name']; ?></h3></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12" >
                                <table class="table table-hover" >
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-left">ชื่อสินค้า</th>
                                            <th class="text-center">จำนวนสั่ง/หน่วย</th>
                                            <th class="text-center">ได้รับสินค้าจริง/หน่วย</th>
                                            <th class="text-center">ราคา/หน่วย</th>
                                            <th class="text-center">รวมเป็นเงิน</th>
                                            <th class="text-center">ยกเลิก</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $count = 0;
                                    $sumQty = 0;
                                    $sumPrice = 0;
                                    $sumPriceAll = 0;
                                    foreach ($order as $row) {
                                        $count++;
                                        $sumQty = $sumQty + $row['chef_unit'];
                                        $sumPrice = $row['chef_unit'] * $row['product_price'];
                                        $sumPriceAll = $sumPriceAll + $sumPrice;
                                        $vat = $sumPriceAll * 7;
                                        $totalVat = $vat / 100;
                                        $sumPriceAllatVat = $sumPriceAll + $totalVat;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count; ?></td>
                                            <td class="text-left"><?php echo $row['product_name']; ?></td>
                                            <td class="text-center">
                                                <?php echo $row['product_unit']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url(); ?>index.php/Order_controller/redue_order_by_order/<?php echo $row['order_dt_id']; ?>/<?php echo $row['order_hd_id']; ?>/<?php echo $row['product_id']; ?>/in">-</a>
                                                <?php echo $row['chef_unit']; ?>
                                                <a href="<?php echo base_url(); ?>index.php/Order_controller/add_order_by_order/<?php echo $row['order_dt_id']; ?>/<?php echo $order[0]['order_hd_id']; ?>/<?php echo $row['product_id']; ?>/in">+</a>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['product_price']; ?>
                                            </td>
                                            <td class="text-center"><?php echo $sumPrice; ?></td>
                                            <td class="text-center">
                                                <a data-hrefdata-delete="index.php/Order_controller/delete_billdetail/<?php echo $row['order_dt_id']; ?>/<?php echo $order[0]['order_hd_id']; ?>/in"   data-toggle="modal" data-target="#confirm-Cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </table>  
                                <hr>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="4" class="text-right"><h3>จำนวนสั่งทั้งสิ้น : </h3></td>
                                            <td class="text-center"><h3><?php echo $sumQty; ?></h3></td>
                                            <td class="text-center"><h3>รายการ</h3></td>
                                        </tr>


                                        <tr>
                                            <td colspan="4" class="text-right"><h3>ภาษี 7% : </h3></td>
                                            <td class="text-center"><h3><?php echo $totalVat; ?></h3></td>
                                            <td class="text-center"><h3>บาท</h3></td>
                                        </tr>


                                        <tr>
                                            <td colspan="4" class="text-right"><h3>รวมเป็นเงิน : </h3></td>
                                            <td class="text-center"><h3><?php echo $sumPriceAll; ?></h3></td>
                                            <td class="text-center"><h3>บาท</h3></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" class="text-right"><h3>ราคารวมภาษี 7% เป็นเงินทั้งสิ้น : </h3></td>
                                            <td class="text-center"><h3><?php echo $sumPriceAllatVat; ?></h3></td>
                                            <td class="text-center"><h3>บาท</h3></td>
                                        </tr>

                                        <tr>
                                            <td class="text-right" colspan="6">
                                                <font color="red">***กรุณาพิมพ์ใบเสร็จก่อนชำระเงินทุกครั้ง</font>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <a id="comfirm" href="<?php echo base_url(); ?>index.php/Order_controller/check_biil_in">
                                                    <span class="btn-menu-orange">
                                                    <h4>ย้อนกลับเมนูเช็คบิล</h4>
                                                </span>
                                                </a>
                                            </td>
                                            <td>
                                                <a id="comfirm" href="<?php echo base_url(); ?>index.php/Order_controller/print_bill_in/<?php echo $order[0]['order_hd_id']; ?>" target="_blank">
                                                    <span class="btn-menu-gray">
                                                    <h4>พิมพ์ใบเสร็จ</h4>
                                                </span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>index.php/Order_controller/payment_in_view/<?php echo $order[0]['order_hd_id']; ?>/<?php echo $sumPriceAllatVat; ?>/<?php echo $order[0]['order_hd_table_id']; ?>/in">
                                                    <span class="btn-menu-blue">
                                                        <h4>หน้าชำระเงิน</h4>
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
</div>



<!-- Modal Cancel -->
<div class="modal fade" id="confirm-Cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><font color="#0040FF">Confirm Dialog</font></h4>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบข้อมูล ใช่หรือไม่</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger ok">ตกลง</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#confirm-Cancel').on('show.bs.modal', function (e) {
            $(this).find('.ok').attr('href', $(e.relatedTarget).data('hrefdata-delete'));
        });
        
    });
    
</script>