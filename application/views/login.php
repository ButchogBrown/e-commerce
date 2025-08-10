<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Shop: Let’s order fresh items for you.</title>

    <link rel="shortcut icon" href="<?= base_url('../assets/images/organic_shop_favicon.ico') ?>" type="image/x-icon">

    <script src="<?= base_url('../assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js')?>"></script>

	

    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css') ?>">

    <script src="<?= base_url('../assets/js/global/dashboard.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/signup.css') ?>">
	<link rel="stylesheet" href="<?= base_url('../assets/css/custom/login.css') ?>">
	<link rel="stylesheet" href="<?=  base_url('../assets/css/vendor/toastr.min.css') ?>">

	<script src="<?= base_url("assets/js/vendor/jquery.validate.js")?>"></script>
	<script src="<?= base_url('assets/js/main/users.js')?>"></script>
	<script src="<?= base_url("assets/js/vendor/toastr.min.js")?>"></script>
</head>

<body>
	<?php if($this->session->flashdata('success')): ?>
		<script>
				toastr.success("<?= $this->session->flashdata('success'); ?>");
		</script>
	<?php endif; ?>
    <div class="wrapper">
        <a href="/dashboard"><img src="<?= base_url('../assets/images/organic_shop_logo_large.svg') ?>" alt="Organic Shop"></a>
		

		<?php echo form_open('users/login', ['class' => 'login_form', 'id' => 'login_form']);?>
		
            <h2>Login to order.</h2>
            <a href="<?= base_url('signup')?>">New Member? Register here.</a>
            <ul>
                <li>
                    <input type="text" name="email">
                    <label>Email</label>

					<?php if (form_error('email')):?>
						<div class="error-message">
							<?php echo form_error('email') ?>
						</div>
					<?php endif; ?>
                </li>
                <li>
                    <input type="password" name="password">
                    <label>Password</label>

					<?php if (form_error('password')):?>
						<div class="error-message">
							<?php echo form_error('password') ?>
						</div>
					<?php endif; ?>

                </li>
            </ul>
            <button type="submit" class="login_btn">Login</button>

            <input type="hidden" name="action" value="login">
        </form>
    </div>
</body>
</html>
