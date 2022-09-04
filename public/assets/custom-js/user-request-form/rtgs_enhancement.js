function rtgs_tmp_exp_date(){
      $(".rtgs_tmp_exp_date").css('display','');
      $(".rtgs_tmp_exp_time").css('display','');
 }

function rtgs_permanent(){
   $(".rtgs_tmp_exp_date").css('display','none');
   $(".rtgs_tmp_exp_time").css('display','none');
}

$(".showRtgsEnhanceMentDateTime").on('click', function(){
	$(".rtgs_tmp_exp_date").css('display','');
    $(".rtgs_tmp_exp_time").css('display','');
});

// when select rtgs permanent option then work this function
function rtgsEnhancementParmanentAdd(parameterId, parameterVal, action, sysId) {
	var seletected_parameter_id = parameterId;


	var previous = document.getElementById('parameterList').value;

	
	var newString = null;
	if (previous == '') {
		newString = sysId + "-" + parameterId + "-" + parameterVal;
	} else {
		var sysSet = previous.split(",");
		
		console.log(sysSet);
		
		var current_select_value = sysId + "-" + parameterId + "-" + parameterVal;
		
		console.log(current_select_value);
		
		
		var sys = null;
		if (sysSet.indexOf(current_select_value) === -1) {  // if not exists
			newString = previous + "," + current_select_value;			
		} else {
			console.log("hasan");
			var index = sysSet.indexOf(current_select_value);
			previous = sysSet.toString()
			newString = previous
		}
	}

	var array = newString.split(",");
	var a = array.filter(onlyUnique);

	var prameter_list = a.toString();
	
	prameter_list = removeRtgsDateTimePermanentFiledFromParameterList(prameter_list, 144); // 144 means rtgs permanent
		
	document.getElementById('parameterList').value = prameter_list;

}


// when select rtgs date-time option then work this function
function rtgsEnhancementDateTimeLabelSelect(parameterId, parameterVal, action, sysId){
	var prameter_list = document.getElementById('parameterList').value;
	prameter_list = removeRtgsDateTimePermanentFiledFromParameterList(prameter_list, parameterId); // 143	
	document.getElementById('parameterList').value = prameter_list;
}


// when select rtgs date time option then work this function
function rtgsEnhancementDateTimeAdd(parameterId, parameterVal, action, sysId) {
	var seletected_parameter_id = parameterId;

	var previous = document.getElementById('parameterList').value;

	
	var newString = null;
	if (previous == '') {
		newString = sysId + "-" + parameterId + "-" + parameterVal;
	} else {
		var sysSet = previous.split(",");
		
		var current_select_value = sysId + "-" + parameterId + "-" + parameterVal;
		
		
		var sys = null;
		if (sysSet.indexOf(current_select_value) === -1) {  // if not exists
			newString = previous + "," + current_select_value;			
		} else {
			var index = sysSet.indexOf(current_select_value);
			sysSet.splice(index, 1);
			previous = sysSet.toString()
			newString = previous
		}
	}

	var array = newString.split(",");
	var a = array.filter(onlyUnique);

	var prameter_list = a.toString();
	
	prameter_list = removeRtgsDateTimePermanentFiledFromParameterList(prameter_list, parameterId); // when select date or time
	
	console.log(prameter_list);
		
	document.getElementById('parameterList').value = prameter_list;

}




  function removeRtgsDateTimePermanentFiledFromParameterList(parameter_list, item_value){
    const parameter_list_array  = parameter_list.split(",");
    var new_parameter_list = [];
    
    parameter_list_array.map(item => {
        var item_array = item.split("-");
        var check_item = item_array[0] + "-" + item_array[1];
        if(item_value == 144){
            if(check_item != "6-1814" && check_item != "6-1815"){
                new_parameter_list.push(item);
            }
        }
		
		if(item_value == 143){
            if(check_item != "6-144"){
                new_parameter_list.push(item);
            } 
        }
		
		
		if(item_value == 1814 || item_value == 1815){
            if(check_item != "6-144"){
                new_parameter_list.push(item);
            } 
        }
       
    });

    return new_parameter_list.join(",");
}
  