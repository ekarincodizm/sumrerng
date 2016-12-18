<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-12">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="active" id="login-form-link">ตรวจสอบสถานะการทำอาหาร</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <a class="btn btn-info" data-toggle="modal" data-target="#Modal_AddCategory">เพิ่มหมวดหมู่</a>
                                <a class="btn btn-success" data-toggle="modal" data-target="#Modal_Add">เพิ่มสินค้า</a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12" >
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>
                                                <th class="text-center">หมวดหมู่</th>
                                                <th class="text-center">รหัสสินค้า</th>
                                                <th class="text-center">ชื่อสินค้า</th>
                                                <th class="text-center">ราคาต่อหน่วย</th>
                                                <th class="text-center">หน่วย</th>
                                                <th class="text-center">สถานะ</th>
                                                <th class="text-center">ลบ</th>
                                                
                                            </tr>
                                        </thead>


                                        <tr>
                                            <?php
                                            $count = 0;
                                            foreach ($product as $row) {
                                                $count++;
                                                ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count; ?></td>
                                                <td class="text-center"><?php echo $row['category_name']; ?></td>
                                                <td class="text-center"><?php echo $row['product_id']; ?></td>
                                                <td class="text-center"><?php echo $row['product_name']; ?></td>
                                                
                                                <td class="text-center"><?php echo $row['product_price']; ?></td>
                                                <td class="text-center"><?php echo $row['product_packkey']; ?></td>
                                                <td class="text-center">
                                                    <?php if( $row['product_status'] == "A"){ ?>
                                                
                                                        มีสินค้า
                                                    <?php } else if( $row['product_status'] == "B"){?>
                                                        สินค้าหมด
                                                    <?php }else {?>
                                                        สินค้ายกเลิกขาย
                                                        <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a data-hrefdata-delete="index.php/Addproduct_controller/delete_product/<?php echo $row['product_id']; ?>"   data-toggle="modal" data-target="#confirm-Cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tr>
                                        <tr>
                                            <td colspan="10">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Modal_AddCategory" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><font color="#0040FF">เพิ่มหมวดหมู่สินค้า</font></h4>
            </div>
            <form action="index.php/Addproduct_controller/add_category" method="post">
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="category" name="category" class="form-control " placeholder="หมวดหมู่" maxlength="50">
                            </div>
                        </div>
                    </div>
                    <br>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-danger">บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modal_Add" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><font color="#0040FF">เพิ่มสินค้า</font></h4>
            </div>
            <form action="index.php/Addproduct_controller/add_product" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                
                                <select name="category" id="category" class="form-control ">
                                    <?php foreach ($category as $row) {?>
                                    <option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="product_name" name="product_name" class="form-control " placeholder="ชื่อสินค้า" maxlength="50">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="product_price" name="product_price" class="form-control " placeholder="ราคา" maxlength="11">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="product_packkey" name="product_packkey" class="form-control " placeholder="หน่วย" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-danger">บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Cancel -->
<div class="modal fade" id="confirm-Cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><font color="#0040FF">Confirm Dialog</font></h4>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบข้อมูล ใช่หรือไม่</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger ok">ตกลง</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#confirm-Cancel').on('show.bs.modal', function (e) {
            $(this).find('.ok').attr('href', $(e.relatedTarget).data('hrefdata-delete'));
        });
        
    });
    
</script>