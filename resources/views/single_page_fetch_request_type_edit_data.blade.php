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
          

          <input type="hidden" name="hidden_id" id="hidden_id" value="{{$get_data->id}}">
        

          <table class="table table-bordered" width="80%">
             

              <tr>
                  <th>System Name</th>
                  <td>
                   
                    <select class="form-control select2"  name="edit_system_name" id="edit_system_name">

                      <option value="">--select--</option>

                      <?php 

                      $system_data =  DB::table('systems')->get();

                      foreach ($system_data as  $value) {

                        ?>


                        <option value="{{$value->id}}" <?php if($value->id==$get_data->system_id){echo'selected';} ?>>{{$value->system_name}}</option>
                        <?php 
                      }
                      ?>
                    </select>
                   
                </td>
              </tr>

               <tr>
                  <th>Show Parameter</th>
                  <td>
                    <select class="form-control" name="edit_show_parameter" id="edit_show_parameter">
                        <option value="">--select--</option>
                        <option value="0">Yes</option>
                        <option value="1">No</option>
                    </select>
                  </td>
              </tr>

              <tr>
                <th>Show Input Field</th>
                <td>
                    <select class="form-control" name="show_input_field" id="edit_show_input_field">
                        <option value="">--select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                  </td>

              </tr>

              <tr>
                  <th>Request Type Name</th>
                  <td>
                    <input type="text" name="edit_request_type_name" id="edit_request_type_name" class="form-control" value="{{$get_data->request_type_name}}">
                  </td>
              </tr>

              



          </table>

           


      </form>



      

  </div>