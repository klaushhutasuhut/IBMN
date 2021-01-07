<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt="" style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                <img src="<?php echo base_url("assets/image/img-01.webp") ?>" alt="IMG" />
            </div>
            <form method="POST" action="<?= base_url('auth/changepassword'); ?>" class="login100-form validate-form">
                <span class="login100-form-title">Ganti password for <?= $this->session->userdata('reset_email'); ?></span>
                <div class="wrap-input100 validate-input" data-validate="Isi password">
                    <input class="input100" type="password" name="pass1" placeholder="Password Baru" />
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Isi password">
                    <input class="input100" type="password" name="pass2" placeholder="Ketik ulang password baru" />
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">Ganti password</button>
                </div>
                <div class="text-center p-t-12">
                </div>
                <div class="text-center p-t-136"></div>
            </form>
        </div>
    </div>
</div