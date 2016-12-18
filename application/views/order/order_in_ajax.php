<table class="table table-bordered">
    <tr>
        <th>ชื่อสินค้า</th>
        <th class="text-center">จำนวน</th>
        <th class="text-right">ราคา/หน่วย</th>
        <th class="text-right">ราคารวม</th>

    </tr>
    <?php
    $sum = 0;
    foreach ($this->cart->contents() as $items) {
        ?>
        <tr>
            <td><?php echo $items['productname']; ?></td>
            <td class="text-center"><a href="<?php echo base_url(); ?>index.php/Order_controller/reduce_cart/<?php echo $items['rowid']; ?>/<?php echo $items['qty']; ?>/<?php echo $table[0]['table_id']; ?>">-</a>&nbsp;&nbsp;<?php echo $items['qty']; ?>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>index.php/Order_controller/load_cart/<?php echo $items['rowid']; ?>/<?php echo $items['qty']; ?>/<?php echo $table[0]['table_id']; ?>">+</a></td>
            <td class="text-right"><?php echo $items['price']; ?></td>
            <td class="text-right"><?php echo $items['subtotal']; ?></td>
            <?php $sum +=$items['subtotal']; ?>
        </tr>
    <?php } ?>

    <?php if ($sum > 0) { ?>
        <tr>
            <td><label>รวมเป็นเงินทั้งสิ้น</label></td>
            <td class="text-right"><?php echo $sum; ?>&nbsp;<label>บาท</label></td>
            <td colspan="2" class="text-right">
                <a class="btn btn-info " id="ww">สั่งอาหาร</a>
                <a href="<?php echo base_url(); ?>index.php/Order_controller/cancel_cart"  class="btn btn-danger">ยกเลิก</a>
            </td>
            
        </tr>
    <?php } ?>
</table>

<script type="text/javascript">
        $(document).ready(function () {
             $('#ww').click(function () {
               $('#confirm-ConfirmOrder').modal({show: 'false'}); 
            });
        });
</script>