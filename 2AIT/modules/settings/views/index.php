    
<script type="text/javascript" src="assets/redactor/fontsize.js"></script>
<script type="text/javascript" src="assets/redactor/fontfamily.js"></script>
<script type="text/javascript" src="assets/redactor/fullscreen.js"></script>
<script type="text/javascript" src="assets/redactor/fontcolor.js"></script>

<script type="text/javascript" src="assets/redactor/redactor.min.js"></script>
<link rel="stylesheet" href="assets/redactor/css/redactor.css" />
<script type="text/javascript">
	$(document).ready(
		function()
		{
			$('#redactor_content').redactor({
                                plugins: ['fontsize', 'fontfamily', 'fontcolor'],
                                imageUpload : '<?=site_url()?>fileupdown/image_upload'
			});
		}
	);
</script>


<div class="row">

    <div class="col-md-12 ">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Settings
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('settings', array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        
                        
                        <div class="form-group">
                                <label class="col-md-3 control-label">Email Footer</label>
                                <div class="col-md-5">
                                    <textarea name="mail_footer"  id="redactor_content" class="form-control"><?=$site->mail_footer?></textarea>
                                </div>
                                <div class="col-md-4">

                                    <table align="center" border="0" cellpadding="0" cellspacing="0" id="backgroundTable" style="border: 1px solid #B9B6B6;">
                                        <tbody>
                                            <tr>
                                                <td valign="top">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td height="90" style="color: #999999;" width="600">
                                                                    <img src="uploads/extra/logo/<?=$site->logo?>" alt="<?=$site->title?>" style="max-width: 111px; max-height: 70px;">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td bgcolor="#FFFFFF" height="200" style="background: whitesmoke; border: 1px  solid  #e0e0e0; font-family: Helvetica,Arial,sans-serif;" valign="top" width="600">
                                                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td height="10" width="560">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="560" style="padding-left: 20px;">
                                                                                    <h3>Mail Title</h3>

                                                                                    <p style="font-size: 12px; font-family: Helvetica,Arial,sans-serif;">Hello,</p>

                                                                                    <p style="font-size: 12px; line-height: 20px; font-family: Helvetica,Arial,sans-serif;">
                                                                                        Mail Body
                                                                                        <br><br>
                                                                                        Best regards,<br>
                                                                                        {Mail Footer}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10" width="560">&nbsp;</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10" width="600">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right">
                                                                    <span style="font-size: 10px; color: #999999; font-family: Helvetica,Arial,sans-serif;"><?=$site->copyrightYear?> &copy; <?=(!empty($site->copyrightUrl))?'<a href="'.$site->copyrightUrl.'">'.$site->copyrightText.'</a>':$site->copyrightText?> <?=(!empty($site->developedUrl))?'Developed & Maintains By <a href="'.$site->developedUrl.'">'.$site->developedText.'</a>':'Developed & Maintains By '.$site->developedText?></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="submit" value="avatar" class="btn blue">Confirm</button>
                                <button type="reset" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>