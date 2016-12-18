<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="active" id="login-form-link">เมนูหลัก</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/Main_controller/order">
                                            <span class="btn-menu-orange">
                                                <h5>หน้าจอรับ Order ที่ร้าน <br>(Order Store)</h5>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/Order_controller/check_biil_in">
                                            <span class="btn-menu-blue">
                                                <h5>หน้าจอเช็คบิล ที่ร้าน <br>(Check Bill Store)</h5>
                                            </span>
                                        </a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/OrderOut_controller">
                                            <span class="btn-menu-orange">
                                                <h5>หน้าจอรับ Order ทางโทรศัพท์<br>(Order Telephone)</h5>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/OrderOut_controller/check_biil_out">
                                            <span class="btn-menu-blue">
                                                <h5>หน้าจอเช็คบิล Order ทางโทรศัพท์ <br>(Check Bill Telephone)</h5>
                                            </span>
                                        </a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/Payment_controller/payMent_View">
                                            <span class="btn-menu-gray">
                                                <h5>หน้าจอตรวจสอบการชำระเงิน<br>(Payment)</h5>
                                            </span>
                                        </a>
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="4">
                                        <a href="<?php echo base_url(); ?>index.php/Checkfood_controller/checkFood_view">
                                            <span class="btn-menu-red">
                                                <h5>หน้าจอตรวจสอบสถานะอาหาร<br>(Check Food)</h5>
                                            </span>
                                        </a>
                                    </td>

                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <a href="<?php echo base_url(); ?>index.php/Addproduct_controller">
                                            <span class="btn-menu-blue">
                                                <h5>หน้าจอเพิ่มสินค้า <br>(Product)</h5>
                                            </span>
                                        </a>
                                    </td>
                                    <td colspan="2">
                                        <a href="">
                                            <span class="btn-menu-red">
                                                <h5>ตั้งค่าระบบ <br>(Setting)</h5>
                                            </span>
                                        </a>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <a href="<?php echo base_url(); ?>index.php/Report_controller">
                                            <span class="btn-menu-pink">
                                                <h5>พิมพ์รายงาน (Report)</h5>
                                            </span>
                                        </a>
                                    </td>
                                    <td colspan="1">
                                        <a href="<?php echo base_url(); ?>index.php/Login_controller/logout">
                                            <span class="btn-menu-blue">
                                                <h5>ออกจากระบบ (Logout)</h5>
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