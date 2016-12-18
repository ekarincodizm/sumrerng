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
                        <th class="text-center">จำนวนสั่ง</th>
                        <th class="text-center">เสิร์ฟแล้ว</th>
                        <th class="text-center">รอเสิร์ฟ</th>
                        <th class="text-center">หน่วย</th>
                        <!--<th class="text-center">สถานะ</th>-->
                        <th class="text-center">กรณีพิเศษ</th>
                        <th class="text-center">เร่ง</th>
                        <th class="text-center">ยกเลิก</th>
                    </tr>
                    </thead>
                        
                    
                    <tr>
                        <?php
                        $count = 0;
                        $dif = 0;
                        foreach ($order_detail as $row) {
                            $count++;
                            $dif = $row['product_unit']- $row['chef_unit'];
                            ?>
                        <tr>
                            <td class="text-center"><?php echo $count; ?></td>
                            <td class="text-center"><?php echo $row['order_hd_id']; ?></td>
                            <td class="text-center"><?php echo $row['order_hd_table_name']; ?></td>
                            <td class="text-center"><?php echo $row['product_name']; ?></td>
                            <td class="text-center"><?php echo $row['product_unit']; ?></td>
                            <td class="text-center"><?php echo $row['chef_unit']; ?></td>
                            <td class="text-center"><?php echo $dif;?></td>
                            <td class="text-center"><?php echo $row['product_packkey']; ?></td>
                           <!-- <td class="text-center">
                                <?php if($row['cook_status'] == "B"){?>
                                    ยังไม่ได้ทำ
                                <?php }else if($row['cook_status'] == "A"){?>
                                    ทำเสร็จแล้ว
                                <?php }?>
                            </td>-->
                            <td class="text-center">
                                <?php if($row['speed_food'] == "F"){?>
                                    ยังไม่ได้อาหาร เร่งเป็นพิเศษ 
                                <?php }else{?>
                                    -
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <?php if($row['cook_status'] == "B" && $row['speed_food'] == "S"){?>
                                    <a data-hrefdata-send-speed="<?php echo base_url(); ?>index.php/Checkfood_controller/update_speed_food/<?php echo $row['order_dt_id']; ?>/<?php echo $row['order_hd_id']; ?>/<?php echo $row['product_id']; ?>" data-toggle="modal" data-target="#confirm-Send-speed" class="btn btn-success btn-lg">เร่ง</a>
                                <?php }?>
                                
                            </td>
                            <td class="text-center">
                                <?php if($row['cook_status'] != "A"){?>
                                <a data-hrefdata-cancel="<?php echo base_url(); ?>index.php/Checkfood_controller/cancel_detail/<?php echo $row['order_dt_id']; ?>/<?php echo $row['order_hd_id']; ?>/<?php echo $row['product_id']; ?>" data-toggle="modal" data-target="#confirm-Cancel" class="btn btn-danger btn-lg">ยกเลิก</a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <a href="<?php echo base_url(); ?>index.php/Main_controller">
                                <span class="btn-menu-red">
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
