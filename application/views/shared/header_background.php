<?php
$target_sub_page = isset($target_sub_page) ? $target_sub_page : FALSE;
$slogan = isset($slogan) ? $slogan : FALSE;
?>
<div class="line-container">
    <div class="line-page-content">
        <div id="line-home" class="line-full line-center line-parallax " data-type="background" data-speed="4" style="height: auto; background-image: url(<?php echo img("bg/background-gurita-01.jpg"); ?>);">
            <?php if ($target_sub_page): ?>
                <div class="line-scroll-btn">
                    <a href="#<?php echo $target_sub_page; ?>" class="line-reveal animated bounce">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="line-container">
    <div class="line-page-content">
        <div class="home-slogan line-home line-hello line-middle">
            <h1>Selamat datang di 
                <span>Gurita Store</span>
            </h1>
            <?php if ($slogan && $slogan != ""): ?>
                <h2><?php echo $slogan; ?></h2>
            <?php endif; ?>
        </div>
    </div>
</div>
