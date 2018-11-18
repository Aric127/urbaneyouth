<style>
.add_product [class*="col"] {padding:0 0 0 15px;} 
.add_product .form-control {border-radius:3px;height:45px;}
.count-input {position:relative;}
.count-input a {background: #ccc none repeat scroll 0 0;border: 1px solid #e4e4e4;height: 23px;line-height: 17px;position: absolute;right: 0;text-align: center;width:20px;}
.count-input a:first-child {right: 1px;top: 0;}
.count-input a:last-child {right:1px;top:22px;}
.product-table .form-control {border-radius: 3px;height: 45px;}
.product-table .count-input {max-width:80px;}
.product-table tr td {vertical-align: middle;}



.print-value-head::after {clear: both;content: "";display: table;}

.print-value-head {border: 1px solid #ececec;}

.print-value-head [class*="col-"] {color: #000;font-size:14px;font-weight:600;padding:15px;text-align: center;}
.print_value [class*="col-"] {height: 45px;padding: 10px;text-align: center;}

.print_value .form-control {background: rgba(0, 0, 0, 0) none repeat scroll 0 0;border: medium none;padding: 0;text-align: center;}

.print_value .row {border-top: 1px solid #ececec; margin: 0;}

.print-value-head [class*="col-"]:first-child, .print_value [class*="col-"]:first-child {text-align:left;}


.mrg-T-50 {
    margin-bottom: 50px;
}


</style>

  <div class="content">
        <div class="container-fluid">
          <div class="col-md-8 col-12 mr-auto ml-auto">
            <!--      Wizard container        -->
            <div class="wizard-container">
              <div class="card card-wizard" data-color="rose" id="wizardProfile">
             <form class="add_bill" <?php if(!empty($biller_details1)){ ?>action="<?php echo site_url('biller/edit_bill_user'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_biller_user'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        <div class="form-group">
                  <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                  <div class="card-header text-center">
                    <h3 class="card-title in">
                      Invoice
                    </h3>
                    <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                    
                     <img src="<?php echo company_logo."/".$biller_details[0]->biller_company_logo;?>" style="width: 100%;">
                    </div>
                    <div class="col-lg-5 col-md-5 col-xs-12 col-sm-5">
                        
                      <p class="address"> <i class="material-icons">face</i> <?php echo $biller_details[0]->biller_company_name; ?>
                    </p>
                      <p>
                        <i class="material-icons">location_on</i>
                        <?php echo $biller_details[0]->biller_address."".$biller_details[0]->biller_city; ?>
                      </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4 contact">
                      <i class="material-icons">phone</i> 
                      <p>Phone: <?php echo $biller_details[0]->biller_contact_no; ?> </p>
                      <i class="material-icons">email</i> 
                      <p>Email : <?php echo $biller_details[0]->biller_email; ?></p>
                    </div>
                  </div>
                  </div>
                  <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                          Consumer Details
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                          Add Product
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#address" data-toggle="tab" role="tab">
                         Bill Description
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="about">
                        <h5 class="info-text"> Let's start with the basic informationh<h5>
                        <div class="row justify-content-center">
                         
                          <div class="col-sm-12">
                            <div class="row">
                            <div class="input-group form-control-lg col-lg-6 col-xs-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <img src="http://www.urbaneyouth.com/biller_assets/img/number.png" class="num-icon">
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Customer No</label>
                                <input type="text" class="form-control" onkeyup="check_number(this.value)" name="biller_customer_id_no" <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->biller_customer_id_no; } ?>" required="required" id="biller_customer_id_no" data-msg="Please Enter Customer No" onblur="create_invoive_no()">
                              </div>
                            </div>
                              <div class="input-group form-control-lg col-lg-6 col-xs-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">#</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput11" class="bmd-label-floating">#</label>
                                <input type="text" class="form-control" aria-describedby="basic-addon1" name="bill_invoice_no" id="bill_invoice_no" readonly="">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="input-group form-control-lg col-lg-6 col-xs-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Customer Name</label>
                                <input type="text" class="form-control"  id="biller_user_name" name="biller_user_name"  <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->biller_user_name; } ?>" class="form-control" required="required" data-msg="Please Enter Customer Name">
                              </div>
                            </div>
                            
                              <div class="input-group form-control-lg col-lg-6 col-xs-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">phone</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Contact No</label>
                                <input type="text" id="biller_user_contact_no" class="form-control" name="biller_user_contact_no" <?php if(!empty($biller_details1)){ ?> value="<?php echo $biller_details1[0]->biller_user_contact_no; } ?>" class="form-control" required="required"  data-msg="Please Enter Customer Contact No">
                              </div>
                            </div>
                          </div>
                        <div class="row">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">email</i>
                                </span>
                              </div>
                              <div class="form-group" style="width: 90%!important;">
                                <label for="exampleInput1" class="bmd-label-floating">Email (required)</label>
                                <input type="email" class="form-control"  name="biller_user_email" <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->biller_user_email; } ?>" class="form-control" required="required" data-msg="Please Enter Customer Email" id="biller_user_email">
                              </div>
                            </div>
                          </div>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="account">
                       
                        <div class="row justify-content-center">
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Single Select" onchange="getPrice(this.value)" id="biller_product">
                            <?php if(!empty($product)){
                    foreach($product as $val){ ?>
                    <option value="<?php echo $val ->product_id ?>"><?php echo $val ->product_name ?></option>
              <?php } } ?>
                           
                          </select>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-2 col-xs-12">

                           <div class="count-input space-bottom">
             <a class="incr-btn" data-action="decrease" href="#">–</a>
               <input readonly class="quantity form-control" type="text" value="1"/>
                <a class="incr-btn" data-action="increase" href="#">&plus;</a>
           </div>
                        </div>
                        <div class="col-lg-3  col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group bmd-form-group">
                           <input readonly type="text" id="base_price" class="form-control" placeholder="Base Price"/>
                         </div>
                        </div>
                        <div class="col-lg-3  col-md-3 col-sm-3 col-xs-12">
                           <div class="form-group bmd-form-group">
                          <input readonly type="text" id="total_price" class="form-control"  placeholder="Total Price"/>
                         </div>
                        </div>
                        
                        <div class="col-lg-1  col-md-1 col-sm-1 col-xs-12">
                            <button type="button" class="btn btn-primary add_row">Add</button>
                        </div>
                    
                      
                    <!--   <div class="col-lg-12" style="float: right;">
                        
                        <div class="form-group bmd-form-group" style="    width: 40%;
    float: right;">
                          <label class="col-form-label"> Total Ammount</label>
                          <input class="form-control amt" type="text" email="true" required="true" aria-required="true">
                        </div>
                      </div>
                 -->
                        
                          <div class="col-lg-12 col-md-12">
              <div class="card">
               <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th class="col-sm-2">Product </th>
                      <th class="col-sm-2">Qty.</th>
                      <th class="col-sm-2">Base Price</th>
                      <th class="col-sm-2">Total Price</th>
                      <th class="col-sm-2">Action</th>
                    </thead>
                  </table>
                   <div class="print_value">   
            </div>
                </div>
              </div>
            </div>
             </div>
             </div>

                     
                      <div class="tab-pane" id="address">
                        <div class="row justify-content-center">
                          <div class="col-sm-12">
                            <h5 class="info-text"> Bill Details</h5>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group date" style="    margin-top: 0px;">
                              <label>Bill Last Date</label>
                               <div class="form-group">
                                <i class="material-icons">date_range</i>
                                 <input type="text" class="form-control datepicker" value="" name="bill_due_date" id="end_date" data-start-date="d" required="required" data-msg="Please Enter Invoice Bill Last Date">
                     <!--  <input type="date"  name="bill_due_date" id="end_date" data-start-date="d" <//?php if(!empty($biller_details1)){ ?>value="<?php //echo $biller_details1[0]->bill_due_date; } ?>" class="form-control datepicker" required="required" data-msg="Please Enter Invoice Bill Last Date" > -->
                  </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group date" style="margin-top: 0;">
                              <label>Total Ammount</label>
                              <div class="form-group">
                               <i class="material-icons">₦</i>
                              <input readonly type="text" name="bill_amount" id="total_bill_amount" value="0" class="form-control" required="required" placeholder="Bill Amount" data-msg="Please Enter Invoice Bill Amount" style="background: transparent;
    border-bottom: 1px solid #ccc;">
                            </div>
                          </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Bill Description</label>
                             <textarea class="form-control textarea-height" rows="5" id="bill_description" name="bill_description"  required="required" data-msg="Please Enter Invoice Bill Description" ><?php if(!empty($biller_details1)){ ?> <?php echo $biller_details1[0]->bill_description ; } ?></textarea>
                            </div>
                          </div>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer" style="margin: 0 0 10px 0;">
                    <div class="mr-auto">
                      <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                    </div>
                    <div class="ml-auto" style="margin-right: 17px;">
                      <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
                      <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Submit" style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
            <!-- wizard container -->
          </div>
        </div>
      </div>
       <script src="<?php echo base_url('biller_assets/js/core/jquery.min.js');?>" type="text/javascript"></script>
   <script>

function add_price(item)
{
    var checkbox            =   $("#checkbox"+item).val();
    if(checkbox=='1')
    {
      var price             =   $("#c_bill"+item).val(); 
      var product_qty       =   $("#product_qty"+item).val(); 
      var newQty            =   parseInt(product_qty)+parseInt(1);
      var p                 =   price*product_qty; 
      var bill_amount       =   $("#total_bill_amount").val()-p; 
      var new_amount        =   newQty*price;      
      var finalamt          =   bill_amount+new_amount; 
      $("#total_bill_amount").val(finalamt);
      $("#product_qty"+item).val(newQty);
    }
    
    
}
function minus_price(item)
{
      var product_qty       =   $("#product_qty"+item).val(); 
     var checkbox            =   $("#checkbox"+item).val();
      if(checkbox=='1' && product_qty>1)
      {
      var price             =   $("#c_bill"+item).val(); 
      var newQty            =   parseInt(product_qty)-parseInt(1);
      var p                 =   price*product_qty; 
      var bill_amount       =   $("#total_bill_amount").val()-p; 
      var new_amount        =   newQty*price;      
      var finalamt          =   bill_amount+new_amount; 
      $("#total_bill_amount").val(finalamt);
      $("#product_qty"+item).val(newQty);
    }
    
}

function create_invoive_no(){
  var invoice_no = Math.floor(Math.random() * 10000000000);
  $("#bill_invoice_no").val(invoice_no);
  var consumer_no  = $("#biller_customer_id_no").val();
    var URL = "<?php echo site_url('biller/get_consumer_details'); ?>";
            $.ajax({
              url: URL,
              data: {"consumer_no" : consumer_no},
              dataType:"json",
              type: "post",
              success: function(data){ 
                if(data.status == 1){
                  $('#biller_user_name').val(data.biller_user_name);
                  $('#biller_user_email').val(data.biller_user_email);
                  $('#biller_user_contact_no').val(data.biller_user_contact_no);                
                }else{
                  $('#biller_user_name').val('');
                  $('#biller_user_email').val('');
                  $('#biller_user_contact_no').val('');   
                 
                }               
              }
          });
  
}
function check_number(val){
  var consumer_no=val;
  if((isNaN(consumer_no))){
    $("#consumer_no_error").text("Please enter only number");
    $("#submit").attr('style','display: none');
    $("#error_btn").attr('style','display: block');
  }else{
    $("#consumer_no_error").text("");
    $("#submit").attr('style','display: block');
    $("#error_btn").attr('style','display: none');
  }
}
  // function check_word_limit(){
  //  var bill_description=$("#bill_description").val();
  //  var len = bill_description.length;
  //  if(len<=200){
  //    document.getElementById("form1").submit();
  //    //document.getElementById("form1").submit();
  //  }else{
  //    $("#text_error").text("Please Enter character less then 200, you enter character "+len);
  //  }
  // }
  var total=0;
  function bill_amount_value(item)
  {
   var c_bill        =    $("#c_bill"+item.value).val();
   var product_qty         =    $("#product_qty"+item.value).val(); 
     if(item.checked){
         $("#product_qty"+item.value).removeAttr("disabled");
           total+= parseInt(c_bill);
           $("#checkbox"+item.value).val(1);
        }else{
           var bill_amount       =   $("#total_bill_amount").val()
           var finalamt=c_bill*product_qty;
           if(bill_amount>=finalamt)
           {
            $("#product_qty"+item.value).val(1);
            total=bill_amount-finalamt;
           }
            $("#checkbox"+item.value).val(2);

        }
       $("#total_bill_amount").val(total);
       
  }
</script>


<script>
    $(".incr-btn").on("click", function (e) {
        var $button = $(this);
        var bassePrice = $("#base_price").val();
        if(bassePrice == '' || bassePrice == 'undefined'){
          return false;
        }
        var oldValue = $button.parent().find('.quantity').val();
        console.log("old value" + oldValue);
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ($button.data('action') == "increase") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                $button.addClass('inactive');
            }
        }

        var total_price = newVal * bassePrice;
        console.log('newVal' + newVal);
        console.log('total_price' + total_price);
        $("#total_price").val(total_price);

        $button.parent().find('.quantity').val(newVal);
        e.preventDefault();
    }); 
</script>

  <script type="text/javascript">
      function getPrice(productId){
          var URL = "<?php echo site_url('biller/getPrice'); ?>";
            $.ajax({
              url: URL,
              data: {"productId" : productId},
              dataType:"json",
              type: "post",
              success: function(data){
                if(data.status == 1){
                  $('#base_price').val(data.price);
                  $('#total_price').val(data.price);
                  $('.quantity').val(1);
                }else{
                  $('#base_price').val("");
                  $('#total_price').val("");
                  $('.quantity').val(1);
                }               
              }
          });
        }
  </script>


<script>
 $('document').ready(function() {
  $('.add_row').click(function() {

       var total_price = $("#total_price").val();
       var quantity    = $(".quantity").val();
       var base_price  = $("#base_price").val();

        if(base_price == '' || base_price == 'undefined'){
          return false;
        }

       var total_bill_amount = $("#total_bill_amount").val();
       var finalamt = parseInt(total_bill_amount) + parseInt(total_price);
       $("#total_bill_amount").val(finalamt);

       var sn        = $("#sn").val();
       $("#sn").val( parseInt(sn) + 1 );
       var productName = $("#biller_product :selected").text();
       var productId   = $("#biller_product :selected").val();
       // <td>'+sn+'</td>

       $(".print_value").append('<div class="row"> <div class="col-sm-2">'+productName+'</div><div class="col-sm-2"><input readonly type="text" name="product_qt[]" value='+quantity+' class="form-control"></div><div class="col-sm-2"><input readonly type="text" value='+base_price+' class="form-control"></div><div class="col-sm-3"><input readonly type="text"  value='+total_price+' class="form-control"></div><div class="col-sm-2"><input type="hidden" class="productId" name="bill_product_id[]" value='+productId+'><input type="hidden" class="productName" value="'+productName+'"><input type="hidden" class="totalPrice" value="'+total_price+'"><a class="btn removeproduct btn-danger btn-sm btn-icon icon-left">Delete </a></div> </div>');


      // $("#prod_tbl").append('<tr><td>'+productName+'</td><td><input readonly type="text" name="product_qt[]" value='+quantity+' class="form-control"></td><td><input readonly type="text" name="base_price" value='+base_price+' class="form-control"></td><td><input readonly type="text" name="total_price" value='+total_price+' class="form-control"></td><td><input type="hidden" class="productId" name="bill_product_id[]" value='+productId+'><input type="hidden" class="productName" name="productName" value="'+productName+'"><input type="hidden" class="totalPrice" value="'+total_price+'"><a class="btn removeproduct btn-danger btn-sm btn-icon icon-left">Delete </a></td></tr>');

       $('option[value='+productId+']').remove();
       $("#total_price").val("");
       $(".quantity").val(1);
       $("#base_price").val("");

   });
}) 
</script>

 <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });
  </script>
<script>
    $(document).on("click", ".removeproduct", function (e) {
        var $button = $(this);
        $button.parent().parent().remove();

        var productId = $button.siblings('.productId').attr('value');
        var productName = $button.siblings('.productName').attr('value');
        var totalPrice = $button.siblings('.totalPrice').attr('value');

        var total_bill_amount = $("#total_bill_amount").val();
        var finalamt = parseInt(total_bill_amount) - parseInt(totalPrice);
        $("#total_bill_amount").val(finalamt);


        console.log(productId);

        $('#biller_product').append(
        $('<option></option>').val(productId).html(productName));    

      e.preventDefault();
   }); 
</script>
<style>
  #about .input-group.form-control-lg.col-lg-6.col-xs-12 {

    margin: 15px 0px;

}
.mr-auto {

    margin-left: 18px;

}
</style>