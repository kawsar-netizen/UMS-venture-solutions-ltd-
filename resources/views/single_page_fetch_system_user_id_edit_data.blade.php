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
                    <?php 
                   $sys_id = $get_data->sys_id;
                   $get_system = DB::table('systems')->where('id',$sys_id)->first();
                   echo $get_system->system_name;

                    ?>
                </td>
              </tr>

               <tr>
                  <th>System User Id</th>
                  <td><input type="text" name="edit_system_user_id" id="edit_system_user_id" class="form-control" value="{{$get_data->sys_user_id}}"></td>
              </tr>

              



          </table>

           


      </form>



      

  </div>