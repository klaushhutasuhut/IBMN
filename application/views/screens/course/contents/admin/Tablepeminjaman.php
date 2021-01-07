<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Table Peminjaman<small></small></h3>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="form-group pull-right">
                        <a href="" data-toggle="modal" data-target="#newPinjamModal" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i></a>
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
                                                <th>Tanggal Peminjaman</th>
                                                <th>Keterangan</th>
                                                <th>Booking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($pinjam as $row) : ?>
                                                <tr>
                                                    <td scope="row"><?= $i; ?></td>
                                                    <td><?= $row['kd_barang']; ?></td>
                                                    <td><?= $row['nama_brg']; ?></td>
                                                    <td><?= date('d F Y', $row['tgl_pinjam']); ?></td>
                                                    <td><?= $row['keterangan']; ?></td>
                                                    <td>
                                                        <?php if ($row['status'] == 'Di Booking') : ?>
                                                            <a href="" id="nextbook" data-toggle="modal" data-idbrg="<?= $row['id']; ?>" data-useremail="<?= $row['id_user']; ?>" data-target="#newBookingModal" class="btn btn-success btn-sm"><i class="fa fa-book"></i></a>
                                                            <a class="btn btn-danger btn-sm tombol-bookbatal" href="<?= base_url(); ?>admin/batalbooking/<?= $row['id']; ?>"><i class="fa fa-close"></i></a>
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

<div class="modal fade" id="newPinjamModal" tabindex="-1" aria-labelledby="newPinjamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPinjamModalLabel">Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addpeminjaman'); ?>" method="POST">
                <div class="modal-body">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_brg">Kode Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" name="kode_brg">
                                <option value="">Pilih Kode Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option id="kode_brg" value="<?= $b['id']; ?>"><?= $b['kd_barang']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" id="email" name="email">
                                <option value="">Pilih Email</option>
                                <?php foreach ($userlist as $u) : ?>
                                    <option value="<?= $u['id']; ?>"><?= $u['email']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ket">Keterangan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <textarea name="ket" id="ket" cols="30" rows="10"></textarea>
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

<div class="modal fade" id="newBookingModal" tabindex="-1" aria-labelledby="newBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBookingModalLabel">Teruskan Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/terimabooking'); ?>" method="POST">
                <div class="modal-body">

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_brg">Kode Barang <span class="required">*</span>
                        </label>
                        <select class="form-control" id="kdbarang" name="kdbarang" readonly>
                            <option value="">Pilih Kode Barang</option>
                            <?php foreach ($select as $b) : ?>
                                <option value="<?= $b['id']; ?>"><?= $b['kd_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_brg">email <span class="required">*</span>
                        </label>
                        <select class="form-control" id="useremail" name="useremail" readonly>
                            <option value="">Pilih Email</option>
                            <?php foreach ($userlist as $u) : ?>
                                <option value="<?= $u['id']; ?>"><?= $u['email']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="keterangan">Keterangan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <textarea name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Booking</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>