<?php $cat=$biller_details[0]->category;?>
      <!-- End Navbar -->
      <div class="content">
        <div class="content">
           <?php if ($this->session->flashdata('success')) { ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b>  <?php echo $this->session->flashdata('success'); ?></span>
                  </div>

        <?php } ?>
          <div class="container-fluid">
             <div class="row">
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">supervisor_account</i>
                                </div>
                                <p class="card-category">Total Invoices</p>
                                <h3 class="card-title"><?php if(!empty($bill_user)){
                                  echo $bill_user;
                                }else{ echo "0"; }   ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!--<i class="material-icons text-danger">warning</i>
                                   <a href="#pablo">Get More Space...</a> -->
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">description</i>
                                </div>
                                <p class="card-category">Total Consumer</p>
                                <h3 class="card-title"> <?php if(!empty($count_consumer)){
                                  echo $count_consumer;
                                }else{ echo "0"; }   ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!-- <i class="material-icons">update</i> Just Updated -->
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">description</i> 
                                </div>
                                <p class="card-category">Total Products</p>
                                <h3 class="card-title"> <?php if(!empty($oyawallet[0]->product_count)){
                                  echo $oyawallet[0]->product_count;
                                }else{ echo "0";}   ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!-- <i class="material-icons">update</i> Just Updated -->
                                </div>
                              </div>
                            </div>
                          </div>
                         <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">description</i>
                                </div>
                                <p class="card-category">Total Balance</p>
                                <h3 class="card-title"> <?php if(!empty($oyawallet[0]->wallet_amount)){
                                  echo "₦".$oyawallet[0]->wallet_amount;
                                }else{
                                  echo "₦ 0";
                                }   ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!-- <i class="material-icons">update</i> Just Updated -->
                                </div>
                              </div>
                            </div>
                          </div> 
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon" style="background-color: #999999!important;background-image: none;">
                                  <i class="material-icons">swap_horiz</i>
                                </div>
                                <p class="card-category">All Transactions</p>
                                <h3 class="card-title"><?php if($cat=='2'){ echo $donate_transaction ; }else if($cat=='3'){ echo $Booking_amount[0]->total_booking; }else if($cat=='1'){ echo $Bill_amount[0]->total_trans; }?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!-- <i class="material-icons">date_range</i> Last 24 Hours -->
                                </div>
                              </div>
                            </div>
                          </div>
                           <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">receipt</i>
                                </div>
                                <p class="card-title"><?php echo "Paid Bill"; ?></p>
                                <h3 class="card-title"><?php echo "₦".$Bill_amount[0]->total_donation; ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                               <!--    <i class="material-icons">local_offer</i> Tracked from Google Analytics -->
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          
                           <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">description</i>
                                </div>
                                <p class="card-title">Pending Amount</p>
                                <h3 class="card-title"> <?php if(!empty($pending_amount[0]->total_pending)){
                                  echo "₦".$pending_amount[0]->total_pending;
                                }   ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!-- <i class="material-icons">update</i> Just Updated -->
                                </div>
                              </div>
                            </div>
                          </div>
                           <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">description</i>
                                </div>
                                <p class="card-title">Total Amount(₦)</p>
                                <h3 class="card-title"> <?php if(!empty($total_amount[0]->total_amount)){
                                  echo "₦".$total_amount[0]->total_amount;
                                }   ?></h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <!-- <i class="material-icons">update</i> Just Updated -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                 <div class="row second">
                          
                      <div class="col-md-6">
                            <div class="card card-chart">
                              <div class="card-header card-header-success" data-header-animation="true">
                                <!-- <div class="ct-chart" id="dailySalesChart"></div> -->

                                <div class="ct-chart"  id="chartContainer" style="height: 200px; width: 100%;"></div>
                              </div>
                           <div class="card-body">
                              <h4 class="card-title">Weekly Invoice</h4>
                           </div> 
                           </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card card-chart">
                              <div class="card-header card-header-info" data-header-animation="true">
                              <!--   <div class="ct-chart" id="completedTasksChart"></div> -->
                                <div class="ct-chart" id="chartContainer21" style="height: 200px; width: 100%;"></div>
                              </div>
                              <div class="card-body">
                              <h4 class="card-title">Invoice Transactions </h4>
                              </div>
                          </div>
                          </div>
                        </div>
                       
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                      <i class="material-icons">swap_horiz</i>
                    </div>
                    <h4 class="card-title "> Latest Transactions</h4>
                  </div>
                  <div class="card-body table-full-width table-hover">
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="">
                          <th>SNo</th>
                          <th>Transaction No</th>
                          <th>Consumer No</th>
                          <th>Consumer Name</th>
                          <th>Invoice No</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th class="disabled-sorting text-center">Action</th>
                        </thead>
                        <tbody>
                          <?php if(!empty($biller_trans)){ 
                            $i=1; 
                            foreach ($biller_trans as  $value) { ?>
                              <tr class="table-success">
                            <td style="text-align: center;"><?php echo $i; ?></td>
                            <td><?php echo $value->bill_transaction_id; ?></td>
                            <td><?php echo $value->bill_consumer_no; ?> </td>
                            <td><?php echo $value->username; ?> </td>
                            <td><?php echo $value->bill_invoice_no; ?> </td>
                            <td><?php echo "&#8358;".$value->bill_amount; ?> </td>
                            <td><?php echo $value->bill_pay_date; ?> </td>
                            <td style="text-align: center;"> 
                                <?php if($value->bill_pay_status=='1'){ ?>
                                        <a style="cursor: pointer" class="btn btn-link btn-warning btn-just-icon edit"" href="<?php echo base_url('biller/invoice_details/1/'.$value->bill_paid_invoice_no); ?>"><i class="material-icons">visibility</i></a>&nbsp;

                                <?php }else{ ?>
                                          <a style="cursor: pointer" class="btn btn-link btn-warning btn-just-icon edit"" href="<?php echo base_url('biller/invoice_details/2/'.$value->bill_invoice_no); ?>"><i class="material-icons">visibility</i></a>&nbsp;

                                <?php } ?>
                              <!-- <a style="cursor: pointer" class="btn btn-link btn-warning btn-just-icon edit"" href="<?php echo bill_invoice."/".$value->bill_paid_invoice ?>"><i class="material-icons">dvr</i></a>&nbsp;</td> -->
                          </tr>
                         <?php $i++;  }
                          } ?>
                         
                        
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>
<?php

     $date   = date("Y-m-d");
      $ts     = strtotime($date);
      $year   = date('o', $ts);
      $week   = date('W', $ts);
      $j=0;$k=0;
     for($i = 1; $i <= 7; $i++) 
     {
      $ts = strtotime($year.'W'.$week.$i);
       if ($week_invoice_count[$j]->bill_invoice_date == date("Y-m-d", $ts))
           {
           
          $week_invoice[$i-1]=$week_invoice_count[$j]->invoice_count;
          	$j++;
           }else{
          
            $week_invoice[$i-1]=0;
           }
           if ($week_invoice_amount[$k]->bill_invoice_date == date("Y-m-d", $ts))
           {
           
          $week_amount[$i-1]=$week_invoice_amount[$k]->invoice_amount;
          	$k++;
           }else{
          
            $week_amount[$i-1]=0;
           }
   } 
     

    $dataPoints=array(array("y" => $week_invoice[0], "label" => "M"),array("y" => $week_invoice[1], "label" => "T"),array("y" => $week_invoice[2], "label" => "W"),array("y" => $week_invoice[3], "label" => "T"),array("y" => $week_invoice[4], "label" => "F"),array("y" => $week_invoice[5], "label" => "S"),array("y" => $week_invoice[6], "label" => "S"));


    $dataPoints1=array(array("y" => $week_amount[0], "label" => "M"),array("y" => $week_amount[1], "label" => "T"),array("y" => $week_amount[2], "label" => "W"),array("y" => $week_amount[3], "label" => "T"),array("y" => $week_amount[4], "label" => "F"),array("y" => $week_amount[5], "label" => "S"),array("y" => $week_amount[6], "label" => "S"));
 
 
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: "Invoice Over a Week"
  },
  axisY: {
    title: "Number of Invoices"
  },
  data: [{
    type: "spline",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 var chart21 = new CanvasJS.Chart("chartContainer21", {
  title: {
    text: "Transactions Over a Week"
  },
  axisY: {
    title: "Transactions Amount"
  },
  data: [{
    type: "spline",
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  }]
});
chart21.render();
}
</script>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>