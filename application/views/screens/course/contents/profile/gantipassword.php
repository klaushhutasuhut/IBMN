<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ganti Password</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form method="POST" action="<?= base_url('profile/gantipassword'); ?>">
                        <div class="x_content">
                            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                            <div class="flash-gagal" data-flashgg="<?= $this->session->flashdata('gagal'); ?>"></div>
                            <br />
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="oldpassword">Password Lama <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="oldpassword" type="password" name="oldpassword" class="form-control">
                                    <?= form_error('oldpassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="oldpassword">Password Baru <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="newpassword" type="password" name="newpassword" class="form-control">
                                    <?= form_error('newpassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="repassword">Ketik Ulang Password<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="repassword" class="form-control" name="repassword" type="password">
                                    <?= form_error('repassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <a href="<?= base_url('profile') ?>" class="btn btn-danger btn-sm" type="reset"><i class="fa fa-mail-reply"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-mail-forward"></i> Ganti Password</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>