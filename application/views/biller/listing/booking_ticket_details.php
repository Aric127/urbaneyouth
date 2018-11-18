<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #EEEEEE;
}
</style>
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
	  <div class="btn btn-warning pull-right" onclick="PrintDiv()">
            <i class="fa fa-print"></i> Print
        </div>

        <div class="ticket_booking_details" id="current_page">
        	<h3> <img class="pull-left" src="<?php echo base_url(); ?>assets/images/logo_1.png"><?php echo $booking_details[0]->event_name; ?></h3>

        	<div class="ticket-in-main-div">
                    
        	    <div class="trnn-dtn-id">
        	    	<span class="ids-f-tr">Transaction ID : <?php echo $booking_details[0]->transaction_id; ?></span>
        	    	<span class="date pull-right">Date : <?php echo $booking_details[0]->transaction_date; ?></span>
        	    	 
        	    </div>
        		<div class="row">
	        		<div class="col-sm-4">
	        			<div class="e-ticket-detail-box">
	        				User Name  <br>
	        				<h4>  <?php echo $booking_details[0]->user_name; ?> </h4>
	        			</div>
	        		</div>
	        		<div class="col-sm-4">
	        			<div class="e-ticket-detail-box">
	        				Contact Number  <br>
	        				<h4> <?php echo $booking_details[0]->user_contact_no; ?> </h4>
	        			</div>
	        		</div>
	        		<div class="col-sm-4">
	        			<div class="e-ticket-detail-box">
	        				Email ID  <br>
	        				<h4> <?php echo $booking_details[0]->user_email; ?> </h4>
	        			</div>
	        		</div>
        	    </div>

        	     <table class="table-small-font" style=" font-size: 12px;">
				  <tr>
				    <th>Ticket Name </th>
				    <th>Ticket No</th>
				    <th>Ticket Price</th>
                    <th>Ticket QTY</th>
                     <th>Total Price</th>
				     <th>Ticket Desc</th>
				   
				  </tr>
				   <?php $i=0;
                    foreach($ticket_details as $val)
               {    
                if($ticket_qty[$i]->booking_ticket_qty!='0'){
                ?>
				  <tr>
				    <td><?php echo $val[0]->events_tickets_name; ?></td>
				    <td><?php echo $val[0]->events_tickets_no; ?></td>
				   <td><?php echo $val[0]->events_tickets_price; ?></td>
                   <td><?php echo $ticket_qty[$i]->booking_ticket_qty; ?></td>
                    <td><?php echo $val[0]->events_tickets_price*$ticket_qty[$i]->booking_ticket_qty; ?></td>
				    <td><?php echo $val[0]->events_tickets_desc; ?></td>
				  </tr>
				 <?php } $i++;   }?>
				</table>


				<div class="transaction-amount-show">
					Transaction Amount : <span class="pull-right" style="columns: #333;"><?php echo $booking_details[0]-> booking_ticket_price; ?>/-</span>
				</div>


        	</div>
        </div>
</body>
</html>