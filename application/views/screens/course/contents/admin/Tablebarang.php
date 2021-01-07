<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Table Barang<small></small></h3>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="form-group pull-right">
                        <a href="" data-toggle="modal" data-target="#newBarangModal" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i></a>
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
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($barang as $row) : ?>
                                                <tr>
                                                    <td scope="row"><?= $i; ?></td>
                                                    <td><?= $row['kd_barang']; ?></td>
                                                    <td><?= $row['nama_brg']; ?></td>
                                                    <td><?= $row['status']; ?></td>
                                                    <td>
                                                        <?php if ($row['status'] == 'Tersedia') : ?>
                                                            <button disabled="disabled" class="btn btn-secondary btn-sm" role="button"><i class="fa fa-eye"></i> </button>
                                                        <?php elseif ($row['status'] == 'Di Booking') : ?>
                                                            <button disabled="disabled" class="btn btn-secondary btn-sm" role="button"><i class="fa fa-eye"></i> </button>
                                                        <?php elseif ($row['status'] == 'Di Pinjam') : ?>
                                                            <a href="" id="setdetail" data-toggle="modal" data-target="#newDetailModal" class="btn btn-secondary btn-sm" role="button" data-kdbrg="<?= $row['kd_barang']; ?>" data-nmbrg="<?= $row['nama_brg']; ?>" data-status="<?= $row['status']; ?>" data-nama="<?= $row['nama']; ?>" data-tanggal="Pada Tanggal <?= date('d F Y', $row['tgl_pinjam']); ?>"><i class="fa fa-eye"></i></a>
                                                        <?php endif; ?>
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

<div class="modal fade" id="newBarangModal" tabindex="-1" aria-labelledby="newBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBarangModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addbarang'); ?>" method="POST">
                <div class="modal-body">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_brg">Kode Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="kode_brg" class="form-control" data-validate-length-range="6" data-validate-words="2" name="kode_brg" type="text">
                            <?= form_error('kode_brg', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_brg">Nama Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" name="nama_brg" class="form-control">
                            <?= form_error('nama_brg', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newDetailModal" tabindex="-1" aria-labelledby="newDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDetailModalLabel">Detail: <span id="k_brg"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Kode Barang :</label>
                        </div>
                        <div class="col-sm-6">
                            <p><span id="kd_brg"></span></p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Nama Barang :</label>
                        </div>
                        <div class="col-sm-6">
                            <p><span id="nama_brg"></span></p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Status :</label>
                        </div>
                        <div class="col-md-6">
                            <p><span id="status"></span></p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col col-sm-3">
                            <label>Keterangan :</label>
                        </div>
                        <div class="col-sm-6">
                            <p><span id="nama"></span> <br /> <span id="tanggal"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>