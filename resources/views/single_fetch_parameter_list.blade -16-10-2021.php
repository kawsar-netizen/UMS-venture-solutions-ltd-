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



  <div class="modal_body_parameter_list container">
    

    <table class="table table-bordered">
        

      <?php

           foreach($requests as $show_message){

          $action_status_br_checker = $show_message['action_status_br_checker'];
          $ho_authorize_status = $show_message['ho_authorize_status'];
          $system_id = $show_message['system_id'];
          $request_type_id = $show_message['request_type_id'];

          if ($action_status_br_checker=='1' && $ho_authorize_status!='1' && $system_id=='6' && $request_type_id=='33') {
            if (Auth::user()->role=='1' || Auth::user()->role=='5') {
             
            
         ?>
        <tr >
          <th colspan="2" class="text-center" style="color: red">Please Contact With Opeartions DIvision</th>
        </tr>

        <?php 
          }

         }

         }

      ?>
      

        <tr>
          <th>Request Id</th>

           <td><?php 

         foreach($requests as $single_req_data){

          echo $single_req_data['req_id'];
          echo"<br>";

         } ?>
           

         </td>

        </tr>


        <tr>
          <th>Request User</th>
          <td>
            <?php 
              foreach($requests as $single_req_data){
                $entry_user_name_id = $single_req_data['req_id'];

                $request_id = $single_req_data['req_id'];
                $ip_phone = $single_req_data['ip_phone'];

                $entry_user_data = DB::select(DB::raw("select ui.name,ui.user_id  from [request_id] ri left join [users] ui on ri.br_maker = ui.id where req_id='$request_id'"));
                echo $entry_user_data[0]->name;
                echo "(".$entry_user_data[0]->user_id.")";

                echo "<br>";

                if($ip_phone) {
                 echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                }
                
              } 
         ?>
           

         </td>

        </tr>




         <tr>
          <th>Request Branch</th>

           <td><?php 

         foreach($requests as $single_req_branach){

          $branch_code = $single_req_branach['branch_code'];
          $division_name = $single_req_branach['division_name'];

         $branch_data = DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

         if ($branch_code=='202') {

           echo $branch_data->name." ($division_name)";
         }else{

          echo $branch_data->name;
         }
          
          

         } ?>
           

         </td>

        </tr>


        <tr>
          <th>Request Entry Date</th>
          <td>
            
            <?php 

           foreach($requests as $single_req_date){

         
            if ($single_req_date['entry_date']) {
              
            
              echo date('d F, Y h:i:s A', strtotime($single_req_date['entry_date']));
              echo"<br>";

              }

           } 

         ?>

          </td>
        </tr>

        <tr>
          <th>Request Complete Date</th>

          <td>
            <?php 
              foreach($requests as $complete_req_date){

              if ($complete_req_date['ho_chkr_aprove_sts_update_date']) {
                
              
                echo date('d F, Y h:i:s A', strtotime($complete_req_date['ho_chkr_aprove_sts_update_date']));
                echo"<br>";

              }

           } 

            ?>
          </td>
        </tr>

        <tr>
           <?php 

           foreach($requests as $single_branch_maker){

            $user_role_id = $single_branch_maker['user_role_id'];
            
            if ($user_role_id=='9' || $user_role_id=='10') {
              
              ?>

              <th>Head Office Division Maker</th>

              <?php 
            }elseif($user_role_id!='9' && $user_role_id!='10'){

                if ($user_role_id=='2' || $user_role_id=='6') {

                  ?>
                  <th>IT Request Maker</th>

                  <?php

                }elseif($user_role_id=='2' || $user_role_id=='6'){

                  ?>

                    <th>IT Request Checker</th>

                  <?php 

                }else{

                  ?>

                   <th>Branch Maker</th>

                  <?php 
                }
              ?>

             

              <?php 
            }

           } 

         ?>

          
          <td>
            <?php 

           foreach($requests as $single_branch_maker){


            $br_maker = $single_branch_maker['br_maker'];

            $pk_for_sub_br_for_br_maker = $single_branch_maker['pk_for_sub_br'];
           // $ip_phone = $single_branch_maker['ip_phone'];
           

        
             $branch_code = $single_branch_maker['branch_code'];

              $division_name = $single_branch_maker['division_name'];

            if ($br_maker) {

             $data_br_maker_count = DB::table('users')->where('id',$br_maker)->count();

               if ($data_br_maker_count>0) {

                  $data_br_maker = DB::table('users')->where('id',$br_maker)->first();

                    
                     
                     if ($branch_code=='202') {

                      echo $data_br_maker->name." (". $data_br_maker->user_id.") ($division_name)";
                      

                     }else{

                     echo $data_br_maker->name." (". $data_br_maker->user_id.") ";

                     }

                  

                  $ip_phone = $data_br_maker->ip_phone;

                    echo "<br>";

                  if($ip_phone) {
                   echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                  }

               }else{
                echo "";
               }
             

            


             if(!empty($pk_for_sub_br_for_br_maker)) {
                
                    if($pk_for_sub_br_for_br_maker >0)
                    {
                      $sub_br_data_get = DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br_for_br_maker)->first();

                      echo "<span style='color:red;'> ( $sub_br_data_get->name ) </span>";

                    }

               }


           }

           } 

         ?>
          </td>
        </tr>

        <tr>

          <?php 

            foreach($requests as $single_branch_checker){

               $user_role_id = $single_branch_checker['user_role_id'];

               if ($user_role_id=='9' || $user_role_id=='10') {
                  

                ?>

                <th>Head Office Division  Checker</th>

                <?php 
               }elseif($user_role_id!='9' && $user_role_id!='10'){

                   if ($user_role_id=='2') {
                ?>

                 <th>IT Request Maker</th>

                <?php 

                  }elseif($user_role_id=='6'){

                    ?>
              <th>IT Request Checker</th>

                    <?php
                  }else{

                    ?>

                     <th>Branch Checker</th>


                     <?php 
                  }
               }

            }
          ?>
        


          <td>
            <?php 

           foreach($requests as $single_branch_chceker){


            $br_checker_assign_manual_id = $single_branch_chceker['br_checker_assign_manual_id'];

             $pk_for_sub_br_checker = $single_branch_chceker['pk_for_sub_br_checker'];
             // $ip_phone = $single_branch_chceker['ip_phone'];


             $branch_code = $single_branch_chceker['branch_code'];

              $division_name = $single_branch_chceker['division_name'];

            if ($br_checker_assign_manual_id) {

             $data_br_chekcer_count = DB::table('users')->where('id',$br_checker_assign_manual_id)->count();
            
            if ($data_br_chekcer_count>0) {

                $data_br_chekcer = DB::table('users')->where('id',$br_checker_assign_manual_id)->first();


               // echo $data_br_chekcer->name." (". $data_br_chekcer->user_id.") ";

                if ($branch_code=='202') {

                      echo $data_br_chekcer->name." (". $data_br_chekcer->user_id.") ($division_name)";
                      

                     }else{

                     echo $data_br_chekcer->name." (". $data_br_chekcer->user_id.") ";

                     }

                $ip_phone = $data_br_chekcer->ip_phone;

                 echo "<br>";

                  if($ip_phone) {
                   echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                  }

            }else{
              echo "";
            }
            

            

             if (!empty($pk_for_sub_br_checker)) {
                
                    if($pk_for_sub_br_checker>0)
                    {
                      $sub_br_data_get = DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br_checker)->first();

                      echo "<span style='color:red;'> ( $sub_br_data_get->name ) </span>";

                    }

               }
           }

           
          
           

           } 

         ?>
          </td>
        </tr> 



        <tr>


          <th>Branch Checker / Head Office Division Checker Authorized Date</th>
          <td>


            <?php 

               foreach($requests as $br_checker_auth_date){

             $br_checker_sts_update_date = $br_checker_auth_date['br_checker_sts_update_date'];

             if ($br_checker_sts_update_date) {
              
               echo date('d F, Y h:i:s A', strtotime($br_checker_sts_update_date));
             }
             

           }

            ?>
            
          </td>
        </tr>



        <?php 

           foreach($requests as $single_req){

              $request_type_system_id = $single_req['request_type_system_id'];
              $request_type_id = $single_req['request_type_id'];
            

            if ($request_type_system_id=='6' and $request_type_id=='33') {
             
            

        ?>
        <tr>
          <th>Operations Division Authorizer</th>
          <td>
            
            <?php 

           foreach($requests as $single_ho_authorizer){

            $ho_authorizer = $single_ho_authorizer['ho_authorizer'];
            // $ip_phone = $single_ho_authorizer['ip_phone'];

           if ($ho_authorizer) {

               $data_ho_authorizer_count = DB::table('users')->where('id',$ho_authorizer)->count();

               if ($data_ho_authorizer_count>0) {

                  $data_ho_authorizer = DB::table('users')->where('id',$ho_authorizer)->first();
                  echo $data_ho_authorizer->name." (". $data_ho_authorizer->user_id.") ";
                  
                 $ip_phone = $data_ho_authorizer->ip_phone;

                  echo "<br>";

                  if($ip_phone) {
                   echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                  }

               }
              

             }
             

           } 

         ?>

          </td>
        </tr>


        <?php 
           }
        }

        ?>
         
        <tr>
          <th>IT Maker</th>
          <td>
            <?php 

           foreach($requests as $single_ho_maker){

            $ho_maker_id = $single_ho_maker['ho_maker'];
             // $ip_phone = $single_ho_maker['ip_phone'];

           if ($ho_maker_id) {

             $data_ho_maker_count = DB::table('users')->where('id',$ho_maker_id)->count();

             if ($data_ho_maker_count>0) {

              $data_ho_maker = DB::table('users')->where('id',$ho_maker_id)->first();
              $ip_phone = $data_ho_maker->ip_phone;
              echo $data_ho_maker->name." (".$data_ho_maker->user_id.")";


                  echo "<br>";

                  if($ip_phone) {
                   echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                  }

             }
             
           }
           

           } 

         ?>
          </td>
        </tr> 

       


        <tr>
          <th>IT Maker Remarks</th>

          <td>
              <?php 

             foreach($requests as $single_ho_maker){

            echo  $ho_maker_remarks = $single_ho_maker['ho_maker_remarks'];

            

             } 

           ?>
          </td>
        </tr>


        
         <tr>
          <th>IT Checker</th>
          <td>
            <?php 

           foreach($requests as $single_ho_checker){

            $ho_checker_id = $single_ho_checker['ho_checker'];
            // $ip_phone = $single_ho_checker['ip_phone'];

           if ($ho_checker_id) {

             $data_ho_checker_count = DB::table('users')->where('id',$ho_checker_id)->count();
             if ($data_ho_checker_count>0) {

               $data_ho_checker = DB::table('users')->where('id',$ho_checker_id)->first();
               $ip_phone = $data_ho_checker->ip_phone;
               echo $data_ho_checker->name." (".$data_ho_checker->user_id.")";


               echo "<br>";

                  if($ip_phone) {
                   echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                  }

             }
             
           }
           

           } 

         ?>
          </td>
        </tr> 

      

        <tr>
          <th>System Name</th>

          <td><?php 

         foreach($requests as $single_req){

          $request_type_system_id = $single_req['request_type_system_id'];
         $request_type_system_data = DB::table('systems')->where('id', $request_type_system_id)->first();
         echo $request_type_system_data->system_name;

         } ?></td>

        </tr> 


         <tr>
          <th>System User Id (Request Maker)</th>

          <td><?php 

             foreach($requests as $single_system){

              $request_type_system_id = $single_system['request_type_system_id'];
            

              $br_maker = $single_system['br_maker'];
          
             $system_user_id_data_count = DB::table('system_user_id')->where('sys_id',$request_type_system_id)->where('user',$br_maker)->count();

             if ($system_user_id_data_count>0) {
                
                $system_user_id_data = DB::table('system_user_id')->where('sys_id',$request_type_system_id)->where('user',$br_maker)->first();

                echo $system_user_id_data->sys_user_id;

             }

         }

           ?></td>

        </tr> 




       <tr>
         <th>Request Type</th>

         <td><?php 
          foreach($requests as $single_reqest_type){

           echo  $request_type_name = $single_reqest_type['request_type_name'];
          

            $request_type_value = $single_reqest_type['request_type_value'];

          
            }

           
          ?></td>
       </tr>


       <?php

        if ($request_type_value) {
         
         ?>

         <tr>
           <th>Request Type Value</th>

           <td><?php  echo urldecode($request_type_value); ?></td>

          </tr>

         <?php 

        }
       ?>
       
       <?php 
        foreach($requests as $single_user_id){

             $request_type_name =  $single_user_id['request_type_name'];

             if ($request_type_name=="New ID Creation") {
                
            
          ?>

       <tr>
         <th>User id</th>

          <td><?php echo $single_user_id['created_user_id'] ?> </td>
          
       </tr>


       <?php

          }
        }
       ?>



       <?php 

        foreach($requests as $single_user_pass){

                $request_type_name =  $single_user_pass['request_type_name'];

                 if ($request_type_name=="New ID Creation" &&  (Auth::user()->role==2 ||  Auth::user()->role==1 || Auth::user()->role==9) ) {
          ?>

             <tr>
                <th>User Password</th>
                <td><?php echo $single_user_pass['created_password']; ?></td>
             </tr>

       <?php

          }elseif ($request_type_name=="New ID Creation" && ( Auth::user()->role !=2 ||  Auth::user()->role !=1 || Auth::user()->role !=9)) {

            ?>

             <tr>
                <th>User Password</th>
                <td>**************</td>
             </tr>
           
           <?php 
          }

        }

       ?>



       <?php 

        foreach($requests as $reset_pass){

                $request_type_name =  $reset_pass['request_type_name'];

                 if ($request_type_name=="Password Reset" &&  (Auth::user()->role==2 ||  Auth::user()->role==1)) {
          ?>

             <tr>
                <th>Password</th>
                <td><?php echo $reset_pass['created_password']; ?></td>
             </tr>

       <?php

          }elseif ($request_type_name=="Password Reset" && ( Auth::user()->role!=2 ||  Auth::user()->role!=1)) {

            ?>

             <tr>
                <th>Password</th>
                <td>**************</td>
             </tr>
           
           <?php 
          }

        }

       ?>



       <?php 
         foreach ($requests as $key => $para_list_value) {
            $para_list = $para_list_value['para_list'];

             foreach($para_list as $key => $para_value) {

              $para_value_0 =  $para_value[0];


              }

         }


       ?>
        <tr style="<?php 

          if ($para_value_0=='') {

                  echo "display: none";
                  
                }

      ?>">




          <th>Role Name</th>

          <td>
            
              <?php

      foreach ($requests as $key => $para_list_value) {
       

         $para_list = $para_list_value['para_list'];
        
        

         foreach($para_list as $key => $para_value) {
                          // echo"<pre>";
                          // print_r($para_value);
                        $para_id = $para_value[0];
                        $para_name = $para_value[1];
                        $para_val = $para_value[2];
                        $para_type = $para_value[3];


                       
                   ?>


      <p style="margin-left:20px;">

        <?php

         if($para_type==2){

            if($para_name=='rtgs_tmp_exp_datetime'){

              ?>

               <input type="checkbox"  checked>
              <label for="vehicle3"> <?php echo utf8_decode(urldecode($para_val)); ?></label>

              <?php

            }else{

              ?>

               <input type="checkbox"  checked>
              <label for="vehicle3"> <?php echo $para_name; ?></label>

              <?php 
            }

            ?>
            
           


           <?php

          }elseif($para_type==3){

            ?>

            <input type="radio"  checked>
           <label for="vehicle3"> <?php echo $para_name; ?></label>

            <?php 
          }
        ?>

      </p>



  <?php


      }

    }

    ?>




    <?php

      foreach ($requests as $key => $para_list_value) {
        // echo "<pre>";
        // print_r($para_list_value);

         $para_list = $para_list_value['para_list'];
        
        

         foreach($para_list as $key => $para_value) {
                          // echo"<pre>";
                          // print_r($para_value);
                        $para_id = $para_value[0];
                        $para_name = $para_value[1];
                        $para_val = $para_value[2];
                        $para_type = $para_value[3];




                       
                   ?>


    <p style="margin-left:20px;">
      <?php

         if($para_type==1){

            ?>
            
            <label for="vehicle3"> <?php echo $para_name; ?> : </label>

           <input type="text"  disabled value="<?php echo urldecode($para_val); ?>">
           
           <?php

          }
        ?>


      </p>

      

  <?php


      }

    }

    ?>

          </td> 



        </tr> <!-- end roles/ parameter -->

      

       <?php 

            foreach ($requests as  $cancel) {

               if($cancel['canceled_by'] && $cancel['cancel_reason']){

              ?>

                <tr>
                  
                  <th>Canceled By</th>
                  <td>
                    <?php 

                      foreach ($requests as  $canceled_val) {

                        $canceled_by =  $canceled_val['canceled_by'];
                        // $ip_phone =  $canceled_val['ip_phone'];

                        if ($canceled_by) {
                       
                          $canceled_data =  DB::select(DB::raw("SELECT users.name as user_name, role_table.role_name, users.ip_phone FROM users LEFT JOIN role_table on users.role=role_table.id where users.id='$canceled_by' "))[0];

                          echo "$canceled_data->user_name ( $canceled_data->role_name)";

                          echo "<br>";

                          $ip_phone = $canceled_data->ip_phone;

                          if($ip_phone) {
                           echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone </span>";
                          }

                        }
                       
                      }
                    ?>
                  </td>



                </tr>


                <tr>

                   <th>Cancel Reason</th>
                   
                   <td>
                      
                      <?php 

                      foreach ($requests as  $canceled_reason) {

                       echo $canceled_reason =  $canceled_reason['cancel_reason'];
                       
                       
                      }
                    ?>

                   </td>

                </tr>  <!-- cancel reason and canceled by -->

          <?php 


           }
         }
          ?>



           <?php 

                foreach ($requests as  $recheck) {

                  if($recheck['rechecker']){

                 ?>

          <tr>
            <th>Declineed By: (Request Checker)</th>
            <td>
              <?php 

                foreach ($requests as  $recheck_by) {

                    $rechecker =  $recheck_by['rechecker'];
                    //$ip_phone =  $recheck_by['ip_phone'];
                    

                     if ($rechecker) {
                       
                          $rechecker_data =  DB::select(DB::raw("SELECT users.name as user_name, role_table.role_name, users.ip_phone FROM users LEFT JOIN role_table on users.role=role_table.id where users.id='$rechecker' "))[0];

                          echo "$rechecker_data->user_name ( $rechecker_data->role_name)";

                          echo "<br>";

                          $ip_phone = $rechecker_data->ip_phone;

                            if($ip_phone) {
                             echo "<span class='fa fa-phone-square' style='color:green;'> $ip_phone  </span>";
                            }

                        }
                       
                      }

              ?>
            </td>
          </tr>

          <?php 

        }

        if ($recheck['br_checker_recheck_reason']) {
          
        

        ?>

          <tr>
            <th>Decline Reason (Request Checker)</th>
            <td>
              
              <?php 

                foreach ($requests as  $recheck_reason) {

                   echo $br_checker_recheck_reason =  $recheck_reason['br_checker_recheck_reason'];
                    
  
                      }

              ?>
            </td>
          </tr>

          <?php 


            }
              }
          ?>


          <?php 
                 foreach ($requests as  $ho_declined) {

                      
                      if ($ho_declined['ho_decliner']) {
                        ?>
                <tr>
                  <th>Declined By</th>
                  <td>
                    <?php 
                       foreach ($requests as  $ho_declined_by) {

                            $ho_checker =  $ho_declined_by['ho_decliner'];
                           // $ip_phone =  $ho_declined_by['ip_phone'];

                            if ($ho_checker) {
                            
                            
                             $ho_checker_data =  DB::select(DB::raw("SELECT users.name as user_name, role_table.role_name, users.ip_phone FROM users LEFT JOIN role_table on users.role=role_table.id where users.id='$ho_checker' "))[0];


                             $ip_phone = $ho_checker_data->ip_phone;

                          echo "$ho_checker_data->user_name ( $ho_checker_data->role_name)";

                          
                              echo "<br>";

                              if($ip_phone) {
                               echo "<span class='fa fa-phone-square' style='color:green;'>  $ip_phone  </span>";
                              }


        
                            }
                          }

                    ?>
                  </td>
                </tr>

          <?php 
            }}
          ?>



           <?php 
                 foreach ($requests as  $ho_declined_reason) {

                      
                      if ($ho_declined_reason['ho_checker_comment']) {
                        ?>
                <tr>
                  <th>Declined Reason</th>
                  <td>
                    <?php 
                       foreach ($requests as  $ho_declined_reasons) {

                          echo  $ho_declined_reasons['ho_checker_comment'];
                           
                          }

                    ?>
                  </td>
                </tr>

          <?php 
            }}
          ?>

    </table>

  

  </div>


   
