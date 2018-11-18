<?php if ($this->session->flashdata('status')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('status'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
            Event Viewer List
        </div>
        <div class="panel-options">
           <!-- <a href="<?php echo site_url('admin/add_biller'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
                Add church
           </a> -->
        </div>
    </div>

    <div id="user_list" class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-1").dataTable({
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
            });
        </script>

        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SNo.</th>
                     <th>Event Viewer</th>
                    <th>Email Id</th>
                     <th>Conatct No</th>
                    <th>Company</th>
                    <th>Image</th>
                   
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($event_viewer_list)) {
      
                    $n = 1;
                    foreach ($event_viewer_list as $value) { ?>
            
                        <tr>
                            <td style="width: 8%"><?php echo $n; ?></td>
                              <td style="width: 25%"><?php echo $value->biller_name; ?></td>
                             <td style="width: 25%"><?php echo $value->biller_email	; ?></td>
                                 <td style="width: 25%"><?php echo $value->biller_contact_no; ?></td>
                            <td style="width: 25%"><?php echo $value->biller_company_name ; ?></td>
                           <td style="width: 15%"><img src="<?php echo biller_company_logo.'/'.$value->biller_company_logo; ?>" height="90" width="90"></td>
                      	   
                            
                           
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
