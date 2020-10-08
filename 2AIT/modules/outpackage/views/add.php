<script type="text/javascript" src="assets/redactor/fontsize.js"></script>
<script type="text/javascript" src="assets/redactor/fontfamily.js"></script>
<script type="text/javascript" src="assets/redactor/fullscreen.js"></script>
<script type="text/javascript" src="assets/redactor/fontcolor.js"></script>

<script type="text/javascript" src="assets/redactor/redactor.min.js"></script>
<link rel="stylesheet" href="assets/redactor/css/redactor.css" />

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- editor start -->
  <script type="text/javascript" src="assets/redactor/ckeditor/ckeditor.js"></script>
        
<!-- editor end -->
<script type="text/javascript">
    
    $(document).ready(function(){
            $('#redactor_content').redactor({
                    plugins: ['fontsize', 'fontfamily', 'fontcolor'],
                    imageUpload : '<?=site_url()?>fileupdown/image_upload'
            });
            $('.date-picker').datepicker();
            $("#add_attached_file").click(function(){
                $('<div class="form-group"><div class="col-md-offset-3 col-md-4"><?php echo form_input($attachedName);?></div><div class="col-md-5"><input type="file" name="attached[]"></div></div>').appendTo("#attached");
            });
        });
        
</script>
<script type="text/javascript">
    $(document).ready(
        function()
        {
            $('#redactor_content,#re').redactor({
                plugins: ['fontsize', 'fontfamily', 'fontcolor'],
                imageUpload : '<?=site_url()?>fileupdown/image_upload'
            });
        }
    );
</script>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<div class="row">    
    <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet box blue">
                    <div class="portlet-title">
                            <div class="caption">
                                    Add Package
                            </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('outpackage/add'); ?>" enctype="multipart/form-data">

                                    <div class="form-body">
                                            <div class="form-group">
                                                <div class=" col-md-12">
                                                     
                                                <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
            
       
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
                              </form>
                    </div>
            </div>
    </div>
</div>
 <script>
 
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>

