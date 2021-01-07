<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cek Kelengkapan Barang Dikembalikan<small></small></h3>
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="form-group pull-right">
                        <a href="" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus-square fa-fw"></i></a>
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
                                                <th>Kode Barang</th>
                                                <th>Nama</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Cek</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php foreach ($kembali as $row) : ?>
                                                <tr>
                                                    <td><?= $row['kd_barang']; ?></td>
                                                    <td><?= $row['nama']; ?></td>
                                                    <td><?= date('d F Y', $row['tgl_pinjam']); ?></td>
                                                    <td><?= date('d F Y', $row['tgl_kembali']); ?></td>
                                                    <td>
                                                        <?php if ($row['ijin'] == 0) : ?>
                                                            <a href="" id="konfirmasi" data-toggle="modal" data-target="#newCekModal" data-kembali="<?= $row['id']; ?>" data-pinjam="<?= $row['id_pinjam']; ?>" data-kdbarang="<?= $row['kd_barang']; ?>" data-nmmember="<?= $row['nama']; ?>" data-ket="<?= $row['keterangan']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a>
                                                            <a href="<?= base_url() ?>admin/batalpengembalian/<?= $row['id_pinjam']; ?>" class="btn btn-danger btn-sm tombol-tidakcocok"><i class="fa fa-close"></i></a>
                                                        <?php elseif ($row['ijin'] == 2) : ?>
                                                            <a href="<?= base_url() ?>admin/confirmbatalkembali/<?= $row['id_barang']; ?>" class="btn btn-success btn-sm tombol-editijin"><i class="fa fa-pencil"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
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

<div class="modal fade" id="newCekModal" tabindex="-1" aria-labelledby="newCekModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCekModalLabel">Pengembalian BMN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/cekpengembalian'); ?>" method="POST">
                <div class="modal-body">
                    <input type="text" id="kembali" name="kembali" class="form-control" hidden>
                    <input type="text" id="pinjam" name="pinjam" class="form-control" hidden>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kdbarang">Kode Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="kdbarang" name="kdbarang" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmmember">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="nmmember" name="nmmember" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="ket">Keterangan :</label>
                    </div>
                    <textarea id="ket" class="form-control" cols="30" rows="10" name="ket" readonly></textarea>
                </div>
                <br />
                <div class="item form-group">
                    <div class="col col-sm-12">
                        <p>Pastikan kelengkapan barang sesuai sebelum mengonfirmasi pengembalian</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>