<!-- start banner Area -->
    <section class="banner-area relative" id="home">    
        <div class="overlay overlay-bg"></div>
        <div class="container">             
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        About Us                
                    </h1>   
                    <p class="text-white link-nav"><a href="<?=base_url();?>home">Home</a><span class="lnr lnr-arrow-right"></span><a href="#">About Us</a></p>
                </div>  
            </div>
        </div>
    </section>
   
    <section class="service-area section-gap" id="service">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 pb-30 header-text text-center">
                    <h1 class="mb-10">
                        <?php   

                            if($this->uri->segment(3)==1){ echo "President";  }
                            elseif($this->uri->segment(3)==2){  echo "Vice Presidents";  }
                            elseif($this->uri->segment(3)==3){  echo "Board of Directors";  }
                            else{ echo""; } 

                        ?>    
                    </h1>
                </div>
            </div>                      
            <div class="row">
           <?php foreach ($abouts as $about) { ?>
                <div class="col-lg-4">
                    <div class="single-service">
                        <div class="thumb">
                            <img src="<?=base_url();?>/assets/frontend/img/director.jpg" alt="">                                   
                        </div>
                        <h4 style="text-align: center;"><?=$about->title;?></h4>
                        <p style="text-align: center;">
                            <?=$about->sub_title;?>
                        </p>
                    </div>
                </div>
            <?php } ?>                                             
            </div>
        </div>  
    </section>
   