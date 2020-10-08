<!-- start banner Area -->
      <section class="banner-area relative" id="home">  
        <div class="overlay overlay-bg"></div>
        <div class="container">       
          <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
              <h1 class="text-white">
                Contact Us        
              </h1> 
              <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Contact Us</a></p>
            </div>  
          </div>
        </div>
      </section>
      <!-- End banner Area -->          

      <!-- Start contact-page Area -->
      <section class="contact-page-area section-gap">
        <div class="container">
          <div class="row">
            <div class="map-wrap" style="width:100%; height: 445px;" id="ap">
                
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29191.78947172287!2d90.65446948193787!3d23.855068210015517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375433f91fb27701:0x18ca4f1b772bff3b!2sMadhabdi!5e0!3m2!1sen!2sbd!4v1554720999174!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                
                
            </div>
            <div class="col-lg-4 d-flex flex-column address-wrap">
              <div class="single-contact-address d-flex flex-row">
                <div class="icon">
                  <span class="lnr lnr-home"></span>
                </div>
                <div class="contact-details">
                  <h5>Factory</h5>
                  <p>
                    Shekherchar(Baburhat),Narsindi,Bangladesh<br>
                    Office:CIP Tower, Madhabdi Bazar, Madhabdi-Narsingdi<br>
                    Bangladesh

                  </p>
                </div>
              </div>
              <div class="single-contact-address d-flex flex-row">
                <div class="icon">
                  <span class="lnr lnr-phone-handset"></span>
                </div>
                <div class="contact-details">
                  <h5>+88 029446573</h5>
                  <p>Mon to Fri 9am to 6 pm</p>
                </div>
              </div>
              <div class="single-contact-address d-flex flex-row">
                <div class="icon">
                  <span class="lnr lnr-envelope"></span>
                </div>
                <div class="contact-details">
                  <h5>mosharrafspinning64@gmail.com</h5>
                  <p>Send us your query anytime!</p>
                </div>
              </div>                            
            </div>
            <div class="col-lg-8">
              <form class="form-area " id="myForm" action="<?php echo site_url('contact/addClientData'); ?>" method="post" class="contact-form text-right">
                <div class="row"> 
                  <div class="col-lg-6 form-group">
                    <input name="contact_name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="text">
                  
                    <input name="contact_email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email">

                    <input name="contact_subject" placeholder="Enter your subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your subject'" class="common-input mb-20 form-control" required="" type="text">
                    <div class="mt-20 alert-msg" style="text-align: left;"></div>
                  </div>
                  <div class="col-lg-6 form-group">
                    <textarea class="common-textarea form-control" name="contact_message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                    <button class="genric-btn primary circle mt-30" style="float: right;">Send Message</button>               
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>  
      </section>
      <!-- End contact-page Area -->

