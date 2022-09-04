  <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse ">
                <ul class="nav metismenu" id="side-menu">
                    <li class="" style="padding: 33px 25px; background-color: #a3b0c2">
                        <div class="dropdown profile-element">
                <img alt="image" class="rounded-circle" src="{{ asset('assets/img/dbl2.png') }}" width="160px" />
                           <!--  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">David Williams</span>
                                
                            </a> -->
                           
                        </div>
                        <div class="logo-element">
                            DB
                            <br>
                            Ltd.
                        </div>
                    </li>
                    


                  <li>
                        <a href="{{route('dash')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>


               
              






                      <?php

                 $role = Auth::user()->role;
                 
                
                
                   $menu_data = DB::select(DB::raw("SELECT * FROM menu_table where status='1' and (parent='0' or parent IS NULL)   and role ='$role' order by ordering asc " ));

                  

                   foreach ($menu_data as $key => $value) {
                       
                       $pd = $value->link;

                       $main_menu_id = $value->sl;

                  ?>



                   <li>

                   

                     <a href="{{ url($pd) }}"><i class="{{$value->icon}}"></i> <span class="nav-label">{{$value->menu_name}} </span><span class="{{$value->icon2}}"></span></a>


                      <?php

                          // echo "select * from menu_table where status='2' and parent='$main_menu_id' and role like '%$role%'";

                           $q_sub = DB::select(DB::raw("select * from menu_table where status='2' and parent='$main_menu_id' and role like '%$role%' "));

                           $sts=0;
                           foreach ($q_sub as $key => $sub) {
                                $sts++;

                                 $sub_menu_link = $sub->link;

                                $sub_menu_id = $sub->sl;

                             ?>

                            <ul class="nav nav-second-level collapse">

                                <li>
                                    <a href="{{url($sub_menu_link)}}">{{$sub->menu_name}} <span class="{{$sub->icon}}"></span></a>


                                         <?php

                                      

                                   $q_sub_sub = DB::select(DB::raw("select * from menu_table where status='3' and parent='$sub_menu_id'  and role like '%$role%' "));

                                   foreach ($q_sub_sub as $key => $sub_sub) {

                                         $sub_sub_menu_link = $sub_sub->link;

                                        $sub_sub_menu_id = $sub_sub->sl;

                                     ?>

                                     <ul class="nav nav-third-level">

                                        <li>
                                            <a href="{{url($sub_sub_menu_link)}}">{{$sub_sub->menu_name}}</a>
                                        </li>

                                       
                                    </ul>

                                    <?php


                                    }

                                ?>

                                  <?php 
                                    if (Auth::user()->division_name=='Internal Control Compliance Division' && $sts==1) {
                                      
                                      // echo "$sts see";
                                    
                                  ?>
                                    <a href="{{url('single_user_report')}}">Single User Report </a>
                                    <a href="{{url('audit_sheet_report')}}">Audit Sheet Report </a>

                                 <?php 
                                    }
                                  ?>

                                </li>

                               
                        </ul>


                            <?php

                                }

                            ?> 

                        
                          
                        
                </li>


                 <?php

                
                    }

                  ?>

                                                    <li>
                  <a href="{{route('UBSunlock')}}"><i class="fa fa-street-view"></i> <span class="nav-label">UBS Unlock Req.</span></a>
                </li>
                
                <?php
                if($role=='5' or $role=='8' or $role=='10' or $role=='2' or $role=='12' or $role=='6')
                {

                ?>                          
                <li>
                  <a href="{{route('AuthorizeList')}}"><i class="fa fa-cogs"></i> <span class="nav-label">Auth UBS Unlock Req.</span></a>
                </li>
                <?php

                }

                ?>
                <?php
                if($role=='2' or $role=='12' or $role=='6')
                {  
                ?>
                <li>
                  <a href="{{route('ubs_unlock_request_report')}}"><i class="fa fa-cogs"></i> <span class="nav-label">UBS Unlock Report</span></a>
                </li>
                <?php
                }
                ?>   
                                                
                </ul>

            </div>
        </nav>




            
      