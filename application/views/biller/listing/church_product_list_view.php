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
            Product List
        </div>
        <div class="panel-options">
            <a href="<?php echo site_url('biller/church_add_product'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
                Add product
            </a> 
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

        <table id="example-1" class="table-small-font table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($product_details)) {
       
                    $n = 1;
                    foreach ($product_details as $value) { ?>
            
                        <tr>
                            <td style="width: 10%"><?php echo $n; ?></td>
                             <td style="width: 32%"><?php echo $value->church_product_name; ?></td>
                            
                            <td style="width: 25%"><?php echo $value->church_product_price; ?></td>
                           
                      	   
                            
                            <td style="width: 40%">
                            <a href="<?php echo site_url('biller/church_edit_product') . '/' . $value->church_product_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a> 
                               
                       
                                 <?php $status = $value->church_product_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/church_product_id/' . $value->church_product_id; ?>/biller_produt/prodcut_status/2/product_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/church_product_id/' . $value->church_product_id; ?>/biller_produt/prodcut_status/1/product_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?> 
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this product?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_product/biller_produt/church_product_id/' . $value->church_product_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
