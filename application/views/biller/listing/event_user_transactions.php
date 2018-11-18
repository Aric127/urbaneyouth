<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
        printWindow.document.write('<html><head><title>OyaCharge</title>');
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


 <div class="tranactionrecorder-main">
      
     <div class="row header-for-tranctionhis"  >
         <div class="col-sm-6 logo-intran">
             <a href="#" style="margin-left:10px;"><img width="100" src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="..."/></a>
         </div>
         <div class="col-sm-6 tital-page-intran">
            <h2>Event Ticket Transaction</h2>
         </div>
     </div>
     <div style="padding: 10px 25px;">
         <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                      
                          <div class="text-box-for-eli-inner">
                            Transaction ID : <span style="color: gray;"> <?php echo $transaction_record[0]->transaction_id; ?></span>
                          </div>
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                     <div class="text-box-for-eli-inner">
                            Transaction Status :  <span style="color: #35AC19;"> <span  <?php  if($transaction_record[0]-> wt_status=='3'){?> style="color: red" <?php }else{?> style="color: #35AC19" <?php } ?>><?php if($transaction_record[0]-> wt_status=='1'){echo "Success";}elseif($transaction_record[0]-> wt_status=='2'){echo "Pending";} elseif($transaction_record[0]-> wt_status=='3'){echo "Failed";}  ?></span> </span>
                          </div>
                 </div>
        </div>

        <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                      
                          <div class="text-box-for-eli-inner">
                           
                            <div class="e-ticket-detail-box2">
                               User Name :  <br>
                              <h4> Anurag Sharma </h4>
                            </div> 

                          </div>
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                     <div class="text-box-for-eli-inner">

                            <div class="e-ticket-detail-box2">
                              Contact Number   :  <br>
                              <h4> <?php echo $transaction_record[0]-> user_contact_no; ?> </h4>
                            </div>
                               
                    </div>
                 </div>
        </div>


         <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                          <div class="text-box-for-eli-inner">

                            <div class="e-ticket-detail-box2">
                              User Email :  <br>
                              <h4> <?php echo $transaction_record[0]->user_email; ?> </h4>
                            </div>
                               
                      </div>
                          
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                          <div class="text-box-for-eli-inner">
                            <div class="e-ticket-detail-box2">
                              Transaction Type   :   <br>
                              <h4> <?php  if($transaction_record[0]->wt_category=='16'){ echo "Event Ticket Booking"; }; ?> </h4>
                            </div>
                              
                          </div>
                 </div>
        </div>



         <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                      
                          <div class="text-box-for-eli-inner">
                             <div class="e-ticket-detail-box2">
                              Event Name :   <br>
                              <h4> <?php echo $transaction_record[0]->event_name ?> </h4>
                            </div>
                              
                          </div>
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                     <div class="text-box-for-eli-inner">
                            <div class="e-ticket-detail-box2">
                               Event Address :   <br>
                              <h4> <?php echo $transaction_record[0]->event_place ?> </h4>
                            </div>

                             
                          </div>
                 </div>
        </div>


         <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                      
                          <div class="text-box-for-eli-inner">
                             <div class="e-ticket-detail-box2">
                               Event Start :   <br>
                              <h4> <?php echo date('d-m-Y h:i:s a',strtotime($transaction_record[0]->event_date)); ?> </h4>
                            </div>
                          </div>
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                     <div class="text-box-for-eli-inner">
                            <div class="e-ticket-detail-box2">
                               Event End :   <br>
                              <h4><?php echo  date('d-m-Y h:i:s a', strtotime($transaction_record[0]->event_end_date)); ?> </h4>
                            </div>
                               
                          </div>
                 </div>
        </div>

         <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                      
                          <div class="text-box-for-eli-inner">
                            <div class="e-ticket-detail-box2">
                               Transaction Date :  <br>
                              <h4><?php echo date('d-m-Y h:i:s a', strtotime($transaction_record[0]->wt_datetime)); ?> </h4>
                            </div>
                             
                          </div>
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                     <div class="text-box-for-eli-inner">
                             <div class="e-ticket-detail-box2">
                               Transaction Number : <br>
                              <h4><?php echo $transaction_record[0]-> transaction_id; ?> </h4>
                            </div>
                               
                          </div>
                 </div>
        </div>

         <div class="row event-tra-hi-con">
                  <div class="col-sm-6">
                      <div class="text-box-for-eli">
                      
                          <div class="text-box-for-eli-inner">
                              <div class="e-ticket-detail-box2">
                                Transaction Amount : <br>
                              <h4><?php echo $transaction_record[0]-> wt_amount; ?></h4>
                            </div>
                            <span style="color: gray;"> </span>
                          </div>
                      </div>
                 </div>
                 <div class="col-sm-6 tital-page-intran">
                     <div class="text-box-for-eli-inner">
                           <div class="e-ticket-detail-box2">
                                Description : <br>
                              <h4><?php echo $transaction_record[0]-> wt_desc; ?></h4>
                            </div>
                            
                          </div>
                 </div>
        </div>

     

     <div class="print-btn-trn">
          <div class="btn btn-warning  " onclick="PrintDiv()">
            <i class="fa fa-print"></i> Print
        </div>
      </div>
     </div>
 </div>
	  
        
