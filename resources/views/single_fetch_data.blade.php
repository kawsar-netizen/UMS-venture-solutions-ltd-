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
    

    
   
    

     <form action="{{ route('ho_maker_change_status_submit') }}" method="POST">
          

          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php  echo $request_sl; ?>">
          <input type="hidden" name="req_id" id="req_id" value="<?php  echo $request_id; ?>">
          <input type="hidden" name="system_name" id="system_name" value="<?php echo $system_name;?>">


          <table class="table table-bordered" width="80%">
              <tr>
                  <th>Request Id </th>
                  <td>{{$request_id}}</td>
              </tr>

             

              <tr>
                  <th>System Name</th>
                  <td>{{$system_name}}</td>
              </tr>

               <tr>
                  <th>Request Type</th>
                  <td><?php 

                    $final_request_type_exp = explode(',',$final_request_type);
                    echo $final_request_type_exp[0];

                   ?></td>
              </tr>

              <?php  

                if ($final_request_type_exp[0]=='New ID Creation') {
                  ?>


              
              <tr>
                  <th>User Id</th>
                  <td><input type="text" class="form-control" name="user_id" value="{{$single_fetch_data->created_user_id}}" id="user_id"></td>
              </tr>

              <tr>
                  <th>Password</th>
                  <td><input type="text" class="form-control" name="user_password" value="{{$single_fetch_data->created_password}}" id="user_password"></td>
              </tr>

               <?php 


                }elseif($final_request_type_exp[0]=='Password Reset'){
                  ?>

                  <tr>
                    <th>Password</th>
                    <td><input type="text" class="form-control" name="reset_password" value="{{$single_fetch_data->created_password}}" id="reset_password"></td>
                </tr>

                  <?php
                }
              ?>

              <tr>
                  <th>Change Status Request</th>
                  <td>
                      
                      <select class="form-control" id="change_status" name="change_status">
                    
                        <option>--select--</option>

                        <option value="0" <?php  if($single_fetch_data->status=='0'){echo 'selected'; } ?> >Initiate</option>

                      

                        <option value="2" <?php  if($single_fetch_data->status=='2'){echo 'selected'; } ?> >Complete</option>

                        <option value="3" <?php  if($single_fetch_data->status=='3'){echo 'selected'; } ?> >On Hold</option>

                        <option value="4" <?php  if($single_fetch_data->status=='4'){echo 'selected'; } ?> >Cancel</option>
                            
                            
                  </select>
              
                  </td>
              </tr>

              <tr>
                <th>Remarks</th>

                <td>
                 
                
                  <textarea name="ho_maker_remarks" id="ho_maker_remarks">{{$ho_maker_remarks}}</textarea>
                  
                </td>
              </tr>



          </table>

           


      </form>



      

  </div>