<?php
echo load_partial("shared/role_define");
?>
<aside class="widget">
    <ul>
        <?php if(!is_administrator_or_pengembang($const_role_administrator, $const_role_pengembang, $current_role)): ?>
        <li class="cat-item">
            <a href="<?php echo base_url("front_end/member/asdeveloper"); ?>">Menjadi Pengembang</a>
        </li>
        <?php endif; ?>
        <?php if(is_administrator_or_pengembang($const_role_administrator, $const_role_pengembang, $current_role)): ?>
        <li class="cat-item">
            <a href="<?php echo base_url("front_end/etalase/kelola"); ?>">Kelola Aplikasi</a>
        </li>
        <?php endif; ?>
    </ul>
</aside>