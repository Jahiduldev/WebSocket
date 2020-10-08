
    <!-- breadcumb-area start -->
    <div class="breadcumb-area flex-style  black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Sevices Page</h2>
                    <ul class="d-flex">
                        <li><a href="index.html">Home</a></li>
                        <li><i class="fa fa-angle-double-right"></i></li>
                        <li><span>Service</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->

    <!-- about-area start -->
    <div class="service-page-area">
        <div class="container">
            <div class="row">

          <?php $x = 0; foreach ($services as $service) { ?>

                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="service-wrappper">
                        <img src="<?=base_url();?>/uploads/event/<?=$service->image?>" alt="">
                        <div class="service-contents">
                            <h3><a href="#"><?=$service->title?></a></h3>
                            <p><?=$service->designation?></p>
                        </div>
                        
                    </div>
                </div>
          <?php  $x++;  if ($x%3==0 ) { echo '<div class="clearfix"></div>'; } } ?>




            </div>
        </div>
    </div>
    <!-- about-area end -->
