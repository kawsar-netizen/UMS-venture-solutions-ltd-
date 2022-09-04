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
          

          <input type="hidden" name="hidden_id" id="hidden_id" value="{{$get_data->sl}}">
        

          <table class="table table-bordered" width="80%">
             
              <tr>
                  <th>Designation Title</th>
                  <td>
                    <input type="text" name="designtaion_title" id="designtaion_title" class="form-control" value="{{$get_data->designation_name}}" required="">
                  </td>
              </tr>

              



          </table>

           


      </form>



      

  </div>