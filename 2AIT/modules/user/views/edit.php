    <div class="row">
        <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box blue">
                        <div class="portlet-title">
                                <div class="caption">
                                        Create User
                                </div>
                        </div>
                        <div class="portlet-body form">
                                <?=form_open(uri_string(), array('class' => 'form-horizontal'))?>
                                        <div class="form-body">
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">First Name</label>
                                                        <div class="col-md-9">
                                                                <?php echo form_input($first_name);?>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Last Name</label>
                                                        <div class="col-md-9">
                                                                <?php echo form_input($last_name);?>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Designation</label>
                                                        <div class="col-md-9">
                                                                <?php echo form_input($designation);?>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Phone</label>
                                                        <div class="col-md-9">
                                                                <?php echo form_input($phone);?>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Password</label>
                                                        <div class="col-md-9">
                                                                <?php echo form_input($password);?>
                                                                <span class="help-block"> If Changing Password. </span>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Confirm Password</label>
                                                        <div class="col-md-9">
                                                                <?php echo form_input($password_confirm);?>
                                                                <span class="help-block"> If Changing Password. </span>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Member of groups</label>
                                                        <div class="col-md-9">
                                                                <div class="checkbox-list">
                                                                        <?php foreach ($groups as $group):?>
                                                                            <label>
                                                                            <?php
                                                                                $gID=$group['id'];
                                                                                $checked = null;
                                                                                $item = null;
                                                                                foreach($currentGroups as $grp) {
                                                                                    if ($gID == $grp->id) {
                                                                                        $checked= ' checked="checked"';
                                                                                    break;
                                                                                    }
                                                                                }
                                                                            ?>
                                                                            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>" <?php echo $checked;?>>
                                                                            <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                                                                            </label>
                                                                        <?php endforeach?>
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
                                    <?php echo form_hidden('username', $edit_user->username);?>
                                    <?php echo form_hidden($csrf); ?>
                                <?php echo form_close();?>
                        </div>
                </div>
        </div>
</div>


