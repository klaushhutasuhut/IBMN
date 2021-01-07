<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Barang Dipinjam<small></small></h3>
                <h6>Nama: <?= $member['nama'] ?></h6>
                <h6>Jumlah: <?= $member['jum'] ?> </h6>
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <div class=" title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php
        $id = $member['id'];
        $ListBrg = $this->m_barang->getBarangMember('barang_pinjam', $id);
        ?>

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
                                                <th>Tanggal Pinjam</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($ListBrg as $row) : ?>
                                                <tr>
                                                    <td scope="row"><?= $i; ?></td>
                                                    <td><?= $row['kd_barang']; ?></td>
                                                    <td><?= $row['nama_brg']; ?></td>
                                                    <td><?= date('d F Y', $row['tgl_pinjam']); ?></td>
                                                    <td><?= $row['keterangan']; ?></td>
                                                    <td>
                                                        <?php if ($row['id_pinjam'] && $row['ijin'] == 0) : ?>
                                                            <p class="">Dalam pengecekan</p>
                                                        <?php elseif ($row['ijin'] == 0) : ?>
                                                            <a href="#" id="kembali" data-toggle="modal" data-target="#newPengembalianModal" class="btn btn-primary btn-sm" data-idpinjam="<?= $row['id']; ?>" data-userid="<?= $member['id']; ?>" data-idbarang="<?= $row['id_barang']; ?>" data-kodebrg="<?= $row['kd_barang']; ?>" data-namabrg="<?= $row['nama_brg']; ?>" data-tglpinjam="<?= date('d F Y', $row['tgl_pinjam']); ?>" data-ket="<?= $row['keterangan']; ?>">Pengembalian</a>
                                                        <?php elseif ($row['ijin'] == 1) : ?>
                                                            <p class="">Di booking</p>
                                                        <?php elseif ($row['id_pinjam'] && $row['ijin'] == 2) : ?>
                                                            <p class="">Barang tidak sesuai silahkan hubungi admin</p>
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

<!-- Modal -->
<div class="modal fade" id="newPengembalianModal" tabindex="-1" aria-labelledby="newPengembalianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPengembalianModalLabel">Pengembalian BMN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member/addpengembalian'); ?>" method="POST">
                <div class="modal-body">
                    <input type="text" id="idpinjam" name="idpinjam" class="form-control" hidden>
                    <input type="text" id="iduser" name="iduser" class="form-control" hidden>
                    <input type="text" id="idbarang" name="idbarang" class="form-control" hidden>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_barang">Kode Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="kode_barang" name="kode_barang" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_barang">Nama Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_pinjam">Tgl Pinjam <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="tgl_pinjam" name="tgl_pinjam" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="keterangan">Keterangan :</label>
                    </div>
                    <textarea id="keterangan" cols="30" rows="10" class="form-control" name="keterangan" readonly></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>