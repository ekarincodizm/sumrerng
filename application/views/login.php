<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <base href = "<?= base_url(); ?>"/>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/form_login.css" rel="stylesheet">
        <!--<script src="js/bootstrap.js"></script> 
        <script src="js/bootstrap.min.js"></script> 
        jquery
        <script src="js/jquery-1.12.2.js"></script>-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a href="" class="active" id="login-form-link">เข้าสู่ระบบ</a>
                                </div>
                                
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="form_login" action="<?= base_url(); ?>index.php/Login_controller/check_login" method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="ชื่อผู้ใช้" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="รหัสผ่าน">
                                        </div>
                                        <!--<div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember"> Remember Me</label>
                                        </div>-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-4">
                                                    <!--<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">-->
                                                    <!--<a id="btn_login" class="btn btn-info btn-lg">เข้าสู่ระบบ</a>-->
                                                    <button class="btn btn-info btn-lg" type="submit">เข้าสู่ระบบ</button>
                                                    <button type="reset" class="btn btn-danger btn-lg">ยกเลิก</button>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript">
        //$(document).ready(function () {
            //$("#btn_login").click(function () {
                //$("#form_login").submit();
           // });
       // });
    </script>

</html>