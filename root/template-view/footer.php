
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<!-- Bootstrap 3.3.6 -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/bootstrap/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dist/js/demo.js"></script>

<script>
	jQuery( document ).ready(function($) {
		$('ul.sidebar-menu a').each(function(){
	    if (this.href == document.URL) {
	      $(this).closest("li").addClass('active');
	    }
	  });
	})
</script>
</body>
</html>