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

<style type="text/css">
  .staff-w3l {
    padding: 5em 0;
    background: #ffffff;
  }
</style>
<div class="banner-w3agile">
    <div class="container">
        <h3><a href="<?=base_url();?>">Home</a>/<span>Employers</span></h3>
    </div>
</div>
        <!--content-->
<div class="content">
        <div class="staff-w3l">
            <div class="container">
               <!--  <h3 class="tittle">Courses</h3> -->
                <div class="taff-grids">
             
                <div class="row col-md-offset-2" style=" overflow: hidden;margin-top: 2%;">
                      <?php  foreach ($courses as $data){ ?>

                         <div class="col-md-4">
                             <?=$data->description;?>
                         </div>

                       <?php } ?>  
                </div>
                  
                </div>  
            </div>
        </div>
</div>  