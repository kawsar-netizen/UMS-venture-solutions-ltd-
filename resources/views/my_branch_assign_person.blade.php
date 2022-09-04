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
  	

  	

         
           <div class="form-group form-inline">
              <label for="sel1"><b>Assign Person :  </b> </label>   


             <select name="assign_person" id="assign_person" class="form-control" style="width: 74%;">
                    
                   
                    <?php
                    foreach ($db_data as $key => $value) {
                     
                   ?>

                  
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                
                <?php

                 }
                    ?>
                        
                        
              </select>



          </div>  

      

      

  </div>


   
