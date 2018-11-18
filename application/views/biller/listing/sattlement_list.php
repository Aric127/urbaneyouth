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
            My Settlement
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

        <table id="example-1" class="table-small-font table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Settlement Amount(&#8358;)</th>
                    <th>Transaction Ref</th>
                    <th>Transaction Date</th>
                    <th>Settlement Note</th>
                    <th>Attachment</th>
                    <th>Settlement Date</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($my_sattlement)) {
       
                    $n = 1;
                    foreach ($my_sattlement as $value) { ?>
            
                        <tr>
                            <td style="width: 8%"><?php echo $n; ?></td>
                             <td style="width: 25%"><?php echo $value->settlement_amount; ?></td>
                            <td style="width: 25%"><?php echo $value->transaction_ref ; ?></td>
                                <td style="width: 25%"><?php echo $value->transaction_date ; ?></td>
                                    <td style="width: 25%"><?php echo $value->sattlement_note ; ?></td>
                           <td style="width: 15%"><a style="cursor: pointer" href="<?php echo biller_sattlement.'/'.$value->sattlement_attachment; ?>" >Attachment</a></td>
                      	   <td style="width: 25%"><?php echo $value->sattlement_date ; ?></td>
                            
                            
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
