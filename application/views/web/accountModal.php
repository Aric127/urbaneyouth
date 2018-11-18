<!DOCTYPE html>
<html lang="en">
<head>
  <title>Otp verification</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
      
      $(document).ready(function () {

          $('#myModal').modal({backdrop: 'static', keyboard: false})  

      });


      $('#myModal').on('hidden.bs.modal', function () {
          alert('hidden event fired!');
      });

  </script>
</head>
<body>

<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <h1 class="text-center">Verify your payment</h1>
        </div>
        <div class="modal-body">
          

          <form method="post" id="veryfyotp" action="<?php echo base_url('web/AcoountOtpVerify') ?>" >
              <div class="row">                    
              <div class="form-group col-sm-8">
                 <span style="color:red;"></span>  
                 <input type="text" class="form-control" name="otp" placeholder="Enter your OTP number" required=""  pattern="[0-9.]+" maxlength="6" autocomplete="off">
                 <input type="hidden" name="transactionRef" value="<?php echo $id; ?>">
                 <input type="hidden" name="redirecturl" value="<?php echo $redirecturl; ?>">
              </div>
              <button type="submit" class="btn btn-primary  pull-right col-sm-3">Verify</button>
              </div>
          </form>

        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>
