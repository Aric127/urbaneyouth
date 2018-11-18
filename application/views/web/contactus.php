<div class="contact-us-wrap">
  <div class="container">
     <div class="row">
       <div class="col-md-6">
         <div class="address-box">
            <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.3350463602196!2d75.8915146650869!3d22.752944082060495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396302af403406fb%3A0x5b50834b117f8bab!2sVijay+Nagar%2C+Indore%2C+Madhya+Pradesh+452010!5e0!3m2!1sen!2sin!4v1541007354734" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
            <div style="width: 100%"><iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=450&amp;hl=en&amp;coord=6.491650,3.350910&amp;q=8B%2C%20Lalupon%20close%2C%20Ikoyi%20Lagos+(Oyacharge)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Google map generator</a></iframe></div><br />
         </div>
       </div>
       <div class="col-md-6">
       	<?php 
       	$this->load->view('alert');
       	?>
         <div class=" contact-form">
            
            <form method="post" action="<?php echo base_url('ContactUs'); ?>" id="contact-form">
                <h3>Drop Us a Message</h3>
               <div class="row">
               	     <div class="col-md-6">
                       <div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                         
                    </div>
               	     <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Your Email *" value="" />
                        </div> 
                         
                    </div>
                    <div class="col-md-12">
                        
                       
                        <div class="form-group">
                            <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Enter Phone Number *" value="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                        </div>
                        <div class="form-group">
                            <textarea name="user_msg" id="user_msg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                        </div>
                </div>
            </form>
</div>
       </div>
     </div>
  </div>
</div>

<section class="section bg-light shadow-md pt-4 pb-3" style="background-color: #eee">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-phone"></i> </div>
              <h4>24/7 Contact</h4>
              <p>+234 - 8076197654</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-envelope-o"></i> </div>
              <h4>Email</h4>
              <p>care@oyacharge.com </p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-map-marker"></i> </div>
              <h4>Address</h4>
              <p>8B, Lalupon close, Ikoyi Lagos </p>
            </div>
          </div>
      
        </div>
      </div>
    </section>
<!-- <section class="section bg-light shadow-md pt-4 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-lock"></i> </div>
              <h4>100% Secure Payments</h4>
              <p>Moving your card details to a much more secured place.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-thumbs-up"></i> </div>
              <h4>Trust pay</h4>
              <p>100% Payment Protection. Easy Return Policy.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-bullhorn"></i> </div>
              <h4>Refer &amp; Earn</h4>
              <p>Invite a friend to sign up and earn up to ₦ 5.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-life-ring"></i> </div>
              <h4>24X7 Support</h4>
              <p>We're here to help. Have a query and need help ? <a href="#">Click here</a></p>
            </div>
          </div>
        </div>
      </div>
    </section> -->

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
 
</style>