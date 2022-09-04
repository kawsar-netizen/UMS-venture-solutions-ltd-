@extends('master.master_report')
@section('css')
    <style type="text/css">
        label {
            margin-left: 20px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 0.5rem !important;
        }
    </style>
@endsection




@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading"
        style="background-color: #a3b0c2; color: white; font-family: serif;">
        <div class="col-lg-10">
            <h2><b align="center">Report</b></h2>
            <ol class="breadcrumb" style="background-color: #a3b0c2;">
                <li class="breadcrumb-item">
                    <a href=""><b style="color: white;">UBS Unlock Request Report</b></a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <table id="example2" class="display nowrap" style="width:100%">
        <thead>
            <tr>

                <th>Sl</th>
                <th>UBS User Id</th>
                <th>User Name</th>
                <th>Branch Code</th>
                <th>Branch Name</th>
                <th>Division Name</th>
                <th>Branch Maker/Ho Maker</th>
                <th>Branch Checker/HO Checker</th>
                <th>Unlock Status</th>
                <th>Unlock Request Date & Time</th>
                <th>Authorization Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->req_name}}</td>
                    <td>
                        @php
                        $user_name = DB::table('users')->where('id','=',$item->maker_user_id)->first();
                        @endphp
                        {{$user_name->name}}
                    </td>
                    <td>{{ $item->br_code }}</td>
                    <td>
                        @php
                            $branch = DB::table('branch_info')->where('bnk_br_id','=',$item->br_code)->first();
                        @endphp
                        {{$branch->name}}
                    </td>
                    <td>
                        @php
                        $division = DB::table('users')->where('division_name','=',$item->division_id)->first();
                        @endphp
                        {{$division->division_name}}
                    </td>
                    <td>
                        @php
                        $user_name = DB::table('users')->where('id','=',$item->maker_user_id)->first();
                        @endphp
                        {{$user_name->name}}
                    </td>
                    <td>
                        @php
                            $checker_id=$item->checker_user_id;
                            if($checker_id!="")
                            {
                                $checker_user_name = DB::table('users')->where('id','=',$item->checker_user_id)->first();
                                echo $checker_user_name->name;
                            }
                            
                        @endphp
                        
                    </td>
                    <td>
                        @if ($item->status == '0')
                            <div class="mb-2 mr-2 badge badge-warning">Initiated</div>
                        @elseif($item->status == '1')
                            <div class="mb-2 mr-2 badge badge-info">Authorized</div>
                        @else
                            <div class="mb-2 mr-2 badge badge-danger">Declined</div>
                        @endif
                    </td>
                    <td>{{ $item->entry_date }}</td>
                    <td>{{$item->autho_date}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>

                <th>Sl</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Branch Code</th>
                <th>Branch Name</th>
                <th>Division Name</th>
                <th>Branch Maker/Ho Maker</th>
                <th>Branch Checker/HO Checker</th>
                <th>Unlock Request Date & Time</th>
                <th>Authorization Date & Time</th>
            </tr>
        </tfoot>

    </table>
@endsection


@push('scripts')
    <script src="{{ asset('assets/js/jquery_for_report.js') }} "></script>
    <script src="{{ asset('assets/js/data_table_button.js') }} "></script>
    <script src="{{ asset('assets/js/jzip.js') }} "></script>
    <script src="{{ asset('assets/js/pdf_make.js') }} "></script>
    <script src="{{ asset('assets/js/vfs.js') }} "></script>
    <script src="{{ asset('assets/js/print.js') }} "></script>
    <script src="{{ asset('assets/js/html_button.js') }} "></script>

    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "scrollX": true,

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
