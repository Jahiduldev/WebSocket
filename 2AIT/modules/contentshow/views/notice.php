<div class="banner-w3agile">
    <div class="container">
        <h3><a href="<?=base_url();?>">Home</a> / <span>Course</span></h3>
    </div>
</div>
        <!--content-->
<div class="content">
        <div class="staff-w3l">
            <div class="container">
               <!--  <h3 class="tittle">Courses</h3> -->
                <div class="taff-grids">
               <?php foreach ($courses as $data){?>
                <div class="row" style="min-height:250px;max-height: 300px; overflow: hidden;">
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