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
            Biller Profie Edit
        </div>
        <div class="panel-options">
            <!-- <a href="<?php echo site_url('biller/add_biller_user'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
                Add Invoice
            </a>  -->
        </div>
    </div>
<style type="text/css">
  
</style>
<div id="user_list" class="panel-body">
   <form class="add_bill" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
<div class="col-md-6">
     
        <div class="form-group">
          <label for="exampleInputEmail1">Company Name</label>
          <input type="text" class="form-control" id="biller_user_name" name="biller_user_name" class="form-control" data-validate="required" data-msg="Please Enter Invoice Name" placeholder="Company Name">
        </div>
       
        <div class="form-group">
          <label for="exampleInputEmail1">Biller Email</label>
          <input type="email" name="biller_user_email" class="form-control" data-validate="required" data-msg="Please Enter Biller Email" placeholder="Biller Email">
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1"> Biller Category</label>

          <select class="form-control">
            <option>Farewell</option>
            <option>Wedding Anniversary</option>
            <option>Birthday Event</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Registraion No</label>
          <input type="text" name="biller_user_contact_no" class="form-control" data-validate="required" placeholder="Phone" data-msg="Please Enter Registraion No">
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1"> Tin No</label>
          <input type="text" class="form-control" data-validate="required" placeholder=" Tin No" data-msg="Please Enter  Tin No" data-validate="required">
           
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Bank Name</label>
          <input type="text" name="biller_user_contact_no" class="form-control" data-validate="required" placeholder="Phone" data-msg="Please Enter Registraion No">
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Account No.</label>
          <input type="text" name="biller_user_contact_no" class="form-control" data-validate="required" placeholder="Account No." data-msg="Please Enter Account No.">
        </div>
        <div class="form-group">
          
          <button class="btn blue-theme-btn">Submit</button>
        </div>
    
</div>
<div class="col-md-6">
        
         <div class="form-group">
          <label for="exampleInputEmail1"> Profile Image</label>
          <input type="file" class="default" style="font-size: 12px;" />
        </div>
        <br>


        <div class="form-group">
          <label for="exampleInputEmail1"> Bussiness Address</label>
          <input type="text" class="form-control" data-validate="required" placeholder=" Bussiness Address" data-msg="Please Enter  Bussiness Address" data-validate="required">
          
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Phone</label>
          <input type="text" name="biller_user_contact_no" class="form-control" data-validate="required" placeholder="Phone" data-msg="Please Enter Phone">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Incorporation Date</label>
          <input type="email" name="biller_user_email" class="form-control" data-validate="required" data-msg="Please Enter Incorporation Date" placeholder="Incorporation Date">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">RC No</label>
          <input type="text" name="biller_user_contact_no" class="form-control" data-validate="required" placeholder="RC No" data-msg="Please Enter RC No">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Business Settlement Account</label>
          <input type="email" name="biller_user_email" class="form-control" data-validate="required" data-msg="Please Enter Business Settlement Account" placeholder="Business Settlement Account">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Account Holder Name </label>
          <input type="email" name="biller_user_email" class="form-control" data-validate="required" data-msg="Please Enter Account Holder Name " placeholder="Account Holder Name ">
        </div>

</div>

</form>









</div>
