
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

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
          @csrf

          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php  echo $role_data->sl; ?> ">

           <div class="form-group row">
                
                <label class="col-sm-4 control-label" required="required">Role Name</label>

                <div class="col-sm-8">

                    <input type="text" class="form-control" name="rolename2"  value="{{$role_data->role_name}}" />
                </div>

            </div>

          <div class="form-group row">
                                <label class="col-sm-4 control-label" required="required">Menu Name</label>

                                <div class="col-sm-6">

                                     <select class="selectpicker" multiple  name="bnk2[]">
                                       <option value="">-- Select a Menu --</option>

                                                            <?php 
                                                
                                                    
                                                $db_select_menu = DB::select(DB::raw("SELECT * FROM  menu_table  "));


                                                foreach ($db_select_menu as $key => $data_menu) {
                                                   
                                                    ?>

                                                <option value="<?php echo $data_menu->sl; ?>" ><?php echo $data_menu->menu_name; ?></option>

                                                <?php } ?>

                                    </select>

                                </div>

                        </div>  


                      <div class="form-group">
                        <div class="col-sm-8 offset-sm-4">
                            <input type="submit" class="btn btn-primary" ></input>
                        </div>
                    </div>
   

      </form>



      

  </div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script type="">
  
  $('select').selectpicker();

</script>