<!-- <table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;" id="current_page">
	<thead class="header">
    	<tr>
        	<td style="background:#fff; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="..."/></a>
            </td>
      
        </tr>
    </thead>
    <tbody style=" border-bottom:1px solid #ddd;">
     <tr>
       <td style="padding:10px 15px;">
           <h2 style="margin-bottom:0px; color:#8162B2;">Event Ticket Transaction</h2></br>
           <p><strong style="width:120px;">Transaction ID :</strong> <?php echo $transaction_record[0]->transaction_id; ?></p>
            <p><strong style="width:120px;">User Name :</strong> <?php echo $transaction_record[0]->user_name; ?></p>
            <p><strong>Contact Number :</strong> <?php echo $transaction_record[0]-> user_contact_no; ?></p>
            <p><strong>User Email :</strong> <?php echo $transaction_record[0]->user_email; ?></p>
            <p><strong>Transaction Type :</strong> <?php  if($transaction_record[0]->wt_category=='16'){ echo "Event Ticket Booking"; }; ?></p>
            <p><strong>Event Name :</strong> <?php echo $transaction_record[0]->event_name ?></p>
            <p><strong>Event Address :</strong> <?php echo $transaction_record[0]->event_place ?></p><p><strong>Event Start :</strong> <?php echo date('d-m-Y h:i:s a',strtotime($transaction_record[0]->event_date)); ?></p>
            <p><strong>Event End :</strong> <?php echo  date('d-m-Y h:i:s a', strtotime($transaction_record[0]->event_end_date)); ?></p>
            <p><strong>Transaction Date:</strong> <?php echo date('d-m-Y h:i:s a', strtotime($transaction_record[0]->wt_datetime)); ?></p>
                 <?php if($transaction_record[0]->wt_category!='3'){?>
            <p><strong>Transaction Number :</strong> <?php echo $transaction_record[0]-> transaction_id; ?></p>
                    <?php } ?>
            <p><strong>Transaction Amount :</strong> <?php echo $transaction_record[0]-> wt_amount; ?></p> 
            <p><strong>Transaction Description :</strong> <?php echo $transaction_record[0]-> wt_desc; ?></p>
            <p><strong>Transaction Status :</strong> <span  <?php  if($transaction_record[0]-> wt_status=='3'){?> style="color: red" <?php }else{?> style="color: green" <?php } ?>><?php if($transaction_record[0]-> wt_status=='1'){echo "Success";}elseif($transaction_record[0]-> wt_status=='2'){echo "Pending";} elseif($transaction_record[0]-> wt_status=='3'){echo "Failed";}  ?></span></p>
                  
                </br>
                </td>
            </td>
        </tr>
     
        
        <tr>
        	<td style="background:#ddd; height:1px; width:100%;"></td>
        </tr>
    </tbody>
    
    <tfoot style="background:#fff; text-align:center; color:#333;">
    	<tr>
        	<td style="color:#666;"><p>OyaCharge Panel</p></td>
        <tr>
        <tr>
        	<td style="color:#666;"><p>Copyright © 2016 OyaCharge</p></td>
        <tr>
    </tfoot>
    <div class="print-btn-trn">
          <div class="btn btn-warning pull-right" onclick="PrintDiv()">
            <i class="fa fa-print"></i> Print
        </div>
      </div>
</table> -->
</body>
</html>