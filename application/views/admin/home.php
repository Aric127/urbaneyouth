<style>
.notification-time {
  color: #999;
  font-size: 12px;
  font-style: italic;
  position: absolute;
  right: 26px;
  margin-top: 43px;
}
.sp_latest_box {
  max-height: 500px;
  overflow-y: scroll;
}
</style>

<!-- 	<div class="panel-heading"> OyaCharge Management </div> -->
	<div class="row">
		<div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue green-bg" data-count=".num" data-from="1" data-to="<?php echo $admin_wallet[0]->admin_wallet;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="icon-wallet"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Wallet</span>
                   </div>
               </div>
           </div>
         <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue blue-bg" data-count=".num" data-from="1" data-to="<?php echo $user_count;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-users"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Total User</span>
                   </div>
               </div>
           </div>
           <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue orange-bg" data-count=".num" data-from="1" data-to="<?php  echo $website;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="icon-globe"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Website Users</span>
                   </div>
               </div>
           </div>
            <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue pink-bg" data-count=".num" data-from="1" data-to="<?php  echo $Android;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-android"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Android Users</span>
                   </div>
               </div>
           </div>
            <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue yellow-bg" data-count=".num" data-from="1" data-to="<?php  echo $Iphone;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-apple"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">IPhone Users</span>
                   </div>
               </div>
           </div>
		<div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue red-bg" data-count=".num" data-from="1" data-to="<?php echo $balence_caricon_api;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-gavel"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Caricorn</span>
                   </div>
               </div>
           </div>
         
		<div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue purple-bg" data-count=".num" data-from="1" data-to="<?php echo $wallet_amount[0]->wallet_amount;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                       <i class="icon-wallet"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">User Wallet</span>
                   </div>
               </div>
           </div>
         <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue cream-bg" data-count=".num" data-from="1" data-to="<?php echo $oyacash_transaction[0]->oyacash_trans;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-exchange"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">OyaCash Transaction</span>
                   </div>
               </div>
           </div>
           <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue pich-bg" data-count=".num" data-from="1" data-to="<?php echo $kongapay_transaction[0]->kongapay_transaction;?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-money"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Money Way</span>
                   </div>
               </div>
           </div>
		      <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue gray-bg" data-count=".num" data-from="1" data-to="<?php echo $event_merchent; ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="icon-event icons"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Merchant Events </span>
                   </div>
               </div>
           </div>
           <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue green-bg" data-count=".num" data-from="1" data-to="<?php echo $biller_merchent; ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="fa fa-bullhorn"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Merchant Billers </span>
                   </div>
               </div>
           </div>
           <div class="col-sm-3">
              <div class="xe-widget xe-counter xe-counter-blue blue-bg" data-count=".num" data-from="1" data-to="<?php echo $church_merchent; ?>" data-suffix="" data-duration="1" data-easing="false">
                   <div class="xe-icon">
                        <i class="linecons-user"></i>
                   </div>
                   <div class="xe-label">
                       <strong class="num">1</strong>
                              <span style="font-size: 12px">Merchant Church  </span>
                   </div>
               </div>
           </div>
         
 </div>
 
 <div class="row">
    <div class="col-sm-6"> 
      <div class="panel panel-default sp_latest_box">
         <div class="panel-heading">
             <h3 class="panel-title">Latest Users </h3>
         </div>
         <div class="panel-body dashboard-alert">
         <?php if(!empty($letest_user))
         {
          foreach ($letest_user as $value) {
            $cur_time   = time();
            $usertime=$value->user_created_date;
 $time_elapsed   = $cur_time - strtotime($usertime);
$seconds  = $time_elapsed ;
$minutes  = round($time_elapsed / 60 );
$hours    = round($time_elapsed / 3600);
$days     = round($time_elapsed / 86400 );
$weeks    = round($time_elapsed / 604800);
$months   = round($time_elapsed / 2600640 );
$years    = round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
  $timeago= "$seconds seconds ago";
}
//Minutes
else if($minutes <=60){
  if($minutes==1){
     $timeago= "one minute ago";
  }
  else{
     $timeago= "$minutes minutes ago";
  }
}
//Hours
else if($hours <=24){
  if($hours==1){
     $timeago= "an hour ago";
  }else{
     $timeago= "$hours hours ago";
  }
}
//Days
else if($days <= 7){
  if($days==1){
     $timeago= "yesterday";
  }else{
     $timeago= "$days days ago";
  }
}
//Weeks
else if($weeks <= 4.3){
  if($weeks==1){
     $timeago= "a week ago";
  }else{
     $timeago= "$weeks weeks ago";
  }
}
//Months
else if($months <=12){
  if($months==1){
     $timeago= "a month ago";
  }else{
     $timeago= "$months months ago";
  }
}
//Years
else{
  if($years==1){
     $timeago= "one year ago";
  }else{
     $timeago= "$years years ago";
  }
}
           ?>
           <div class="alert alert-success clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender"><span><a href="#"> 
                          <h5><?php echo $value->user_name; ?> </h5>
              <p>Mobile no.:<?php echo $value->user_contact_no; ?></p>
              <p>Email ID:<?php echo $value->user_email; ?></p>           
            </a></span> </li>
                        <li class="pull-right notification-time"><?php echo $timeago; ?></li>
                    </ul>
                </div>
            </div>
        <?php   }
          } ?>
           
           
          
           
         </div>
      </div>
    </div>
    <div class="col-sm-6"> 
      <div class="panel panel-default sp_latest_box">
         <div class="panel-heading">
             <h3 class="panel-title">Latest Transactions </h3>
         </div>
         <div class="panel-body dashboard-alert">
          <?php if(!empty($letest_trans))
         {
          foreach ($letest_trans as $value) {
            $cur_time   = time();
            $usertime=$value->wt_datetime;
 $time_elapsed   = $cur_time - strtotime($usertime);
$seconds  = $time_elapsed ;
$minutes  = round($time_elapsed / 60 );
$hours    = round($time_elapsed / 3600);
$days     = round($time_elapsed / 86400 );
$weeks    = round($time_elapsed / 604800);
$months   = round($time_elapsed / 2600640 );
$years    = round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
  $timeago= "$seconds seconds ago";
}
//Minutes
else if($minutes <=60){
  if($minutes==1){
     $timeago= "one minute ago";
  }
  else{
     $timeago= "$minutes minutes ago";
  }
}
//Hours
else if($hours <=24){
  if($hours==1){
     $timeago= "an hour ago";
  }else{
     $timeago= "$hours hours ago";
  }
}
//Days
else if($days <= 7){
  if($days==1){
     $timeago= "yesterday";
  }else{
     $timeago= "$days days ago";
  }
}
//Weeks
else if($weeks <= 4.3){
  if($weeks==1){
     $timeago= "a week ago";
  }else{
     $timeago= "$weeks weeks ago";
  }
}
//Months
else if($months <=12){
  if($months==1){
     $timeago= "a month ago";
  }else{
     $timeago= "$months months ago";
  }
}
//Years
else{
  if($years==1){
     $timeago= "one year ago";
  }else{
     $timeago= "$years years ago";
  }
}
           ?>
           <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-user"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-right notification-time"><?php echo $timeago; ?></li>
                        <li class="pull-left notification-sender"><span><a href="#"> <h5>
                        <?php if(!empty($value->user_name)) { echo $value->user_name; }else { echo $value->user_contact_no; } ?></h5>
							<p><?php echo $value->wt_desc ?> </p>
							<p><span>Transaction ID: <?php echo $value->transaction_id; ?> </span> | 
              <span>Transaction Amount: ₦<?php echo $value->wt_amount; ?> </span></p>						
						</a></span> </li>
                        
                    </ul>
                </div>
            </div>
            
            <?php   }
          } ?>
           
         </div>
      </div>
    </div>
 </div>