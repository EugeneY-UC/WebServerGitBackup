<?php 
          $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/menu.json');
          $json = json_decode($file);
          
      ?>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php  
            $k=0;
            foreach ($json->MENU as $item=>$val){
              $k++;
        ?>
          <li class="treeview <?php  if ($k==1) echo 'active'; ?>">
                <a href="#">
                  <i class="fas fa-cogs"></i> <span> <?php  echo $item; ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <?php
                    foreach ($val as $info=>$edn_name) {
                      ?>  
                        <li><a href="<?php echo $edn_name; ?>"><?php echo $info;?></a></li>
                      <?php
                    }
                  ?>
                  
                </ul>
              </li>
        <?php
      }
         ?>

         </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

