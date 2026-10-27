<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login.css');?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/favicon.png');?>" />

    <style>
    .img-fluid {
        max-width: 100%;
        height: auto;

    }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <img class="img-fluid img-responsive" src="<?php echo base_url('assets/images/nar2.png');?>">
            </div>

            <div class="wrap-login100">
                <div class="login100-pic js-tilt">
                    <img src="<?php echo base_url('assets/img-01.png');?>" alt="IMG">
                </div>
                <?php
			if($this->session->flashdata('unnotmatch'))
			{
				?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <center><strong><?php echo $this->session->flashdata('unnotmatch'); ?></strong></center>
                </div>
                <?php 
			} 
			elseif($this->session->flashdata('pwdnotmatch')) 
			{ 
				?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <center><strong><?php echo $this->session->flashdata('pwdnotmatch'); ?></strong></center>
                </div>
                <?php 
			} 
			?>
                <style>
                /* CAPTCHA CONTAINER */
                .captcha-box {
                    background: #f5f7fa;
                    border: 1px solid #dcdcdc;
                    border-radius: 8px;
                    padding: 12px;
                    margin-bottom: 20px;
                    text-align: center;
                }

                /* CAPTCHA IMAGE */
                .captcha-img img {
                    display: block;
                    margin: 0 auto;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    background: #fff;
                    padding: 4px;
                }
                </style>
                <form method="POST" action="<?= base_url('log'); ?>" class="login100-form">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <span class="login100-form-title">Admin JNRC</span>

                  
<div class="wrap-input100">
    <input class="input100"
           type="text"
           name="username"
           id="username"
           required
           placeholder="Username"
           autocomplete="off"
           oncopy="return false"
           onpaste="return false"
           oncut="return false"
           ondrag="return false"
           ondrop="return false">
</div>

<div class="wrap-input100">
    <input class="input100"
           type="password"
           name="password"
           id="password"
           required
           placeholder="Password"
           autocomplete="new-password"
           minlength="8"
           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}"
           title="Password must be at least 8 characters and include uppercase, lowercase, number and special character"
           oncopy="return false"
           onpaste="return false"
           oncut="return false"
           ondrag="return false"
           ondrop="return false">
</div>


                    <!-- CAPTCHA BOX -->
                    <div class="captcha-box">

                        <div class="captcha-img">
                            <?= $captcha_img; ?>
                        </div>

                        <div class="wrap-input100 mt-2">
                            <input class="input100" type="text" name="captcha" required placeholder="Enter CAPTCHA">
                        </div>

                    </div>


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">Login</button>
                    </div>

                </form>

                <?php if ($this->session->flashdata('error')): ?>
                <p style="color:red;text-align:center;">
                    <?= html_escape($this->session->flashdata('error')); ?>
                </p>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {

    const secureFields = document.querySelectorAll(
        'input[name="username"], input[name="password"]'
    );

    secureFields.forEach(function (field) {

        field.addEventListener('keydown', function (e) {
            if (
                (e.ctrlKey || e.metaKey) &&
                ['c', 'v', 'x', 'a'].includes(e.key.toLowerCase())
            ) {
                e.preventDefault();
            }
        });

    });

});
</script>

    <script src="<?php echo base_url('assets/adminpage/jquery.min.js');?>"></script><!-- JQUERY.MIN JS -->
    <script src="<?php echo base_url('assets/adminpage/popper.min.js');?>"></script><!-- BOOTSTRAP.MIN JS -->
    <script src="<?php echo base_url('assets/adminpage/bootstrap.min.js');?>"></script><!-- BOOTSTRAP.MIN JS -->
</body>

</html>