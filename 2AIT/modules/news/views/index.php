<!-- start banner Area -->
      <section class="banner-area relative" id="home">  
        <div class="overlay overlay-bg"></div>
        <div class="container">       
          <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
              <h1 class="text-white">
                At a Glance        
              </h1> 
              <!-- <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Contact Us</a></p -->>
            </div>  
          </div>
        </div>
      </section>
      <!-- End banner Area -->          

      <!-- Start contact-page Area -->
      <section class="contact-page-area section-gap">
        <div class="container">
          <div class="row">
            <?php foreach ($news as $new){  ?>
            <h1 style="text-align: justify;"><?=$new->title;?></h1>

             <p style="margin-top: 3%;">Mosharraf Spinning Mills Limited is a 100% export oriented yarn manufacturing company. The company has been incorporated with the Registrar of Joint Stock Companies as a Private Limited Company on March 13,2007 with a paid up capital of Tk. 20.00 million against an authorized capital of TK. 150.00 million. The company has started commercial operation in March, 2009. The Company has been producing high quality yarn, ranging from 30 Counts to 80 Counts from ring spinning & rotor count 10 to 30. Currently Mosharraf Spinning has been operating with 51,312 spindles with the daily production capacity of 15,000 Kgs yarn per day under Ring frame and Rotor with 100% capacity utilization. The management is led by the Managing Director having 33 years of business experience in different sectors relating to textile industries. The company procures high quality raw-cotton of different origin to ensure high quality standard of yarns. MSMPL has its own 30,000 sft warehouse for raw materials storage with a capacity of 16,000 ton raw cotton and 20,000 sft for finished goods with a capacity of 600 ton in its factory premises. The company usually maintains a buffer stock of raw-cotton as inventory for uninterrupted operation. The company sells all of its finished products as dream export against back to back L/Cs.</p>
        <?php } ?>
          </div>

        </div>  
      </section>
      <!-- End contact-page Area -->

