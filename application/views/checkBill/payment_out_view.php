<div class="container" onload="focus();">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-12">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="active" id="login-form-link">ชำระเงิน</a>
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
                                            <td colspan="3"><input type="text" name="money" id="money" class="form-control" placeholder="จำนวนเงิน" maxlength="11"></td>

                                            <td class="text-center">
                                                <a id="0" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>0</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="C" class="calculator">
                                                    <span class="btn-menu-gray">
                                                        <h4>C</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="-" class="calculator">
                                                    <span class="btn-menu-gray">
                                                        <h4><</h4>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="width: 15%;"><h2>รับเงิน</h2></td>
                                            <td class="text-center"><h2><span id="receipt_money">0</span></h2></td>
                                            <td class="text-center"  style="width: 10%;"><h2>บาท</h2></td>
                                            <td class="text-center">
                                                <a id="1" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>1</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="2" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>2</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="3" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>3</h4>
                                                    </span>
                                                </a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"> <h2>ค่าสินค้า</h2></td>
                                            <td class="text-center">
                                                <h2><?php echo $payment['payment_money']; ?></h2>
                                                <input hidden="" id="payment_money" value="<?php echo $payment['payment_money']; ?>">
                                            </td>
                                            <td class="text-center"><h2>บาท</h2></td>
                                            <td class="text-center">
                                                <a id="4" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>4</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="5" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>5</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="6" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>6</h4>
                                                    </span>
                                                </a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><h2>เงินทอน</h2></td>
                                            <td class="text-center"><h2><span id="change_money">0</span></h2></td>
                                            <td class="text-center"><h2>บาท</h2></td>
                                            <td class="text-center">
                                                <a id="7" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>7</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="8" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>8</h4>
                                                    </span>
                                                </a>

                                            </td>
                                            <td class="text-center">
                                                <a id="9" class="calculator">
                                                    <span class="btn-menu-blue">
                                                        <h4>9</h4>
                                                    </span>
                                                </a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <a href="<?php echo base_url(); ?>index.php/OrderOut_controller/check_biil_out">
                                                    <span class="btn-menu-red">
                                                        <h4>กลับเมนูเช็คบิล</h4>
                                                    </span>
                                                </a>
                                            </td>
                                        <form id="confirm-payment" action="<?php echo base_url(); ?>index.php/Order_controller/confirm_payment/<?php echo $payment['table_id']; ?>/<?php echo $payment['payment_money']; ?>/<?php echo $payment['order_id']; ?>/<?php echo $payment['type']; ?>" method="post">

                                        </form>
                                        <td colspan="3">

                                            <a id="comfirm"  >
                                                <span class="btn-menu-orange">
                                                    <h4>ชำระเงิน</h4>
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
<div class="modal fade" id="confirm-Comfirm-Payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><font color="#0040FF">Confirm Dialog</font></h4>
            </div>
            <div class="modal-body">
                <span id="msg"></span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">ตกลง</button>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.calculator').click(function () {
            var str = $("#money").val();
            var a;
            var value = $(this).attr("id");
            if (value == "0" && str == "") {
                $("#money").val('');
            } else {
                if (value == "C") {
                    $("#money").val('');
                    $("#receipt_money").html(0);
                    $("#change_money").html(0);
                } else if (value == "-") {

                } else {
                    a = str + value;
                    $("#money").val(a);
                    $("#receipt_money").html(a);
                }
            }
            var receipt = $("#money").val();
            var payment_money = $("#payment_money").val();
            var chang = receipt - payment_money;
            if (chang > 0) {
                $("#change_money").html(chang);
            }
        });
        $("#comfirm").click(function () {
            var money = $('#money').val();
            var payment_money = $('#payment_money').val();
            
            if (money == "") {
                $('#msg').html("กรุณาระบุ จำนวนเงิน ค่ะ");
                $('#confirm-Comfirm-Payment').modal({show: 'false'});
            } else {
                if(parseInt(money) > parseInt(payment_money)){
                    $('#confirm-payment').submit();
                }else{
                    $('#msg').html("จำนวนเงินไม่เพียงพอสำหรับชำระค่าบริการ ค่ะ");
                    $('#confirm-Comfirm-Payment').modal({show: 'false'});
                }
            }
        });
        $("#money").on("keypress", function (e) {
            var code = e.keyCode ? e.keyCode : e.which;
            if (code > 57) {
                return false;
            } else if (code < 48 && code != 8) {
                return false;
            }
        });

    });
</script>