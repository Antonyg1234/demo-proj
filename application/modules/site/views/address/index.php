<?php
include(SIDENAV);
?>


 <div class="col-md-6">

      <div class="box">
            <div class="box-title" style="display:inline;font-size: 30px;">Address Details</div>
                <div class="col-md-3" style="float:right; display:inline;">
                <button style="float:right;margin-bottom:6px;margin-right:-14px;" type="button" class="box-title btn btn-block btn-warning" onclick="location.href='<?php echo base_url(); ?>site/address/add'">Add Address</button>
                </div>
                <!-- /.box-header -->

                 <?php if(!($address->result())){ ?>
          
                    <h3 style="text-align:center;color:#fe980f;">! No Address added !</h3>
                
                 <?php }else{ ?>

                    <div class="box-body">
                      <table class="table table-bordered">
                         <tbody>

                            <tr style="color: #fe980f">
                          
                              <th>Address </th>
                              <th style="width: 100px;">Action</th>
                            </tr>
                             <?php
                            // var_dump($address->result());die();
                             foreach ($address->result() as $row){
                                  ?>
                            <tr>
                              
                              <td class="col-md-8"><?php echo $row->address_1.',<br>'.$row->address_2.',<br>'.$row->city.',<br>'.$row->statename.',<br>'.$row->countryname.' - '.$row->zipcode; ?></td>
                              <td col-md-3>
                                 <div class="clearfix">
                                  <button type="submit" name="edit" class="btn btn-warning cart_inline"  onclick="location.href='<?php echo base_url(); ?>site/address/edit/<?php echo $row->id ?>'">Edit</button>
                                  <button type="button" onclick="deleteAddress(<?php echo $row->id ?>)" name="delete" class="btn btn-danger cart_inline">Delete</button>
                                 </div>
                                 
                              </td>
                            </tr>
                           <?php }?>   
                        </tbody>
                      </table>
                    </div>
                  <?php } ?>
                    <!-- /.box-body -->
          
          </div>
    </div>
  </div>
</section>