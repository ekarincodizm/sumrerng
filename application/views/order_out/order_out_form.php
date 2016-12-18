<div class="container">
    <div class="row">
        <div class="col-md-12 ">

            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="active" id="login-form-link">Order ภายนอก</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12" >
                            <form method="post" action="<?php echo base_url(); ?>index.php/OrderOut_controller/confirm_order_out" id="order_out">
                                <table class="table table-bordered" >
                                    <tr>
                                        <td><input type="text" id="order_customer" name="order_customer" class="form-control" placeholder="ชื่อผู้สั่ง" required="true"></td>
                                        <td><input  type="text" id="order_phone" name="order_phone" maxlength="10" class="form-control" placeholder="เบอร์ติดต่อ" required="true"></td>

                                    </tr>
                                    <tr>
                                        <td><input type="text" id="order_stop" name="order_stop" class="form-control" placeholder="จุดส่งอาหาร" required="true"></td>
                                        <td><input type="text" id="order_stopview" name="order_stopview" class="form-control" placeholder="จุดสังเกตุ" required="true"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" >
                                <table class="table table-bordered" >
                                    <tr>
                                        <td>
                                            <table class="table table-bordered" >
                                                <tr>
                                                    <th>ชื่อสินค้า</th>
                                                    <th class="text-center">ราคา/หน่วย</th>
                                                    <th class="text-center">เพิ่มอาหาร</th>
                                                </tr>
                                                <?php foreach ($product as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row['product_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['product_price']; ?></td>
                                                        <td class="text-center">
                                                            <button value="<?php echo $row['product_id']; ?>" class="btn btn-success send" >สั่ง</button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                            </table>
                                        </td>
                                        <td>
                                            <div id="data-menu">

                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href="<?php echo base_url(); ?>index.php/OrderOut_controller/back_tomain">
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
                    <button  type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
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
            $('#ok').click(function () {
                $('#order_out').submit();
            });
            $('.send').click(function () {

                var product_id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/OrderOut_controller/add_order_out",
                    cache: false,
                    method: 'POST',
                    data: {product_id: product_id},
                    success: function (data) {
                        $("#data-menu").html(data);

                    }
                });
            });
        });

    </script>