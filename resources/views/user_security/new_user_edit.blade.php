

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
          

          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php  echo $user_data->id; ?> ">
          

          <div class="row">
              <div class="col-md-6">
                
            
           <div class="form-group row"><label class="col-lg-4 col-form-label">User Name</label>

                <div class="col-lg-8">
                  <input type="text" class="form-control" name="edit_user_name"  id="edit_user_name" value="<?php  echo $user_data->name; ?>" />
                </div>

            </div>


            <div class="form-group row"><label class="col-lg-4 col-form-label">User Role</label>

                <div class="col-lg-8">

                   <select class="form-control" id="edit_user_role" name="edit_user_role">

                     <?php 

                       $roles = DB::table('role_table')->get();

                       foreach($roles as $single_role){
                            
                        ?>

            <option value="<?php echo $single_role->sl; ?>" 
                <?php

                if ($user_data->role==$single_role->sl) {

                   echo "selected";
                }

        ?> 
        ><?php  echo $single_role->role_name; ?></option>
                       
                        <?php 
                       }

                     ?>

                    </select>


                </div>

            </div>


            <div class="form-group row">

                <label class="col-sm-4 control-label" required="required">Branch Name</label>

                <div class="col-sm-8">

                    <select class="form-control" name="edit_branch_name" id="edit_branch_name">
                      <?php

                        $branch_data = DB::table('branch_info')->get();

                        foreach($branch_data as $single_branch){

                          ?>
                          <option value="<?php echo $single_branch->bnk_br_id;  ?>" <?php if($user_data->branch==$single_branch->bnk_br_id){

                                echo"selected";
                                
                              } 

                        ?>><?php echo $single_branch->name; ?></option>

                          <?php
                        }
                      ?>
                      
                    </select>
                </div>

            </div>

            <div class="form-group row">

                <label class="col-sm-4 control-label" required="required">Phone</label>

                <div class="col-sm-8">

                   <input type="text" name="edit_phone" id="edit_phone" class="form-control" value="<?php  echo $user_data->contact; ?>">
                </div>

            </div>
           
            <div class="form-group row">

                <label class="col-sm-4 control-label" required="required">Email</label>

                <div class="col-sm-8">

                   <input type="text" name="edit_email" id="edit_email" class="form-control" value="<?php  echo $user_data->email; ?>">
                </div>

            </div>

              </div>
            

            <div class="col-md-6">
              
            
                 <div class="form-group row">

                    <label class="col-sm-4 control-label" required="required">Designation</label>

                    <div class="col-sm-8">

                       <input type="text" name="edit_designation" id="edit_designation" class="form-control" value="<?php  echo $user_data->designation; ?>">
                    </div>

                </div>

                


                <div class="form-group row">

                      <label class="col-sm-4 control-label" required="required">User Id</label>

                      <div class="col-sm-8">

                         <input type="text" name="edit_user_id" id="edit_user_id" class="form-control" value="<?php  echo $user_data->user_id; ?>" >

                      </div>

                  </div>


                 <div class="form-group row">

                      <label class="col-sm-4 control-label" required="required">Status</label>

                      <div class="col-sm-8">

                         <select class="form-control" name="edit_status" id="edit_status">

                            <option value="1"  <?php 

                              if ($user_data->status_id==1) {

                                echo"selected";

                              }
                             ?>>Active</option>

                            <option value="0" <?php 

                              if ($user_data->status_id==0) {

                                echo "selected";
                                
                              } ?> >Inactive</option>

                         </select>

                      </div>

                  </div>



            </div>
          </div>

      </form>



      

  </div>








