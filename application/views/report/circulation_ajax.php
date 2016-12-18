<table class="table table-bordered" >


    <tr>
        <th class="text-center">ลำดับ</th>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th class="text-right">ราคา/หน่วย</th>
        <th class="text-right">จำนวน</th>
        <th class="text-right">รวมเป็นเงิน</th>
    </tr>


    <?php
    $count = 0;
    $total = 0;
    $sum = 0;

    foreach ($circulation as $row) {
        $count++;
        $sum = $row['price'] * $row['chef_unit'];
        $total = $total + $sum;
        ?>
        <tr>
            <td class="text-center"><?php echo $count; ?></td>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td class="text-right"><?php echo $row['price']; ?></td>
            <td class="text-right"><?php echo $row['chef_unit']; ?></td>
            <td class="text-right"><?php echo $sum; ?></td>


        </tr>
    <?php } ?>
    <tr>
        <td colspan="5" class="text-right">
            รวมเป็นเงินที่ขายได้ทั้งสิ้น
        </td>
        <td class="text-right">
            <?php echo $total; ?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <a href="<?php echo base_url(); ?>index.php/Report_controller">
                <span class="btn-menu-orange">
                    <h4>ย้อนกลับ</h4>
                </span>
            </a>
        </td>
        <td colspan="3">
            <a target="_blank" href="<?php echo base_url(); ?>index.php/Report_controller/circulation_report/<?php echo $date['start_date']; ?>/<?php echo $date['end_date']; ?>">
                <span class="btn-menu-gray">
                    <h4>พิมพ์</h4>
                </span>
            </a>
        </td>
    </tr>


</table>