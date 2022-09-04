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



<label class="col-lg-2 col-form-label">Sub Branch Name </label>

<div class="col-lg-4">

      
      <select  class="form-control" id="sub_branch_name" name="sub_branch_name"
        >

          <option value="">--select Sub branch--</option>
          <?php  

          

              $sub_br_data = DB::table('branch_info')->where('bnk_br_id', $branch_code)->where('brinfo_flag',2)->get();

            foreach($sub_br_data as $single_branch_info_data){

              ?>

              <option value="{{$single_branch_info_data->agent_br_key}}">{{$single_branch_info_data->name}}</option>

              <?php 
            }

          ?>
      </select>
  </div>