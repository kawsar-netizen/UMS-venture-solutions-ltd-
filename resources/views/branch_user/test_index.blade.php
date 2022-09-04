@extends('layouts.app')


@section('css')

<style type="text/css">
    label{
            margin-left: 20px;
                font-size: 15px;
    }

    .form-group {
    margin-bottom: 0.5rem !important;
}

</style>
 @endsection

<div class="container">
    <table>
        <thead>
            <tr>
                
                <th>Value</th>
            </tr>
        </thead>

        <tbody>
            @foreach(explode('=', $input) as $info)
            @if(!empty($info[1]))
            <tr>
                
                <td>{{$info['0']}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
</div>



@section('content')




@endsection


@push('scripts')


@endpush
