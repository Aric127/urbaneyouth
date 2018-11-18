<style>
.notification-time {
  color: #999;
  font-size: 12px;
  font-style: italic;
  position: absolute;
  right: 26px;
  margin-top: 43px;
}
.sp_latest_box{
  max-height: 500px;
}
/*.dashb-img {
  background: url(<?php echo base_url(); ?>assets/images/dash-bg-img.jpg);
  margin: -15px -30px;
  background-repeat: no-repeat;
  background-size: cover;
  padding: 20px;
}*/
.dashb-img .panel{
  background:rgba(255,255,255,1);
}
.dashb-img .xe-widget strong, .dashb-img .xe-widget span {
 /* color: #fff !important;*/
}
.dashb-img .panel .panel-heading {
  color: #666;
}
.dashb-img .green-bg {
 /* background: rgba(218, 246, 206, 0.2);*/
  color: #666;
}
.dashb-img .orange-bg {
  /*background: rgba(246, 137, 40, 0.2);*/
  color: #666;
}
.dashb-img .blue-bg {
  /*background: rgba(175, 246, 252, 0.2);*/
  color: #666;
}
.dashb-img .pink-bg {
  /*background: rgba(251, 174, 203, 0.2);*/
  color: #666;
}






</style>

<div class="dashb-img">







<?php $cat=$biller_details[0]->category;?>
<div class="row">
         <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue green-bg" data-count=".num" data-from="1" data-to="<?php if($cat=='2'){ echo $church_area; }else if($cat=='1'){  echo $bill_user; }else if($cat=='3'){  echo $event_count[0]->total_event; } ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i> <img src="<?php echo base_url('assets/images/consumer.png'); ?>" /></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px"> <?php if($cat=='2'){ echo "Total Branches" ; }else if($cat=='1'){  echo "Total Consumer"; }else if($cat=='3'){  echo "Total Events"; }?> </span>
                   </div>
               </div>
           </div>
         <?php if($cat=='3')
         { ?>
         		  <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue green-bg" data-count=".num" data-from="1" data-to="<?php echo $past_event[0]->past_event; ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="linecons-user"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Past Events </span>
                   </div>
               </div>
           </div>
           <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue green-bg" data-count=".num" data-from="1" data-to="<?php echo $start_event[0]->start_event; ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="linecons-user"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Start Events </span>
                   </div>
               </div>
           </div>
           <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue green-bg" data-count=".num" data-from="1" data-to="<?php echo $upcoming_event[0]->upcoming_event; ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="linecons-user"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px"> Upcoming Events</span>
                   </div>
               </div>
           </div>
         <?php	} ?>
		<div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue orange-bg" data-count=".num" data-from="1" data-to="<?php if($cat=='2'){ echo $domation_amount[0]->total_donation ; }else if($cat=='1'){ echo $Bill_amount[0]->total_donation; }else if($cat=='3'){ echo $event_user[0]->event_user; }?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i> <img src="<?php echo base_url('assets/images/paid.png'); ?>" /></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px"><?php  if($cat=='2'){ echo "Donation Amount(₦)" ; }elseif($cat=='1'){ echo "Paid Bill(₦)"; }elseif($cat=='3'){ echo "Users"; }?></span>
                   </div>
               </div>
           </div>
        <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue blue-bg" data-count=".num" data-from="1" data-to="<?php if($cat=='2'){ echo $donate_transaction ; }else if($cat=='3'){ echo $Booking_amount[0]->total_booking; }else if($cat=='1'){ echo $Bill_amount[0]->total_trans; }?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-exchange"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Transactions</span>
                   </div>
               </div>
           </div>
               <?php if($cat=='3'){?>
    
            <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue purple-bg" data-count=".num" data-from="1" data-to="<?php if($cat=='3'){ echo $sold_ticket[0]->total_sold ; }?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="linecons-user"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Sold Tickets</span>
                   </div>
               </div>
           </div>
           <?php } ?>
             <?php if($cat!='3'){?>
        <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue pink-bg" data-count=".num" data-from="1" data-to="<?php if(!empty($donate_user)){ echo count($donate_user) ; }else{ echo $bill_pending; }?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i> <img src="<?php echo base_url('assets/images/pending.png'); ?>" /></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px"><?php if(!empty($donate_user)){ echo "Donate User" ; }else{ echo "Pending Bill Users";}?> </span>
                   </div>
               </div>
           </div>
           <?php } ?>
          <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue pich-bg" data-count=".num" data-from="1" data-to="<?php if(!empty($settlement_amount)){ echo $settlement_amount ; }?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-money"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Settlement Amount </span>
                   </div>
               </div>
           </div>
            <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue red-bg" data-count=".num" data-from="1" data-to="<?php if(!empty($settlement_count)){ echo $settlement_count ; }?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                         <i> <img src="<?php echo base_url('assets/images/sat_tran.png'); ?>" /></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Settlement Transaction</span>
                   </div>
               </div>
           </div>
   </div>
  
