<?php
include_once 'Layout_User/H_User.php';
require_once 'Koneksi.php';
?>
    <div class="container">
    <br><br><br><br><br><br>
    <!-- alert -->
    <div class="col-xl-12 col-md-6 mb-4">
        <div class="alert alert-danger">
            Jadwal belum aktif.
        </div>
    </div>
    <!-- /alert -->

    <!-- <script> alert('Data tidak ditemukan') </script>; -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
    <script>
        var sound = new Howl({
        src: ['suara/Jadwal_belum_aktif.mp3'],
        volume: 0.5,
        onend: function () {
        window.location='Beranda.php';
        }
        });
        sound.play()
    </script>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include_once 'Layout_User/F_User.php';
?>