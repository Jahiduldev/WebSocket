<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<style>
    .product_image{
            max-width: 150px;
            max-height: 150px;
    }
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                        All Applications
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_6">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Birth</th>
                            <th>NID</th>
                            <th>Mobile</th>
                            <th>Course</th>  
                            <th>Address</th>
                            <th>Education</th>             
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($applys as $apply){ ?>
                            <tr>
                                <td><?=$apply->name?></td>
                                <td><?=$apply->father_name?></td>
                                 <td><?=$apply->birth_date?></td>
                                <td><?=$apply->nation_id?></td>
                                <td><?=$apply->mobile?></td>
                                <td><?=$apply->course?></td>
                                 <td><?=$apply->address?></td>
                                <td><?=$apply->education?></td>                            
                                <td><?=anchor("project/delete/".$apply->id, 'Delete')?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
jQuery(document).ready(function() {       
   TableAdvanced.init();
});
</script>


