<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Shop: Let’s order fresh items for you.</title>

    <link rel="shortcut icon" href="<?= base_url('assets/images/organic_shop_favicon.ico')?>" type="image/x-icon">

    <script src="<?= base_url('../assets/js/vendor/jquery.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js')?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css')?>">

    <script src="<?= base_url('../assets/js/global/global.js')?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css')?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/signup.css')?>">
	<link rel="stylesheet" href="<?= base_url('../assets/css/custom/login.css')?>">
</head>
<script>
    // $(document).ready(function() {
    //     $("form").submit(function(event) {
    //         event.preventDefault();
    //         return false;
    //     });
    //     /* prototype add */
    //     $(".signup_btn").click(function() {
    //         window.location.href = "catalogue.html";
    //     });
    // });
</script>
<body>
	<?php if($this->session->flashdata('success')): ?>
		<script>
			toastr.success( <?= $this->session->flashdata('success') ?>)
		</script>
	<?php endif; ?>
    <div class="wrapper">
        <a href="/dashboard"><img src="<?= base_url('../assets/images/organic_shop_logo_large.svg')?>" alt="Organic Shop"></a>
		
		<?php echo form_open('users/registerUser') ?>

            <h2>Signup to order.</h2>
            <a href="<?= base_url('users') ?>">Already a member? Login here.</a>
            <ul>
                <li>
                    <input type="text" name="first_name" value="<?= set_value('first_name') ?>">
                    <label>First Name</label>
					<?php if(form_error('first_name')):?>
						<div class="error-message">
							<?= form_error('first_name') ?>
						</div>
					<?php endif; ?>
                </li>
                <li>
                    <input type="text" name="last_name" value="<?= set_value('last_name') ?>">
                    <label>Last Name</label>

					<?php if(form_error('last_name')):?>
						<div class="error-message">
							<?= form_error('last_name') ?>
						</div>
					<?php endif; ?>
                </li>
                <li>
                    <input type="email" name="email" value="<?= set_value('email') ?>">
                    <label>Email</label>

					<?php if(form_error('email')):?>
						<div class="error-message">
							<?= form_error('email') ?>
						</div>
					<?php endif; ?>
                </li>
                <li>
                    <input type="password" name="password" value="12345678" >
                    <label>Password</label>

					<?php if(form_error('password')):?>
						<div class="error-message">
							<?= form_error('password') ?>
						</div>
					<?php endif; ?>
                </li>
                <li>
                    <input type="password" name="confirm_password" value="12345678">
                    <label>Confirm Password</label>

					<?php if(form_error('confirm_password')):?>
						<div class="error-message">
							<?= form_error('confirm_password') ?>
						</div>
					<?php endif; ?>
                </li>
            </ul>
            <button class="signup_btn" type="submit">Signup</button>
            <!-- <input type="hidden" name="action" value="signup"> -->

        </form>
    </div>
</body>
</html>
