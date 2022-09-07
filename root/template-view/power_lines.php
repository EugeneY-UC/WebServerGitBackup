<?php include_once "../template-view/header.php"; ?> 
<?php include_once "../template-view/menu.php"; ?>
<?php 

$power_line = array();

foreach ($json_data->PowerLines as $line) {  
  $arr = array(
          "PowerLineID"=>$line->PowerLineID,
          "PowerLineName"=>$line->PowerLineName,
          "MaxAmp"=>$line->MaxAmp
        ); 
$power_line[]=$arr;
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
     
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-info">
            <div class="box-header">
              <i class="fas fa-charging-station"></i>

              <h3 class="box-title">Power Lines</h3>
              <!-- tools box -->
              
              <table>
                <thead>
                    <tr><td>ID</td><td>Line Name</td><td>Max AMP</td><td>Edit</td><td>Delete</td></tr>
                  </thead>
                <tbody>
                  <?php 
                  foreach ($power_line as $pow) {
                    echo "<tr><td id='plid' val='".$pow["PowerLineID"]."'>".$pow["PowerLineID"]."</td><td id='pl'>".$pow["PowerLineName"]."</td><td id='ma'>".$pow["MaxAmp"]."</td><td class='dis_lines'><i class='fas fa-edit'></i></td><td class='del_lines'><i class='fas fa-trash-alt'></i></td></tr>";
                  }
                  ?>
                  
                </tbody>
              </table>
              <input type="button" name="add_line" id="add_line" value="Add Power Line">
              <!-- /. tools -->
            </div>
            <div class="box-body">
              
            </div>
            
          </div>
          <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Update <b>Power Line</b> id <span></span></h3>
            <form id="edit_power_line">
              <input type="hidden" name="id" value="">
              <div>
              <label for="line_name"> Line Name </label>
                <input type="text" name="line_name" value="" required>
              </div>
              <div>
              <label for="max_amp"> Max AMP </label>
                <input type="number" name="max_amp" value="" required>
              </div>
              <input type="submit" name="submit" value="Update">
              
            </form>
          </div>

        </div>


        <div id="myModal2" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add <b>Power Line</b></h3>
            <form id="add_power_line">
              <div>
              <label for="line_name"> Line Name </label>
                <input type="text" name="line_name" value="" required>
              </div>
              <div>
              <label for="max_amp"> Max AMP </label>
                <input type="number" name="max_amp" value="" required>
              </div>
              <input type="submit" name="submit" value="Add">
              
            </form>
          </div>

        </div>
        </section>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
  </footer>
  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<script>
  jQuery( document ).ready(function($) {

    
      $("body").on("click",".dis_lines i", function(){
      $("#myModal").toggleClass("active");
      var id = $(this).closest("tr").find("td#plid").text();
      var ln = $(this).closest("tr").find("td#pl").text();
      var ma = $(this).closest("tr").find("td#ma").text();
      $("#myModal .modal-content h3 span").text(id);
      $("#myModal input[type='hidden']").attr("value",id);
      $('#myModal input[name="line_name"]').attr("value",ln);
      $('#myModal input[name="max_amp"]').attr("value",ma);

    });
    $("#add_line").on("click", function(){
      $("#myModal2").toggleClass("active");
    });
    

    $("#myModal .close").on("click", function(){
      $("#myModal").toggleClass("active");
    });

    $("#myModal2 .close").on("click", function(){
      $("#myModal2").toggleClass("active");
    });
  });
</script>

<script>
  jQuery( document ).ready(function($) {
     $('#edit_power_line').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/edit_line.php',
            data: $(this).serialize(),
            success: function(response)
            {
              alert("Update completed");
              $("#myModal").toggleClass("active");
              var resp = JSON.parse(response);
              $("td[val="+resp.id+"]").closest("tr").find("#pl").text(resp.PowerLineName);
              $("td[val="+resp.id+"]").closest("tr").find("#ma").text(resp.MaxAmp);
           },
            error: function() {
              alert('There was some error performing the AJAX call!');
            }
       });
    });


     $('#add_power_line').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_line.php',
            data: $(this).serialize(),
            success: function(response)
            {
              $("#myModal2").toggleClass("active");
              alert("Add completed");
              var resp = JSON.parse(response);
              $("tbody").append("<tr><td>"+resp.PowerLineID+"</td><td>"+resp.PowerLineName+"</td><td>"+resp.MaxAmp+"</td><td><i class='fas fa-edit' ></i></td><td><i class='fas fa-trash-alt'></i></td></tr>");
              $("tbody tr:last td").each(function(index ){
                  switch(index) {
                    case 0:
                      $(this).attr("id","plid");
                      $(this).attr("val",resp.PowerLineID);
                      $(this).text(resp.PowerLineID);
                      break

                    case 1:  
                      $(this).attr("id","pl");
                      $(this).text(resp.PowerLineName);
                      break

                    case 2:  
                      $(this).attr("id","ma");
                      $(this).text(resp.MaxAmp);
                      break

                    case 3:  
                      $(this).addClass("dis_lines");
                      break

                    case 4:  
                      $(this).addClass("del_lines");
                      break

                    default:
                      break
                  }
              });
              $('#add_power_line').trigger('reset');
           },
            error: function() {
              alert('There was some error performing the AJAX call!');
            }
       });
    });

     $("body").on("click",".del_lines i", function(){
          var id_del = $(this).closest("tr").find("td#plid").text();
          var del = $(this).closest("tr");
          if(confirm("Do you really want to delete Power Line " + id_del +" ?")){
            $.ajax({
              type: "POST",
              url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/del_line.php',
              data: {id:id_del},
              success: function(response)
              {
                var resp = JSON.parse(response);
                
                if(resp.bool === false){
                  alert(resp.mess); 
                  del.detach();
                }else{
                  alert(resp.mess); 
                }
                
              },
              error: function() {
                alert('There was some error performing the AJAX call!');
              }
          });
         };

          
    });
   });
</script>
<!-- jQuery 2.2.0 -->

<?php include "footer.php"; ?>
