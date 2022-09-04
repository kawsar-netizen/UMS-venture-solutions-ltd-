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
          
          @csrf
          <input type="hidden" name="hidden_id_assign" id="hidden_id_assign" value="{{$request_id}}">
          <input type="hidden" name="hidden_request_id" id="hidden_request_id" value="{{$req_id}}">

          <table class="table table-bordered" width="80%">
              <tr>
                  <th>Request Id </th>
                  <td>{{$req_id}}</td>
              </tr>

             

              <tr>
                  <th>System Name</th>
                  <td>{{$system_name}}</td>
              </tr>

               <tr>
                  <th>Request Type</th>
                  <td>{{$final_request_type_exp_0}}</td>
              </tr>

          </table>

           <div class="form-group form-inline">
              <label for="sel1"><b>Assign Person :  </b> </label>   


             <select name="users" id="user_manual_id" class="form-control" style="width: 74%;">
                    
                   
                    <?php
                    foreach ($db_data as $key => $value) {
                     
                   ?>

                  
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                
                <?php

                 }
                    ?>
                        
                        
              </select>


             


          </div>  

      
      <button type="button" name="submit" class="btn btn-primary update_assign_person" onclick="updateAssaignPerson()" style="margin-left: 152px;margin-top: 20px;">Submit</button>
         
         


      </form>



      

  </div>


   
