<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Pengaturan Akses Menu<small></small></h3>
                <h5>Jabatan : <?= $akses['role']; ?></h5>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="form-group pull-right">
                        <a href="<?= base_url('menu/aksesmenu') ?>" class="btn btn-danger btn-sm" type="reset"><i class="fa fa-mail-reply"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Menu</th>
                                                <th scope="col">Akses</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $row) : ?>
                                                <tr>
                                                    <td scope="row"><?= $i; ?></td>
                                                    <td><?= $row['menu'] ?></td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" <?= cek_akses($akses['id'], $row['id']); ?> data-menu="<?= $row['id']; ?>" data-role="<?= $akses['id']; ?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>