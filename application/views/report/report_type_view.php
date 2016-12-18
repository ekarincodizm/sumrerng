<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="active" id="login-form-link">พิมพ์รายงาน</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">
                                        <a href="<?php echo base_url(); ?>index.php/Report_controller/circulation">
                                            <span class="btn-menu-blue">
                                                <h5>รายงานสรุปยอดขาย</h5>
                                            </span>
                                        </a>
                                    </td>
                                    <td colspan="2">
                                        <a href="<?php echo base_url(); ?>index.php/Report_controller/best_seller">
                                            <span class="btn-menu-red">
                                                <h5>รายงานสรุปสินค้าขายดี</h5>
                                            </span>
                                        </a>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <a href="<?php echo base_url(); ?>index.php/Report_controller/inventory_balance">
                                            <span class="btn-menu-pink">
                                                <h5>ตรวจสอบยอดคงเหลือเครื่องดื่ม</h5>
                                            </span>
                                        </a>
                                    </td>
                                    <td colspan="1">
                                        <a href="">
                                            <span class="btn-menu-gray">
                                                <h5>ออกจากระบบ</h5>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/Main_controller">
                                            <span class="btn-menu-orange">
                                                <h5>ย้อนกลับ</h5>
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