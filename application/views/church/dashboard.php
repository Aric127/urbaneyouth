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
                                <p class="card-category">Total Branches </p>
                                <h3 class="card-title"><?php echo $oyawallet[0]->area_count; ?></h3>
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
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">receipt</i>
                                </div>
                                <p class="card-category">Amount(₦)</p>
                                <h3 class="card-title"><?php echo "₦".$domation_amount[0]->total_donation ; ?></h3>
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
                              <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon" style="background-color: #999999!important;background-image: none;">
                                  <i class="material-icons">swap_horiz</i>
                                </div>
                                <p class="card-category">Transactions</p>
                                <h3 class="card-title"><?php  echo $donate_transaction ; ?></h3>
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
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">description</i>
                                </div>
                                <p class="card-category">Balence</p>
                                <h3 class="card-title"> <?php if(!empty($oyawallet['0']->wallet_amount)){
                                  echo "₦".$oyawallet['0']->wallet_amount;
                                }else{ echo "0" ;}   ?></h3>
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
                                <div class="ct-chart"  id="chartContainer" style="height: 200px; width: 100%;"></div>
                              </div>
                           <div class="card-body">
                             <h4 class="card-title">Weekly Donation</h4>
                            </div> 
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card card-chart">
                              <div class="card-header card-header-info" data-header-animation="true">
                              <div class="ct-chart" id="chartContainer21" style="height: 200px; width: 100%;"></div>
                              </div>
                              <div class="card-body">
                               <h4 class="card-title">Donation Transactions </h4>
                              </div>
                           </div>
                          </div>
                        </div>
            <div class="row">
              <!-- <div class="col-md-12">
                <div class="card ">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons"></i>
                    </div>
                    <h4 class="card-title">Latest Transaction</h4>
                  </div>
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive table-sales">
                         
                          </div>
                          </div>
                          
                          </div>
                          </div>
                          </div>
                          </div> -->
                            <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                      <i class="material-icons">swap_horiz</i>
                    </div>
                    <h4 class="card-title "> Latest Dontation Transactions</h4>
                  </div>
                  <div class="card-body table-full-width table-hover">
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="">
                         <th style="text-align: center;">SNo</th>
                          <th>Branch Name</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>User Contact</th>
                          <th>Amount(₦)</th>
                          <th>Service</th>
                          <th>Date</th>
                          <th style="text-align: center;">Image</th>
                        </thead>
                        <tbody>
                          <?php if(!empty($donate_trans)){ $i=1; 
                            foreach ($donate_trans as  $value) { ?>
                              <tr class="table-success">
                              <td style="width: 8%;text-align: center;"><?php echo $i; ?></td>
                              <td style="width: 12%"><?php echo $value->branch_area; ?></td>
                              <td style="width: 15%"><?php echo $value->username; ?></td>
                              <td style="width: 15%"><?php echo $value->useremail; ?></td>
                              <td style="width: 15%"><?php echo $value->user_contact; ?></td>
                              <td style="width: 10%"><?php echo "₦".$value->church_product_price ; ?></td>
                              <td style="width: 10%"><?php echo $value->church_product_name ; ?></td>
                              <td style="width: 10%"><?php echo $value->donate_datetime ; ?></td>
                           <td style="width: 15%;text-align: center"><img src="<?php echo church_image.'/'.$value->church_area_img; ?>" height="90" width="90"></td>
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

 <div class="modal fade modal-mini modal-primary" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-small">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                            </div>
                            <div class="modal-body">
                              <form method="#" action="#">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Old Password </label>
                      <input type="password" class="form-control" id="examplePass">
                    </div>
                    <div class="form-group bmd-form-group">
                      <label for="examplePass" class="bmd-label-floating">New Password</label>
                      <input type="password" class="form-control" id="examplePass">
                    </div>
                       <div class="form-group bmd-form-group">
                      <label for="examplePass" class="bmd-label-floating">Confirm Password</label>
                      <input type="password" class="form-control" id="examplePass">
                    </div>
                    <div class="card-footer " style="padding-left: 0;">
                  <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                </div>
                  </form>
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
       if ($week_invoice_count[$j]->donate_datetime == date("Y-m-d", $ts))
           {
           
          $week_invoice[$i-1]=$week_invoice_count[$j]->donation_count;
            $j++;
           }else{
          
            $week_invoice[$i-1]=0;
           }
           if ($week_invoice_amount[$k]->donate_datetime == date("Y-m-d", $ts))
           {
           
          $week_amount[$i-1]=$week_invoice_amount[$k]->donate_price;
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
    text: "Donation Over a Week"
  },
  axisY: {
    title: "Number of Donation"
  },
  data: [{
    type: "spline",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 var chart21 = new CanvasJS.Chart("chartContainer21", {
  title: {
    text: "Donation Over a Week"
  },
  axisY: {
    title: "Donation Amount"
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