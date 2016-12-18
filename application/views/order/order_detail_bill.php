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
                                            <td class="text-left"><h3><?php echo $order[0]['ordder_hd_date']; ?></h3></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><h3>เลขที่โต๊ะ : </h3></td>
                                            <td class="text-left"><h3><?php echo $order[0]['order_hd_table_id']; ?></h3></td>
                                            <td class="text-right"><h3>ชื่อโต๊ะ : </h3></td>
                                            <td class="text-left"><h3><?php echo $order[0]['order_hd_table_name']; ?></h3></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><h3>ผู้รับ Order : </h3></td>
                                            <td class="text-left" colspan="3"><h3><?php echo $order[0]['order_hd_user']; ?></h3></td>
                                           
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
                                            <th class="text-center">จำนวนสั่ง</th>
                                            <th class="text-center">หน่วย</th>
                                        </tr>
                                    </thead>

                                    <?php
                                   $count = 0;
                                    foreach ($order as $row) {
                                        $count++;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count; ?></td>
                                            <td class="text-left"><?php echo $row['product_name']; ?></td>
                                            <td class="text-center">
                                                <?php echo $row['product_unit']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['product_packkey']; ?>
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
                                            <td colspan="2">
                                                <a id="comfirm" href="<?php echo base_url(); ?>index.php/Order_controller/back_main">
                                                    <span class="btn-menu-orange">
                                                    <h4>กลับเมนูหลัก</h4>
                                                </span>
                                                </a>
                                            </td>
                                            <td>
                                                <a id="comfirm" href="<?php echo base_url(); ?>index.php/Order_controller/print_bill_order/<?php echo $order[0]['order_hd_id']; ?>" target="_blank">
                                                    <span class="btn-menu-gray">
                                                    <h4>พิมพ์ใบสั่งอาหาร</h4>
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