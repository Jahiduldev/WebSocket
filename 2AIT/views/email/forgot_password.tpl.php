<?php
    $site = $this->CoreZ_IT->get('site')->row();
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" id="backgroundTable">
    <tbody>
        <tr>
            <td valign="top">
                <table align="center" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td height="90" style="color: #999999;" width="600">
                                <img src="<?=base_url()?>uploads/extra/logo/<?=$site->logo?>" alt="<?=$site->title?>" style="max-width: 111px; max-height: 70px;">
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
                                                <h3>Reset Password</h3>

                                                <p style="font-size: 12px; font-family: Helvetica,Arial,sans-serif;">Hello,</p>

                                                <p style="font-size: 12px; line-height: 20px; font-family: Helvetica,Arial,sans-serif;">
                                                    <?php echo sprintf(lang('email_forgot_password_subheading'), anchor('user/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?>
                                                    <br><br>
                                                    Best regards,<br>
                                                    <?=$site->mail_footer?>
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
