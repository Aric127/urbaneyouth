
<div class="about-wrap">
  <div class="container">
    <?php  
        foreach($about_us_data as $data){  
    ?>
    <div class="jumbotron text-center">
     <?php
           echo $data->about_us_content; 
           echo $data->website_content;
      ?>
	</div>
  <?php
      }
  ?>
<div class="slideshow-container">
    <div class="col-md-3"></div>
    <div >
       <?php  
        foreach($about_us_data as $data){  
      ?>
      <iframe autoplay="false" width="560" height="315" src="<?php echo $data->about_us_video; ?>" frameborder="0" allowfullscreen></iframe>
      <?php         
        }
      ?>
    </div>


</div>
	<div class="ouvepartenr">
		<h3 class="text-center about-head-line">Our Services</h3> 
      <?php //print_r($about_us_operator);
      //foreach($about_us_operator as $operator_data){
        //echo $operator_data->operator_image;
        ?>
        <!-- <img src="/uploads/operator/<?php echo $operator_data->operator_image; ?>"> -->
        
		 <section class="customer-logos slider">
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner1.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner2.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner3.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner4.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner1.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner2.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner3.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner4.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner1.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner2.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner3.png');?>"></div>
      <div class="slide"><img src="<?php echo base_url('wassets/images/partner4.png');?>"></div>
      
   </section>
   <?php
    //  } ?>
	</div>
	</div>

	

</div>

<script type="text/javascript">
	var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>
<style type="text/css">
	.hero:before {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    height: auto;
    width: auto;
    background: url(../images/dots.png);
    z-index: 0;
}
.hero {
    background: #fff;
    overflow: hidden;
    padding: 10px 0;
    background-attachment: fixed;
    position: relative;
    -webkit-animation: hero-bg 90s linear infinite;
    -moz-animation: hero-bg 90s linear infinite;
    -o-animation: hero-bg 90s linear infinite;
    animation: hero-bg 90s linear infinite;
}
</style>