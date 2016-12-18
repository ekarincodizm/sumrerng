<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="active" id="login-form-link">เช็คบิล</a>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12"><!-- col-sm-6 col-sm-offset-4 -->
                                        <table class="table table-bordered">
                                            <tr>
                                                <?php
                                                $count = 0;
                                                foreach ($order_table as $row) {
                                                    $count++;
                                                    ?>
                                                    <?php if ($count % 3 == 0) { ?>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>index.php/Order_controller/bill_detail/<?php echo $row['order_hd_id']; ?>/<?php echo $row['order_hd_type']; ?>">
                                                                <span class="btn-menu-blue">
                                                                    <h4><?php echo $row['order_hd_table_name']; ?></h4>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>index.php/Order_controller/bill_detail/<?php echo $row['order_hd_id']; ?>/<?php echo $row['order_hd_type']; ?>">
                                                            <span class="btn-menu-blue">
                                                                <h4><?php echo $row['order_hd_table_name']; ?></h4>
                                                            </span>
                                                        </a>
                                                    </td>

                                                <?php } ?>

                                            <?php } ?>
                                                    <tr>
                                                        <td colspan="3">
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
    </div>
</div>