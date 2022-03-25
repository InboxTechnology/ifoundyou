@extends('layouts.admin_dashboard')



@section('content')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <style>

        .container {
            height: 600px !important;
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
            vertical-align:unset;
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

        .head  ,h3{
                padding: 10px 15px !important;
                /*border-bottom: 1px solid #bfccda;
                font-size: 21px;
                padding-bottom: 10px;
                margin-bottom: 15px;
                line-height: 30px;
                color: #47525d;
                font-weight: 600;*/
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading head">Match List</div>
                        <?php //echo '<pre>'; print_r($users); ?>
                        @if(!empty($matchdetail)) <h3>Match List</h3> @else <h3>No Match Found</h3> @endif
                    <div class="panel-body">
                    	<table id="match_id" class="table table-bordered tbls datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="text-align:center">Email</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($matchdetail))
                                    @foreach($matchdetail as $key=> $user)
                                        <tr>
                                            <td><div>{{ $user['name'] }}</div> </td>
                                            <td><div>{{ $user['email'] }}</div></td>
                                            <td style="text-align:center"><a style="color:#dd0000" href="{{ url('/admin/view-matchprofile').'/'.$user['id'] }}">View</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    	<div class="col-md-12 text-center">
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ csrf_token() }}" id="_token">
    <script>
      $(document).ready(function() {
        $('#match_id').DataTable();
    } );
    </script>
@endsection