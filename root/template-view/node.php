<?php include_once "../template-view/header.php"; ?> 
<?php include_once "../template-view/menu.php"; ?>
<?php 

$nodes = array();

foreach ($json_data->Nodes->RegisteredNodes as $line) {  
  foreach ($json_data->PowerLines as $pwl) {
    if($pwl->PowerLineID === $line->PowerLine){
      $power_line_name = $pwl->PowerLineName;
    }
  }

  $arr = array(
          "ID"=>$line->NodeID,
          "chargerNodeNumber"=>$line->ChargerNodeNumber,
          "chargerNodeAddress"=>$line->ChargerNodeAddress,
          "chargerNodeType"=>$line->ChargerNodeType,
          "chargerNodeStatus"=>$line->ChargerNodeStatus,
          "node_mode"=>$line->NodeMode,
          "power_line"=>$line->PowerLine,
          "power_line_name"=>$power_line_name
        ); 
  unset($power_line_name);
$nodes[]=$arr;
}

// $power_lines_arr= array();
// foreach ($json_data->PowerLines as $line) {  
//   $arr = array("$line->PowerLineID" => ); 
// $nodes[]=$arr;
// }

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

              <h3 class="box-title">Nodes</h3>
              <!-- tools box -->
              
              <table id="table_node">
                <thead>
                    <tr><td>ID</td><td>Charger Node Number</td><td>Charger Node Address</td><td>Charger Node Type</td><td>Charger Node Status</td><td>Node mode</td><td>Power Line</td><td>Edit</td><td>Delete</td></tr>
                  </thead>
                <tbody>
                  <?php 
                  foreach ($nodes as $pow) {
                    echo "<tr><td id='id' val='".$pow["ID"]."'>".$pow["ID"]."</td><td id='chargerNodeNumber'>".$pow["chargerNodeNumber"]."</td><td id='chargerNodeAddress'>".$pow["chargerNodeAddress"]."</td><td id='chargerNodeType'>".$pow["chargerNodeType"]."</td><td id='chargerNodeStatus'>".$pow["chargerNodeStatus"]."</td><td id='node_mode'>".$pow["node_mode"]."</td><td id='power_line'>".$pow["power_line"]."</td><td id='power_line_name'>".$pow["power_line_name"]."</td><td class='dis_node'><i class='fas fa-edit'></i></td><td class='del_node'><i class='fas fa-trash-alt'></i></td></tr>";
                  }
                  ?>
                  
                </tbody>
              </table>
              <input type="button" name="add_node" id="add_node" value="Add Node">
              <!-- /. tools -->
            </div>
            <div class="box-body">
              
            </div>
            
          </div>
          <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Update <b>Node</b> to id:"<span></span>"</h3>
            <form id="edit_node">
              <input type="hidden" name="id" value="">
              <div>
              <label for="chargerNodeNumber"> Node Number </label>
                <input type="number" name="chargerNodeNumber" value="">
              </div>
              <div>
              <label for="chargerNodeAddress"> Node Address</label>
                <input type="text" name="chargerNodeAddress" value="" required>
              </div>
              <div>
              <label for="chargerNodeType"> Node Type </label>
                 <select id="chargerNodeType_edit" name="chargerNodeType">
                  <option value="PRIVATE">Private</option>
                  <option value="PUBLIC">Public</option>
                  <option value="MIXED">Mixed</option>
                </select>
              </div>
              <div>
              <label for="chargerNodeStatus"> Node Status </label>
                <select id="chargerNodeStatus_edit" name="chargerNodeStatus">
                  <option value="OFF">Off</option>
                  <option value="ACTIVE">Active</option>
                  <option value="REPAIR">Repair</option>
                </select>
              </div>
              <div style="display: none;">
              <label for="node_mode"> Node Mode </label>
                <select id="node_mode_edit" name="node_mode">
                  <option value="PRIVATE">Private</option>
                  <option value="PUBLIC">Public</option>
                  <option value="MIXED">Mixed</option>
                </select>
              </div>
              <div style="justify-content: flex-end;"><a href="MIXED" class="shc_edit_node">Schedule Edit</a></div>
              <div>
              <label for="power_line"> Power Line </label>
              <select id="pow_l_id_edit" name="power_line">
              	<option value =''></option>
                <?php 
                      foreach ($json_data->PowerLines as $line) {  
                          $res = get_power_data($line->PowerLineID);
                          if($res['AmpNodes']>$res['MaxAmp']){
                            $class = "class='red_line'";
                          }
                          echo "<option ".$class." value ='$line->PowerLineID'>".$line->PowerLineName."(".$res['MaxAmp']."A/".$res['AmpNodes']."A)</option>";
                          $class ='';       
                      }
                  ?>
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
            <h3>Add <b>Node</b></h3>
            <form id="add_node_form">
              <div>
              <label for="chargerNodeNumber"> Node Number </label>
                <input type="number" name="chargerNodeNumber" value="">
              </div>
              <div>
              <label for="chargerNodeAddress"> Node Address</label>
                <input type="text" name="chargerNodeAddress" value="" required>
              </div>
              <div>
              <label for="chargerNodeType"> Node Type </label>
                 <select id="chargerNodeType_add" name="chargerNodeType">
                  <option value="PRIVATE">Private</option>
                  <option value="PUBLIC">Public</option>
                  <option value="MIXED">Mixed</option>
                </select>
              </div>
              <div>
              <label for="chargerNodeStatus"> Node Status </label>
                <select id="chargerNodeStatus_add" name="chargerNodeStatus">
                  <option value="OFF">Off</option>
                  <option value="ACTIVE">Active</option>
                  <option value="REPAIR">Repair</option>
                </select>
              </div>
              <div style="display: none;">
              <label for="node_mode"> Node Mode </label>
                <select id="node_mode_add" name="node_mode">
                  <option value="PRIVATE">Private</option>
                  <option value="PUBLIC">Public</option>
                  <option value="MIXED">Mixed</option>
                </select>
               </div>
               
              <div>
              <label for="power_line"> Power Line </label>
              <select id="pow_l_id_add" name="power_line">
              	<option value =''></option>
                <?php 
                	   unset($data);
                      $class = "";
                      foreach ($json_data->PowerLines as $line) {  
                          $res = get_power_data($line->PowerLineID);
                          if($res['AmpNodes']>$res['MaxAmp']){
                            $class = "class='red_line'";
                          }
                          echo "<option ".$class." value ='$line->PowerLineID'>".$line->PowerLineName."(".$res['MaxAmp']."A/".$res['AmpNodes']."A)</option>";       
                      }
                  ?>
                </select>
              </div>
              <input type="submit" name="submit" value="Add" type_node="PRIVATE">
              
            </form>
            
	      </div>

        </div>
        <div id="modal_schu">
          <div class="item_sch_mix">
            <a class="in_all_days_mix">Apply Monday settings for all days</a>
            <div class ="sch_form_start">
                <h2>Monday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Monday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Monday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>


          <div class="item_sch_mix">
            <div class ="sch_form_start">
                <h2>Tuesday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Tuesday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Tuesday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>


          <div class="item_sch_mix">
            <div class ="sch_form_start">
              <h2>Wednesday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Wednesday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Wednesday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>


          <div class="item_sch_mix">
            <div class ="sch_form_start">
              <h2>Thursday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Thursday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Thursday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>


          <div class="item_sch_mix">
            <div class ="sch_form_start">
              <h2>Friday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Friday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Friday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>


          <div class="item_sch_mix">
            <div class ="sch_form_start">
              <h2>Saturday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Saturday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Saturday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>


          <div class="item_sch_mix">
            <div class ="sch_form_start">
              <h2>Sunday</h2>
                <h3>Schedule Form Time</h3>
                  <form id="add_schedule_public" class="add_schedule_public" day="Sunday">
                      <table width="100%">
                        <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                        <tbody>
                          <tr>
                            <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" ></td><td><input type="time" name="public_time_to" data-id="1" value="11:59"></td>
                          </tr>
                          <tr>
                            <td>Private</td><td><input type="time" name="private_time_from" data-id="2" value="12:00" disabled></td><td><input type="time" name="private_time_to" data-id="3" value="23:59" disabled></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
            <p></p>
            <div class ="sch_form_end">
                  <h3>Schedule Public Time</h3>
                  <form id="add_schedule_mixed" class="add_schedule_mixed" day="Sunday">
                      <table width="100%">
                        <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                        <tbody>
                          <tr>
                            <td><input type="time" name="mixed_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="mixed_time_to" data-id="1" value="11:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                          </tr>
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>
          <input type="submit" name="submit" id="add_schud_block_mixed" value="Ok">
         </div>

        <div id="modal_schu_public">
            <h3>Schedule Form Time Public</h3>
            
              <div class="item_sch_pub">
                <a class="in_all_days_pub">Apply Monday settings for all days</a>
                <div class ="sch_form_start">
                  <h4>Monday</h4>
                    <form id="add_schedule_public_mode" day="Monday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public"  class="add_schedule_price_public" day="Monday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>
                 <div class="item_sch_pub">
                  <div class ="sch_form_start">
                    <h4>Tuesday</h4>
                    <form id="add_schedule_public_mode" day="Tuesday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public" class="add_schedule_price_public" day="Tuesday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>

                <div class="item_sch_pub">
                  <div class ="sch_form_start">
                    <h4>Wednesday</h4>
                    <form id="add_schedule_public_mode" day="Wednesday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public" class="add_schedule_price_public" day="Wednesday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>

                 <div class="item_sch_pub">
                  <div class ="sch_form_start">
                    <h4>Thursday</h4>
                    <form id="add_schedule_public_mode" day="Thursday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public" class="add_schedule_price_public" day="Thursday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>

                 <div class="item_sch_pub">
                  <div class ="sch_form_start">
                    <h4>Friday</h4>
                    <form id="add_schedule_public_mode" day="Friday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public" class="add_schedule_price_public" day="Friday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>

                 <div class="item_sch_pub">
                  <div class ="sch_form_start">
                    <h4>Saturday</h4>
                    <form id="add_schedule_public_mode" day="Saturday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public" class="add_schedule_price_public" day="Saturday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>

                 <div class="item_sch_pub">
                  <div class ="sch_form_start">
                    <h4>Sunday</h4>
                    <form id="add_schedule_public_mode" day="Sunday">
                        <table width="100%">
                          <thead><th>Mode</th><th>Time From</th><th>Time To</th></thead>
                          <tbody>
                            <tr>
                              <td>Public</td><td><input type="time" name="public_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_time_to" data-id="1" value="23:59" disabled></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
                  <p></p>
                  <div class ="sch_form_end">
                    <form id="add_schedule_price_public" class="add_schedule_price_public" day="Sunday">
                        <table width="100%">
                          <thead><th>Time From</th><th>Time To</th><th>Price</th><th>Delete</th></thead>
                          <tbody>
                            <tr>
                              <td><input type="time" name="public_price_time_from" data-id="0" value="00:00" disabled></td><td><input type="time" name="public_price_time_to" data-id="1" value="23:59"></td><td><input type="number" name="price" step="0.01" min="0" required></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>

                    <input type="submit" name="submit" id="add_schud_block_public" value="Ok">
                  </div>
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
	jQuery( document ).ready(function($) {  // ~~~~~~~~~~~~~~~  MIXED VALIDATE
		// $('#my-select').multiSelect();
    function get_time_minus_rek(time){
      return time.setMinutes(time.getMinutes() - 1);
    }

		function isInRange(tstart, tend, tval) {
		    if(tstart < tval && tval < tend){
          var tmp_time = new Date(get_time_minus_rek(tend));
          return tstart < tval && tval <= tmp_time
        }
        return false;
		}

		function get_time_plus(time){
			var CurrentTime = new Date(null,null,null,time[0],time[1]);
			CurrentTime.setMinutes(CurrentTime.getMinutes() + 1);
			var h = CurrentTime.getHours();
			var m = CurrentTime.getMinutes();
			if(h<10){
					h="0"+h;
				}
				if(m<10){
					m="0"+m;
				}
			var end_val = h+":"+m;
			return end_val;
		}

		function get_time_minus(time){
			var CurrentTime = new Date(null,null,null,time[0],time[1]);
			CurrentTime.setMinutes(CurrentTime.getMinutes() - 1);
			var h = CurrentTime.getHours();
			var m = CurrentTime.getMinutes();
			if(h<10){
					h="0"+h;
				}
				if(m<10){
					m="0"+m;
				}
			var end_val = h+":"+m;
			return end_val;
		}


    

		function add_block_mix(time,last_blocks,day){
			var end_val = get_time_plus(time);
			var time_pub = $('.add_schedule_public[day='+day+'] input[name=public_time_to]').val().split(":");
			var la_b = $(last_blocks).attr("data-id");
			var new_1 = parseInt(la_b)+1;
			var new_2 = parseInt(la_b)+2;

			$(last_blocks).attr("disabled", true);
			$(".add_schedule_mixed[day="+day+"] tbody").append('<tr><td><input type="time" name="mixed_time_from" data-id="'+new_1+'" disabled></td><td><input type="time" name="mixed_time_to" data-id="'+new_2+'" ></td><td><input type="number" name="price" step="0.01" min="0" required></td><td class="del_line_sch"><i class="fas fa-trash-alt"></i></td></tr>');
			$(".add_schedule_mixed[day="+day+"] tbody input[data-id="+new_1+"]").val(end_val);
			$(".add_schedule_mixed[day="+day+"] tbody input[data-id="+new_2+"]").val(time_pub[0]+":"+time_pub[1]);
		}

    function add_block_public(time,last_blocks,day){
      var end_val = get_time_plus(time);
      var time_pub = $('#add_schedule_public_mode[day='+day+'] input[name=public_time_to]').val().split(":");
      var la_b = $(last_blocks).attr("data-id");
      var new_1 = parseInt(la_b)+1;
      var new_2 = parseInt(la_b)+2;

      $(last_blocks).attr("disabled", true);
      $("#add_schedule_price_public[day="+day+"] tbody").append('<tr><td><input type="time" name="public_price_time_from" data-id="'+new_1+'" disabled></td><td><input type="time" name="public_price_time_to" data-id="'+new_2+'" ></td><td><input type="number" name="price" step="0.01" min="0" required></td><td class="del_line_sch"><i class="fas fa-trash-alt"></i></td></tr>');
      $("#add_schedule_price_public[day="+day+"] tbody input[data-id="+new_1+"]").val(end_val);
      $("#add_schedule_price_public[day="+day+"] tbody input[data-id="+new_2+"]").val(time_pub[0]+":"+time_pub[1]);
    }

      function reset_forms(){
    // node forms
      $("#add_node_form").trigger("reset");
      $("#edit_node").trigger("reset");
      $('input[name="price"]').each(function(index){
      	$(this).val("");
      });
      // public forms
          $(".add_schedule_public_mode").trigger("reset");
          $(".add_schedule_price_public tbody tr").each(function(index){
        if(index != 0){
            $(this).find(".del_line_sch i").trigger("click");
          }
        })
          $(".add_schedule_price_public tbody tr").trigger("reset");
          $(".shc_ed").detach();
          // mixed forms
          $(".add_schedule_public").trigger("reset");
          $(".add_schedule_mixed tbody tr").each(function(index){
        if(index != 0){
            $(this).find(".del_line_sch i").trigger("click");
          }
        })
          $(".add_schedule_mixed tbody tr").trigger("reset");
          $(".shc_ed").detach();
    }


      // Mixed shc get data

         function timeline_item(data,day){
           $(".add_schedule_public[day="+day+"] input[name=public_time_from]").val(data["From"]);
           $(".add_schedule_public[day="+day+"] input[name=public_time_to]").val(data["To"]);
           $(".add_schedule_public[day="+day+"] input[name=public_time_from]").trigger("change");
           $(".add_schedule_public[day="+day+"] input[name=public_time_to]").trigger("change");
        }

        function public_items(data){
           Object.keys(data).forEach(function(value){
             timeline_item(data[value]["Timline"]["PublicNode"],value);
              data[value]["Public_items"].forEach((element) => {
                var items_arr = $(".add_schedule_mixed[day="+value+"]").find("input[name=mixed_time_to]");
                var leng = items_arr.length-1;
                var this_item = $(".add_schedule_mixed[day="+value+"]").find("input[name=mixed_time_to]")[leng];
                $(this_item).val(element["To"]);
                $(this_item).closest("tr").find("input[name=price]").val(element["Price"]);
                $(this_item).trigger("blur");
             })
              var items_arr = $(".add_schedule_mixed[day="+value+"]").find("input[name=mixed_time_to]");
              var leng = items_arr.length-1;
              var last = $(".add_schedule_mixed[day="+value+"]").find("input[name=mixed_time_to]")[leng];
              //$(last).closest("tr").find(".del_line_sch i").trigger("click"); 
          })

        }

        function select_mixed_data_to_form(data){
          public_items(data);

        }
        function get_sch_mixed(id){
          $.ajax({
              type: "POST",
              url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/get_shc_mixed.php',
              data: {id:id},
              success: function(response)
              {
                var json_pars = JSON.parse(response);
                select_mixed_data_to_form(json_pars);     
              },
              error: function() {
                alert('There was some error performing the AJAX call!');
              }
          });
        }

         // End Mixed shc get data

         // Public shc get data

      function public_items_public_node(data){
        Object.keys(data).forEach(function(value){
          data[value].forEach((element) => {
             // inputs.forEach((element) =>{
                var items_arr = $("#add_schedule_price_public[day="+value+"]").find("input[name=public_price_time_to]");
                var leng = items_arr.length-1;
                var this_item = $("#add_schedule_price_public[day="+value+"]").find("input[name=public_price_time_to]")[leng];
                $(this_item).val(element["To"]);
                $(this_item).closest("tr").find("input[name=price]").val(element["Price"]);
                $(this_item).trigger("blur");
             })
             var items_arr = $("#add_schedule_price_public[day="+value+"]").find(" input[name=public_price_time_to]");
              var leng = items_arr.length-1;
              var last = $("#add_schedule_price_public[day="+value+"]").find("input[name=public_price_time_to]")[leng];
              //$(last).closest("tr").find(".del_line_sch i").trigger("click"); 
          })
        }

        function get_sch_public_node(id){
          $.ajax({
              type: "POST",
              url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/get_shc_public.php',
              data: {id:id},
              success: function(response)
              {
                  public_items_public_node(JSON.parse(response));     
              },
              error: function() {
                alert('There was some error performing the AJAX call!');
              }
          });
        }

        function edit_sch(){

            var select_node_type = $("#edit_node select#chargerNodeType_edit option:selected").val();
            if(select_node_type === "MIXED"){
              $('#edit_node input[type="submit"]').attr("type_node","MIXED");
            }
            if(select_node_type === "PUBLIC"){
              $('#edit_node input[type="submit"]').attr("type_node","PUBLIC");
            }
            if(select_node_type === "PRIVATE"){
              $('#edit_node input[type="submit"]').attr("type_node","PRIVATE");
            }
            var id_node = $("#edit_node input[name=id]").val();

          if($("#edit_node input[type=submit]").attr("type_node") === "PUBLIC"){
                var public_data=[];
                $(".add_schedule_price_public").each(function(index){
                  var day = $(this).attr("day");
                  $(this).find("tbody tr").each(function(index){
                      var time_fr = $(this).find("input[name=public_price_time_from]").val();
                      var time_to = $(this).find("input[name=public_price_time_to]").val();
                      var price_sch = $(this).find("input[name=price]").val()
                      var arr_tmp= {"time_fr": time_fr,"time_to": time_to,"price_sch": price_sch,"id_node": id_node,"day":day};
                      public_data.push(arr_tmp);
                    })
                }) 
                  
                $.ajax({
                  type: "POST",
                  url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_shc_public.php',
                  data: {public_data:public_data},
                  success: function(response){
                    var resp = JSON.parse(response);
                    reset_forms();
                  }
              })
              }
              else if($("#edit_node input[type=submit]").attr("type_node") === "MIXED"){
                var public_data=[];
                var arr_mix_data = [];
                $(".item_sch_mix").each(function(item){
                  var day = $(this).find(".add_schedule_public").attr("day");
                  var arr_mix_data_tmp = {"public_from":$(this).find(".add_schedule_public input[name=public_time_from]").val(),"public_to":$(this).find(".add_schedule_public input[name=public_time_to]").val(),"private_from":$(this).find(".add_schedule_public input[name=private_time_from]").val(),"private_to":$(this).find(".add_schedule_public input[name=private_time_to]").val(),"day":day};
                  arr_mix_data.push(arr_mix_data_tmp);
                  $(this).find(".add_schedule_mixed").each(function(index){ 
                        $(this).find("tbody tr").each(function(index){
                        var time_fr = $(this).find("input[name=mixed_time_from]").val();
                        var time_to = $(this).find("input[name=mixed_time_to]").val();
                        var price_sch = $(this).find("input[name=price]").val()
                        var arr_tmp= {"time_fr": time_fr,"time_to": time_to,"price_sch": price_sch,"id_node": id_node,"day":day};
                        public_data.push(arr_tmp);
                      })
                  })  
                })
                
                $.ajax({
                  type: "POST",
                  url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_shc_mixed.php',
                  data: {public_data:public_data,mixed_data:arr_mix_data},
                  success: function(response){
                    var resp = JSON.parse(response);
                    reset_forms();
                  }
              })
             }
        }

        function add_private(id){
          $.ajax({
                  type: "POST",
                  url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_sch_private.php',
                  data: {id:id},
                  success: function(response){
                    var resp = JSON.parse(response);
                    reset_forms();
                  }
              })
        }

        function valid_time_input(){
          var err = false;
          $("input[type='time']").each(function(){
            if($(this).val() === ""){
              if(!$(this).attr("disabled")){
                $(this).after("<div class='mess_err' style='color:red;font-weght:600'>Please fill in the field</div>");
                err = true;
              }
                
            }
          })
          return err;
        }
        

       function valid_public(){
          $(".mess_err").detach();
          var err = false;
          $(".add_schedule_price_public").each(function( index ){
            var prices_input = $(this).find("input[name='price']");
            $(prices_input).each(function( index ){
              var val = $(this).val();
              if(val.length == 0){
                $(this).after("<div class='mess_err' style='color:red;font-weght:600'>Please fill in the field</div>");
                err= true;
              }
            })
          })
          return err;
        }

        function valid_mixed(){
          $(".mess_err").detach();
          var err = false;
          $(".add_schedule_mixed").each(function( index ){
            var prices_input = $(this).find("input[name='price']");
            $(prices_input).each(function( index ){
              var val = $(this).val();
              if(val.length == 0){
                $(this).after("<div class='mess_err' style='color:red;font-weght:600'>Please fill in the field</div>");
                err= true;
              }
            })
          })
          return err;
        }
        



         // End Public shc get data


		$("body").on("click","#add_schud_block", function(){
			var blocks = $("#add_schedule_mixed tbody tr input[type='time']");
			var last_blocks = $("#add_schedule_mixed tbody tr input[type='time']")[blocks.length-1];
			var time = $(last_blocks).val().split(":");
			var time_pub = $('input[name=public_time_to]').val().split(":");
			if( (time[0]  == time_pub[0]) && (time[1]  == time_pub[1]) ){
				return;
			}
			add_block_mix(time,last_blocks);

		});


		$("body").on("click",".add_schedule_mixed .del_line_sch i", function(){ //  ~~~~ DELETE LINE
      		var day = $(this).closest(".add_schedule_mixed").attr("day");
			var de = $(this).closest("tr");
			var last_time_del_elem = $(de).find("input[type=time]")[0];
			var last_time_del = $(last_time_del_elem).val();
			var last_time_data_id = parseInt($(last_time_del_elem).attr("data-id"));		
			de.detach();

			$(".add_schedule_mixed[day="+day+"] input[type=time]").each(function( index ) {
				$(this).attr("data-id",index);
			})
			var last_time_id = $(".add_schedule_mixed[day="+day+"] [type=time]").length-1;
			if(last_time_id === 1){
       		var last_d = $(".add_schedule_public[day="+day+"] input[name=public_time_to]").val();
				$(".add_schedule_mixed[day="+day+"] input[data-id="+last_time_id+"]").val(last_d);
			}else{
				$(".add_schedule_mixed[day="+day+"] input[data-id="+last_time_data_id+"]").val(last_time_del);
			}
			var last_blocks = $(".add_schedule_mixed[day="+day+"] input[type=time]").length-1;
			$(".add_schedule_mixed[day="+day+"] input[data-id="+last_blocks+"]").attr("disabled",false);
		})
	


		$("body").on("blur",".add_schedule_mixed input[name=mixed_time_to]", function(){ //  ~~~~~~ ADD SCHEDULE TIME LINE
      		var day = $(this).closest("form.add_schedule_mixed").attr("day");
			var get_id_block = $(this).attr("data-id");
			var leng_sch_mix = parseInt($(this).closest("div").closest("div").find(".add_schedule_mixed input[type=time]").length-1);
			var leng_sch_mix_last =  $(this).closest("div").closest("div").find(".add_schedule_mixed input[type=time]")[leng_sch_mix];
			var leng_sch_mix_last_id = $(leng_sch_mix_last).attr("data-id");
			var time = $(this).val().split(":");
			var time_pub = $(this).closest("div.item_sch_mix").find(".add_schedule_public input[name=public_time_to]").val().split(":");
			var time_pub_from =  $(this).closest("div.item_sch_mix").closest("div").find('.add_schedule_public input[name=public_time_from]').val().split(":");
      
			var pre_id = parseInt(get_id_block)-1;
			var time_pre = 	$(this).closest("div.item_sch_mix").find('.add_schedule_mixed input[data-id='+pre_id+']').val().split(":");
			var data_id = parseInt(get_id_block)+1;
			var time_priv_from  = $(this).closest("div.item_sch_mix").find('.add_schedule_public input[name=private_time_from]').val().split(":");
			var time_priv_to  = $(this).closest("div.item_sch_mix").find('.add_schedule_public input[name=private_time_to]').val().split(":");			

			var Time_this = new Date(null,null,null,time[0],time[1]),
			Time_public = new Date(null,null,null,time_pub[0],time_pub[1]),
			Time_pre_block = new Date(null,null,null,time_pre[0],time_pre[1]),
			Time_public_from = new Date(null,null,null,time_pub_from[0],time_pub_from[1]);
			var flag_reverce = false; 
			if(Time_public_from>Time_public){
				var flag_reverce = true; 
				var Time_priv_from_date = new Date(null,null,null,time_priv_from[0],time_priv_from[1]);
				var Time_priv_to_date = new Date(null,null,null,time_priv_to[0],time_priv_to[1]);
			}
			
			if(!flag_reverce){		
					if( !isInRange(Time_public_from,Time_public,Time_this) ){
						$(this).val(time_pub[0]+":"+time_pub[1]);
					}
					else{
						var blocks = $(this).closest("div").closest("div").find(".add_schedule_mixed tbody tr input[type='time']");
						var last_blocks = $(this).closest("div").closest("div").find(".add_schedule_mixed tbody tr input[type='time']")[blocks.length-1];
						if(isInRange(Time_pre_block,Time_public,Time_this)){
							add_block_mix(time,last_blocks,day);
						}else{
							$(this).val(time_pub[0]+":"+time_pub[1]);
						}
						
					}					
			}else{
				if(isInRange(Time_priv_from_date,Time_priv_to_date,Time_this) ){

							$(this).val(time_pub[0]+":"+time_pub[1]);
					}
					else{
							var doble = false;
							var length_tr_shc = $(this).closest("div").closest("div").find(".add_schedule_mixed tbody tr").length-1;
							$(this).closest("div").closest("div").find(".add_schedule_mixed tbody tr").each(function( index ) {
								if(index !=length_tr_shc){
									var inputs_time = $(this).find("input[type=time]");
									var time_start = $(inputs_time)[0];
									var time_end = $(inputs_time)[1];
									var time_start_val = $(time_start).val().split(":");
									var time_end_val = $(time_end).val().split(":");
									var time_start_val_date = new Date(null,null,null,time_start_val[0],time_start_val[1]);
									var time_end_val_date = new Date(null,null,null,time_end_val[0],time_end_val[1]);
                  
									if(time_start_val_date>time_end_val_date){

										var date_zero_end = new Date(null,null,null,23,59);
										var date_zero_start = new Date(null,null,null,00,00);

										if(isInRange(time_start_val_date,date_zero_end,Time_this) || isInRange(date_zero_start,time_end_val_date,Time_this)){
											doble = true;
										}
									}else{
										if(isInRange(time_start_val_date,time_end_val_date,Time_this)){
											doble = true;
										}
									}
								}
									
							})
							if(!doble){
								var blocks = $(this).closest("div").closest("div").find(".add_schedule_mixed tbody tr input[type='time']");
								var last_blocks = $(this).closest("div").closest("div").find(".add_schedule_mixed tbody tr input[type='time']")[blocks.length-1];
								add_block_mix(time,last_blocks,day);
							}else{
								$(this).val(time_pub[0]+":"+time_pub[1]);
							}
					}
			}

			
			
			
		})

		$("body").on("change",".add_schedule_public input",function(){ // ~~~~~~ CHANGE SCHEDULE TIME LINE
			var data_id = $(this).attr("data-id");
			var val_data = $(this).val();
      		var day = $(this).closest("form.add_schedule_public").attr("day");
			var time = val_data.split(':');
			$(this).closest("div.item_sch_mix").find(".add_schedule_mixed[day="+day+"] tbody tr").each(function(index){
				if(index != 0){
					$(this).find(".del_line_sch i").trigger("click");
				}
			})
			if(data_id==0){
				var tmp_id = 3;
				var get_data = $("input[data-id="+tmp_id+"]").val();
				var get_time = get_data.split(':');
				var str_val = get_time_minus(time);
				$(this).closest("div.item_sch_mix").find(".add_schedule_public[day="+day+"] input[data-id="+tmp_id+"]").val(str_val);
				$(this).closest("div.item_sch_mix").find(".add_schedule_mixed[day="+day+"] input[data-id=0]").val(val_data);	
			}

			if(data_id==1){
				var tmp_id = 2;
				var get_data = $("input[data-id="+tmp_id+"]").val();
				var get_time = get_data.split(':');
				var str_val = get_time_plus(time);
				$(this).closest("div.item_sch_mix").find(".add_schedule_public[day="+day+"] input[data-id="+tmp_id+"]").val(str_val);
				var last_blocks = $(".add_schedule_mixed[day="+day+"] input[type=time]").length-1;
				$(this).closest("div.item_sch_mix").find(".add_schedule_mixed[day="+day+"] input[data-id="+last_blocks+"]").val(val_data);
			}
		});

		$("body").on("click","#add_schedule_price_public .del_line_sch i", function(){ //  ~~~~ DELETE LINE
			var de = $(this).closest("tr");
      		var day = $(this).closest("#add_schedule_price_public").attr("day");
			var last_time_del_elem = $(de).find("input[type=time]")[1];
			var last_time_del = $(last_time_del_elem).val();
			var last_time_data_id = parseInt($(last_time_del_elem).attr("data-id"))-2;	
			de.detach();
			$("#add_schedule_price_public[day="+day+"] input[type=time]").each(function( index ) {
				$(this).attr("data-id",index);
			})
			var last_time_id = $("#add_schedule_price_public[day="+day+"] [type=time]").length-1;

			$("#add_schedule_price_public[day="+day+"]").find("input[data-id="+last_time_data_id+"]").val(last_time_del);
			
			var last_blocks = $("#add_schedule_price_public[day="+day+"] input[type=time]").length-1;
			$("#add_schedule_price_public[day="+day+"] input[data-id="+last_blocks+"]").attr("disabled",false);
		})
	


		$("body").on("blur","#add_schedule_price_public input[name=public_price_time_to]", function(){ //  ~~~~~~ ADD SCHEDULE TIME LINE
			var get_id_block = $(this).attr("data-id");
			var leng_sch_mix = parseInt($(this).closest("#add_schedule_price_public").find("input[type=time]").length-1);
		  var leng_sch_mix_last =  $(this).closest("#add_schedule_price_public").find("input[type=time]")[leng_sch_mix];
			var leng_sch_mix_last_id = $(leng_sch_mix_last).attr("data-id");
			var time = $(this).val().split(":");
			var time_pub = "23:59";
      		time_pub = time_pub.split(":");
			var time_pub_from =  "00:00";
      		time_pub_from =  time_pub_from.split(":");
			var pre_id = parseInt(get_id_block)-1;
			var time_pre = 	$(this).closest("#add_schedule_price_public").find('input[data-id='+pre_id+']').val().split(":");
			var data_id = parseInt(get_id_block)+1;

			var Time_this = new Date(null,null,null,time[0],time[1]);
			var Time_public = new Date(null,null,null,time_pub[0],time_pub[1]);
			var Time_pre_block = new Date(null,null,null,time_pre[0],time_pre[1]);
			var Time_public_from = new Date(null,null,null,time_pub_from[0],time_pub_from[1]);

     		var day = $(this).closest("form").attr("day");


      if( !isInRange(Time_public_from,Time_public,Time_this) ){
            $(this).val(time_pub[0]+":"+time_pub[1]);
          }
          else{
            var blocks = $(this).closest("#add_schedule_price_public").find("tbody tr input[type='time']");
            var last_blocks = $(this).closest("#add_schedule_price_public").find(" tbody tr input[type='time']")[blocks.length-1];
            if(isInRange(Time_pre_block,Time_public,Time_this)){
              add_block_public(time,last_blocks,day);
            }else{
              $(this).val(time_pub[0]+":"+time_pub[1]);
            }
            
          } 
		})

		$("body").on("change","#add_schedule_public_mode input",function(){ // ~~~~~~ CHANGE SCHEDULE TIME LINE
			var data_id = $(this).attr("data-id");
			var val_data = $(this).val();
			var time = val_data.split(':');
			$("#add_schedule_price_public tbody tr").each(function(index){
				if(index != 0){
					$(this).find(".del_line_sch i").trigger("click");
				}
			})
			if(data_id==0){
				var str_val = get_time_minus(time);
				$("#add_schedule_price_public input[data-id=0]").val(val_data);
				$("#add_schedule_price_public input[data-id=1]").val(str_val);
				$("#add_schedule_public_mode input[name=public_time_to]").val(str_val);

			}
			if(data_id==1){
				var str_val = get_time_plus(time);
				$("#add_schedule_price_public input[data-id=0]").val(str_val);
				$("#add_schedule_price_public input[data-id=1]").val(val_data);
				$("#add_schedule_public_mode input[name=public_time_from]").val(str_val);
			}
		});


      $("body").on("click",".dis_node i", function(){
        $("#myModal").toggleClass("ACTIVE");
        var id = $(this).closest("tr").find("td#id").text();
        var chargerNodeNumber = $(this).closest("tr").find("td#chargerNodeNumber").text();
        var chargerNodeAddress = $(this).closest("tr").find("td#chargerNodeAddress").text();
        var chargerNodeType = $(this).closest("tr").find("td#chargerNodeType").text();
        var chargerNodeStatus = $(this).closest("tr").find("td#chargerNodeStatus").text();
        //var node_mode = $(this).closest("tr").find("td#node_mode").text();
        var power_line = $(this).closest("tr").find("td#power_line").text();

        $("#myModal .modal-content h3 span").text(id);
        $("#myModal input[type='hidden']").attr("value",id);
        $('#myModal input[name="chargerNodeNumber"]').attr("value",chargerNodeNumber);
        $('#myModal input[name="chargerNodeAddress"]').attr("value",chargerNodeAddress);

        $('#myModal #pow_l_id option[value="'+power_line+'"]').prop('selected', true);
        $('#myModal #node_mode option[value="'+node_mode+'"]').prop('selected', true);
        $('#myModal #pow_l_id_edit option[value="'+power_line+'"]').prop('selected', true);
        $('#myModal #chargerNodeStatus_edit option[value="'+chargerNodeStatus+'"]').prop('selected', true);
        $('#myModal #chargerNodeType_edit option[value="'+chargerNodeType+'"]').prop('selected', true);
        if(chargerNodeType !== "PRIVATE"){
          $(".shc_edit_node").detach();
          $("#chargerNodeType_edit").closest("div").after('<div style="justify-content: flex-end;"><a href="'+chargerNodeType+'" class="shc_edit_node">Schedule Edit</a></div>');
          $(".shc_edit_node").attr("href",chargerNodeType);
        }else{
          $(".shc_edit_node").detach();
        }

        if(chargerNodeType == "MIXED"){
         get_sch_mixed(id);
        }else if(chargerNodeType == "PUBLIC"){
          get_sch_public_node(id);
        }
        

      });

    $("#add_node").on("click", function(){
      $("#myModal2").toggleClass("ACTIVE");
    });
    

    $("#myModal .close").on("click", function(){
      $("#myModal").toggleClass("ACTIVE");
      reset_forms();
    });

    $("#myModal2 .close").on("click", function(){
      $("#myModal2").toggleClass("ACTIVE");
      reset_forms();
    });

    $("#add_schud_block_public").on("click",function(ex){

      if(!valid_public()){
        if(!valid_time_input()){
          ex.preventDefault();
          $("#modal_schu_public").toggleClass("ACTIVE");
        }     
        else{
        alert("Please enter all data");
      }
    }
    })

    $("#add_schud_block_mixed").on("click",function(ex){
      if(!valid_mixed()){
        if(!valid_time_input()){
          ex.preventDefault();
          $("#modal_schu").toggleClass("ACTIVE");
        }
        else{
        alert("Please enter all data");
      }
      }
    })

     $("#add_schedule_mixed").submit(function(ex){
    	ex.preventDefault();
    	$("#modal_schu").toggleClass("ACTIVE");
    })

     $('#edit_node').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/edit_node.php',
            data: $(this).serialize(),
            success: function(response)
            {
              edit_sch();
              alert("Update completed");
              $("#myModal").toggleClass("ACTIVE");
              var resp = JSON.parse(response);
              $("td[val="+resp.id+"]").closest("tr").find("#chargerNodeNumber").text(resp.chargerNodeNumber);
              $("td[val="+resp.id+"]").closest("tr").find("#chargerNodeAddress").text(resp.chargerNodeAddress);
              $("td[val="+resp.id+"]").closest("tr").find("#chargerNodeType").text(resp.chargerNodeType);
              $("td[val="+resp.id+"]").closest("tr").find("#chargerNodeStatus").text(resp.chargerNodeStatus);
              $("td[val="+resp.id+"]").closest("tr").find("#power_line").text(resp["PowerLine"]);
              $("td[val="+resp.id+"]").closest("tr").find("#power_line_name").text(resp["PowerLine_name"]);
               reset_forms();
               location.href=location.href;
           },
            error: function() {
              alert('There was some error performing the AJAX call!');
            }
       });
    });

   

     $('#add_node_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_node.php',
            data: $(this).serialize(),
            success: function(response)
            {
              $("#myModal2").toggleClass("ACTIVE");
              var resp = JSON.parse(response);
              if(!resp['PowerLine_name']){
                $pow_l = "";
              }
              else{
               $pow_l = resp['PowerLine_name']
              }
              $("#table_node tbody").append("<tr><td id='id' val='"+resp.NodeID+"'>"+resp.NodeID+"</td><td id='chargerNodeNumber'>"+resp.ChargerNodeNumber+"</td><td id='chargerNodeAddress'>"+resp.ChargerNodeAddress+"</td><td id='chargerNodeType'>"+resp.ChargerNodeType+"</td><td id='chargerNodeStatus'>"+resp.ChargerNodeStatus+"</td><td id='node_mode'>"+resp['NodeMode']+"</td><td id='power_line'>"+resp['PowerLine']+"</td><td id='power_line_name'>"+$pow_l+"</td><td class='dis_node'><i class='fas fa-edit'></i></td><td class='del_node'><i class='fas fa-trash-alt'></i></td></tr>");
              var id_node = resp.NodeID;
              if($("#add_node_form input[type=submit]").attr("type_node") === "PUBLIC"){
              	var public_data=[];
              	$(".add_schedule_price_public").each(function(index){
                  var day = $(this).attr("day");
                  $(this).find("tbody tr").each(function(index){
                      var time_fr = $(this).find("input[name=public_price_time_from]").val();
                      var time_to = $(this).find("input[name=public_price_time_to]").val();
                      var price_sch = $(this).find("input[name=price]").val()
                      var arr_tmp= {"time_fr": time_fr,"time_to": time_to,"price_sch": price_sch,"id_node": id_node,"day":day};
                      public_data.push(arr_tmp);
                    })
                }) 
                  
              	$.ajax({
			            type: "POST",
			            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_shc_public.php',
			            data: {public_data:public_data},
			            success: function(response){
			            	var resp = JSON.parse(response);
			            	reset_forms();
			            }
     		  		})
              }else if($("#add_node_form input[type=submit]").attr("type_node") === "MIXED"){
              	var public_data=[];
              	var arr_mix_data = [];
              	$(".item_sch_mix").each(function(item){
              		var day = $(this).find(".add_schedule_public").attr("day");
              		var arr_mix_data_tmp = {"public_from":$(this).find(".add_schedule_public input[name=public_time_from]").val(),"public_to":$(this).find(".add_schedule_public input[name=public_time_to]").val(),"private_from":$(this).find(".add_schedule_public input[name=private_time_from]").val(),"private_to":$(this).find(".add_schedule_public input[name=private_time_to]").val(),"day":day};
              		arr_mix_data.push(arr_mix_data_tmp);
	              	$(this).find(".add_schedule_mixed").each(function(index){ 
	                  	  $(this).find("tbody tr").each(function(index){
	                      var time_fr = $(this).find("input[name=mixed_time_from]").val();
	                      var time_to = $(this).find("input[name=mixed_time_to]").val();
	                      var price_sch = $(this).find("input[name=price]").val()
	                      var arr_tmp= {"time_fr": time_fr,"time_to": time_to,"price_sch": price_sch,"id_node": id_node,"day":day};
	                      public_data.push(arr_tmp);
	                    })
	              	})	
              	})
              	
              	$.ajax({
			            type: "POST",
			            url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/add_shc_mixed.php',
			            data: {public_data:public_data,mixed_data:arr_mix_data},
			            success: function(response){
			            	var resp = JSON.parse(response);
			            	reset_forms();
			            }
     		  		})
              }else if($("#add_node_form input[type=submit]").attr("type_node") === "PRIVATE"){
                add_private(id_node);
              }
              location.href=location.href;
           },
            error: function() {
              alert('There was some error performing the AJAX call!');
            }
       });
    });

     $("body").on("click",".del_node i", function(){
          var id_del = $(this).closest("tr").find("td#id").text();
          var del = $(this).closest("tr");
          if(confirm("Do you really want to delete Node "+id_del +" ?")){
            $.ajax({
              type: "POST",
              url: 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/template-control/del_node.php',
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

      $("#add_node_form select#chargerNodeType_add").change(function() {
        var th_i = $("#add_node_form select#chargerNodeType_add option:selected").attr("value");
        $('#add_node_form select#node_mode_add option[value="'+th_i+'"]').prop('selected', true);
        $('#add_node_form select#node_mode_add option[value="'+th_i+'"]').trigger("change");
      });

      $('#add_node_form select#node_mode_add').change(function() {
      	var select_node_type = $("#add_node_form select#node_mode_add option:selected").val();
      	if(select_node_type === "MIXED"){
      		$("#modal_schu").toggleClass("ACTIVE");
      		$('#add_node_form input[type="submit"]').attr("type_node","MIXED");
      		$(".shc_ed").closest('div').detach();
      		$("#node_mode_add").closest("div").after("<div style='justify-content: flex-end;'><a href='Mixed' class='shc_ed'>Schedule Edit</a></div>");
      	}
      	if(select_node_type === "PUBLIC"){
      		$("#modal_schu_public").toggleClass("ACTIVE");
      		$('#add_node_form input[type="submit"]').attr("type_node","PUBLIC");
      		$(".shc_ed").closest('div').detach();
      		$("#node_mode_add").closest("div").after("<div style='justify-content: flex-end;'><a href='Public' class='shc_ed'>Schedule Edit</a></div>");
      	}
      	if(select_node_type === "PRIVATE"){
      		$('#add_node_form input[type="submit"]').attr("type_node","PRIVATE");
      	}
      });

        $('body').on("click",".shc_ed",function(ex){
      		ex.preventDefault();
      		console.log("clic");
      		var hr = $(this).attr("href");
      		if((hr === "MIXED") ||  (hr === "Mixed")){
      			$("#modal_schu").addClass("ACTIVE");
      			console.log("ed1");
      		}else if ((hr === "PUBLIC") ||  (hr === "Public")){
      			$("#modal_schu_public").addClass("ACTIVE");
      			console.log("ed");
      		}
      	})

      	// $('body').on("click",".shc_edit_node",function(ex){
      	// 	ex.preventDefault();
      	// 	var hr = $(this).attr("href");
      	// 	var id = $("#edit_node input[name=id]").val();
      	// 	if(hr === "MIXED"){
      	// 		edit_sch_mix(id);
      	// 		$("#modal_schu").addClass("ACTIVE");
      	// 	}else if (hr === "PUBLIC"){
      	// 		edit_sch_pub(id);
      	// 		$("#modal_schu_public").addClass("ACTIVE");
      	// 	}

      

      $("#edit_node select#chargerNodeType_edit").change(function() {
        var th_i = $("#edit_node select#chargerNodeType_edit option:selected").attr("value");
        $('#edit_node select#node_mode_edit option[value="'+th_i+'"]').prop('selected', true);
        if(th_i !== "PRIVATE"){
          $(".shc_edit_node").detach();
          $("#chargerNodeType_edit").closest("div").after('<div style="justify-content: flex-end;"><a href="PUBLIC" class="shc_edit_node">Schedule Edit</a></div>');
          $(".shc_edit_node").attr("href",th_i);
          $(".shc_edit_node").trigger("click");
        }else{
          $(".shc_edit_node").detach();
        }
      });

      $('body').on("click",".shc_edit_node",function(ex){
          ex.preventDefault();
          var hr = $(this).attr("href");
          var id_node = $("#edit_node input[type=hidden]").val();
          if(hr === "MIXED"){
            $("#modal_schu").addClass("ACTIVE");
          }else if (hr === "PUBLIC"){
            $("#modal_schu_public").addClass("ACTIVE");
          }
        })

        $("body").on("click",".close",function(){
          reset_forms();
        })

        $('body').on("click","a.in_all_days_mix",function(ex){
          ex.preventDefault();
          $(this).closest(".item_sch_mix").find(".add_schedule_public").find("table").clone().appendTo($(".item_sch_mix").find(".add_schedule_public"));
          $(this).closest(".item_sch_mix").find(".add_schedule_mixed").find("table").clone().appendTo($(".item_sch_mix").find(".add_schedule_mixed"));
          $(".item_sch_mix").each(function(){
            var tmp_tab = $(this).find(".add_schedule_public").find("table")[0];
            var tmp_tab_pub = $(this).find(".add_schedule_mixed").find("table")[0];
            $(tmp_tab).detach();
            $(tmp_tab_pub).detach();
          })

        })

        $('body').on("click","a.in_all_days_pub",function(ex){
          ex.preventDefault();
          $(this).closest(".item_sch_pub").find(".add_schedule_price_public").find("table").clone().appendTo($(".item_sch_pub").find(".add_schedule_price_public"));
          $(".item_sch_pub").each(function(){
            var tmp_tab_pub = $(this).find(".add_schedule_price_public").find("table")[0];
            $(tmp_tab_pub).detach();
          })

        })


   });


</script>

<?php include "footer.php"; ?>
