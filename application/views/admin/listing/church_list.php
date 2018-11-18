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
            Church List
        </div>
        <div class="panel-options">
           <!-- <a href="<?php echo site_url('admin/add_biller'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
                Add church
           </a> -->
        </div>
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
                    <th>SNo.</th>
                     <th>Church Type</th>
                    <th>Church Name</th>
                     <th>Church City</th>
                    <th>Product</th>
                    <th>Image</th>
                   
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($church_list)) {
      
                    $n = 1;
                    foreach ($church_list as $value) { ?>
            
                        <tr>
                            <td style="width: 8%"><?php echo $n; ?></td>
                              <td style="width: 25%"><?php echo $value->biller_category_name; ?></td>
                             <td style="width: 25%"><?php echo $value->church_name; ?></td>
                                 <td style="width: 25%"><?php echo $value->church_city; ?></td>
                            <td style="width: 25%"><?php echo $value->church_product_name ; ?></td>
                           <td style="width: 15%"><img src="<?php echo church_image.'/'.$value->church_img; ?>" height="90" width="90"></td>
                      	   
                            
                           
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
