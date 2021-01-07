<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Profile</h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?= form_open_multipart('profile/editProfile'); ?>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <img src="<?= base_url('assets/image/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">Cari file</label>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" value="<?= $user['email']; ?>" name="email" placeholder="Email" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Nama <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input id="nama" class="form-control" value="<?= $user['nama']; ?>" name="nama" placeholder="Nama Lengkap" type="text">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">

                        <a href="<?= base_url('profile') ?>" class="btn btn-danger btn-sm" type="reset"><i class="fa fa-mail-reply"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-mail-forward"></i> Simpan</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>