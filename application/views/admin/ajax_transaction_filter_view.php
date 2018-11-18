
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
<div class="table-responsive">
      <table id="example-1" class="table table-striped table-bordered table-small-font " cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Type</th>
                    <th>User Name</th>
                    <th>User Email / Mobile</th>
                    <th>Transaction Type</th>
                    <th>TransactionID / Refference</th>
                    <th>Amount</th>
                    <th>Transaction Date</th>
                    <th>Transaction Status</th>                
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($wallet_transaction)) {
    //   print_r($wallet_transaction);
                    $n = 1;
                    foreach ($wallet_transaction as $value) {
                        $trans_type=$value->wt_category;
                        if($trans_type=='1'){
                            $trans_type="Add Money";
                        }else if($trans_type=='2'){
                                $trans_type="Recharge";
                        }else if($trans_type=='3'){
                                $trans_type="Refund Money";
                        }else if($trans_type=='4'){
                                $trans_type="Cashback";
                        }else if($trans_type=='5'){
                                $trans_type="Transfer";
                        }else if($trans_type=='7'){
                                $trans_type="Add SMS";
                        }else if($trans_type=='8'){
                                $trans_type="Share SMS";
                        }else if($trans_type=='9'){
                                $trans_type="Refer Amount";
                        }
                        else if($trans_type=='10'){
                                $trans_type="Transfer money from";
                        }else if($trans_type=='11'){
                                $trans_type="Bill pay";
                        }else if($trans_type=='12'){
                                $trans_type="Electrictiy Bill";
                        }else if($trans_type=='13'){
                                $trans_type="Donation to Church";
                        }else if($trans_type=='16'){
                                $trans_type="Event Ticket Booking";
                        }
                        $redund_status=$value->refund_status;
                        if($redund_status=='1'){
                            
                            $ref_sttaus="Refund";
                        }else if($redund_status=='2'){
                            
                            $ref_sttaus='';
                        }
                        if($value->transaction_user_type=='1')
                        {
                            $userType='Registered User';
                        }else if($value->transaction_user_type=='2')
                        {
                            $userType='Guest User';
                        }
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 5%"><?php echo $userType; ?></td>
                            <td style="width: 10%"><?php if(!empty($value->user_name)){  echo $value->user_name; } else{
                                echo $value->user_contact_no;
                                } ?></td>
                            <td style="width: 20%"><?php if(!empty($value->user_email)){ echo $value->user_email; }else{
                                echo $value->user_contact_no;
                                }  ?></td>
                            <td  style="width: 10%"><?php echo $trans_type ?></td>
                             <td style="width: 20%"><?php echo $value->transaction_id." / ".$value->trans_ref_no;?></td>
                            <td><?php echo $value->wt_amount; ?></td>
                            <td style="width: 15%"><?php echo $value->wt_datetime;?></td>
                            <td style="width: 10%" <?php if($value->wt_status=='2'){?> style="color: red" <?php } ?>><?php if($value->wt_status=='1'){echo "Success";}else if($value->wt_status=='3'){echo "Failed".' '.$ref_sttaus;}else if($value->wt_status=='2'){echo "Pending";}?></td>
                            
                            <td style="width: 10%">
                              <a  href="<?php echo site_url('admin/view_perticuler_transaction') . '/'. $value->wt_id. '/'. $value->wt_user_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a>
                            <?php if($value->wt_category=='2' && $redund_status!=1 && $value->wt_status=='2'){ ?>
                               <a  onclick="if(!confirm('Are you sure, You want Refund this user?')){return false;}else{ fund_transfer(<?php echo $value->wt_user_id; ?>,<?php echo $value->wt_id; ?>)}" class="btn btn-blue btn-sm btn-icon icon-left">Refund</a>
                               <?php }?>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
        </div>
   