<div class="about-wrap">
	<div class="container">
		<div class="jumbotron text-center">
		<h3>About Oyacharge</h3>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
		<p> when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	</div>

	<div class="ouvepartenr">
		<h3 class="text-center about-head-line">Our Partner</h3> 
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
	</div>
	</div>

	<div class="slideshow-container">
<h3 class="text-center about-head-line">Review</h3>
<div class="mySlides">
  <q>I love you the more in that I believe you had liked me for my own sake and for nothing else</q>
  <p class="author">- John Keats</p>
</div>

<div class="mySlides">
  <q>But man is not made for defeat. A man can be destroyed but not defeated.</q>
  <p class="author">- Ernest Hemingway</p>
</div>

<div class="mySlides">
  <q>I have not failed. I've just found 10,000 ways that won't work.</q>
  <p class="author">- Thomas A. Edison</p>
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

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