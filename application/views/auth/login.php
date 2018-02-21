
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
                    <input type="text" id="nip" class="form-control form-login" placeholder="NIP . . ." autofocus="autofocus"/>
                </div>
            </div>
            <div class="form-group">
                <!--<label for="password">Password:</label>-->
                <div class="input-icon">
                    <i class="icon-lock"></i>
                    <input type="password" id="password" class="form-control form-login" placeholder="Password . . ." />
                </div>
            </div>
            <!-- /Input Fields -->

            <!-- Form Actions -->
            <div class="form-actions">
                <!--                    <label class="checkbox pull-left"><input type="checkbox" class="uniform" name="remember"> Remember me</label>-->
                <button type="button" id="login_btn" class="submit btn btn-primary pull-right">
                    Sign In <i class="icon-angle-right" style="margin-left: 5px;"></i>
                </button>
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
                <form class="form-vertical forgot-password-form hide-default" action="" method="post">
                    <!-- Input Fields -->
                    <div class="form-group">
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
        <a href="<?php echo $loginURL; ?>" class="btn btn-google-plus btn-block">
            <i class="icon-google-plus"></i> Sign in with Google
        </a>
    </div>
    <!-- /Single-Sign-On (SSO) -->

    <script>

        $(document).ready(function () {
            window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
            var pc = new RTCPeerConnection({iceServers:[]}), noop = function () {};
            pc.createDataChannel("");
            pc.createOffer(pc.setLocalDescription.bind(pc),noop);
            pc.onicecandidate = function (ice) {
                if(!ice || !ice.candidate || !ice.candidate.candidate) return;
                var myIPc = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate);
                var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];

                console.log(myIPc);


                $.getJSON("//freegeoip.net/json/?callback=?", function (data) {
                    console.log(data);
                    // alert('Local IP : '+myIP +' | Public IP : '+data.ip);

                });

                pc.onicecandidate = noop;
            }
        });

        $('#login_btn').click(function(){
            sendAuth();
        });

        $('.form-login').keypress(function (e) {

            if (e.which == 13) {
                sendAuth();
                return false;    //<---- Add this line
            }
        });

        function sendAuth() {
            var nip = ($('#nip').val()!='') ? $('#nip').val() :
                $('#nip').css('border', '1px solid red').animateCss('shake');

            var password = ($('#password').val()!='')? $('#password').val() :
                $('#password').css('border','1px solid red').animateCss('shake');

            setTimeout(function () {
                $('.form-login').css('border','1px solid #ccc');
            },3000);

            if($('#nip').val()!='' && $('#password').val()!=''){

                loading_button('#login_btn');
                $('.form-login').prop('disabled',true);

                var url = base_url_js+"uath/authUserPassword";
                var data = {
                    nip : nip,
                    password : password
                };

                var token = jwt_encode(data,'L06M31N');
                $.post(url,{token:token},function (result) {
                    var res = result.trim();

                    setTimeout(function () {
                        if(res==1){
                            toastr.success('Logged In TRUE', 'Success!!');
                            window.location.href = base_url_js+'dashboard';
                        } else {
                            $('.box').animateCss('shake');
                            toastr.error('NIK and Password not match', 'Error!!');
                            // $('.form-login').val('');
                            $('.form-login').css('border','1px solid red');
                            setTimeout(function () {
                                $('.form-login').css('border','1px solid #ccc');
                            },5000);
                        }
                        $('#login_btn').html('Sign In <i class="icon-angle-right" style="margin-left: 5px;"></i>');
                        $('.form-login,#login_btn').prop('disabled',false);

                    },2000);

                });
            }
        }
    </script>



</div>