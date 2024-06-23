<?php 
session_start();

$koneksi = mysqli_connect('localhost','root','','kasir');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username' and password = '$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung > 0){
        $_SESSION['login'] = true;
        header('location:index.php');
    }else{
        echo '
        <script>
            alert("Username Atau Password Salah")
            window.location.href="login.php"
        </script>';
    }
}

if(isset($_POST['tambahproduk'])){
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $insert_produk = mysqli_query($koneksi,"INSERT INTO produk (nama_produk, deskripsi, harga, stock) VALUES ('$nama_produk','$deskripsi','$harga','$stock')");
    if($insert_produk){
        echo'
        <script>
            alert("Berhasil Insert Produk")
        </script>';
        header('location:stock.php');
    }else{
        echo '
        <script>
            alert("Gagal Insert Produk")
            window.location.href="stock.php"
        </script>';
    }
}

if(isset($_POST['tambahpelanggan'])){
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    $insert_pelanggan = mysqli_query($koneksi,"INSERT INTO pelanggan (nama_pelanggan, notelp, alamat) VALUES ('$nama_pelanggan','$notelp','$alamat')");
    if($insert_pelanggan){
        echo'
        <script>
            alert("Berhasil Insert Pelanggan")
        </script>';
        header('location:pelanggan.php');
    }else{
        echo '
        <script>
            alert("Gagal Insert Pelanggan")
            window.location.href="pelanggan.php"
        </script>';
    }
}

if(isset($_POST['tambahpesanan'])){
    date_default_timezone_set("Asia/Jakarta");
    $id_pelanggan = $_POST['id_pelanggan'];

    $insert_pesanan = mysqli_query($koneksi,"INSERT INTO pesanan (id_pelanggan,tgl_pesan) VALUES ('$id_pelanggan','".date("Y-m-d h:i:s")."')");
    if($insert_pesanan){
        echo'
        <script>
            alert("Berhasil Insert Pesanan")
        </script>';
        header('location:index.php');
    }else{
        echo '
        <script>
            alert("Gagal Insert Pesanan")
            window.location.href="index.php"
        </script>';
    }
}

if(isset($_POST['addProdukQuantity'])){
    $id_produk = $_POST['id_produk'];
    $qty = $_POST['qty'];
    $idp = $_POST['idp'];

    $insert = mysqli_query($koneksi,"INSERT INTO detail_pesanan (id_pesanan,id_produk,qty) VALUES ('$idp','$id_produk','$qty')");
    if($insert){
        echo'
        <script>
            alert("Berhasil Insert Detail Pesanan")
        </script>';
        header('location:view.php?idp= '. $idp);
    }else{
        echo '
        <script>
            alert("Gagal Insert Detail Pesanan")
            window.location.href="view.php"'.$idp.'
        </script>';
    }
}

?>