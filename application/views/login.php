<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" rev="stylesheet" href="<?php echo base_url(); ?>css/login.css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Invoice System <?php echo $this->lang->line('login_login'); ?></title>
        <script src="<?php echo base_url(); ?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $("#login_form input:first").focus();
            });
        </script>
    </head>
    <body>
        <?php echo form_open('login') ?>
        <div id="container">
            <?php echo validation_errors(); ?>
            <div class="login_form">
                <div class="login_logo">
                    <img src="<?php echo base_url();?>images/image.png"/>
                </div>
                <div class="login_details"><?php echo $this->lang->line('login_welcome_message'); ?></div>
                <div class="login_iputs">
                    <?php echo form_input(array('name' => 'username', 'placeholder' => 'someone@example.com')); ?>
                </div>
                <div class="login_iputs">
                    <?php echo form_password(array('name' => 'password', 'placeholder' => 'Password')); ?>
                </div>
                <div class="login_check_box">
                    <input type="checkbox" name="stay_signed_in"/> Keep me signed in 
                </div>
                <div class="login_button">
                    <?php echo form_submit('submit', 'Sing in'); ?>
                </div>
                <div class="login_helps">
                    <a href="#">Can't access your account?</a>
                </div>
                <div class="login_helps">
                    <a href="#">Sign in with a single-use code</a>
                </div>
                <div class="login_create_new">Don't have an account? <a href="#">Sign up now</a></div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </body>
</html>
