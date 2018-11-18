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
           Recharge content
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

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                  
                   
                   <th>MOBILE Recharge</th>
                   <th>TV Recharge</th>
                   <th>DATA Recharge</th>
                    <th>Electricty</th>
                    <th>Church</th>
                   <th>Bill Pay</th>
                    <th>Share App</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($recharge_content)) {
                    $n = 1;
                    foreach ($recharge_content as $value) {
                        ?>
                        <tr>
                          
                             <td><?php echo $value->mobile_recharge; ?></td>
                            <td><?php echo $value->tv_recharge; ?></td>
                             <td><?php echo $value->data_recharge; ?></td>
                      		 <td><?php echo $value->electricity_recharge; ?></td>
                      		 <td><?php echo $value->church_content; ?></td>
                             <td><?php echo $value->biller_content; ?></td>
                      		 <td><?php echo $value->share_app_content; ?></td>
                            <td style="width: 1%">

       						 <a href="<?php echo site_url('admin/edit_recharge_content') . '/' . $value->recharge_content_id; ?>" class="" ><i class="fa-pencil icon-blue"></i>
                              </td>
                        </tr>
        <?php $n = $n + 1;
    }
} ?>
            </tbody>
        </table>

    </div>

</div>