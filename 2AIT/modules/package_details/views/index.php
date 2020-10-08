<div class="breadcumb-area flex-style  black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Package Details</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->

    <!-- blog-details-area start -->
    <div class="blog-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">

                   <?php foreach ($package_titles as $package_title) {  ?>
                    <div class="blog-details-wrap">
                        <img src="assets/images//blog/blog-details.jpg" alt="">
                        <h3>Digital Marketo Moved To Their Office</h3>
                        <?php echo $package_title->texteditor; ?>
                    </div>

                  <?php } ?>
                   
                </div>
            </div>
        </div>
    </div>
