<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php    $path="http://".$_SERVER['HTTP_HOST']."/uploads/biller_logo/"; ?>
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
<script type="text/javascript">
    function PrintDiv() {
        var divContents = $("#current_page").html();
       	var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head><title>Violet Admin</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
       
    }
</script>
<style>
	.dl-horizontal dt{text-align: left; margin-bottom:5px;}
</style>
</head>

<body bgcolor="#f1f1f1">
	  <div class="btn btn-warning pull-right" onclick="PrintDiv()">
            <i class="fa fa-print"></i> Print
        </div>
        
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;" id="current_page">
	<thead class="header">
    	<tr>
        	<td style="background:#fff; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="<?php echo base_url(); ?>assets/images/logo.png" alt="..."/></a>
            </td>
        </tr>
    </thead>
   
    <tbody style=" border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h2 style="margin-bottom:0px; color:#8162B2;">View Biller Details</h2></br>
            	<p><strong style="width:120px;">Bussiness Category :</strong> <?php echo $biller_details[0]->biller_category_name; ?></p>
            	<p><strong style="width:120px;">Biller Name :</strong> <?php echo $biller_details[0]->biller_name; ?></p>
                <p><strong>Biller Number :</strong> <?php echo $biller_details[0]-> biller_contact_no; ?></p>
                <p><strong>Biller Email :</strong> <?php echo $biller_details[0]->biller_email; ?></p>
              <p><strong>Bussiness Address :</strong> <?php echo $biller_details[0]->biller_address; ?></p>
              
                <p><strong>Registered Date:</strong> <?php echo date('d-m-Y h:i:s', strtotime($biller_details[0]->biller_created_date)); ?></p>
                
              
          
              <p><strong>Registraion No :</strong> <?php echo $biller_details[0]->company_reg_no; ?></p>  
               <p><strong>RC No :</strong> <?php echo $biller_details[0]->rc_no; ?></p>  
      			<p><strong>Tin No :</strong> <?php echo $biller_details[0]->tin_no; ?></p> 
                
                </br>
                    <p><strong>Bussiness Logo :</strong><img src="<?php echo biller_company_logo."/".$biller_details[0]->biller_company_logo; ?>" height="150" width="150"></p>
                </td>
            </td>
        </tr>
     
        
        <tr>
        	<td style="background:#ddd; height:1px; width:100%;"></td>
        </tr>
    </tbody>
    
    <tfoot style="background:#fff; text-align:center; color:#333;">
    	<tr>
        	<td style="color:#666;"><p>Recharge Panel</p></td>
        <tr>
        <tr>
        	<td style="color:#666;"><p>Copyright © 2016 Recharge</p></td>
        <tr>
    </tfoot>
    
</table>
</body>
</html>