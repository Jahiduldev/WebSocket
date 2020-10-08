<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title><?=$site->title?> | <?=$page_title?></title>
        <base href="<?=base_url()?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
        <!-- BEGIN THEME STYLES -->
        <link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
      <!--   <link rel="shortcut icon" href="uploads/extra/logo/"/> -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        
        <script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
        
        
        <!-- END CORE PLUGINS -->
        <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function() {    
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
            });
       </script>
    </head>
    <body class="page-header-fixed page-quick-sidebar-over-content"  style="word-wrap: break-word;">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner">
                        <!-- BEGIN LOGO -->
                        <div class="page-logo">
                            
                                <a href="">
                                    <!-- <img src="uploads/extra/logo/" alt="LOGO"  class="logo-default"/> -->
                                </a>
                                <div class="menu-toggler sidebar-toggler hide">
                                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                                </div>
                        </div>
                        <!-- END LOGO -->
                        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        </a>
                        <!-- END RESPONSIVE MENU TOGGLER -->
                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                       <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <li class="dropdown dropdown-user">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                              
                                                <span class="username username-hide-on-mobile">
                                               </span>
                                                <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                        <li>
                                                            <?=anchor("user/change_avatar", '<i class="fa fa-image"></i> Change Image')?>
                                                        </li>
                                                        <li>
                                                            <?=anchor("user/change_password", '<i class="icon-lock"></i> Change Password')?>
                                                        </li>
                                                        <li class="divider">
                                                        </li>
                                                        <li>
                                                            <?=anchor("user/logout", '<i class="icon-key"></i> Log Out')?>
                                                        </li>
                                                        
                                                </ul>
                                        </li>
                                        <!-- END USER LOGIN DROPDOWN -->
                                </ul>
                        </div>
                        <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu " data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				
                <li class="start <?=($controller == 'dashboard')?'active':''?>">
                    <?=anchor('dashboard','<i class="icon-home"></i><span class="title">Dashboard</span>')?>
				</li>
                <?php if($this->ion_auth->is_admin()){ ?>
				<li class="<?=($controller == 'user')?'active open':''?>">
					<a href="javascript:;">
					<i class="icon-users"></i>
					<span class="title">User</span>
					<span class="arrow <?=($controller == 'user')?'open':''?>"></span>
					</a>
					<ul class="sub-menu">
                        
						<li class="<?=($controller == 'user' && $method == 'all')?'active':''?>">
							<?=anchor('user/all','<i class="icon-users"></i><span class="title"> All Users</span>')?>
						</li>
						<li class="<?=($controller == 'user' && $method == 'create')?'active':''?>">
                                                        <?=anchor('user/create','<i class="icon-user-follow"></i><span class="title"> Create User</span>')?>
						</li>
                                            
					</ul>
				</li>

             
                    <li class="<?=($controller == 'slider')?'active open':''?>">
    				<a href="javascript:;">
    				<i class="icon-users"></i>
    				<span class="title">Slider</span>
    				<span class="arrow <?=($controller == 'slider')?'open':''?>"></span>
    				</a>
    				<ul class="sub-menu">
    					<li class="<?=($controller == 'slider' && $method == 'all')?'active':''?>">
    						<?=anchor('slider/all','<i class="icon-users"></i><span class="title"> All slider</span>')?>
    					</li>
    					<li class="<?=($controller == 'slider' && $method == 'create')?'active':''?>">
                                                        <?=anchor('slider/add','<i class="icon-user-follow"></i><span class="title">Add slider</span>')?>
    					</li>
                                            
    				</ul>
    			</li>
               
                <?php } ?>
                   
                <li class="start <?=($controller == 'home')?'active':''?>">
                    <?=anchor('home/all','<i class="fa fa-cogs"></i><span class="title">Updae Marquee</span>')?>
                </li>
                <li class="start <?=($controller == 'about')?'active':''?>">
                    <?=anchor('about/course','<i class="fa fa-cogs"></i><span class="title">About Us</span>')?>
                </li>
                 <li class="<?=($controller == 'package')?'active open':''?>">
                    <a href="javascript:;">
                    <i class="icon-users"></i>
                    <span class="title">Academic & Shake.</span>
                    <span class="arrow <?=($controller == 'course')?'open':''?>"></span>
                    </a>
                    <ul class="sub-menu">
                        
                         <li class="<?=($controller == 'course' && $method == 'course/add')?'active':''?>">
                            <?=anchor('package/course','<i class="icon-users"></i><span class="title">Add Course</span>')?>
                        </li>
                        <li class="<?=($controller == 'package' && $method == 'add')?'active':''?>">
                            <?=anchor('package/add_cat','<i class="icon-user-follow"></i><span class="title">Add Course Category</span>')?>
                        </li>
                        <li class="<?=($controller == 'package' && $method == 'add')?'active':''?>">
                            <?=anchor('package/all_cat','<i class="icon-user-follow"></i><span class="title">All Category</span>')?>
                        </li>

                        <li class="<?=($controller == 'package' && $method == 'all')?'active':''?>">
                            <?=anchor('package/all','<i class="icon-users"></i><span class="title"> All Courses</span>')?>
                        </li>
                        
                        
                                            
                    </ul>
                </li>

                <li class="<?=($controller == 'project')?'active open':''?>">
                    <a href="javascript:;">
                    <i class="icon-users"></i>
                    <span class="title">Admission Form</span>
                    <span class="arrow <?=($controller == 'project')?'open':''?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?=($controller == 'project' && $method == 'all')?'active':''?>">
                            <?=anchor('project/all','<i class="icon-users"></i><span class="title"> All Applications</span>')?>
                        </li>                 
                    </ul>
                </li>
               
                

                <li class="<?=($controller == 'gallery')?'active open':''?>">
					<a href="javascript:;">
					<i class="icon-users"></i>
					<span class="title">Gallery</span>
					<span class="arrow <?=($controller == 'gallery')?'open':''?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?=($controller == 'gallery' && $method == 'all')?'active':''?>">
							<?=anchor('gallery/all','<i class="icon-users"></i><span class="title"> All gallery</span>')?>
						</li>
						<li class="<?=($controller == 'product' && $method == 'add')?'active':''?>">
                                                        <?=anchor('gallery/add','<i class="icon-user-follow"></i><span class="title">Add gallery</span>')?>
						</li>
                         <li class="<?=($controller == 'gallery' && $method == 'all_cat')?'active':''?>">
                            <?=anchor('gallery/all_cat','<i class="icon-users"></i><span class="title"> All Category</span>')?>
                        </li>
                        <li class="<?=($controller == 'gallery' && $method == 'add_cat')?'active':''?>">
                            <?=anchor('gallery/add_cat','<i class="icon-users"></i><span class="title"> Add Category</span>')?>
                        </li>

                                            
					</ul>
				</li>


                <li class="<?=($controller == 'news')?'active open':''?>">
                    <a href="javascript:;">
                    <i class="icon-users"></i>
                    <span class="title">Latest News</span>
                    <span class="arrow <?=($controller == 'news')?'open':''?>"></span>
                    </a>
                    <ul class="sub-menu">
                        
                         <li class="<?=($controller == 'news' && $method == 'news/add')?'active':''?>">
                            <?=anchor('news/course','<i class="icon-users"></i><span class="title">Add News Details</span>')?>
                        </li>
                        <li class="<?=($controller == 'news' && $method == 'add')?'active':''?>">
                            <?=anchor('news/add_cat','<i class="icon-user-follow"></i><span class="title">Add News</span>')?>
                        </li>
                        <li class="<?=($controller == 'news' && $method == 'add')?'active':''?>">
                            <?=anchor('news/all_cat','<i class="icon-user-follow"></i><span class="title">All News</span>')?>
                        </li>

                        <li class="<?=($controller == 'news' && $method == 'all')?'active':''?>">
                            <?=anchor('news/all','<i class="icon-users"></i><span class="title"> All News Details</span>')?>
                        </li>
                        
                        
                                            
                    </ul>
                </li>
                </ul>
		</div>
            </div>
            <div class="page-content-wrapper">
		<div class="page-content">
			
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li class="text-capitalize" >						
                                            <?php
                                                $explode = explode('_', $controller);
                                                $controller_name = implode(' ', $explode);
                                            ?>
                                            <?=$controller_name?>
					</li>
                                        <?php if(!empty($method)){ 
                                            $explode = explode('_', $method);
                                            $method_name = implode(' ', $explode);
                                        ?>                                        
                                            <li class="text-capitalize" >
                                                    <i class="fa fa-angle-right"></i>
                                                    <?=$method_name?>

                                            </li>
                                        <?php } ?>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt">
                                                    <i class="fa fa-calendar"></i> <?=date("F j, Y, g:i a")?>
						</button>
						
					</div>
				</div>
			</div>
            <?php if(!empty($message)){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <strong>Success!</strong> <?=$message?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($message_error)){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <strong>Error!</strong> <?=$message_error?>
                        </div>
                    </div>
                </div>
            <?php } ?>