
<!-------------- footer -------------->
<footer>
<div class="container footer">
	<div class="col-sm-3 col-xs-12 col-620">
    	<h3>Mobile Recharge</h3>
    	<ul>
    		<?php if(!empty($footer)){
    			$i=0;
    			foreach ($footer as  $value) {
    				if($value->recharge_category_id =='1'){ ?>
					<li><a href="#" onclick="show_recharge_plan(<?php echo $value->operator_id;?>)"><?php echo $value->operator_name;?> </a></li>
          
         	<?php   }
				$i++;
				}
    		} ?>
        </ul>
    </div>
    <div class="col-sm-3 col-xs-12 col-620">
    	<h3>TV Recharge</h3>
    	<ul>
        	<?php if(!empty($footer)){
    			$i=0;
    			foreach ($footer as  $value) {
    				if($value->recharge_category_id =='2'){ ?>
					<li><a href="#"><?php echo $value->operator_name;?> </a></li>
          
         	<?php   }
				$i++;
				}
    		} ?>
        </ul>
    </div>
    <div class="col-sm-3 col-xs-12 col-620">
    	<h3>Data Recharge</h3>
    	<ul>
        	<?php if(!empty($footer)){
    			$i=0;
    			foreach ($footer as  $value) {
    				if($value->recharge_category_id =='3'){ ?>
					<li><a href="#"><?php echo $value->operator_name;?> </a></li>
          
         	<?php   }
				$i++;
				}
    		} ?>
        </ul>
    </div>
    <div class="col-sm-3 col-xs-12 col-620">
        <h3>Support</h3>
    	<ul>
        	<li><a href="#"><?php echo $contact_details[0]->contact_email ?> </a></li>
       
            <li><a href="#vedio_section">About Us </a></li>
            <li><a href="#contact_form ">Contact Us </a></li>
            <li><a href="<?php echo site_url('website/terms_conditions'); ?>">Terms & Conditions</a></li>
        </ul>
    </div>
</div>

</footer>
	
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
       <script src="<?php //echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>-->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>webassets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>webassets/js/owl.carousel.js"></script>

    
    <script>
		$(document).ready(function(e) {
			 $('.menu-bar').click(function(){
				$('.menu, .overlay-menu').toggleClass('active');
			});
			$('.overlay-menu').click(function(){
				$('.menu, .overlay-menu').removeClass('active');
			});
			
			$('.radio-style-box, .focus-pop').click(function(){
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
			});
			$('.focus-pop').click(function(){
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
			});
			$('.show_signup').click(function(){
				$('#loginPop, .modal-backdrop').removeClass('in');
			});
			$('.show_login').click(function(){
				$('#loginPop, .modal-backdrop').addClass('in');
			});
			
			$('.change-num').click(function(){
				$('#OTP, .modal-backdrop').removeClass('in');
			});
		
		});
		$('.recharge-fields').carousel({
			interval: false,
			wrap:false
		}); 
		$('.owl-carousel').owlCarousel({
			loop:false,
			nav:true,
			responsive:{
				0:{
					items:3
				},
				600:{
					items:3
				},
				1200:{
					items:4
				}
			}
		});
		$('.offer-slide').owlCarousel({
			loop:false,
			nav:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:2
				},
				1200:{
					items:3
				}
			}
		});
		
	</script>
		<script>
	$(document).ready(function(){
	  $("#tv_prev, #tv_next").attr('style','display: none');
	  
	 $("#next_recharge, #preview_recharge").attr('style','display: none');
	  $("#datacard_prev, #datacard_next").attr('style','display: none');
	   $("#bill_recharge_prev, #bill_recharge_next").attr('style','display: none');
		$('#mobile').keyup(function(){ 
	  	var value = $('#mobile').val();
	  	 if($('#mobile').val().length ==11) {
       $("#next_recharge").attr('style','display: block');
        $("#num_error").text("");
	    } else if(isNaN($('#mobile').val())){
		//	$('#num_error').attr('style','border-color: red!important');
			$('#num_error').text('Please Enter a valid mobile number');
			} else {
	     $("#next_recharge").attr('style','display: none');
	       $("#num_error").text("Please Enter 11 digit mobile number");
	    }
 
	});
	
	
	
	
		$('#tv_number').keyup(function(){ 
			
			var value = $('#tv_number').val();
		 if($('#tv_number').val().length >= 5) {
	  	 
       $("#tv_next").attr('style','display: block');
        $("#tv_num_error").text("");
	    }else if(isNaN($('#tv_number').val())){
		//	$('#tv_num_error').attr('style','border-color: red!important');
				$('#tv_num_error').text('Please Enter a valid mobile number');
			} else {
				
	       $("#tv_num_error").text("Please Enter 8 digit mobile number");
	     $("#tv_next").attr('style','display: none');
	    }
 
	});
	$('#data_card_number').keyup(function(){ 
	  	var value = $('#data_card_number').val();
	  	 if($('#data_card_number').val().length >=5) {
	  	 	 $("#data_num_error").text("");
       $("#datacard_next").attr('style','display: block');
	    }else if(isNaN($('#data_card_number').val())){
		//	$('#data_num_error').attr('style','border-color: red!important');
				$('#data_num_error').text('Please Enter a valid Data card number');
			}  else {
	     $("#datacard_next").attr('style','display: none');
	      $("#data_num_error").text("Please Enter minimum 5 digit Data card number");
	    }
 
	});

});
$('.overlay-menu').addClass('active');
function close_pop_field(){
	$("#popup").hide();
	$('.overlay-menu').removeClass('active');
}
</script>

</html>