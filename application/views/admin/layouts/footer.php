<div class="clearfix"></div>
<div class="footer bg-inverse">
    <p class="text-center">Copyright &copy; <?php echo date('Y'); ?> Advance India Insurance Broker Services Ltd, All rights reserved.</p>
</div>
</div></div>
<!-- Required Jquery -->
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/popper.js/js/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>-->

<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery-slimscroll/js/jquery.slimscroll.js'); ?>"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?php echo base_url('assets/admin/modernizr/js/modernizr.js'); ?>"></script>
<!-- data-table js -->
<script src="<?php echo base_url('assets/admin/data-table/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/data-table/js/responsive.bootstrap4.min.js'); ?>"></script>
<!-- Chart js -->
<!-- <script type="text/javascript" src="<?php echo base_url('assets/admin/chart.js/js/Chart.js'); ?>"></script> -->
<!-- amchart js -->
<!-- <script src="<?php echo base_url('assets/admin/pages/widget/amchart/amcharts.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/pages/widget/amchart/serial.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/pages/widget/amchart/light.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/admin/jquery/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery/js/SmoothScroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/jquery/js/pcoded.min.js'); ?>"></script>
<!-- custom js -->
<script src="<?php echo base_url('assets/admin/jquery/js/vartical-layout.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/pages/dashboard/custom-dashboard.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery/js/script.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery/js/custom.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<!-- BG JS File -->
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/common_custom.js'); ?>"></script>

<script type="text/javascript">
/*Delete Vehicle Models/Variants Confirmation Ajax Start*/
$(".remove").click(function(){
  var val = $(this).data("value");
  var fun_name = $(this).data("url"); 
  var url = '<?php echo base_url(); ?>admin/admin/'+fun_name+'/'; 
  var id = $(this).parents("tr").attr("id");
  //alert(fun_name+"--"+url+"---"+id);
  //return false;
  if(confirm('Are you sure to delete this vehicle '+val+'?'))
  {
    $.ajax({
      url: url+id,
      success: function(response) {
        if(response=='true'){
          $("#"+id).remove();
          alert("You have deleted this vehicle "+val+" successfully!!");
        }
        else{
          alert("Unable to deleted "+val+", Please try again!!");
        }
        /*alert(response);
        $("#"+id).remove();
        alert("You have deleted this vehicle model successfully!!"); */
      },
      error: function() {
        alert('Something is wrong!');
      },
    });
  }
});
/*Delete Vehicle Models/Variants Confirmation Ajax End*/

/** Add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.pcoded-left-item a').filter(function() {
   return this.href == url;
}).parent().addClass('active');

// For TreeView Menu active class JS
$('li.pcoded-hasmenu.pcoded-trigger a').filter(function() {
   return this.href == url;
}).parentsUntil(".pcoded-left-item > .pcoded-hasmenu").addClass('active');

$(document).ready(function(){
  $('.pcoded-left-item ul li.active').parent().closest('li').addClass('pcoded-trigger');
});
//End TreeView Menu active class JS
$('.input-group.date').datepicker({format: "dd.mm.yyyy"});
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'>

</body>
</html>