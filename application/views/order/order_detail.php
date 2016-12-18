<div class="container">
    <div class="row">
        <div class="col-md-4 text-center">
            <label>รหัสโต๊ะ <?php echo $table[0]['table_id']; ?> &nbsp;ชื่อโต๊ะ : <?php echo $table[0]['table_name']; ?></label>
        </div>
        <div class="col-md-4 text-center">
            <label>ผู้รับ Order : <?php echo $this->session->userdata('user_prefix') . "" . $this->session->userdata('user_name') . " " . $this->session->userdata('user_lastname'); ?></label>
        </div>
        <div class="col-md-4 text-center">
            <label>วันที่รับ Order : <?php echo date('d/m/Y'); ?></label>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="active" id="login-form-link">เมนูวันนี้</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12" >
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <table class="table table-bordered" >
                                            <tr>
                                                <th width="10%">รหัสสินค้า</th>
                                                <th>ชื่อสินค้า</th>
                                                <th class="text-center">ราคา/หน่วย</th>
                                                <th class="text-center">เพิ่มอาหาร</th>
                                            </tr>
                                            <?php foreach ($product as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row['product_id']; ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td class="text-center"><?php echo $row['product_price']; ?></td>
                                                    <td class="text-center">
                                                        <button value="<?php echo $row['product_id'] . "," . $table[0]['table_id']; ?>" class="btn btn-success send" >สั่ง</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </table>  
                                    </td>
                                    <td>
                                        <form method="post" action="<?php echo base_url(); ?>index.php/Order_controller/confirm_order/<?php echo $table[0]['table_id']; ?>/<?php echo $table[0]['table_name']; ?>" id="ConfirmOrder">
                                        <div id="data-menu"></div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="<?php echo base_url(); ?>index.php/Main_controller/table">
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

<!-- Modal Confirm -->
<div class="modal fade" id="confirm-ConfirmOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><font color="#0040FF">Confirm Dialog</font></h4>
            </div>
            <div class="modal-body">
                <p>คุณต้องการส่ง Order ใช่หรือไม่</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger " id="ok">ตกลง</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Message -->
<div class="modal fade" id="confirm-Message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><font color="#0040FF">Warning Dialog</font></h4>
            </div>
            <div class="modal-body">
                <p>กรุณาระบุข้อมูล <span id="msg"></span>&nbsp;ค่ะ</p>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-danger" data-dismiss="modal">ตกลง</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#ok').click(function(){
            $('#ConfirmOrder').submit();
        });
        $('.send').click(function () {
            var str = $(this).val();
            var arr = str.split(",");
            var product_id = arr[0];
            var table_id = arr[1];
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Order_controller/add_order",
                cache: false,
                method: 'POST',
                data: {product_id: product_id, table_id: table_id},
                success: function (data) {
                    $("#data-menu").html(data);
                }
            });
        });
    });

</script>