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
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
         Add Sattlement
       </div>
    </div>
        
    <div class="panel-body">
        <form action="<?php echo base_url('admin/biller_sattlement'); ?>" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
     		      <div class="form-group">
                <label class="control-label">Select Biller</label>
                <select class=" form-control" id="biller_id" name="biller_id" data-validate="required" data-msg="Please Select Category" placeholder="" onchange="get_biller_details(this.value)">
                                	<option value="">Select Biller</option>
                             <?php foreach ($biller_list as $value) { ?>
                                    <option value="<?php if (!empty($value ->biller_id)) {
                                    echo $value ->biller_id; 
                                }?>" >
                                  <?php echo $value ->biller_name; ?>
                                    
                                  </option><?php } ?> 
              </select>
            </div>
     		   
             <div class="form-group">
                <label class="control-label">Wallet Amount</label>
                <input type="text" id="wallet_amount" name="wallet_amount" value="" class="form-control" readonly="readonly" />
                <span id="error_msg"></span>
            </div>
         <div class="form-group">
                <label class="control-label">Minimum Withdraw Amount</label>
                <input type="text" id="minimum_withdraw_amount" name="minimum_withdraw_amount" value="" class="form-control" readonly="readonly" />
            </div>
            <div class="form-group">
                <label class="control-label">Settlement Amount</label>
                <input type="text" id="settlement_amount" onblur="check_amount(this.value)" name="settlement_amount" value="" class="form-control" data-validate="required" placeholder="Amount" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                 <span id="walleterror_msg"></span>
            </div>
             <div class="form-group">
                <label class="control-label">Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" value="" class="form-control"  readonly="readonly" />
                <input type="hidden" name="bank_code" id="bank_code" value="" readonly="readonly">
            </div>
              <div class="form-group">
                <label class="control-label">Account Number</label>
                <input type="text" name="bank_account_no" id="bank_account_no" value="" class="form-control"  readonly="readonly" />
            </div>
             <div class="form-group">
                <label class="control-label">Account Holder Name</label>
                <input type="text" name="bank_account_holder" id="bank_account_holder" value="" class="form-control"  readonly="readonly" />
            </div>
          

          <br>
            <div class="form-group">
                
                <input type="button" id="submit" name="submit" value="Transfer" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
  function check_amount(amount)
  {
    var wallet_amount = $("#wallet_amount").val();
    if(amount<=wallet_amount && amount>=5100)
    {
      $("#submit").attr('type', 'submit');
    }else{
       $("#walleterror_msg").css('color','red');
       $("#walleterror_msg").text('Wallet amount is sufficent to transfer amount from wallet to bank');
       $("#submit").attr('type', 'button');
    }
  }
  function get_biller_details(biller_id)
  {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('admin/biller_details_satelemnt'); ?>",
      data: {'id':biller_id},
      cache: false,
      success: function(result){
      var obj = JSON.parse(result);
      $("#wallet_amount").val(obj.wallet_amount);
      $("#minimum_withdraw_amount").val(obj.minimum_withdraw_amount);
      $("#bank_name").val(obj.bank_name);
      $("#bank_code").val(obj.bank_code);
      $("#bank_account_no").val(obj.bank_account_no);
      $("#bank_account_holder").val(obj.bank_account_holder);
      
      if((obj.wallet_amount>=obj.minimum_withdraw_amount) && (obj.wallet_amount>5100))
      {
        $("#submit").attr('type', 'submit');
      }else{
        $("#error_msg").css('color','red');
        $("#error_msg").text('Minimum Amount 5100 is required to transfer wallet to bank');
         $("#submit").attr('type', 'button');
      }
      }
  });
  }
</script>