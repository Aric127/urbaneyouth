<?php if ($this->session->flashdata('status')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('status'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
            Terms & Conditions
        </div>
        <!-- <div class="panel-options">
            <a href="<?php echo site_url('admin/add_about_content'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
                Add Content
            </a> 
        </div> -->
    </div>

    <div id="user_list" class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-1").dataTable({
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
            });
        </script>

        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S. No.</th>
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
                        <tr>
                            <td style="width: 10%"><?php echo $n; ?></td>
                            <td><?php echo $value->faq; ?></td>
                            <td style="width: 25%">

      

                                <a href="<?php echo site_url('admin/edit_faq') . '/' . $value->faq_id; ?>" class="" ><i class="fa-pencil icon-blue"></i>
                                    &nbsp;
                                    <!-- <?php if ($status == 1) { ?>
                                        <a href="<?php echo site_url('admin/change_status') . '/about_us_id/' . $value->about_us_id; ?>/about_us/about_us_status/2/about_us" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                    <?php } elseif ($status == 2) { ?>
                                        <a href="<?php echo site_url('admin/change_status') . '/about_us_id/' . $value->about_us_id; ?>/about_us/about_us_status/1/about_us" class="btn btn-warning btn-sm btn-icon icon-left">Inactive</a>
        <?php } ?>
                                    <a onClick="if (!confirm('Are you sure, You want delete this content?')) {
                                                return false;
                                            }" href="<?php echo site_url('admin/delete') . '/delete_about_us/about_us/about_us_id/' . $value->about_us_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a> -->
                            </td>
                        </tr>
        <?php $n = $n + 1;
    }
} ?>
            </tbody>
        </table>

    </div>

</div>