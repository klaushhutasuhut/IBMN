<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt="" style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
				<img src="<?php echo base_url("assets/image/img-01.webp") ?>" alt="IMG" />
			</div>
			<form method="POST" action="<?= base_url('auth/login'); ?>" class="login100-form validate-form">
				<span class="login100-form-title">Member Login</span>
				<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
				<div class="flash-gagal" data-flashgg="<?= $this->session->flashdata('gagal'); ?>"></div>
				<div class="wrap-input100 validate-input" data-validate="Format email salah">
					<input class="input100" type="text" value="<?= set_value('email'); ?>" name="email" placeholder="Email" />
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Isi password">
					<input class="input100" type="password" name="pass" placeholder="Password" />
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">Login</button>
				</div>
				<div class="text-center p-t-12">
					<a class="txt2" href="<?= base_url('auth/forgotpassword'); ?>">
						Forgot Password?
					</a>
				</div>
				<div class="text-center p-t-136"></div>
			</form>
		</div>
	</div>
</div>