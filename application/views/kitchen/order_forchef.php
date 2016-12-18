<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-12">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="active" id="login-form-link">รายการ การทำอาหาร</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div id="auto_load_div">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setInterval(auto_load, 10000);
        $(document).ready(function () {
            auto_load();
        });
        function auto_load() {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Chef_controller/refresh_view",
                cache: false,
                success: function (data) {
                    $("#auto_load_div").html(data);

                }
            });
        }
    });
</script>