<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="active" id="login-form-link">รายงานสรุปยอดขาย</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" >

                                <tr>
                                    <td><input type="date" id="start_date" name="start_date" class="form-control" placeholder="วันที่เริ่มต้น" required="true"></td>
                                    <td><input  type="date" id="end_date" name="end_date"  class="form-control" placeholder="วันที่สื้นสุด" required="true"></td>
                                    <td class="text-right">
                                        <a id="btn_search" class="btn btn-info">ค้นหา</a>
                                        <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div id="data_circulation"></div>
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
<div class="modal fade" id="confirm-Print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><font color="#0040FF">Confirm Dialog</font></h4>
            </div>
            <div class="modal-body">
                <p>คุณต้องการพิมพ์เอกสาร ใช่หรือไม่</p>
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
        $('#btn_search').click(function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date == "") {
                $('#msg').html("วันที่เริ่มต้น");
                $('#confirm-Message').modal({show: 'false'});
            } else if (end_date == "") {
                $('#msg').html("วันที่สิ้นสุด");
                $('#confirm-Message').modal({show: 'false'});
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/Report_controller/circulation_ajax",
                    cache: false,
                    method: 'POST',
                    data: {start_date: start_date, end_date: end_date},
                    success: function (data) {
                        $("#data_circulation").html(data);

                    }
                });

            }
        });
        $('#confirm-Cancel').on('show.bs.modal', function (e) {
            $(this).find('.ok').attr('href', $(e.relatedTarget).data('hrefdata-delete'));
        });
    });

</script>