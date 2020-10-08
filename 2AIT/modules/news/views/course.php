<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
 <script type="text/javascript" src="assets/redactor/ckeditor/ckeditor.js"></script>
<div class="row">    
    <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                    <div class="caption">
                            Add Course
                    </div>
            </div>
            <div class="portlet-body form">
                    <?=form_open_multipart("news/course", array('class' => 'form-horizontal'))?>
                            <div class="form-body">
                                     <div class="form-group">
                                                <label for="inputSuccess" class="col-md-3">Company Name*</label>

                                                <div class="col-md-9">
                                                    <?php  
                                                    $gal_cats = $this->CoreZ_IT->get('news_cat')->result(); ?>
                                                    <select class="form-control" name="course_cat" id="course_cat"  required> 
                                                        <option value="">Select category</option>
                                                        <?php foreach($gal_cats as $gal_cat ){ ?>
                                                            <option value="<?=$gal_cat->news_cat_id?>"><?=$gal_cat->title?></option>
                                                        <?php } ?>
                                                      
                                                    </select>
                                                </div>
                                            </div>
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-9">
                                                    <?php echo form_input($title);?>
                                            </div>
                                    </div>
                                   
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">Image</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                    <img src="uploads/extra/users/corezit.png" alt=""/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">

                                                </div>

                                                <div>
                                                    <span class="btn default btn-file">
                                                    <span class="fileinput-new">
                                                    Select image </span>
                                                    <span class="fileinput-exists">
                                                    Change </span>
                                                    <input type="file" name="slider_image">
                                                    </span>
                                                    <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                                </div>

                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">
                                                    NOTE! 
                                                </span>
                                                 &nbsp; Please Upload JPG or PNG files only. Maximum file size is 2MB or 2048KB.
                                            </div>

                                        <div class="form-group">
                                            <div class=" col-md-12">
                                                 
                                                <textarea name="description" id="editor1" rows="10" cols="80"></textarea>
                                            </div>
                                        </div>


                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-actions">
                                    <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <button type="reset" class="btn default">Reset</button>
                                            </div>
                                    </div>
                            </div>
                    <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
 <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/browser/browse.php',
    filebrowserUploadUrl: '/uploader/upload.php'
});
</script>


