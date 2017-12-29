<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/form.css">
</head>
<body>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div>
        <h1 style="display: inline;">Product page</h1>

    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Product</h3>
        </div>
        <div class="form-horizontal">
            <?php echo form_open_multipart('admin/product/edit/'.$id, 'id="myForm"', 'name="myForm"'); ?>
            <div class="box-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Name<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control capitalize" id="product_name" name="product_name" placeholder="Product Name"  value="<?php echo $data[0]['name'];?>">
                        <span class="required"> <?php echo form_error('product_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Price<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo $data[0]['price'];?>">
                        <span class="required"> <?php echo form_error('price'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Special Price<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="special_price" name="special_price" placeholder="Special Price" value="<?php echo $data[0]['special_price'];?>">
                        <span class="required"> <?php echo form_error('special_price'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Quantity<span class="required">  *</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo $data[0]['quantity'];?>">
                        <span class="required"> <?php echo form_error('quantity'); ?></span>
                    </div>
                </div>
                
                <div class="form-group">
                      <label class="col-md-2 control-label">Product Category<span class="required">  *</span></label>
                      <div class="col-sm-6">
                        <select id="category_select" name="category_select[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">

                            <?php foreach ($dropdown->result() as $row){ ?>
                                <option value="<?php echo $row->id;?>"
                                    <?php foreach($data as $product){
                                        if($product['category_id']== $row->id){
                                            echo 'selected';
                                        }
                                    } ?>><?php echo $row->name;?></option>
                            <?php } ?>

                        </select>
                        <span class="required"> <?php echo form_error('category_select'); ?></span>
                     </div>
                </div>
                 


                <span class="required" style="margin-left: 175px;"><?php echo $this->session->flashdata('error'); ?></span>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload Image<span class="required"> *</span></label>
                    <div class="col-sm-6">
                        <input name="uploadedimage" id="imgInp" type="file" placeholder="Choose File" class="mandatory_fildes" value="upload">
                        <td style="text-align:center"><img src="<?php echo base_url();?>public/assets/images/uploads/product/<?php echo $data[0]['image_name'];?> " alt="" style="width:200px; height:auto;"></td><br>
                        <img id='img-upload' />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Short Description</label>
                    <div class="col-sm-6">
                        <textarea name="short_description" class="form-control" rows="3" placeholder="Enter ..." ><?php echo $data[0]['short_description'];?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Long Description</label>
                    <div class="col-sm-6">
                        <textarea name="long_description" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data[0]['long_description'];?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status <span class="required"> *</span></label>
                    <div class="col-sm-10">

                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" <?php if($data[0]['status'] == '1') echo "checked";?>> Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0" <?php if($data[0]['status'] == '0') echo "checked";?>> Inactive
                        </label>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Featured <span class="required"> *</span></label>
                    <div class="checkbox col-sm-10">

                        <label>
                            <input type="checkbox" name="featured" <?php if($data[0]['is_featured'] == '1') echo "checked";?> value="1">
                        </label>
                    </div>
                </div>


                <div class="clearfix" style="margin-left: 175px;">
                    <button style="width: 75px;display: inline" class="btn btn-block btn-danger" onclick="location.href='<?php echo base_url();?>admin/product'" type="button" class="cancelbtn">Cancel</button>
                    <button style="width: 75px;display: inline;margin-top: 10px;" type="submit" class="btn btn-block btn-success">Update</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</section>
</body>
</html>