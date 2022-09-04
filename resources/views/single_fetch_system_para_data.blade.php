<style type="text/css">
	.entry-meta ul li a,i{
    
    color: gray;
}

.entry-meta ul {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
}

</style>



  <div class="modal-body">
  	

  	
   
    

     <form action="" method="POST">
          

          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php  echo $single_fetch_data->para_id; ?> ">
          
          <table class="table table-bordered" width="80%">
             

              <tr>
                  <th>System Name</th>
                  <td>
                    <select class="form-control" name="system_name" id="system_name">
                      <?php 
                      $systems_data = DB::table('systems')->get();
                      foreach($systems_data as $single_system){

                        ?>

                <option <?php if($single_system->id==$single_fetch_data->system_id){
                    echo"selected";

                } ?> value="<?php echo $single_system->id;  ?>"><?php echo $single_system->system_name;?></option>

                        <?php
                        }

                       ?>
                      

                    </select>
                  </td>

              </tr>


              <tr>
                
                <th>Parameter Type</th>
                <td>
                  <select class="form-control" name="para_type" id="para_type">
                   

                         <option  <?php
                      if ($single_fetch_data->para_type==1) {
                        echo"selected";

                      }
                        ?>

                         value="1">Input Field</option>

                        <option 
                        <?php

                      if ($single_fetch_data->para_type==2) {

                        echo"selected";
                      }
                        ?> value="2">Check Box</option>

                        <option 
                        <?php

                      if ($single_fetch_data->para_type==3) {

                        echo"selected";
                      }
                        ?> value="3">Radio</option>

                       
                     
                  </select>
                </td>
              </tr>

              
              <tr>
                <th>Parameter Name</th>
                <td>
                  <input type="text" class="form-control" name="para_name" id="para_name" value="<?php echo $single_fetch_data->para_name;  ?>">
                </td>
              </tr>

              <tr>
                <th>User Role</th>
                <td>
                 

                  <select class="form-control" name="user_role" id="user_role">
                    <?php  

                    $role_data =  DB::table('role_table')->get();

                    foreach($role_data as $single_role_data){

                   ?>
                      <option value="{{$single_role_data->sl}}" <?php if ($single_role_data->sl==$single_fetch_data->user_role) {
                        echo "selected";

                      } ?> >{{$single_role_data->role_name}}</option>

                      <?php 

                       }

                    ?>
                  </select>
                </td>
              </tr>
             

          </table>

           


      </form>



      

  </div>