<div class="row">
	<div class="col-sm-6"> 
      <div class="panel panel-default sp_latest_box">
         <div class="panel-heading">
             <h3 class="panel-title">Latest Transaction </h3>
         </div>
         <div class="panel-body dashboard-alert">
         <?php if(!empty($donate_trans)){
          foreach ($donate_trans as  $value) { ?>
             <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $value->donate_datetime ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> 
                            <h5><?php echo $value->username ?> </h5>
              <p>Conatct No:<?php echo $value->user_contact." (".$value->useremail.")" ?></p>
              <p>Branch:<?php echo $value->branch_area; ?></p>           
            </a></span> </li>
                        
                    </ul>
                </div>
            </div>
         <?php }
          } ?>
          <?php if(!empty($biller_trans)){
          foreach ($biller_trans as  $value) { ?>
             <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $value->bill_pay_date ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> 
                            <h5><?php echo $value->username ?> </h5>
              <p>Invoice No:<?php echo $value->bill_invoice_no; ?></p>
              <p>Bill Amount:<?php echo " "."₦".$value->bill_amount; ?></p>           
            </a></span> </li>
                        
                    </ul>
                </div>
            </div>
         <?php }
          } ?>
         <?php if(!empty($event_trans)){
          foreach ($event_trans as  $value) { ?>
             <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $value->transaction_date ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> 
                            <h5><?php echo $value->user_name."( ".$value->user_email.")" ?> </h5>
              				<p>Event Name:<?php echo $value->event_name; ?></p>
              				<p>Transaction Amount:<?php echo " ".$value->booking_ticket_price."₦"; ?></p> 
              				<p>Transaction ID:<?php echo " ".$value->transaction_id; ?></p>           
            </a></span> </li>
                        
                    </ul>
                </div>
            </div>
         <?php }
          } ?>   
           
      </div>
    </div>
</div>
<div class="col-sm-6"> 
      <div class="panel panel-default sp_latest_box">
         <div class="panel-heading">
             <h3 class="panel-title"><?php if(!empty($donate_user)){ ?> Users <?php }else if(!empty($billerUSER)){ ?> Latest Invoice <?php }else if(!empty($event_user)){ ?> Latest Booking User <?php } ?></h3>
         </div>
         <div class="panel-body dashboard-alert">
         <?php if(!empty($donate_user)){
          foreach ($donate_user as  $value) { ?>
             <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $value->donate_datetime ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> 
                            <h5><?php echo $value->username ?> </h5>
                            <p>Conatct No:<?php echo $value->user_contact; ?></p>
                            <p>Conatct Email:<?php echo $value->useremail; ?></p>           
                          </a></span> </li>
                        
                    </ul>
                </div>
            </div>
         <?php }
          } ?>
           <?php if(!empty($billerUSER)){
          foreach ($billerUSER as  $value) { ?>
             <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $value->bill_invoice_date ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> 
                            <h5><?php echo $value->biller_user_name ?> </h5>
                            <p>Invoice No:<?php echo $value->bill_invoice_no; ?></p>
                            <p>Invoice Name:<?php echo $value->biller_user_name." (".$value->biller_user_email.")"; ?></p>           
                          </a></span> </li>
                        
                    </ul>
                </div>
            </div>
         <?php }
          } ?>
             <?php if(!empty($eventuser)){
          foreach ($eventuser as  $value) { ?>
             <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $value->transaction_date ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> 
                            <h5><?php echo $value->user_name."( ".$value->user_email.")" ?> </h5>
                           <p>Event Name:<?php echo $value->event_name; ?></p>
              				<p>Transaction Amount:<?php echo " ".$value->booking_ticket_price."₦"; ?></p> 
              				<p>Transaction ID:<?php echo " ".$value->transaction_id; ?></p>               
                          </a></span> </li>
                        
                    </ul>
                </div>
            </div>
         <?php }
          } ?>
           
      </div>
    </div>
</div>
</div>