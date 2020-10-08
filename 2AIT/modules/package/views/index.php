<?php 
$id= $this->uri->segment(3);

if($id==5)
{
	$ti = 'Course';
}
elseif($id==6)
{
	$ti = 'ACCREDITATION';
}
elseif($id==7)
{
	$ti = 'ACADEMIC NEWS';
}
elseif($id==8)
{
	$ti = 'LEARNING CONTENT';
}
?>

<!-- start banner Area -->
<section class="banner-area relative" id="home">    
    <div class="overlay overlay-bg"></div>
    <div class="container">             
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?php 
                       if($this->uri->segment(3)==6){echo "Membership Form";}
                       elseif($this->uri->segment(3)==7){echo "Mosharraf Information";}
                        
                       else{echo "Govt. Regulation & Policies";}
                    ?>
                                   
                </h1>   
              <!--   <p class="text-white link-nav"><a href="home">Home </a>  <span class="lnr lnr-arrow-right"></span><a href="">
                  
                    </a> -->
                </p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->    

<!-- Start home-about Area -->
<section class="home-about-area section-gap aboutus-about" id="about">
    <div class="container">
        <div class="ow justify-content-center align-items-center">
            <div class="col-lg-8 col-md-12 home-about-left">
                <!-- <h6>Brand new app to blow your mind</h6> -->
                <h1>
                    <?php
                      if($this->uri->segment(3)==1){ echo " Office Order of Chittagong Custom House regarding Clearance of Raw Cotton.";  }
                            elseif($this->uri->segment(3)==2){  echo "Government Import Policy";  }
                            elseif($this->uri->segment(3)==3){  echo "Government Export Policy";  }
                            elseif($this->uri->segment(3)==4){  echo "Government Textile Policy"; }
                            elseif($this->uri->segment(3)==5){  echo "SRO";  }
                            elseif($this->uri->segment(3)==6){  echo "MOSHARRAF Membership Form";  }
                            elseif($this->uri->segment(3)==7){  echo "BASIC DATA OF BANGLADESH TEXTILE MILLS ASSOCIATION";  }
                            else{ echo""; } 
                    ?>        
                     
                </h1>
                <!--<p class="sub">Click the button below to download</p>-->
                <p class="pb-20">
                    <?php  if($this->uri->segment(3)==1){
                        
                   echo "All the laws of Bangladesh Government are strictly followed for the operation of this Company .";
                 }
                 elseif($this->uri->segment(3)==2)
                 {  echo "Best cotton (tula) are imported from various countries in the world such as USA , Turkeymenistan, Uzbegistan, India, Pakistan for ensuring  the quality of spin."; 
                 }
                 elseif($this->uri->segment(3)==3){
                     
                     echo "Various programs & policies are taken in home and abroad for earning foreign currency by exporting yarn";
                 }
                 elseif($this->uri->segment(3)==4){
                     
                   echo  "We are fulfilling the local demand by the production of our textile industry"; 
                 }elseif($this->uri->segment(3)==5){
                     
                     echo "SRO rules are strictly followed & exercised for customs, VAT( Value-Added Tax ) and other issues ";
                 }
                 
                 
                 
                 ?>
                </p>
                <!--<a style="background:#4285F4;" class="primary-btn" href="<?=base_url()?>assets/frontend/img/sample.pdf">Download Pdf</a>-->
            </div>
           
        </div>
    </div>  
</section>
<!-- End home-about Area -->
    
           