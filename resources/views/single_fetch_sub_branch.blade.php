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



<label class="col-sm-4 col-form-label">Sub Branch Name </label>

<div class="col-sm-8">

      
      <select  class="form-control" id="sub_branch_name" name="sub_branch_name"
        >

          <option value="0">--select Sub branch--</option>
          <?php  

            $branch_info_data = DB::table('branch_info')->where('br_code',$br_code)->where('brinfo_flag',2)->get();

            foreach($branch_info_data as $single_branch_info_data){

              ?>

              <option value="{{$single_branch_info_data->agent_br_key}}">{{$single_branch_info_data->name}}</option>

              <?php 
            }

          ?>
      </select>
  </div>