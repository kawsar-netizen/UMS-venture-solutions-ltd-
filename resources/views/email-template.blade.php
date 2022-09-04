<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">Welcome!</div>
                   <div class="card-body">
                   
                    <h4>{!! $request_id !!}</h4>
                    <h4>Request Sent : {!! date('d F, Y', strtotime($request_sent_date)) !!}</h4>
                    <h4>{!! $branch_name !!}</h4>
                    <h4>Requested By : {!! $requested_by !!}</h4>
                    <h4>{!! $authorized_by !!}</h4>
                    <h4>{!! $operations_div_auth !!}</h4>
                    <h4> {!! $user_id !!}</h4>
                    <h4>Requested Role : {!! $requested_role !!}</h4>
                    <h4>System Name : {!! $module_name !!}</h4>


                </div>
            </div>
        </div>
    </div>
</div>