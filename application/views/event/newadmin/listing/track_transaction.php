
<section id="main-content">
 <section class="wrapper">
        <!-- page start-->
<?php if($this->session->flashdata('error')){ ?>
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
<?php if($this->session->flashdata('success')){ ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>
    </div>
</div>
<?php } ?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> Track Record
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="edit-contact-div">
                            <div class="form-group clearfix">
								<div class="col-sm-6">
									<label for="exampleInputEmail1"> Track Record </label>
									<!-- <input class="form-control" id="slider1heading" placeholder="Track Record" type="email"> -->

                                    <input type="text" name="transaction_id" id="transaction_id"  class="form-control" data-validate="required" placeholder="Transaction ID" value="" />

								</div>
								<div class="col-sm-6">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-12">
									<button type="button" onclick="track_transaction()"  class="btn btn-info submi">Search</button>
								</div>
							</div>
                           
						
						</div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
</section>
<script>
    function track_transaction()
    {
        var transaction_id=$("#transaction_id").val();
            if(transaction_id!='')
            {
            $.ajax({
                    url: "<?php echo site_url('admin/track_transaction') ?>",
                    type: "POST",
                    data: 
                        {
                          "transaction_id":transaction_id
                         },
                    success: function (data) 
                        {
                            if(data!='2'){
                                 $("#track_record").html(data);
                                  $("#error").html("");
                            }else{
                                $("#track_record").html('');
                                 $("#error").html("No Record Found, please enter a valid transaction id");
                            }
                          
                        }
                });
            }else
            {
                 $("#error").html("Please Enter a Transaction ID");
            } 
    }
</script>
<!--main content end-->
