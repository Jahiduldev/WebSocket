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


<div class="banner-w3agile">
    <div class="container">
        <h3><a href="<?=base_url();?>">Home</a>/<span>Notice Board</span></h3>
    </div>
</div>
        <!--content-->
<div class="content">
        <div class="staff-w3l">
            <div class="container">
               <!--  <h3 class="tittle">Courses</h3> -->
                <div class="taff-grids">
               <?php foreach ($courses as $data){ ?>
                <div class="row" style=" overflow: hidden;margin-top: 2%;">
                     <div class="col-md-8">
                        <div>
                            <h4 style=""><b><?=$data->title?></b></h4>
                            <?=$data->description?>
                        </div>
                     </div>
                </div>
                <?php } ?>    
                </div>  
            </div>
        </div>
</div>  