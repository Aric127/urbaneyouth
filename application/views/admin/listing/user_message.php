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
            User Message
        </div>
        <!-- <div class="panel-options">
            <a href="<?php echo site_url('admin/add_about_content'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
                Add Content
            </a> 
        </div> -->
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
                    <th>S. No.</th>
                  <th>Users</th>
                  <th>Contact no.</th>
                    <th>Email/Message</th>
                </tr>
            </thead>
            <tbody>
                
                        <tr>
                            <td style="width: 10%">1</td>
                            <td>
                                <select name="users_list">
                                    <option value="none">Select</option>
                                </select>
                            </td>
                             <td></td>
                            <td></td>
                            <td style="width: 15%">
                            </td>
                        </tr>
      
            </tbody>
        </table>

    </div>

</div>