<?php
$detail_kontak = isset($detail_kontak) ? $detail_kontak : FALSE;
?>

<section id="content">
    <div class="container">
        <div id="main">
            <?php if ($detail_kontak): ?>
                <div class="row">
                    <!--<div class="col-sm-4 col-md-3">-->
                    <div class="col-sm-12 col-md-12">
                        <div class="travelo-box contact-us-box">
                            <h4>Kontak</h4>
                            <ul class="contact-address">
                                <li class="address">
                                    <i class="soap-icon-address circle"></i>
                                    <h5 class="title">Alamat</h5>
                                    <p><?php echo beautify_str($detail_kontak->alamat); ?></p>
                                </li>
                                <li class="phone">
                                    <i class="soap-icon-phone circle"></i>
                                    <h5 class="title">Telepon</h5>
                                    <p><?php echo beautify_str($detail_kontak->telepon); ?></p>
                                </li>
                                <li class="email">
                                    <i class="soap-icon-message circle"></i>
                                    <h5 class="title">Email</h5>
                                    <p><?php echo beautify_str($detail_kontak->email); ?></p>
                                </li>
                            </ul>
                            <?php /*
                            <ul class="social-icons full-width">
                                <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="soap-icon-twitter"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="GooglePlus"><i class="soap-icon-googleplus"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="soap-icon-facebook"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Linkedin"><i class="soap-icon-linkedin"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Vimeo"><i class="soap-icon-vimeo"></i></a></li>
                            </ul>
                             * 
                             */
                            ?>
                        </div>
                    </div>
                    <!--<div class="col-sm-8 col-md-9">-->
                    <!--<div class="travelo-box">-->
                    <!--<div id="kosan-map" class="block"></div>-->
                    <!--</div>-->
                    <!--</div>-->
                </div>
            <?php else: ?>
                <div class="row">
                    <!--<div class="col-sm-4 col-md-3">-->
                    <div class="col-sm-12 col-md-12">
                        
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>