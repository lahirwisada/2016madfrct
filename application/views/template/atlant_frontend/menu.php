<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
/**
  <ul class="navigation">
  <li>
  <a href="#">Home</a>
  <ul>
  <li><a href="index.html">With Slider</a></li>
  <li><a href="index-default.html">Default</a></li>
  </ul>
  </li>
  <li>
  <a href="#">Pages</a>
  <ul>
  <li><a href="about-us.html">About Us</a></li>
  <li><a href="contacts.html">Contacts</a></li>
  <li><a href="pricing.html">Pricing</a></li>
  </ul>
  </li>
  <li>
  <a href="#">Blog</a>
  <ul>
  <li><a href="blog-grid.html">Blog Grid</a></li>
  <li><a href="blog-post.html">Blog Post</a></li>
  </ul>
  </li>
  <li>
  <a href="#">Portfolio</a>
  <ul>
  <li><a href="portfolio-with-title.html">Portfolio With Title</a></li>
  <li><a href="portfolio-2column.html">Portfolio 2 Column</a></li>
  <li><a href="portfolio-3column.html">Portfolio 3 Column</a></li>
  <li><a href="portfolio-4column.html">Portfolio 4 Column</a></li>
  </ul>
  </li>
  <li><a href="../html/index.html">Admin Template</a></li>
  </ul>
 */
?>
<ul class="navigation">
    <li>
        <a href="<?php echo base_url(); ?>">Home</a>
        <ul>
            <li><a href="<?php echo base_url('back_end/home'); ?>">Kelola Diklat</a></li>
        </ul>
    </li>
    <li>
        <?php if ($is_authenticated): ?>
            <a href="<?php echo base_url('front_end/cfpns/logout'); ?>">Keluar (Sign Out)</a>
            <ul>
                <li><a href="<?php echo base_url('front_end/cfpns/index'); ?>">Profil</a></li>
            </ul>
        <?php else: ?>
            <a href="<?php echo base_url('front_end/cfpns/login'); ?>">Masuk (Sign In)</a>
        <?php endif; ?>
    </li>
</ul>