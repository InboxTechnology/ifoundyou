@extends('layouts.admin_dashboard')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <style>
        .container {
            height: 532px !important;
        }
        .table-bordered a:hover
        {
            text-decoration:none;
        }
        .tbls
        {
            background-color:#eeeeee;
        }
        .table-bordered>tbody>tr>td
        {
            border: 1px solid white;
        }
        .table-bordered>thead>tr>th 
        {
            border: 2px solid white;
            background-color:#D4D0C7;
        }
        .table>tbody>tr>td
        {
            /*vertical-align:unset;*/
            vertical-align: middle;
        }
        .btn-success {
            color: #000;
            background-color: #fff;
            border-color: #fff;
        }
        .btn-success:hover {
            color:black !important;
            border-color: #fff;
            background-color: #fff;
        }
        .btn-success:active:hover
        {
            background-color:#fff;
            border-color:white;
        }
        .btn-danger.active:hover {
            color: black !important;
            background-color: #D4D0C7;
            border-color: #D4D0C7;
        }
        .btn-danger.active
        {
            background-color:#D4D0C7;
            color:black !important;  
            border-color:#D4D0C7;  
        }
        .btn-danger
        {
            color:black !important;
            background-color:#D4D0C7;
            border-color:#D4D0C7;
        }
        .btn-danger:hover
        {
            background-color:#D4D0C7;
            border-color:#D4D0C7;
        }
        .btn-danger:active:hover
        {
            background-color:#D4D0C7;
            border-color:#D4D0C7;
        }
        table.dataTable tbody td
        {
            background:#eeeeee;
        }
        table.dataTable.no-footer
        {
            border:0px;
        }

        .center-block {
            display: block;
            margin-right: unset !important;
            margin-left: unset !important;
        }
        /*img-responsive center-block user-image*/
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Match Profiles</div>
                    <div class="panel-body">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="right-userdetails">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3><?php if(!empty($matchdetail)) { echo 'About my match'; } else { echo 'No Match Found'; } ?></h3>
                                    <table id="match" class="table table-bordered tbls datatable">
                                        <thead>
                                            <tr>
                                                
                                                <th>User Profile</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($matchdetail))
                                                @foreach($matchdetail as $value)
                                                    <tr>
                                                        
                                                        <td>
                                                            <div>
                                                                @if($value['image'])
                                                                <img style="width: 60px !important; margin-left: none !important;border-radius: 48px; height: 59px!important;" src='{{ url('public/img').'/'. $value['image'] }}' class="">
                                                                @else
                                                                    <img style="width: 65px !important; margin-left: none !important;" src="{{ url('/public/img/profile-user.png')}}" class="">
                                                                @endif
                                                            @if($value['name'])<strong>{{ $value['name'] }}</strong>  @else <strong> {{$value['email']}} </strong>@endif      
                                                            </div>

                                                        </td>
                                                        <td><div><a style="color:#dd0000" href="{{ url('/admin/view-matchprofile').'/'.$value['id'] }}">View</a></div></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                    
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ csrf_token() }}" id="_token">
    <script>
      $(document).ready(function() {
        $('#match').DataTable();
    } );
    </script>
@endsection