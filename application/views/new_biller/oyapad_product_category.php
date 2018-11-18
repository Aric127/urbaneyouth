      
<!-- End Navbar -->
<div class="content">
	<div class="container-fluid">
		<?php if ($this->session->flashdata('status')) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="material-icons">close</i>
			</button>
			<span>
				<b> Success - </b>
				<?php echo $this->session->flashdata('status'); ?>
			</span>
		</div>
		<?php } ?>
		<?php if ($this->session->flashdata('error')) { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="material-icons">close</i>
			</button>
			<span>
				<b> Error - </b>
				<?php echo $this->session->flashdata('error'); ?>
			</span>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary card-header-icon">
						<div class="card-icon">
							<i class="material-icons">assignment</i>
						</div>
						<h4 class="card-title">category</h4>
            <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add Category
                  </button>
					</div>
					<div class="card-body">
						<div class="toolbar">
							<!--        Here you can write extra buttons/actions for the toolbar              -->
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-no-bordered table-hover prodct" cellspacing="0" width="100%" style="width:100%">
								<thead>
									<tr>
										<th style="text-align: center;">S.No</th>
										<th style="text-align: center;">Category Name</th>
										<th style="text-align: center;">Datetime</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($oyapad_category))
            		{
            			$i=1;
            			foreach ($oyapad_category as  $value) 
            		   { ?>
									<tr>
										<td style="text-align: center;"><?php echo $i; ?></td>
											<td style="text-align: center;"><?php echo $value->p_cat_name ?></td>
											<td style="text-align: center;"><?php echo $value->p_cat_datetime ?></td>
											<td style="text-align: center;">
												<a  data-toggle="modal" data-target="#edit_product
													<?php echo $value->p_cate_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >
													<i class="material-icons">edit</i>
												</a>
												<div class="modal fade" id="edit_product
													<?php echo $value->p_cate_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															
															<div class="modal-body">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																	<i class="material-icons">clear</i>
																</button>
																<div class="card ">
																	
																	<div class="card-header card-header-rose card-header-icon">
																		<div class="card-icon">
																			<img src="
																				<?php echo base_url('biller_assets/img/add.png');?>">
																			</div>
																			<h4 class="card-title">Update Category</h4>
																		</div>
																		<form id="RegisterValidation" 
																			<?php if(!empty($oyapad_category)){ ?> action="
																			<?php echo site_url('biller/edit_oyapadcategory'); ?>"
																			<?php } else { ?> action="
																			<?php echo site_url('biller/add_oyapadcategory'); ?>"
																			<?php } ?>  method="post">
																			<div class="card-body ">
																				<div class="form-group">
																					<label for="exampleEmail" class="bmd-label-floating"> Category Name *</label>
																					<input type="text" class="form-control" name="p_cat_name"  id="p_cat_name"  value="<?php  echo $value->p_cat_name;?>" required="true">
																					</div>
																					<div class="card-footer text-right">
																						<input type="hidden" name="p_cate_id" value="<?php echo $value->p_cate_id; ?>">
																							<input type="submit" name="submit" value="Update" class="btn btn-success" >
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</td>
															</tr>
															<?php $i++; }
            		} ?>
														</tbody>
													</table>
												</div>
											</div>
											<!-- end content-->
										</div>
										<!--  end card  -->
									</div>
									<!-- end col-md-12 -->
								</div>
								<!-- end row -->
							</div>
						</div>
						<!--upload popu -->
						<style>
  #noticeModal .card-block button {
    float: left;
}
</style>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                           
                            <div class="modal-body" style="padding: 0;">
                            
                <div class="card ">
                  <div class="card-header card-header-rose card-header-icon">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                              </button>
                    <div class="card-icon">
                     <img src="<?php echo base_url('biller_assets/img/add.png');?>">
                    </div>
                    <h4 class="card-title">Add Category</h4>
                  </div>
                   <form id="RegisterValidation" action="<?php echo site_url('biller/add_oyapadcategory'); ?>"  method="post" enctype="multipart/form-data">
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Category Name *</label>
                      <input type="text" class="form-control" name="p_cat_name"  id="p_cat_name"  required="true">
                    </div>
                  
                  <div class="card-footer text-right">
                  
                <input type="submit" name="submit" value="Add" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
<style>
	.modal .modal-content{
		background-color: #fff!important;
	}
</style>