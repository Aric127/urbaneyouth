   <footer class="footer">
                    <div class="container-fluid">
                    
                      <div class="copyright">
                        &copy;
                        <script>
                          document.write(new Date().getFullYear())
                        </script>, Oyacharge.com . All rights reserved by 
                        <a href="https://www.oyacharge.com" target="_blank">Oyacharge</a>.
                      </div>
                    </div>
                  </footer>
                </div>
              </div>
              
              <script src="<?php echo base_url('biller_assets/js/core/jquery.min.js');?>" type="text/javascript"></script>
              <script src="<?php echo base_url('biller_assets/js/core/popper.min.js');?>" type="text/javascript"></script>
              <script src="<?php echo base_url('biller_assets/js/core/bootstrap-material-design.min.js');?>" type="text/javascript"></script>
              <script src="<?php echo base_url('biller_assets/js/plugins/perfect-scrollbar.jquery.min.js');?>"></script>
              <!-- Plugin for the momentJs  -->
              <script src="<?php echo base_url('biller_assets/js/plugins/moment.min.js');?>"></script>
              <!--  Plugin for Sweet Alert -->
              <script src="<?php echo base_url('biller_assets/js/plugins/sweetalert2.js');?>"></script>
              <!-- Forms Validations Plugin -->
              <script src="<?php echo base_url('biller_assets/js/plugins/jquery.validate.min.js');?>"></script>
              <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
              <script src="<?php echo base_url('biller_assets/js/plugins/jquery.bootstrap-wizard.js');?>"></script>
              <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
              <script src="<?php echo base_url('biller_assets/js/plugins/bootstrap-selectpicker.js');?>"></script>
              <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
              <script src="<?php echo base_url('biller_assets/js/plugins/bootstrap-datetimepicker.min.js');?>"></script>
              <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
              <script src="<?php echo base_url('biller_assets/js/plugins/jquery.dataTables.min.js');?>"></script>
              <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
              <script src="<?php echo base_url('biller_assets/js/plugins/bootstrap-tagsinput.js');?>"></script>
              <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
              <script src="<?php echo base_url('biller_assets/js/plugins/jasny-bootstrap.min.js');?>"></script>
              
              <script src="<?php echo base_url('biller_assets/js/plugins/fullcalendar.min.js');?>"></script>
              <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
              <script src="<?php echo base_url('biller_assets/js/plugins/jquery-jvectormap.js');?>"></script>
              <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
              <script src="<?php echo base_url('biller_assets/js/plugins/nouislider.min.js');?>"></script>
              <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
              <!-- Library for adding dinamically elements -->
              <script src="<?php echo base_url('biller_assets/js/plugins/arrive.min.js');?>"></script>
              <!--  Google Maps Plugin    -->
              <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
              <!-- Chartist JS -->
              <script src="<?php echo base_url('biller_assets/js/plugins/chartist.min.js');?>"></script>
              <!--  Notifications Plugin    -->
              <script src="<?php echo base_url('biller_assets/js/plugins/bootstrap-notify.js');?>"></script>
              <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
              <script src="<?php echo base_url('biller_assets/js/material-dashboard.min.js?v=2.0.2');?>" type="text/javascript"></script>
              <!-- Material Dashboard DEMO methods, don't include it in your project! -->
              <script src="<?php echo base_url('biller_assets/demo/demo.js')?>"></script>
              <script>
                $(document).ready(function() {
                  $().ready(function() {
                    $sidebar = $('.sidebar');

                    $sidebar_img_container = $sidebar.find('.sidebar-background');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                      if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                        $('.fixed-plugin .dropdown').addClass('open');
                      }

                    }

                    $('.fixed-plugin a').click(function(event) {
                      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                      if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                          event.stopPropagation();
                        } else if (window.event) {
                          window.event.cancelBubble = true;
                        }
                      }
                    });

                    $('.fixed-plugin .active-color span').click(function() {
                      $full_page_background = $('.full-page-background');

                      $(this).siblings().removeClass('active');
                      $(this).addClass('active');

                      var new_color = $(this).data('color');

                      if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                      }

                      if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                      }

                      if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                      }
                    });

                    $('.fixed-plugin .background-color .badge').click(function() {
                      $(this).siblings().removeClass('active');
                      $(this).addClass('active');

                      var new_color = $(this).data('background-color');

                      if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                      }
                    });

                    $('.fixed-plugin .img-holder').click(function() {
                      $full_page_background = $('.full-page-background');

                      $(this).parent('li').siblings().removeClass('active');
                      $(this).parent('li').addClass('active');


                      var new_image = $(this).find("img").attr('src');

                      if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                          $sidebar_img_container.fadeIn('fast');
                        });
                      }

                      if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                          $full_page_background.fadeIn('fast');
                        });
                      }

                      if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                      }

                      if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                      }
                    });

                    $('.switch-sidebar-image input').change(function() {
                      $full_page_background = $('.full-page-background');

                      $input = $(this);

                      if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                          $sidebar_img_container.fadeIn('fast');
                          $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                          $full_page_background.fadeIn('fast');
                          $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                      } else {
                        if ($sidebar_img_container.length != 0) {
                          $sidebar.removeAttr('data-image');
                          $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                          $full_page.removeAttr('data-image', '#');
                          $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                      }
                    });

                    $('.switch-sidebar-mini input').change(function() {
                      $body = $('body');

                      $input = $(this);

                      if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                      } else {

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                        setTimeout(function() {
                          $('body').addClass('sidebar-mini');

                          md.misc.sidebar_mini_active = true;
                        }, 300);
                      }

                      // we simulate the window Resize so the charts will get updated in realtime.
                      var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                      }, 180);

                      // we stop the simulation of Window Resize after the animations are completed
                      setTimeout(function() {
                        clearInterval(simulateWindowResize);
                      }, 1000);

                    });
                  });
                });
              </script>
              <script>
                $(document).ready(function() {
                  // Javascript method's body can be found in assets/js/demos.js
                  md.initDashboardPageCharts();

                  md.initVectorMap();

                });
              </script>
                <script>
    $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
