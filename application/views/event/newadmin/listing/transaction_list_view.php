
<!--main content start-->
<section id="main-content">
 <section class="wrapper">
        <!-- page start-->
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
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> Transaction List
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table transaction-content-table">
						
						<div class="row">
						   <div class="col-xs-6 counter-show-on-top">
									<div class="counter-item">
										<h5>8</h5>
										<h6>Today</h6>
									</div>
									<div class="counter-item">
										<h5>46</h5>
										<h6>Weekly</h6>
									</div>
									<div class="counter-item">
										<h5>136</h5>
										<h6>Monthly</h6>
									</div>
									<div class="counter-item">
										<h5>1154</h5>
										<h6>Yearly</h6>
									</div>
							</div> 
						</div>
						<div class="row">
								<div class="col-md-2">
								<label class="control-label">Date Wise</label>
								<div class="clearfix"></div>
								<input id="input_test" value="" type="hidden">
							   
							   <input type="text" name="txt" id="selected_date" class="daterange form-control add-ranges" data-format="MMMM D, YYYY" data-start-date="" value=""/> 
							  
								</div>
								<div class="col-md-2">
									<label class="control-label">Operator</label>
									<select id="operator_id" class="form-control input-dark" name="operator_id" data-validate="required">
												<option value="">--- Select ---</option>
												<option value="1">Etislat </option>
                                				<option value="2">Airtel</option>
                                				<option value="3">MTN</option>
                                				<option value="4">African Cable Television ACTV</option>
                                				<option value="5">MultiChoice DSTV</option>
                                				<option value="6">Consat Cable Network</option>
                                				<option value="7">Metro Digital</option>
                                				<option value="8">NETCOM Africa</option>
                                				<option value="9">SWIFT</option>
                                				<option value="10">IPNX Nigeria</option>
                                				<option value="11">ETISALAT</option>
                                				<option value="12">SPECTRANET</option>
                                				<option value="13">Smile Recharge</option>
                                				<option value="14">GLOBACOM</option>
                                				<option value="15">VDT Communications</option>
                                				<option value="16">Glo</option>
                                				<option value="17">Visafone</option>
                                				<option value="20">Startimes</option>
                                				<option value="21">Smile Bundle</option>
                                				<option value="22">Star Times Cable TV</option>
                                				<option value="23">MTN </option>
                                				<option value="25">MultiChoice GOTV</option>
                                				<option value="26">Ikeja Electric Postpaid</option>
                                				<option value="27">Ikeja Electric Prepaid</option>
                                				<option value="28">Ibadan Disco</option>
                                <!--                                <option value="1">1 - Month</option>
                                <option value="6">6 - Month</option>-->
                </select>
            </div>
								<div class="col-md-2">
									<label class="control-label">Recharge Type</label>

										<select id="recharge_type" class="form-control input-dark" name="recharge_type" data-validate="required">
														<option value="">--- Select ---</option>
														<option value="1">Mobile</option>
														<option value="2">DTH</option>
										<option value="3">Data Card</option>
										</select>
								</div>
								<div class="col-md-2">
									<label class="control-label">Recharge Status</label>

										<select id="recharge_status" class="form-control input-dark" name="recharge_status" data-validate="required">
														<option value="">--- Select ---</option>
										<option value="1">Success</option>
														<option value="2">Failed</option>
										<option value="3">Pending</option>
										
										
										</select>
								</div>
								<div class="col-md-2">
									<label class="control-label">Transaction Type</label>

										<select id="transaction_type" class="form-control input-dark" name="transaction_type" data-validate="required">
														<option value="">--- Select ---</option>
										<option value="1">Add Money</option>
														<option value="2">Recharge</option>
										<option value="3">Refund</option>
										<option value="4">Cashback</option>
										<option value="5">Transfer Money</option>
										<option value="6">Receive Benifits</option>
										<option value="7">Add SMS</option>
										<option value="8">Share SMS</option>
										<option value="9">Refer Money</option>
						<!--				<option value="10">6 - Month</option>-->
										</select>
								</div>
								<div class="col-md-2">
								<label class="control-label">&nbsp;</label>
								<div class="clearfix"></div>
								<button id="sub" class="btn btn-info submi" value="Submit" type="button"> Submit </button>

								&nbsp; &nbsp;
								<input style="display: none;" id="excel" class="btn btn-success pull-left" value="Export" type="submit">

								</div>
 
							</div>
							<div class="dt-buttons">
								<a class="buttons-excel btn" tabindex="0" aria-controls="example-1">
									<span>Excel</span>
								</a>
								<a class="buttons-print btn" tabindex="0" aria-controls="example-1"><span>Print</span>
							</a>
							</div>
							
							
							
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
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
                        }
                        $redund_status=$value->refund_status;
                        if($redund_status=='1'){
                            
                            $ref_sttaus="Refund";
                        }else if($redund_status=='2'){
                            
                            $ref_sttaus='';
                        }
                        ?>
                                <tr class="">
									<td><?php echo $n; ?></td>
                                    <td><?php echo $value->user_name; ?> </td>
                                    <td><?php echo $value->user_email; ?></td>
                                    <td><?php echo $trans_type ?></td>
									<td><?php echo $value->transaction_id." / ".$value->trans_ref_no;?></td>
                                    <td><?php echo $value->wt_amount; ?></td>
                                    <td><?php echo $value->wt_datetime;?></td>
                                    <td><?php if($value->wt_status=='1'){echo "Success";}else if($value->wt_status=='3'){echo "Failed".' '.$ref_sttaus;}else if($value->wt_status=='2'){echo "Pending";}?></td>
                                    <td <?php if($value->wt_status=='2'){?> style="color: red" <?php } ?>><a href="<?php echo site_url('admin/view_perticuler_transaction') . '/'. $value->wt_id. '/'. $value->wt_user_id; ?>"  class="btn btn-warning btn-xs"> View </a></td>
                                </tr>
								 <?php $n = $n + 1; } } ?>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
</section>
<!--main content end-->
