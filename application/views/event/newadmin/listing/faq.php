
<section id="main-content">
 <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> FAQ
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table privecy-content-table">
                            <div class="clearfix">
                             
                            </div>

                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <?php
                if (!empty($faq)) {
                    $n = 1;
                    foreach ($faq as $value) {
                        ?>
                                <tr class="">
									<td><?php echo $n; ?></td>
                                    <td><?php echo $value->faq; ?> </td>
                                    <td><a href="<?php echo site_url('admin/edit_faq') . '/' . $value->faq_id; ?>" class="btn btn-info btn-xs"> Edit </a></td>
                                </tr>
								 <?php $n = $n + 1;
    }
} ?>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
</section>
<!--main content end-->
