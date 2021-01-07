<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profile</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col col-sm-6">
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="<?= base_url('assets/image/') . $user['image']; ?>" class="card-img" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                                                    <p class="card-text"><?= $user['email']; ?></p>
                                                    <p class="card-text"><small class="text-muted">Bergabung sejak <?= date('d F Y', $user['date_create']); ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="ln_solid"></div>

                                    <div class="row justify-content-md-center">
                                        <a class="btn btn-success btn-sm" href="<?= base_url('profile/editprofile'); ?>"><i class="fa fa-edit"></i> Edit Profile</a>
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('profile/gantipassword'); ?>"><i class="fa fa-lock"></i> Ganti Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>