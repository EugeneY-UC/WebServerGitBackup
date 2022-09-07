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

?>
<script>
  var stateObject = {"USA":     ["Thiruvananthapuram"],
                    "Canada":   [""]}

window.onload = function () {
  var countySel = document.getElementById("countryId"),
  stateSel = document.getElementById("stateId"),
  for (var country in stateObject) {
    countySel.options[countySel.options.length] = new Option(country, country);
  }
  countySel.onchange = function () {
  stateSel.length = 1; // remove all options bar first
  districtSel.length = 1; // remove all options bar first
  if (this.selectedIndex < 1) return; // done
  for (var state in stateObject[this.value]) {
    stateSel.options[stateSel.options.length] = new Option(state, state);
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
            <div class="row_info"><strong>First Name:</strong> <?php echo $array['firstName']; ?>;</div>
            <div class="row_info"><strong>Last Name:</strong> <?php echo $array['lastName']; ?>;</div>
            <div class="row_info"><strong>Adress:</strong> <?php echo $array['addressID']; ?>;</div>
            <div class="row_info"><strong>Phone:</strong> <?php echo $array['phone']; ?>;</div>
            <div class="row_info"><strong>Email:</strong> <?php echo $array['email']; ?>;</div>
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

              <h3 class="box-title">EDIT OWNER</h3>
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
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
  jQuery( document ).ready(function($) {
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
