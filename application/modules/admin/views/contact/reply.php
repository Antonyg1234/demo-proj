<script src="<?php echo base_url(); ?>public/assets/js/admin/global.js"></script>
<div class="modal fade" id="order-detail" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Order Detail</h4>
                        </div>
                        <div class="modal-body">
                    
                       
                          <div class="form-horizontal">   
                          <?php echo form_open('admin/contact/reply_mail/'.$reply->id); ?>  
                           <div class="box-body">
                            
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Email To<span class="required">  *</span></label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Configuration Value" value="<?php echo $reply->email; ?>" disabled>
                                <span class="required"> <?php echo form_error('email'); ?></span>
                                </div>
                             </div>
                                  
                              <div class="form-group">
                               <label class="col-sm-3 control-label">Querry<span class="required">  *</span></label>
                                  <div class="col-sm-8">
                                    <?php echo $reply->message; ?>
                                  </div>
                              </div>
                             
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Reply</label>
                                  <div class="col-sm-8">
                                    <textarea name="reply_msg" class="form-control" rows="6" placeholder="Enter your message"></textarea>
                                  </div>
                              </div>
                              

                              <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                  <div class="col-sm-8">
                                    <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/contact'" type="button" class="cancelbtn">Cancel</button>
                                   <button style="width: 75px;display: inline;margin-top:0px;" type="submit" class="btn btn-block btn-success">Reply</button>
                                  </div>
                              </div>

                         </div>

                        </div>
                    
                      </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                  </div>
                  
                </div>
        </div>