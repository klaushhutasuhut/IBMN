<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Table Barang<small></small></h3>
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

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
                                                <th>Booking</th>
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
                                                        <a href="" id="booking" data-toggle="modal" data-target="#newBookingModal" class="btn btn-secondary btn-sm" data-rowid="<?= $row['id']; ?>" data-rowkd="<?= $row['kd_barang']; ?>" data-rownama="<?= $row['nama_brg']; ?>" data-rowuser="<?= $user['id']; ?>"><i class="fa fa-star"></i></a>
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

<div class="modal fade" id="newBookingModal" tabindex="-1" aria-labelledby="newBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBookingModalLabel">Booking Barang Ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member/booking'); ?>" method="POST">
                <div class="modal-body">
                    <input id="rowid" class="form-control" name="rowid" type="text" hidden>
                    <input id="rowuser" class="form-control" name="rowuser" type="text" hidden>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="rowkd">Kode Barang<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="rowkd" class="form-control" data-validate-length-range="6" data-validate-words="2" name="rowkd" type="text" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="rownm">Nama Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="rownama" class="form-control" data-validate-length-range="6" data-validate-words="2" name="rownama" type="text" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>