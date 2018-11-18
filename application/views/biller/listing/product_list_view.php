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
            <a href="<?php echo site_url('biller/add_product'); ?>" class="btn blue-theme-btn" style="color: #fff;">
                <i class="fa-plus-circle"> </i> Add product
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
                     <th>Product Code</th>
                    <th>Price(&#8358;)</th>
                    <th>Desciption</th>
                	 <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($product_details)) {
       
                    $n = 1;
                    foreach ($product_details as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->product_name; ?></td>
                             <td style="width: 10%"><?php echo $value->product_code; ?></td>
                            <td style="width: 10%"><?php echo $value->product_price; ?></td>
                            <td style="width: 35%"><?php echo $value->product_desc; ?></td>
                           
                      	   
                            
                            <td style="width: 40%">
                            <a href="<?php echo site_url('biller/edit_product') . '/' . $value->product_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a> 
                               
                       
                                 <?php $status = $value->prodcut_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/product_id/' . $value->product_id; ?>/biller_produt/prodcut_status/2/product_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/product_id/' . $value->product_id; ?>/biller_produt/prodcut_status/1/product_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?> 
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this product?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_product/biller_produt/product_id/' . $value->product_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
