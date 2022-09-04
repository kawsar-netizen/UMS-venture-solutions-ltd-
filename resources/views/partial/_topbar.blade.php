<div class="row-12 border-bottom" align="right">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-link " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.9.3/search_results.html">
                <!-- <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div> -->
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown" style="visibility: hidden;">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a> 
                </li>

               <!--  <li class="dropdown" style="visibility: hidden;">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a> 
                </li> -->



                <li style="padding: 20px">
                    <span class="m-r-sm welcome-message"><b>Welcome, {{Auth::user()->name}} accessing from 

                        <?php 
                            $user_branch_code = Auth::user()->branch;
                           

                    
                        ?>

                       
                     <?php



                    



                    if ($user_branch_code=='202') {
                        
                    

                      $branch_data =  DB::table('branch_info')->where('bnk_br_id', $user_branch_code)->first();

                            echo $branch_data->name;

                         if (Auth::user()->division_name) {



                             echo ' ('.Auth::user()->division_name.')';
                         }
                    

                    }else{

                         $branch_data =  DB::table('branch_info')->where('bnk_br_id', $user_branch_code)->first();

                            echo $branch_data->name;
                    }

                    


                ?> 

                <?php 

                  if (Auth::user()->br_info_flag=='2' && (Auth::user()->br_pk_id!='0' && Auth::user()->br_pk_id!=NULL)) {

                     $br_pk_id =  Auth::user()->br_pk_id;

                    $get_sub_branch_data = DB::table('branch_info')->where('agent_br_key', $br_pk_id)->first();

                    echo " <span style='color: red;'>( $get_sub_branch_data->name )</span> ";

                  }
                         
                        


                    ?>




                        (<?php  

                           $role_id =  Auth::user()->role;
                          $role_data = DB::table('role_table')->where('sl', $role_id)->first();

                         echo $role_data->role_name;
                         
                        ?>)

                    </b></span>
                </li>

               



                <li class="dropdown" style="visibility: hidden;">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a> 
                </li>

                <!-- <li class="dropdown" style="visibility: hidden;">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a> 
                </li>

                <li class="dropdown" style="visibility: hidden;">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a> 
                </li> -->



                <li class="dropdown">

                    
                    <a class="dropdown-toggle count-info" title="Edit Profile" data-toggle="dropdown" href="#">
                       <i class="fa fa-edit"></i> <b>{{Auth::user()->name}}</b> (
                            <?php


                    $user_branch_code = Auth::user()->branch;

                   $branch_data =  DB::table('branch_info')->where('bnk_br_id', $user_branch_code)->first();

                   echo $branch_data->name;



                ?> )

                      
                    </a>
                    <ul class="dropdown-menu">

                      
                       
                        <li style="

                        <?php 

                        if (Auth::user()->role=='11' || Auth::user()->role=='12') {
                            echo "display: none"
                          ?>

                    
                        <?php 

                         }
                       ?>
                       "><a href="{{url('edit_profile')}}" ><i class="fa fa-edit"></i> Edit Profile </a></li>

                        

                        <li class="dropdown-divider"></li>

                        <?php 
                        if(Auth::user()->role=='11' || Auth::user()->role=='12'){

                          ?>
                          
                          <li><a href="{{route('reset-password')}}"><i class="fa fa-cog"></i> Reset Password </a></li>

                          <?php
                          }
                        ?>
                       <!--  <li class="dropdown-divider"></li> -->
                        <li>
                            <a href="{{route('logout')}}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        </li>            
                    </ul>
                </li>

            </ul>

        </nav>
        </div>