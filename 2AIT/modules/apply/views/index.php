<div class="banner-w3agile">
      <div class="container">
        <h3><a href="<?=base_url();?>">Home</a> / <span>Admission Form</span></h3>
      </div>
    </div>
    <div class="content">
      <!--contact-->
      <div class="contact-w3l">
        <div class="container">
          <h2 class="tittle">How To Find Us</h2>
          <div class="contact-bottom">
         
          </div>
          <div class="col-md-4 contact-left">
            <div class="contct-info">
              <h3>Please download the admission form  [ PDF] from in the link</h3>
              <p></p>
              <button>DOWNLOAD</button>
            </div>
          </div>

          <div class="col-md-8 contact-left cont">
            
            <div class="contct-info">
              <h4>APPLY IN ONLINE</h4>
              <form action="<?php echo site_url('apply/addClientData'); ?>" method="post">

                <div class="row">
                  <div class="col-md-6  col-sm-12 row-grid  ">
                  <input type="text" name="name" placeholder="Your Name (required)" required>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="row">
                  <div class="col-md-6 row-grid">
                  <input type="text" name="fother_name" placeholder="Father/ Mother Name" required>

                  </div>
                  <div class="clearfix"></div>
                </div>
               
                <div class="row">
                  <div class="col-md-6 row-grid">
                  <input type="date" name="date" placeholder="Date of Birth" required>
                  </div>
                  <div class="clearfix"></div>
                </div>
                 <p>&nbsp;</p>
                <div class="row">
                  <div class="col-md-6 row-grid">
                  <input type="text" name="nation_id" placeholder="National ID/ Passport No/ Birth Certificate (required)" required>
                  </div>
                  <div class="clearfix"></div>
                </div>
                 <p>&nbsp;</p>
                <div class="row">
                  <div class="col-md-6 row-grid">
                  <input type="text" name="mobile" placeholder="Mobile Number (required)" required>
                  </div>
                  <div class="clearfix"></div>
                </div>
                 <p>&nbsp;</p>
                 
                <div class="row">
                  <div class="col-md-6 row-grid">
                       <label>Course Select</label>
                       <select style="width: 100%" name="course" class="mdb-select md-form colorful-select dropdown-primary col-md-6 row-grid" multiple searchable="Search here..">
                         
                          <option value="Electrical Installation and Maintenance (3 month)" disabled selected><P>Electrical Installation and Maintenance (3 month)</P></option>
                          <option value="Refrigeration and Air Conditioning (3 month)"><p>Refrigeration and Air Conditioning (3 month)</p></option>
                          <option value="Sewing Machine Operation (3 month)"><p>Sewing Machine Operation (3 month)</p></option>
                          <option value="Housekeeping (2 months )"><p>Housekeeping (2 months )</p></option>
                          <option value="Food & Beverage (2 month)"><p>Food & Beverage (2 month)</p></option>
                          <option value="Tailoring & Dress Making (2 month)"><p>Tailoring & Dress Making (2 month)</p></option>
                          <option value="Advanced Graphic Design & Outsourcing (2 month)"><p>Advanced Graphic Design & Outsourcing (2 month)</p>
                          </option>
                       </select>
                        
                       
                    <div class="clearfix"></div>
                 </div> 
               </div>
                 
                 <p>&nbsp;</p>
                <div class="row">
                  <div class="col-md-6 row-grid">
                  <input type="text" name="address" placeholder="Address (Optional)" required>
                  </div>
                  <div class="clearfix"></div>
                </div>
                 <p>&nbsp;</p>
                <div class="row">
                  <div class="col-md-6 row-grid">
                  <input type="text" name="education" placeholder="Education" required>
                  </div>
                  <div class="clearfix"></div>
                </div>
        
                <input type="submit" value="Submit" >
                <input type="reset" value="Clear" >
              </form>
            </div>
          </div>


        </div>
      </div>
      <!--contact-->
    </div>