<?php include('header.php')?>
<div class="wpb_map_wraper">
  <iframe width="100%" height="400" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=ypsilon%20it%20solutions%20pvt%20ltd&amp;key=AIzaSyBACowXIq06M9kjDqOSKC6fzUXwmqzT-FM" style="border:0"> </iframe>
</div>
<div class="container">
  <div class="col-md-4 offset-top">
    <div class="text-center">
      <div class="contact_box_border">
        <div class="contact_box_header">
          <div class="icon_boxed"> <img width="40px" src="images/contact.png"/> </div>
          <h4> CONTACT PHONE </h4>
        </div>
        <div class="contact_content">
          <p> <span> 1800-555-6875 </span> <br>
            <span> 1800-431-7123</span> </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 offset-top">
    <div class="text-center">
      <div class="contact_box_border">
        <div class="contact_box_header">
          <div class="icon_boxed"> <img width="40px" src="images/contact_email.png"/> </div>
          <h4>WRITE US A MESSAGE</h4>
        </div>
        <div class="contact_content">
          <p> <span> info@ypsilonitsolutions.com </span> <br>
            <span> Or just fill the form below</span> </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 offset-top">
    <div class="text-center">
      <div class="contact_box_border">
        <div class="contact_box_header">
          <div class="icon_boxed"> <img width="40px" src="images/map.png"/> </div>
          <h4> OUR ADDRESS </h4>
        </div>
        <div class="contact_content">
          <p> <span> Ypsilon IT Solutions Pvt Ltd, LG-1,</span> <br>
            <span> J.V. Complex, Race Course Road , Indore (M.P.)</span> </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="contact-form-bg offset-top">
	<div class="container">
        <div class="contact_form_heading text-center">
            <h3> CONTACT FORM </h3>
            <div class="border"></div>
        </div>
          <div class="contact_form_content offset-top">
            <form role="form" action="contact.php" method="post" id="contact-form" novalidate="true">
              <div class="messages"></div>
              <div class="controls">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="form_name">Firstname</label>
                      <input type="text" data-error="Firstname is required." required="required" placeholder="Enter Your Firstname" class="form-control" name="name" id="form_name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="form_lastname">Lastname</label>
                      <input type="text" data-error="Lastname is required." required="required" placeholder="Enter Your Lastname" class="form-control" name="surname" id="form_lastname">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="form_email">Email</label>
                      <input type="email" data-error="Valid email is required." required="required" placeholder="Enter Your Email" class="form-control" name="email" id="form_email">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="form_phone">Phone</label>
                      <input type="tel" placeholder="Enter Your Phone" class="form-control" name="phone" id="form_phone">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="form_message">Message</label>
                      <textarea data-error="Please,leave us a message." required="required" placeholder="Enter Message Here" name="message" id="form_message"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <input type="submit" value="Send message" class="btn btn-send hvr-sink">
                  </div>
                </div>
              </div>
            </form>
          </div>
    </div>
</div>
<?php include('footer.php')?>
