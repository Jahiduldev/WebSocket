
        <div class="page-title gallery-title text-center">
          <h2 class="text-extra-bold white text-uppercase">Gallery</h2>
          <div class="page-location direct text-center display-ib">
            <span class="ubuntu fz-14 green-5c">Home   <i class="gray-e9">/</i>   Gallery</span>
          </div>
        </div>

        <section class="mt-150 mb-150 gallery">
          <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class=" black h-sep">Recent  <span class="text-ultra-bold">Works</span> </h3>
                    <p class="fz-16 gray-666 mt-50">Our charity helps those people who have no hope</p>
                </div>
            </div>
            <div class="row mt-20">
                <?php foreach ($products as $product){?>
              <div class="col-md-3 col-sm-6 mt-50 text-center">
                <div class="gallery-item">
                  <div class="gallery-img">
                      <img class="img-responsive" src="uploads/gallery/<?=$product->image;?>" alt="">
                    <div class="gallery-overlay"></div>
                    <div class="gallery-overlay-content text-center">
                      <img data-featherlight="assets/frontend/img/g1.jpg" src="assets/frontend/img/locked.png" alt="">
                    </div>
                  </div>
                  <h5 class="text-semi-bold mt-30"><?=$product->title?></h5>
                </div>
              </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-100 view-more">
                    <a href="#" class="btn-prime tri-b fz-15">View More</a>
                </div>
            </div>
          </div>
        </section>
