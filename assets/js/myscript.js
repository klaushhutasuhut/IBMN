$(document).ready(function () {
    $(document).on('click', '#kembali', function () {
        var pinjam = $(this).data('idpinjam');
        var user = $(this).data('userid');
        var idbarang = $(this).data('idbarang');
        var kode = $(this).data('kodebrg');
        var nama = $(this).data('namabrg');
        var tanggal = $(this).data('tglpinjam');
        var ket = $(this).data('ket');

        $('#idpinjam').val(pinjam);
        $('#iduser').val(user);
        $('#idbarang').val(idbarang);
        $('#kode_barang').val(kode);
        $('#nama_barang').val(nama);
        $('#tgl_pinjam').val(tanggal);
        $('#keterangan').val(ket);
    });
});

$(document).ready(function () {
    $(document).on('click', '#userdetail', function () {
        var User = $(this).data('user');
        var Total = $(this).data('jml');
        var Email = $(this).data('email');

        $('#email').text(Email);
        $('#nama_user').text(User);
        $('#total_p').text(Total);
    });
});

$(document).ready(function () {
    $(document).on('click', '#setdetail', function () {
        var kdBrg = $(this).data('kdbrg');
        var nmBrg = $(this).data('nmbrg');
        var Status = $(this).data('status');
        var nmUser = $(this).data('nama');
        var Tgl = $(this).data('tanggal');

        $('#k_brg').text(kdBrg);
        $('#kd_brg').text(kdBrg);
        $('#nama_brg').text(nmBrg);
        $('#status').text(Status);
        $('#nama').text(nmUser);
        $('#tanggal').text(Tgl);
    });
});

$(document).ready(function () {
    $(document).on('click', '#editmenu', function () {
        var Id = $(this).data('idmenu');
        var Nama = $(this).data('nmmenu');
        var Icon = $(this).data('icon');

        $('#id_menu').val(Id);
        $('#nm_menu').val(Nama);
        $('#mn_icon').val(Icon);
    });
});

const flashData = $('.flash-data').data('flashdata');
const flashError = $('.flash-gagal').data('flashgg');

if (flashData) {
    Swal.fire(
        'Berhasil',
        flashData,
        'success'
    );
}

if (flashError) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: flashError
    })
}

$('.tombol-hapus').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Data akan di hapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
});
