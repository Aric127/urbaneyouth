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

<?php if($this->session->flashdata('error')){ ?>

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> <span class="sr-only">Close</span> </button>
      <strong><?php echo $this->session->flashdata('error'); ?></strong> </div>
  </div>
</div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> <span class="sr-only">Close</span> </button>
      <strong><?php echo $this->session->flashdata('success'); ?></strong> </div>
  </div>
</div>
<?php } ?>

 <!--<div class="row"> 
           <div class="col-sm-3"> 
              <div class="frm_icon"> 
                 <img src="<?php if(!empty($biller_details)){
                                echo company_logo."/".$biller_details[0]->biller_company_logo;
                                } ?>" />
              </div>
           </div>
           <div class="col-sm-4"> 
              <div class="frm_mail"> <?php echo $biller_details[0]->biller_name;?> </div>
              <div class="frm_mobile"><?php echo $biller_details[0]->biller_address;?> </div>
           </div>
           <div class="col-sm-5"> 
            <div class="frm_address"> 
            <?php echo $biller_details[0]->biller_email;?>
             
              <div > <?php echo $biller_details[0]->biller_contact_no;?> </div>
               
            </div>
           </div>
       </div>-->


<div class="panel panel-default">
   <!-- <div class="panel-heading">
   <div class="panel-title">
      <?php if(!empty($biller)){ ?>
      Edit Invoice
      <?php } else { ?>
      Add Invoice
      <?php } ?>
    </div>
  </div> -->
   <div class="panel-body invoice">
       <div class="invoice-header">
        <div class="invoice-title col-md-3">
            <h1>invoice</h1>
           <!--  <img alt="" src="images/bucket-logo.png" class="logo-print"> -->
        </div>
        <div class="invoice-info col-md-9">

            <div class="pull-right">
                <div class="col-md-6 col-sm-6 pull-left">
                    <p><?php echo $biller_details[0]->biller_name; ?> <br>
                      <?php echo $biller_details[0]->biller_company_name; ?>  </p>
                </div>
                <div class="col-md-6 col-sm-6 pull-right">
                    <p>Phone: <?php echo $biller_details[0]->biller_contact_no; ?><br>
                        Email : <?php echo $biller_details[0]->biller_email; ?></p>
                </div>
            </div>

        </div>
       </div>
     </div>
  <div class="panel-body">
    
      <form class="add_bill" <?php if(!empty($biller_details1)){ ?>action="<?php echo site_url('biller/edit_bill_user'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_biller_user'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        <div class="col-md-6">
        <div class="form-group">
          <!-- <label for="exampleInputEmail1">Invoice Number</label> -->
          <input type="text" class="form-control" onkeyup="check_number(this.value)" id="biller_customer_id_no" name="biller_customer_id_no" <?php if(!empty($biller_details1)){ ?> value="<?php echo $biller_details1[0]->biller_customer_id_no; } ?>" required="required" placeholder="Customer No" data-msg="Please Enter Customer No" onblur="create_invoive_no()">
           <label id="consumer_no_error" style="color:red"></label>
        </div>
        <div class="form-group">
         <!--  <label for="exampleInputEmail1">Invoice Name</label> -->
          <input type="text" class="form-control" id="biller_user_name" name="biller_user_name"  <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->biller_user_name; } ?>" class="form-control" required="required" data-msg="Please Enter Customer Name" placeholder="Customer Name">
        </div>
      
        <div class="form-group">
         <!--  <label for="exampleInputEmail1">Invoice Email</label> -->
          <input type="email" id="biller_user_email" name="biller_user_email" <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->biller_user_email; } ?>" class="form-control" required="required" data-msg="Please Enter Customer Email" placeholder="Customer Email">
        </div>
      
    
    </div>
    <div class="col-md-6">
      <div class="add_bill">
      	<div class="form-group clearfix">
            <div class="input-group"> <span class="input-group-addon" id="basic-addon1">#</span>
              <input type="text" class="form-control" placeholder="1" aria-describedby="basic-addon1" name="bill_invoice_no" id="bill_invoice_no" readonly="">
            </div>
        </div>
        <div class="form-group clearfix">
           <!-- <label for="inputEmail3" class="col-sm-6 control-label">Bill Last Date</label>-->
            <div style="padding-left:0;" class="col-sm-6">
              <input type="text"  name="bill_due_date" id="end_date" data-start-date="d" <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->bill_due_date; } ?>" class="form-control datepicker" required="required" placeholder="Bill Last Date" data-msg="Please Enter Invoice Bill Last Date" >
            </div>
         
            <!--<label for="inputPassword3" class="col-sm-6 control-label">Bill Amount</label>-->
            <div style="padding-right:0;" class="col-sm-6">
              <input readonly type="text" name="bill_amount" id="total_bill_amount" value="0" class="form-control" required="required" placeholder="Bill Amount" data-msg="Please Enter Invoice Bill Amount">
            </div>

          </div>
          <div class="form-group">
         <!--  <label for="exampleInputEmail1">Invoice Contact No.</label> -->
          <input type="text" id="biller_user_contact_no" name="biller_user_contact_no" <?php if(!empty($biller_details1)){ ?>value="<?php echo $biller_details1[0]->biller_user_contact_no; } ?>" class="form-control" required="required" placeholder="Customer Contact No" data-msg="Please Enter Customer Contact No">
        </div>
      </div>
    </div>
     <div class="col-md-12">
       <h4> Add Product </h4>  
       <div class="form-group add_product row clearfix"> 
         <!--  <div class="col-md-1"> 
            <input type="text" class="form-control" placeholder="SR No." />
          </div> -->
          <div class="col-md-4"> 
           <!--  <input type="text" class="form-control" placeholder="Search Product" /> -->
            <select class="form-control" onchange="getPrice(this.value)" id="biller_product">
            <option value="">Select Product</option>
             <?php if(!empty($product)){
                    foreach($product as $val){ ?>
                    <option value="<?php echo $val ->product_id ?>"><?php echo $val ->product_name ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="col-md-1"> 
            <div class="count-input space-bottom">
             <a class="incr-btn" data-action="decrease" href="#">–</a>
               <input readonly class="quantity form-control" type="text" value="1"/>
                <a class="incr-btn" data-action="increase" href="#">&plus;</a>
           </div>
          </div>
           <div class="col-md-2"> 
            <input readonly type="text" id="base_price" class="form-control" placeholder="Base Price"/>
          </div>
           <div class="col-md-2"> 
            <input readonly type="text" id="total_price" class="form-control"  placeholder="Total Price"/>
          </div>
          <div class="col-md-2"> 
            <button type="button" class="btn btn-success add_row"> Add Product </button>
          </div>

          <input type="hidden" value="1" id="sn">

       </div>
    </div>
    
    <div class="col-md-12 mrg-T-50">
        <div class="print-value-head"> 
           <div class="col-sm-4"> Product Name </div>
           <div class="col-sm-2"> Qty </div>
           <div class="col-sm-2"> Base Price </div>
           <div class="col-sm-2"> Total Price </div>
           <div class="col-sm-2"> Action </div>
        </div>
       <div class="print_value">   
       </div>
    </div>
<!--      <div class="col-md-12">
        <div class="table-responsive">
           <table id="prod_tbl" class="table product-table">
              <thead>
                 <tr>
                    <th> sr no.</th>
                    <th> Product Name</th>
                    <th> Qty</th>
                    <th> Base Price</th>
                    <th> Total Price</th> 
                    <th> Action</th> 
                 </tr>
              </thead> 
			  <tbody>
                <tr>
                    <td> 1</td>
                    <td> Samsung Mobile </td>
                    <td> <div class="count-input space-bottom">
             <a class="incr-btn" data-action="decrease" href="#">&minus;</a>
               <input class="quantity form-control" type="text" name="quantity" value="1"/>
                <a class="incr-btn" data-action="increase" href="#">&plus;</a>
           </div></td>
                    <td>16000</td>
                    <td> 32000</td>
                    <td> 
                    <a class="btn btn-blue btn-sm btn-icon icon-lef">Edit </a>
                    <a class="btn btn-danger btn-sm btn-icon icon-left">Delete </a>
                    </td> 
                 </tr> 
              </tbody>
           </table>
        </div>
     </div> -->
     
    <div class="col-md-12">
    	
            <div class="form-group">
            <!--  <label for="comment">Bill Description</label> -->
 			 <textarea class="form-control textarea-height" rows="5" id="bill_description" name="bill_description"  required="required" data-msg="Please Enter Invoice Bill Description"  placeholder=" Bill Description "><?php if(!empty($biller_details1)){ ?> <?php echo $biller_details1[0]->bill_description ; } ?></textarea>
            </div>
      
    </div>
    <div class="col-md-12">
    	<div class="form-group">
		<?php if(!empty($biller_details1)){ ?>
            <input type="hidden" name="biller_id" value="<?php echo $biller_details1[0]->biller_id; ?>">
        <?php } ?>
        <input id="submit" type="submit" name="btnSubmit" value="Submit" class="btn btn-success">
       
    </div>
    </div>
      </form>
  </div>
</div>
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
	// 	var bill_description=$("#bill_description").val();
	// 	var len = bill_description.length;
	// 	if(len<=200){
	// 		document.getElementById("form1").submit();
	// 		//document.getElementById("form1").submit();
	// 	}else{
	// 		$("#text_error").text("Please Enter character less then 200, you enter character "+len);
	// 	}
	// }
	var total=0;
	function bill_amount_value(item)
	{
	 var c_bill 			 = 		$("#c_bill"+item.value).val();
	 var product_qty      	 =   	$("#product_qty"+item.value).val(); 
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

  	   var sn  		   = $("#sn").val();
  	   $("#sn").val( parseInt(sn) + 1 );
  	   var productName = $("#biller_product :selected").text();
  	   var productId   = $("#biller_product :selected").val();
  	   // <td>'+sn+'</td>

  	   $(".print_value").append('<div class="row"> <div class="col-sm-4">'+productName+'</div><div class="col-sm-2"><input readonly type="text" name="product_qt[]" value='+quantity+' class="form-control"></div><div class="col-sm-2"><input readonly type="text" value='+base_price+' class="form-control"></div><div class="col-sm-2"><input readonly type="text"  value='+total_price+' class="form-control"></div><div class="col-sm-2"><input type="hidden" class="productId" name="bill_product_id[]" value='+productId+'><input type="hidden" class="productName" value="'+productName+'"><input type="hidden" class="totalPrice" value="'+total_price+'"><a class="btn removeproduct btn-danger btn-sm btn-icon icon-left">Delete </a></div> </div>');


      // $("#prod_tbl").append('<tr><td>'+productName+'</td><td><input readonly type="text" name="product_qt[]" value='+quantity+' class="form-control"></td><td><input readonly type="text" name="base_price" value='+base_price+' class="form-control"></td><td><input readonly type="text" name="total_price" value='+total_price+' class="form-control"></td><td><input type="hidden" class="productId" name="bill_product_id[]" value='+productId+'><input type="hidden" class="productName" name="productName" value="'+productName+'"><input type="hidden" class="totalPrice" value="'+total_price+'"><a class="btn removeproduct btn-danger btn-sm btn-icon icon-left">Delete </a></td></tr>');

       $('option[value='+productId+']').remove();
       $("#total_price").val("");
  	   $(".quantity").val(1);
  	   $("#base_price").val("");

   });
}) 
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
