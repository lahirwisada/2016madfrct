
<?php
$using_breadcrumb = isset($using_breadcrumb) ? $using_breadcrumb : TRUE;

if ($using_breadcrumb):
    ?>
    <div class="page-content-wrap bg-light">
        <!-- page content holder -->
        <div class="page-content-holder no-padding">
            <!-- page title -->
            <div class="page-title">                            
                <h1><?php echo $page_title; ?></h1>
                <!-- breadcrumbs -->
                <?php echo load_partial('template/atlant/breadcrumb'); ?>               
                <!-- ./breadcrumbs -->
            </div>
            <!-- ./page title -->
        </div>
        <!-- ./page content holder -->
    </div>
    <!-- ./page content wrapper -->
<?php endif; ?>