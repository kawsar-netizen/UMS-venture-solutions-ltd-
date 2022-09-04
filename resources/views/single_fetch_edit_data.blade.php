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
  	

  	
 
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-6">
      <p>User ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="input_user_id" 
        value="{{$single_fetch_data->input_user_id}}"></p>

      <p style="margin-top: -20px"><br>Employee ID : &nbsp;<input type="text" name="emp_id" value="{{$single_fetch_data->emp_id}}"></p>
      <p style="margin-top: -20px"><br>Branch : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="branch" value="{{$single_fetch_data->branch}}"></p>

      <p style="margin-top: -20px"><br>Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="user_email" value="{{$single_fetch_data->user_email}}"></p>
    </div>

    <div class="col-lg-6">
      <p>Domain ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="domain_id" value="{{$single_fetch_data->domain_id}}"></p>

      <p style="margin-top: -20px"><br>Employee Name : &nbsp;<input type="text" name="emp_name" value="{{$single_fetch_data->emp_name}}"></p>
      <p style="margin-top: -20px"><br>Designation : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="designation" value="{{$single_fetch_data->designation}}"></p>
      <p style="margin-top: -20px"><br>Mobile : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="emp_mobile" value="{{$single_fetch_data->emp_mobile}}"></p>
    </div>
  </div>
</div>


<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Systems</b></div>



<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">



                       
                            
                            <div class="row"> 

                          <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check1" name="ubs" value="UBS" class="box" type="checkbox" <?php if($single_fetch_data->ubs=='UBS'){echo "checked";} ?> > <label>UBS </label></div>

                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="pbm" value="PBM" type="checkbox"> <label>PBM </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check3" name="cps" value="CPS2" class="box3" type="checkbox"> <label>CPS2 </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check4" name="beftn" value="BEFTN" class="box4" type="checkbox"> <label>BEFTN </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check2" name="rtgs" value="RTGS" type="checkbox" class="box2"> <label>RTGS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="docudex" value="Docudex" type="checkbox"> <label>Docudex</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="newdbcube" value="newdbcube" id="check5" class="box5" type="checkbox"> <label>New DBcube </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="rbs" value="RBS" type="checkbox"> <label>RBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="gefu" value="GEFU" type="checkbox"> <label>GEFU </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="directbank" value="Direct Banking" id="check7" class="box7" type="checkbox"> <label>Direct Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="bkash" value="Bkash" id="check6" class="box6" type="checkbox"> <label>Bkash</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="portal" value="Portal" type="checkbox"> <label>Portal</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="rit" value="RIT" type="checkbox"> <label>RIT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="forex" value="FOREX" type="checkbox"> <label>FOREX </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="csms" value="CSMS" type="checkbox"> <label>CSMS </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="passport" value="PASSPORT" type="checkbox"> <label>PASSPORT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="nscreen" value="N SCREEN" type="checkbox"> <label>N SCREEN</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="swift" value="SWIFT" type="checkbox"> <label>SWIFT</label></div>
                                    </div>
                                </div>
                              
                            </div>



                            </div>  
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    

      <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Request Type</b></div>
    


<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                            
                            <div class="row"> 
                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="newidcreate" value="New ID Creation" type="checkbox" <?php if($single_fetch_data->newidcreate=='New ID Creation'){echo "checked";} ?> > <label>New ID Creation </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="amendment" value="Amendment" type="checkbox" <?php if($single_fetch_data->amendment=='Amendment'){echo "checked";} ?> > <label>Amendment </label></div>
                                    </div>
                                </div>
                              
                            </div>


                           



                              <div class="col-lg-4">
                                   

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="transfer" value="Transfer" type="checkbox" <?php if($single_fetch_data->transfer=='Transfer'){echo "checked";} ?> > <label>Transfer </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="enable" value="Enable" type="checkbox"
                                         <?php if($single_fetch_data->enable=='Enable'){echo "checked";} ?> > <label>Enable </label></div>
                                    </div>
                                </div>
                              
                            </div>




                               <div class="col-lg-4">
                                   

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="disable" value="Disable" type="checkbox" <?php if($single_fetch_data->disable=='Disable'){echo "checked";} ?> > <label>Disable</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="passreset" value="Password Reset" type="checkbox"
                                         
                                          <?php if($single_fetch_data->passreset=='Password Reset'){echo "checked";} ?>

                                          > <label>Password Reset</label></div>
                                    </div>
                                </div>
                              
                            </div>



                            </div>  
                                
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
     


    <div class="wrapper wrapper-content animated fadeInRight" id="box" style="">
    <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>UBS</b></div>
          <!-- <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>UBS</b></a>
                    </li>
                </ol>
            </div> -->

            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 

                                <!-- <label>my test</label><input type="text" name="department" value=""> -->

                            <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="manager" value="Manager" type="checkbox" 

                                         <?php if($single_fetch_data->manager=='Manager'){echo "checked";} ?>> <label>Manager </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="manops" value="Manager OPS" type="checkbox"  <?php if($single_fetch_data->manops=='Manager OPS'){echo "checked";} ?> > 

                                          <label>Manager OPS </label></div>
                                    </div>
                                </div>


                            </div>



                              <div class="col-lg-3">

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="genralbank_ubs" value="General Banking" type="checkbox" 

                                         <?php if($single_fetch_data->genralbank_ubs=='General Banking'){echo "checked";} ?> > <label>General Banking </label></div>

                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="credit_ubs" value="Credit" type="checkbox"  <?php if($single_fetch_data->credit_ubs=='Credit'){echo "checked";} ?> > <label>Credit </label></div>
                                    </div>
                                </div>

                            </div>



                              <div class="col-lg-3">
                                   
                              



                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="foreigntrade" value="Foreign Trade" type="checkbox"  <?php if($single_fetch_data->foreigntrade=='Foreign Trade'){echo "checked";} ?> > <label>Foreign Trade</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="tellerorcash" value="Teller/Cash" type="checkbox" 

                                          <?php if($single_fetch_data->tellerorcash=='Teller/Cash'){echo "checked";} ?>> <label>Teller/Cash</label></div>

                                    </div>
                                </div>

                            </div>



                              <div class="col-lg-3">

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="view_ubs" value="View" type="checkbox"  <?php if($single_fetch_data->view_ubs=='View'){echo "checked";} ?> > <label>View </label></div>
                                    </div>
                                </div>

                            </div>  


                              
                              <div class="col-lg-6">
                                <br>
                                   <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Department : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="depart_ubs" 

                                        value="{{ $single_fetch_data->depart_ubs }}">
                                    </div>
                                </div>


                              <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Existing User ID (if any) : </label>
                                       &nbsp;&nbsp;<input type="text" name="exist_user_id_ubs" value="{{ $single_fetch_data->exist_user_id_ubs }}">
                                    </div>
                                </div>
                              </div>

                              <div class="col-lg-6">
                                <br>
                                  <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Special Function/Role (if any) : </label>
                                        &nbsp;&nbsp;<input type="text" name="special_role_ubs"  value="{{ $single_fetch_data->special_role_cps }}">
                                    </div>
                                </div> 
                              </div>
                              

                        </div>  
                            
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
      

  </div>