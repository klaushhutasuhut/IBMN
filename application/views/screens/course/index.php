<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url("assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/font-awesome/css/font-awesome.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/nprogress/nprogress.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/build/css/custom.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/iCheck/skins/flat/green.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") ?>" rel="stylesheet">
    <title><?= $title ?> </title>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?= $sidebar; ?>
            <?= $navbar; ?>
            <?= $content; ?>
            <?= $footer; ?>
        </div>
    </div>
    <script src="<?= base_url("assets/admin/vendors/jquery/dist/jquery.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/fastclick/lib/fastclick.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/nprogress/nprogress.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/validator/validator.js") ?>"></script>
    <script src="<?= base_url("assets/admin/build/js/custom.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/iCheck/icheck.min.js ") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-buttons/js/buttons.print.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-buttons/js/buttons.colVis.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/jszip/dist/jszip.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/pdfmake/build/pdfmake.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendors/pdfmake/build/vfs_fonts.js") ?>"></script>
    <script src="<?= base_url("assets/js/sweetalert/sweetalert2.all.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/myscript.js") ?>"></script>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('menu/gantiakses'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('menu/aksesuser/'); ?>" + roleId;
                }
            });
        });

        $(document).ready(function() {
            $(document).on('click', '#konfirmasi', function() {
                var Kembali = $(this).data('kembali');
                var Pinjam = $(this).data('pinjam');
                var Kode = $(this).data('kdbarang');
                var Nama = $(this).data('nmmember');
                var Ket = $(this).data('ket');

                $('#kembali').val(Kembali);
                $('#pinjam').val(Pinjam);
                $('#kdbarang').val(Kode);
                $('#nmmember').val(Nama);
                $('#ket').val(Ket);
            });
        });

        $(document).ready(function() {
            $(document).on('click', '#booking', function() {
                var idBrg = $(this).data('rowid');
                var kdBrg = $(this).data('rowkd');
                var Nama = $(this).data('rownama');
                var User = $(this).data('rowuser');

                $('#rowid').val(idBrg);
                $('#rowkd').val(kdBrg);
                $('#rownama').val(Nama);
                $('#rowuser').val(User);
            });
        });

        $(document).ready(function() {
            $(document).on('click', '#nextbook', function() {
                var idBarang = $(this).data('idbrg');
                var userEmail = $(this).data('useremail');

                $('#kdbarang').val(idBarang);
                $('#useremail').val(userEmail);
            });
        });

        $(document).ready(function() {
            $(document).on('click', '#editsubmenu', function() {
                var Id = $(this).data('idsubmenu');
                var idMenu = $(this).data('menuid');
                var Judul = $(this).data('judul');
                var Link = $(this).data('link');
                var Active = $(this).data('isactive');

                $('#idsub').val(Id);
                $('#idmenu').val(idMenu);
                $('#judul').val(Judul);
                $('#link').val(Link);
                $('#isactive').val(Active);
            });
        });

        $('.tombol-bookbatal').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Booking akan di batalkan",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });

        $('.tombol-tidakcocok').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Cek dulu barang apakah sesuai?',
                text: "Pesan pemanggilan akan di kirim",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    </script>
</body>

</html>