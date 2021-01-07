<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Pengaturan Menu<small></small></h3>
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <div class="flash-gagal" data-flashgg="<?= $this->session->flashdata('gagal'); ?>"></div>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="form-group pull-right">
                        <a href="peminjaman_inventaris_add.html" class="btn btn-primary btn-sm" role="button" data-toggle="modal" data-target="#newMenuModal"><i class="fa fa-plus-square fa-fw"></i></a>
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
                                                <th>#</th>
                                                <th>Menu</th>
                                                <th>Icon</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $row) : ?>
                                                <tr>

                                                    <td scope="row"><?= $i; ?></td>
                                                    <td><?= $row['menu'] ?></td>
                                                    <td><i class="<?= $row['icon'] ?>"></i> <?= $row['icon'] ?></td>
                                                    <td>
                                                        <a href="" data-toggle="modal" data-target="#newEditMenuModal" id="editmenu" data-idmenu="<?= $row['id']; ?>" data-nmmenu="<?= $row['menu']; ?>" data-icon="<?= $row['icon']; ?>" class="btn btn-info btn-sm" role="button"><i class="fa fa-edit"></i></a>

                                                        <a class="btn btn-danger btn-sm tombol-hapus" href="<?= base_url(); ?>menu/deletemenu/<?= $row['id']; ?>" role="button"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/addmenu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="icon" name="icon">
                            <option value="">Pilih Icon</option>
                            <option value="fa fa-user">fa fa-user</option>
                            <option value="fa fa-edit">fa fa-edit</option>
                        </select>
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

<div class="modal fade" id="newEditMenuModal" tabindex="-1" aria-labelledby="newEditMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newEditMenuModalLabel">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/editmenu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_menu" name="id_menu" hidden>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nm_menu" name="nm_menu" placeholder="Nama Menu">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="mn_icon" name="mn_icon">
                            <option value="">Pilih Icon</option>
                            <option value="fa fa-user">fa fa-user</option>
                            <option value="fa fa-edit">fa fa-edit</option>
                        </select>
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