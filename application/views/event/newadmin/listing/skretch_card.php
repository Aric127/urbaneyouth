
<!--main content start-->
<section id="main-content">
 <section class="wrapper">
        <!-- page start-->
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
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">Plan List
                        <span class="pull-right">
                            <a class="btn blue-theme-btn btn-sm" type="button">
								<i class="fa fa-plus-circle"></i> Add Card </a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table skretch-table">
                            <div class="clearfix">
                               
                            </div>
                            
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Skretch Card</th>
                                    <th>Create Date</th>
                                    <th>Validity</th>
                                    <th>Amount</th>
                                    <th>Remaining User</th> 
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                 <?php if (!empty($skretch_card)) {
       
                    $n = 1;
                    foreach ($skretch_card as $value) {
                         
                        ?>
                                <tr class="">
									<td><?php echo $n; ?></td>
                                    <td><?php echo $value->skretch_card_code; ?> </td>
                                    <td><?php echo $value->skretch_card_date; ?></td>
                                    <td><?php echo $value->skretch_card_validity; ?></td>
                                    <td><?php echo $value->skretch_card_amount; ?></td>
                                    <td><?php echo $value->skretch_card_user; ?> </td>
                                    <td>
										<div class="full-btn">
											<a class="btn btn-info btn-xs" href="<?php echo site_url('admin/edit_scratch_card') . '/' . $value->skretch_card_id; ?>"  type="button">
											Edit </a>
										</div>

                                         <?php $status = $value->   skretch_card_status; ?>
                                <?php if ($status == 1) { ?>
                                <div class="full-btn">
                                <a href="<?php echo site_url('admin/change_status') . '/skretch_card_id/' . $value->skretch_card_id; ?>/skretch_card/skretch_card_status/2/skretch_card" class="btn btn-success btn-xs">&nbsp;Active&nbsp;</a>
                                </div>
                                <?php } elseif ($status == 2) { ?>
                                 <div class="full-btn">
                                <a href="<?php echo site_url('admin/change_status') . '/skretch_card_id/' . $value->skretch_card_id; ?>/skretch_card/skretch_card_status/1/skretch_card" class="btn btn-warning btn-xs">Inactive</a>
                                </div>
                                <?php } ?>
                                <div class="full-btn">
                                <a onClick="if(!confirm('Are you sure, You want delete this coupon?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_skretch_coupon/skretch_card/skretch_card_id/' . $value->skretch_card_id; ?>" class="btn btn-danger btn-xs">Delete</a>
                                </div>

										
                                    </td>
                                </tr>
								
								  <?php $n = $n + 1; } } ?>
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