<script type="text/javascript">
 function change_password()
{
 var old_password=document.getElementById("old_password").value;
 var new_password=document.getElementById("new_password").value;
 var confirm_password=document.getElementById("confirm_password").value;
if(new_password!=confirm_password)
{
  $("#res_msg").css('color','red');
  $("#res_msg").text("New password and confirm password mismatched");
}else{
  $.ajax({
  type: 'POST',
  url: '<?php echo base_url('biller/change_password'); ?>',
  data: {
   old_password:old_password,
   new_password:new_password
  },
  success: function (response) { 
    var obj = JSON.parse(response);
    if(obj.status==0)
    {
      $("#res_msg").css('color','red');
      $("#res_msg").text(obj.message);
    }else{
      $("#res_msg").css('color','green');
      $("#res_msg").text(obj.message);
      $("#old_password,#new_password,#confirm_password").val('');
      setInterval(function(){ 
       location.reload();
         }, 2000);
      
    }
    
  }
 });
  
}
 
}
function confirm_mpinpin()
{

 var new_mpin=document.getElementById("new_mpin").value;
 var confirm_mpin=document.getElementById("confirm_mpin").value;
 var user_id = '<?php echo $this->session->userdata('user_id'); ?>';
 var url ='<?php echo base_url('webservices/api.php'); ?>';
if(new_mpin=='')
{
$("#new_mpin").css('background-color','red');
}else if(confirm_mpin==''){
$("#confirm_mpin").css('background-color','red');
}else
if(new_mpin!=confirm_mpin)
{
  $("#res_msg").css('color','red');
  $("#res_msg").text("New MPIN and confirm MPIN mismatched");
}else{
 $("#confirm_mpin,#new_mpin").css('background-color','');
   $.ajax({
  type: 'POST',
  url: url,
  data: {
    'rquest':'set_mpin',
    'mpin':new_mpin,
    'user_id':user_id,
  },
  success: function (response) { 
    var obj = JSON.parse(response);
    if(obj.status==0)
    {
      $("#mpin_msg").css('color','red');
      $("#mpin_msg").text(obj.message);
    }else{
      $("#mpin_msg").css('color','green');
      $("#mpin_msg").text(obj.message);
      $("#new_mpin,#confirm_mpin").val('');
      setInterval(function(){ 
       location.reload();
         }, 2000);
    }
    
  }
 });
}
 
}

