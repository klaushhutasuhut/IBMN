<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Table User<small></small></h3>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="form-group pull-right">
                        <a href="" data-toggle="modal" data-target="#newUserModal" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i></a>
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
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Nama</th>
                                                <th>Jumlah Pinjam</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($member as $row) : ?>
                                                <tr>
                                                    <td scope="row"><?= $i; ?></td>
                                                    <td><?= $row['email']; ?></td>
                                                    <td><?= $row['nama']; ?></td>
                                                    <td><?= $row['jum']; ?></td>
                                                    <td>
                                                        <a href="" id="userdetail" data-toggle="modal" data-target="#newDetailModal" class="btn btn-secondary btn-sm" role="button" data-user="<?= $row['nama']; ?>" data-jml="<?= $row['jum']; ?>" data-email="<?= $row['email']; ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $id = $row['id'];
                                                $query = $this->m_barang->queryKodeBarang('barang_pinjam', $id);
                                                ?>
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

<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/register'); ?>" method="POST">
                <div class="modal-body">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" type="text">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="email" name="email" class="form-control">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="password" name="password1" class="form-control">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Ketik Ulang Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="password" name="password2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="select" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newDetailModal" tabindex="-1" aria-labelledby="newDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDetailModalLabel">Detail: <span id="email"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Nama :</label>
                        </div>
                        <div class="col-sm-6">
                            <p><span id="nama_user"></span></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Jumlah Pinjam :</label>
                        </div>
                        <div class="col-sm-6">
                            <p><span id="total_p"></span></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Keterangan :</label>
                        </div>
                        <div class="col-sm-6">
                            <?php foreach ($query as $detail) : ?>
                                <p><?= $detail['kd_barang']; ?> <?= date('d F Y', $detail['tgl_pinjam']); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>