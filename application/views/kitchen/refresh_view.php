<div class="panel-body">
    <div class="row">
        <div class="form-group">
            <div class="col-md-12" >
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">เลขที่ Order</th>
                        <th class="text-center">ชื่อโต๊ะ</th>
                        <th class="text-center">ชื่อสินค้า</th>
                        <th class="text-center">สั่ง</th>
                        <th class="text-center">เสิร์ฟแล้ว</th>
                        <th class="text-center">รอเสิร์ฟ</th>
                        <th class="text-center">หน่วย</th>
                        <th class="text-center">กรณีพิเศษ</th>
                        <th class="text-center">เสร็จ</th>
                    </tr>
                    </thead>
                        
                    
                    <tr>
                        <?php
                        $count = 0;
                        foreach ($order_detail as $row) {
                            $count++;
                            ?>
                        <tr>
                            <td class="text-center"><?php echo $count; ?></td>
                            <td class="text-center"><?php echo $row['order_hd_id']; ?></td>
                            <td class="text-center"><?php echo $row['order_hd_table_name']; ?></td>
                            <td class="text-center"><?php echo $row['product_name']; ?></td>
                            <td class="text-center"><?php echo $row['product_unit']; ?></td>
                            <td class="text-center"><?php echo $row['chef_unit']; ?></td>
                            <td class="text-center"><?php echo $row['not_send']; ?></td>
                            <td class="text-center"><?php echo $row['product_packkey']; ?></td>
                            <td class="text-center">
                                <?php if($row['speed_food'] == "F"){?>
                                    ยังไม่ได้อาหาร เร่งเป็นพิเศษ 
                                <?php }else{?>
                                    -
                                <?php }?>
                            </td>
                            <td class="text-center"><a href="<?php echo base_url(); ?>index.php/Chef_controller/update_chefunit/<?php echo $row['order_dt_id']; ?>/<?php echo $row['order_hd_id']; ?>/<?php echo $row['product_id']; ?>/<?php echo $row['product_unit']; ?>" class="btn btn-success btn-lg">เสิร์ฟ <?php echo $row['order_hd_table_name']; ?></a></td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <a href="<?php echo base_url(); ?>index.php/Login_controller/logout">
                                <span class="btn-menu-red">
                                    <h4>ออกจากระบบ</h4>
                                </span>
                            </a>
                        </td>
                        
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>