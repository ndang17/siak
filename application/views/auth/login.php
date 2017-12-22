
<link href="<?php echo base_url('assets/template/css/login.css'); ?>" rel="stylesheet" type="text/css" />
<!-- App -->
<script type="text/javascript" src="<?php echo base_url('assets/template/js/login.js'); ?>"></script>
<script>
    $(document).ready(function(){
        "use strict";
        Login.init(); // Init login JavaScript
    });
</script>
<style>
    body {
        /*background: url('*/<?php //echo base_url('images/bg.jpg'); ?>/*');*/
        background-color: #f9f9f9;
    }
</style>
<div class="login" style="background: none;">

    <div class="logo">
        <img src="<?php echo base_url('images/logo.png'); ?>" style="width: 200px;" alt="logo" />

    </div>
    <!-- /Logo -->

    <!-- Login Box -->
    <div class="box">
        <div class="content">
            <!-- Login Formular -->

            <!-- Title -->
            <h3 class="form-title">Sign In to your Portal</h3>

            <!-- Error Message -->
            <div class="alert fade in alert-danger" style="display: none;">
                <i class="icon-remove close" data-dismiss="alert"></i>
                Enter any username and password.
            </div>

            <!-- Input Fields -->
            <div class="form-group">
                <div class="input-icon">
                    <i class="icon-user"></i>
                    <input type="text" id="username" name="username" class="form-control" placeholder="NIK" autofocus="autofocus"
                           data-rule-required="true" data-msg-required="Please enter your username." />
                </div>
            </div>
            <div class="form-group">
                <!--<label for="password">Password:</label>-->
                <div class="input-icon">
                    <i class="icon-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." />
                </div>
            </div>
            <!-- /Input Fields -->

            <!-- Form Actions -->
            <div class="form-actions">
                <!--                    <label class="checkbox pull-left"><input type="checkbox" class="uniform" name="remember"> Remember me</label>-->
                <button type="button" id="login_btn" class="submit btn btn-primary pull-right">
                    Sign In <i class="icon-angle-right"></i>
                </button>
            </div>

            <div class="alert alert-danger">
                NIK and Password not match
            </div>
            <!-- /Login Formular -->

        </div> <!-- /.content -->

        <!-- Forgot Password Form -->
        <div class="inner-box">
            <div class="content">
                <!-- Close Button -->
                <i class="icon-remove close hide-default"></i>

                <!-- Link as Toggle Button -->
                <a href="#" class="forgot-password-link">Forgot Password?</a>

                <!-- Forgot Password Formular -->
                <form class="form-vertical forgot-password-form hide-default" action="login.html" method="post">
                    <!-- Input Fields -->
                    <div class="form-group">
                        <!--<label for="email">Email:</label>-->
                        <div class="input-icon">
                            <i class="icon-envelope"></i>
                            <input type="text" name="email" class="form-control" placeholder="Enter email address" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email." />
                        </div>
                    </div>
                    <!-- /Input Fields -->

                    <button type="submit" class="submit btn btn-default btn-block">
                        Reset your Password
                    </button>
                </form>
                <!-- /Forgot Password Formular -->

                <!-- Shows up if reset-button was clicked -->
                <div class="forgot-password-done hide-default">
                    <i class="icon-ok success-icon"></i> <!-- Error-Alternative: <i class="icon-remove danger-icon"></i> -->
                    <span>Great. We have sent you an email.</span>
                </div>
            </div> <!-- /.content -->
        </div>
        <!-- /Forgot Password Form -->
    </div>
    <!-- /Login Box -->

    <!-- Single-Sign-On (SSO) -->
    <div class="single-sign-on">
        <span>or</span>
        <button class="btn btn-google-plus btn-block">
            <i class="icon-google-plus"></i> Sign in with Google
        </button>
    </div>
    <!-- /Single-Sign-On (SSO) -->

    <script>
        $('#login_btn').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();

            var url = base_url_js+"uath-login";
            $.post(url,{username:username,password:password},function () {

            });
            $('.box').animateCss('shake');
            toastr.success('Have fun storming the castle!', 'Miracle Max Says');
        });
    </script>



</div>