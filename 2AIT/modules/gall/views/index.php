
    <div class="banner-w3agile">
      <div class="container">
        <h3><a href="<?=base_url();?>">Home</a> / <span>Gallery</span></h3>
      </div>
    </div>
<!--Projects-->
    <div class="content">
      <div class="projects-agile">
        <div class="container">
          <h2 class="tittle">Gallery</h2>
            <div class="portfolio_grid_w3lss">

  <?php $x = 0; foreach ($gallerys as $data) { ?>
              <div class="col-md-4 w3agile_Projects_grid">
                <div class="w3agile_Projects_image">
                  <a class="sb" href="images/1.jpg" title="quis nostrud exercitation ullamco laboris quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum">
                    <figure>
                      <img src="<?=base_url()?>uploads/gallery/<?=$data->image?>" alt="" class="img-responsive" />
                      <figcaption>
                        <h4></h4>
                        <!-- <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p> -->
                      </figcaption>
                    </figure>
                  </a>
                </div>
              </div>
          <?php $x++; 
          if($x%3==0){ echo '<div class="clearfix"></div>'; } } ?>             

            </div>


          <script type="text/javascript" src="<?=base_url();?>assets/frontend/js/smoothbox.jquery2.js"></script>
        </div>
      </div>
    </div>
    <!--Projects