</script>
</body>
 <div class="modal fade" id="invoice_excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                        </button>
                    </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="width: auto!important;float: left;    line-height: 47px;">UPLOAD INVOICE EXCEL</h4>
                   
                     <a href="<?php echo base_url('uploads/demo_excel/consumer.xlsx'); ?>" class="btn btn-raised btn-primary" style="color: #fff;">
                Sample Excel
            </a> 
                 </div>
                <div class="card-body">
                   <form action="<?php echo base_url('biller/upload_consumer_excel'); ?>" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
                    <div class="card-block">
                       <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input"  placeholder="Upload Invoice Excel" name="consumer_excel">
                            <label class="custom-file-label" for="inputGroupFile01" style="font-size: 12px;color: #ccc;font-size: 12px;color: #777;line-height: 25px;">Upload Invoice Excel...</label>
                          </div>
                      </div> 
                     <button type="submit" class="btn btn-raised btn-primary">Upload</button>
                    </div>
                  </form>
                </div>
            </div>
            </div>
           </div>
          </div>
        </div>
      </div>
       <div class="modal fade" id="product_excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                        </button>
                    </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="width: auto!important;float: left;    line-height: 47px;">UPLOAD PRODUCT EXCEL</h4>
                   
                     <a href="<?php echo base_url('uploads/demo_excel/product_excel.xlsx'); ?>" class="btn btn-raised btn-primary" style="color: #fff;">
                Sample Excel
            </a> 
                 </div>
                <div class="card-body">
                   <form action="<?php echo site_url('biller/upload_product_excel'); ?>" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
                    <div class="card-block">
                       <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="product_excel" placeholder="Upload Invoice Excel">
                            <label class="custom-file-label" for="inputGroupFile01" style="font-size: 12px;color: #ccc;font-size: 12px;color: #777;line-height: 25px;">Upload product Excel...</label>
                          </div>
                      </div> 
                     <button type="submit" class="btn btn-raised btn-primary">Upload</button>
                    </div>
                  </form>
                </div>
            </div>
            </div>
           </div>
          </div>
        </div>
      </div>

 <div class="modal fade modal-mini modal-primary change_pass-wrap" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog modal-small">

                          <div class="modal-content new">
                                 <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                  <div class="card-icon">
                    <i class="material-icons">lock</i>
                  </div>
                  <h4 class="card-title">Change  Password</h4>
                </div>
              </div>
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                            </div>
                            <div class="modal-body">
                             
                                <div class="form-group bmd-form-group">
                                  <label for="exampleEmail" class="bmd-label-floating">Old Password </label>
                                  <input type="password" class="form-control" id="old_password" name="old_password" required="required">
                                </div>
                                <div class="form-group bmd-form-group">
                                  <label for="examplePass" class="bmd-label-floating">New Password</label>
                                  <input type="password" class="form-control" id="new_password" name="new_password" required="required">
                                </div>
                                   <div class="form-group bmd-form-group">
                                  <label for="examplePass" class="bmd-label-floating">Confirm Password</label>
                                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required="required">
                                </div>
                                <div class="card-footer" style="padding-left: 0;">
                              <button type="button" name="submit" class="btn btn-fill btn-rose" onclick="change_password()">Submit</button>
                            </div>
                         <span id="res_msg"></span>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                       <div class="modal fade modal-mini modal-primary change_pass-wrap" id="setmpin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-small">
                          <div class="modal-content new">
                                 <div class="card">
                        <div class="card-header card-header-rose card-header-text">
                  <div class="card-icon">
                    <i class="material-icons">#</i>
                  </div>
                  <h4 class="card-title">Set Mpin</h4>
                </div>
              </div>
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                            </div>
                            <div class="modal-body">
                             
                                <div class="form-group bmd-form-group">
                                  <label for="exampleEmail" class="bmd-label-floating">New MPIN </label>
                                  <input type="password" class="form-control" id="new_mpin" name="old_password" required="required">
                                </div>
                                <div class="form-group bmd-form-group">
                                  <label for="examplePass" class="bmd-label-floating">Confirm MPIN</label>
                                  <input type="password" class="form-control" id="confirm_mpin" name="new_password" required="required">
                                </div>
                                 
                                <div class="card-footer" style="padding-left: 0;">
                              <button type="button" name="submit" class="btn btn-fill btn-rose" onclick="confirm_mpinpin()">Submit</button>
                            </div>
                         <span id="mpin_msg"></span>
                            </div>
                            
                          </div>
                        </div>
                      </div>
</html>