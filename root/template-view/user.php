<?php include_once "../template-view/header.php"; ?> 
<?php include_once "../template-view/menu.php"; ?>
<?php 
$array = array(
          "firstName"=>$json_data->{"General Settings"}->PCPH->{"PCPH Owner"}->firstName,
          "lastName"=>$json_data->{"General Settings"}->PCPH->{"PCPH Owner"}->lastName,
          "addressID"=>$json_data->{"General Settings"}->PCPH->{"PCPH Owner"}->addressID,
          "phone"=>$json_data->{"General Settings"}->PCPH->{"PCPH Owner"}->phone,
          "email"=>$json_data->{"General Settings"}->PCPH->{"PCPH Owner"}->email
        );

 
  $json_url = get_json_url();

?>

<script>
  var stateObject = {
  						"USA":     ["Alabama","Maine","Pennsylvania","Alaska","Maryland","Rhode Island","Arizona","Massachusetts","South Carolina","Arkansas","Michigan","South Dakota","California","Minnesota","Tennessee","Colorado","Mississippi","Texas","Connecticut","Missouri","Utah","Delaware","Montana","Vermont","District of Columbia","Nebraska","Virginia","Florida","Nevada","Washington","Georgia","New Hampshire","West Virginia","Hawaii","New Jersey","Wisconsin","Idaho","New Mexico","Wyoming","Illinois","New York","American Samoa","Indiana","North Carolina","Guam","Iowa","North Dakota","Northern Mariana Islands","Kansas","Ohio","Palau","Kentucky","Oklahoma","Puerto Rico","Louisiana","Oregon","Virgin Islands"],
                    	"Canada":   ["Alberta","British Columbia","Manitoba","New Brunswick","Newfoundland","Northwest Territories","Nova Scotia","Nunavut","Ontario","Prince Edward Island","Quebec","Saskatchewan","Yukon"]
                	}

window.onload = function () {
  var countySel = document.getElementById("countryId"),
  stateSel = document.getElementById("stateId");
  for (var country in stateObject) {
    countySel.options[countySel.options.length] = new Option(country, country);
  }
  countySel.onchange = function () {
  stateSel.length = 1; // remove all options bar first
  if (this.selectedIndex < 1) return; // done
  var district = stateObject[countySel.value];
  for (var i = 0; i < district.length; i++) {
		stateSel.options[stateSel.options.length] = new Option(district[i], district[i]);
  }
}
}
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header col-lg-6 connectedSortable">
      <div class="box box-info">
        <div class="box-header">
              <i class="fa fa-user"></i>
              <h3 class="box-title">Owner Detals</h3>
        </div>
        <div class="box-body">
          <div class="owner_data">
            <div class="row_info"><strong>First Name:</strong> <?php echo $array['firstName']; ?></div>
            <div class="row_info"><strong>Last Name:</strong> <?php echo $array['lastName']; ?></div>
            <div class="row_info"><strong>Adress:</strong> <?php echo $array['addressID']; ?></div>
            <div class="row_info"><strong>Phone:</strong> <?php echo $array['phone']; ?></div>
            <div class="row_info"><strong>Email:</strong> <?php echo $array['email']; ?></div>
         </div>
        </div>
        
      </div>
      <div class="box box-info">
        <div class="box-header">
              <i class="fa fa-file"></i>
              <h3 class="box-title">JSON</h3>
        </div>
        <div class="box-body json_setting">
            <div>
              <form id="upload_json" enctype="multipart/form-data" >
                 Upload JSON: <input name="userfile" type="file" accept=".json"  required />
                <input type="submit" value="Upload" /><a href="http://<?php echo $json_url ?>" class="download_json" download>Download JSON</a>
            </form>
          </div>
        </div>
      </div>
      
    </section>




    <!-- Main content -->
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable content-header">
          <div class="box box-info">
            
            <div class="box-header">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Edit Owner</h3>
              <!-- tools box -->
              
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form id="add_owner" action="/template/owner_add.php" method="post" >
                <div class="form-group">
                  <input type="text" class="form-control" name="first_name" placeholder="First name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:" required>
                </div>
                <!-- <div class="form-group">
                  <input type="text" class="form-control" name="country" placeholder="Country">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="state" placeholder="State">
                </div> -->
                <select name="country" class="countries dropdown-select" id="countryId" required>
				    <option value="">Select Country</option>
        		</select>
        		<select name="state" class="states dropdown-select" id="stateId" required>
        			<option value="">Please select Country first</option>
        		</select>
                <div class="form-group">
                  <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                </div>
                <div class="box-footer clearfix">
                   <input type="submit" id="enter" class="btn btn-block btn-primary" value="Submit" >
                </div>
              </form>
            </div>
            
          </div>

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
    $('#upload_json').submit(function(e) {
        e.preventDefault();
        var form = $('#upload_json')[0];
        var data = new FormData(form);
        $.ajax({
          url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/upload_json.php',
          data: data,
          method: 'POST',
          processData: false,
          contentType: false,
          success: function(response){
            alert("Update completed");
          },
          error:function(resp){
            console.log("Error:"+resp);
          }
        });
    });


     $('#add_owner').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/owner_edit.php',
            data: $(this).serialize(),
            success: function(response)
            {
              alert("Update completed");
              location.href=location.href;
           },
            error: function() {
              alert('There was some error performing the AJAX call!');
            }
       });
    });
   });
</script>
<!-- jQuery 2.2.0 -->
<?php include "footer.php"; ?>
