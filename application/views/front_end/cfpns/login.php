<?php
$detail = isset($detail) ? $detail : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
?>
<div class="page-content-wrap">
    <div class="page-content-holder">

        <div class="row">
            <div class="col-md-6 this-animate" data-animate="fadeInLeft">

                <div class="text-column">
                    <h4>Otentifikasi</h4>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="post" role="form">
                            <?php if ($attention_messages): ?>
                                <div class="form-group">
                                    <h4>Periksa kembali isian anda.</h4>
                                    <?php echo $attention_messages; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" style="color: black;" placeholder="Username" name="username" class="form-control" value="<?php echo isset($detail) && $detail ? $detail->username : ""; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" placeholder="Password" name="password" style="color: black;" class="form-control" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" >Masuk</button>
                                &nbsp;<a href="<?php echo base_url(); ?>">Kembali ke Beranda</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6 this-animate" data-animate="fadeInRight">
                <div class="text-column">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-column">
                            Selamat Datang di halaman Otentifikasi Aplikasi Si Dika Kota Tangerang Selatan.
                            <br />
                            Gunakan Username dan Password yang telah diberikan oleh BKPP kota Tangerang Selatan untuk melakukan otentifikasi di halaman ini.
                            <br />
                            Jika anda belum mendapatkan/lupa/kehilangan Username dan Password anda, maka anda dapat menghubungi petugas di kantor BKPP Kota Tangerang Selatan dengan membawa kartu tanda Pegawai dan NIP untuk mendapatkan Username dan Password yang baru.
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">

        </div>

    </div>
</div>