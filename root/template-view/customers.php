<?php include_once "../template-view/header.php"; ?> 
<?php include_once "../template-view/menu.php"; ?>
<?php 

$customer = array();

foreach ($json_data->RegisteredCustomers as $line) {  
  $arr = array(
          "customerID"=>$line->customerID,
          "chargerNodeID"=>$line->chargerNodeID,
          "parkingSlotID"=>$line->parkingSlotID,
          "addressID"=>$line->addressID,
          "userName"=>$line->userName,
          "firstName"=>$line->firstName,
          "lastName"=>$line->lastName,
          "phone"=>$line->phone,
          "email"=>$line->email,
          "pin"=>$line->pin,
          "password"=>$line->password,
          "tempChargerNode"=>$line->tempChargerNode,
          "status"=>$line->status
        ); 
$customer[]=$arr;
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
              <i class="fas fa-user"></i>

              <h3 class="box-title">Registered Customers</h3>
              <!-- tools box -->
              
              <table>
                <thead>
                    <tr><td>ID</td><td>NodeID</td><td>ParkingSlotID</td><td>Address</td><td>User Name</td><td>Firs tName</td><td>Last Name</td><td>Phone</td><td>Email</td><td>Pin</td><td>Pass</td><td>TempChargerNode</td><td>Active<td>Edit</td><td>Delete</td></tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($customer as $pow) {
                    if($pow["status"] ==="off"){
                      $lamp = "<div class='off_item' val='off'></div>";
                    }else{
                      $lamp = "<div class='on_item' val='on'></div>";
                    }
                    echo "<tr><td id='id' val='".$pow["customerID"]."'>".$pow["customerID"]."</td><td id='chargerNodeID'>".$pow["chargerNodeID"]."</td><td id='parkingSlotID'>".$pow["parkingSlotID"]."</td><td id='addressID'>".$pow["addressID"]."</td><td id='userName'>".$pow["userName"]."</td><td id='firstName'>".$pow["firstName"]."</td><td id='lastName'>".$pow["lastName"]."</td><td id='phone'>".$pow["phone"]."</td><td id='email'>".$pow["email"]."</td><td id='pin'>".$pow["pin"]."</td><td id='password'>".$pow["password"]."</td><td id='tempChargerNode'>".$pow["tempChargerNode"]."</td><td id='status'>".$lamp."</td><td class='dis_customer'><i class='fas fa-edit'></i></td><td class='del_customer'><i class='fas fa-trash-alt'></i></td></tr>";
                  }
                  ?>
                  
                </tbody>
              </table>
              <input type="button" name="add_customer" id="add_customer" value="Add Customers">
              <!-- /. tools -->
            </div>
            <div class="box-body">
              
            </div>
            
          </div>
          <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Update <b>Customer</b> to id:"<span></span>"</h3>
            <form id="edit_customer">
              <input type="hidden" name="id" value="">
              <div>
              <label for="chargerNodeID"> Charger Node ID  </label>
	              <select id="chargerNodeID" name="chargerNodeID">
                  <option value=""></option>
	                  <?php 
	                      foreach ($json_data->Nodes->RegisteredNodes as $line) {  
	                          echo "<option value ='$line->NodeID'>$line->NodeID</option>";       
	                      }
	                  ?>
	              </select>
              </div>
              <div>
              <label for="parkingSlotID"> Parking Slot ID</label>
                <input type="text" name="parkingSlotID" value="">
              </div>
              <div>
              <label for="addressID"> Address ID </label>
                <input type="text" name="addressID" value="">
              </div>

              <div>
              <label for="userName"> User Name </label>
                <input type="text" name="userName" value="" required>
              </div>

              <div>
              <label for="firstName"> First Name </label>
                <input type="text" name="firstName" value="">
              </div>

              <div>
              <label for="lastName"> Last Name </label>
                <input type="text" name="lastName" value="">
              </div>

              <div>
              <label for="phone"> Phone </label>
                <input type="text" name="phone" value="" required>
              </div>

              <div>
              <label for="email"> Email </label>
                <input type="text" name="email" value="" required>
              </div>

              <div>
              <label for="pin"> Pin </label>
                <input type="text" name="pin" value="" required>
              </div>

              <div>
              <label for="password"> Password </label>
                <input type="text" name="password" value="" required>
              </div>

              <div>
              <label for="status"> Status </label>
                <select id="status" name="status">
                      <option value ='on'>On</option>";   
                      <option value ='off'>Off</option>";     
                </select>
              </div>
              <input type="submit" name="submit" value="Update">
            </form>
          </div>

        </div>


        <div id="myModal2" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add <b>Customer</b></h3>
            <form id="add_customer_form">
              
              <div>
              <label for="chargerNodeID"> Charger Node ID  </label>
	              <select id="chargerNodeID" name="chargerNodeID">
                  <option value=""></option>
	                  <?php 
	                      foreach ($json_data->Nodes->RegisteredNodes as $line) {  
	                          echo "<option value ='$line->NodeID'>$line->NodeID</option>";       
	                      }
	                  ?>
	              </select>
              </div>
              <div>
              <label for="parkingSlotID"> Parking Slot ID</label>
                <input type="text" name="parkingSlotID" value="">
              </div>
              <div>
              <label for="addressID"> Address ID </label>
                <input type="text" name="addressID" value="">
              </div>

              <div>
              <label for="userName"> User Name </label>
                <input type="text" name="userName" value="" required>
              </div>

              <div>
              <label for="firstName"> First Name </label>
                <input type="text" name="firstName" value="">
              </div>

              <div>
              <label for="lastName"> Last Name </label>
                <input type="text" name="lastName" value="">
              </div>

              <div>
              <label for="phone"> Phone </label>
                <input type="text" name="phone" value="" required>
              </div>

              <div>
              <label for="email"> Email </label>
                <input type="text" name="email" value="" required>
              </div>

              <div>
              <label for="pin"> Pin </label>
                <input type="text" name="pin" value="" required>
              </div>

              <div>
              <label for="password"> Password </label>
                <input type="text" name="password" value="" required>
              </div>
              <div>
              <label for="status"> Status </label>
                <select id="status" name="status">
                      <option value ='on'>On</option>";   
                      <option value ='off'>Off</option>";     
                </select>
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
      $("body").on("click",".dis_customer i", function(){
        $("#myModal").toggleClass("active");
        var id = $(this).closest("tr").find("td#id").text();
        var chargerNodeID = $(this).closest("tr").find("td#chargerNodeID").text();
        var parkingSlotID = $(this).closest("tr").find("td#parkingSlotID").text();
        var addressID = $(this).closest("tr").find("td#addressID").text();
        var userName = $(this).closest("tr").find("td#userName").text();
        var firstName = $(this).closest("tr").find("td#firstName").text();
        var lastName = $(this).closest("tr").find("td#lastName").text();
        var phone = $(this).closest("tr").find("td#phone").text();
        var email = $(this).closest("tr").find("td#email").text();
        var pin = $(this).closest("tr").find("td#pin").text();
        var password = $(this).closest("tr").find("td#password").text();
        var tempChargerNode = $(this).closest("tr").find("td#tempChargerNode").text();
        var status = $(this).closest("tr").find("td#status>div").attr('val');

        $("#myModal .modal-content h3 span").text(id);
        $("#myModal input[type='hidden']").attr("value",id);
        $('#myModal input[name="parkingSlotID"]').attr("value",parkingSlotID);
        $('#myModal input[name="addressID"]').attr("value",addressID);
        $('#myModal input[name="userName"]').attr("value",userName);
        $('#myModal input[name="firstName"]').attr("value",firstName);
        $('#myModal input[name="lastName"]').attr("value",lastName);
        $('#myModal input[name="phone"]').attr("value",phone);
        $('#myModal input[name="email"]').attr("value",email);
        $('#myModal input[name="pin"]').attr("value",pin);
        $('#myModal input[name="password"]').attr("value",password);
        $('#myModal input[name="tempChargerNode"]').attr("value",tempChargerNode);
        $('#myModal input[name="status"]').attr("value",status);

        $('#chargerNodeID option[value="'+chargerNodeID+'"]').prop('selected', true);
        $('#status option[value="'+status+'"]').prop('selected', true);
        
    });

    $("#add_customer").on("click", function(){
      $("#myModal2").toggleClass("active");
      $("form#add_customer_form")[0].reset();
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
      function valid_pin(){
        var pin =$("#add_customer_form input[name='pin']").val(); 
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/get_pin.php',
            data: {"pin":pin},
            success: function(response)
            {
              console.log(response);
              if (response === "unsuccess"){
                $("#add_customer_form").find("div.error").detach();
                $("#add_customer_form input[type=submit]").attr("disabled",true);
                $("#add_customer_form input[name='pin']").after("<div class='error'>Such a pin already exists</div>");
              }
              else
              {
                $("#add_customer_form input[type=submit]").attr("disabled",false);
                $("#add_customer_form").find("div.error").detach();
              }
            }
        })
      }

      function valid_pin_upd(){
        var pin =$("#edit_customer input[name='pin']").val(); 
        var id = $("#edit_customer input[name='id']").val();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/get_pin_upd.php',
            data: {"pin":pin,"id":id},
            success: function(response)
            {
              console.log(response);
              if (response === "unsuccess"){
                $("#edit_customer").find("div.error").detach();
                $("#edit_customer input[type=submit]").attr("disabled",true);
                $("#edit_customer input[name='pin']").after("<div class='error'>Such a pin already exists</div>");
              }
              else
              {
                $("#edit_customer input[type=submit]").attr("disabled",false);
                $("#edit_customer").find("div.error").detach();
              }
            }
        })
      }

      $("#add_customer_form input[name='pin']").on("input",function(){
        valid_pin();
      })

      $("#edit_customer input[name='pin']").on("input",function(){
        valid_pin_upd();
      })

     $('#edit_customer').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/edit_customer.php',
            data: $(this).serialize(),
            success: function(response)
            {
              alert("Update completed");
              $("#myModal").toggleClass("active");
              var resp = JSON.parse(response);
              console.log(resp);
              $("td[val="+resp.id+"]").closest("tr").find("#chargerNodeID").text(resp.chargerNodeID);
              $("td[val="+resp.id+"]").closest("tr").find("#parkingSlotID").text(resp.parkingSlotID);
              $("td[val="+resp.id+"]").closest("tr").find("#addressID").text(resp.addressID);
              $("td[val="+resp.id+"]").closest("tr").find("#userName").text(resp.userName);
              $("td[val="+resp.id+"]").closest("tr").find("#firstName").text(resp.firstName);
              $("td[val="+resp.id+"]").closest("tr").find("#lastName").text(resp.lastName);
              $("td[val="+resp.id+"]").closest("tr").find("#phone").text(resp.phone);
              $("td[val="+resp.id+"]").closest("tr").find("#email").text(resp.email);
              $("td[val="+resp.id+"]").closest("tr").find("#pin").text(resp.pin);
              $("td[val="+resp.id+"]").closest("tr").find("#password").text(resp.password);
              $("td[val="+resp.id+"]").closest("tr").find("#status").html("<div class='"+resp.status+"_item' val='"+resp.status+"'></div>");

           },
            error: function() {
              alert('There was some error performing the AJAX call!');
            }
       })        
    });


     $('#add_customer_form').submit(function(e) {
        e.preventDefault();
          $.ajax({
              type: "POST",
              url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_customer.php',
              data: $(this).serialize(),
              success: function(response)
              {
                $("#myModal2").toggleClass("active");
                alert("Add completed");
                var resp = JSON.parse(response);
                console.log(resp);
                $("tbody").append("<tr><td id='id' val='"+resp.customerID+"'>"+resp.customerID+"</td><td id='chargerNodeID'>"+resp.chargerNodeID+"</td><td id='parkingSlotID'>"+resp.parkingSlotID+"</td><td id='addressID'>"+resp.addressID+"</td><td id='userName'>"+resp.userName+"</td><td id='firstName'>"+resp.firstName+"</td><td id='lastName'>"+resp.lastName+"</td><td id='phone'>"+resp.phone+"</td><td id='email'>"+resp.email+"</td><td id='pin'>"+resp.pin+"</td><td id='password'>"+resp.password+"</td><td id='tempChargerNode'> </td><td id='status'><div class='"+resp.status+"_item' val='"+resp.status+"'></div></td><td class='dis_customer'><i class='fas fa-edit'></i></td><td class='del_customer'><i class='fas fa-trash-alt'></i></td></tr>");
                $("#add_customer_form").trigger("reset");
                
             },
              error: function() {
                alert('There was some error performing the AJAX call!');
              }
         })
    });

     $("body").on("click",".del_customer i", function(){
          var id_del = $(this).closest("tr").find("td#id").text();
          var del = $(this).closest("tr");
          if(confirm("Do you really want to delete customer " + id_del+" ?")){
            $.ajax({
              type: "POST",
              url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/del_customer.php',
              data: {id:id_del},
              success: function(response)
              {
                alert(response); 
                del.detach();
                
              },
              error: function() {
                alert('There was some error performing the AJAX call!');
              }
          });
         };

          
    });

     $("span.close").on("click",function(){
        $("#edit_customer input[type=submit]").attr("disabled",false);
        $("#edit_customer").find("div.error").detach();
        $("#add_customer_form input[type=submit]").attr("disabled",false);
        $("#add_customer_form").find("div.error").detach();
     })
     
   });



</script>
<!-- jQuery 2.2.0 -->

<?php include "footer.php"; ?>
