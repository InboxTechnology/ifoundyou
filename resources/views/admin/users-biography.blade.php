@extends('layouts.admin_dashboard')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<style>
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
</style>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User Biography List</div>

                <div class="panel-body">
                	<table id="table_id" class="table table-bordered tbls datatable">
                		<thead>
                			<tr>
                				<th width="30%">Email</th>
                                <th width="60%">Biography</th>
                				<th width="10%">Status</th>
                			</tr>
                		</thead>

                		<tbody>
                			@foreach($usersBiography as $userBiography)
                    			<tr>
                    				<td>{{ $userBiography->email }}</td>
                                    <td>{{ $userBiography->biography }}</td>
                                    <td data-userId="{{ $userBiography->id }}">
                                        <input type="checkbox" @if($userBiography->biography_status == 'Approve') checked @endif value="@if($userBiography->biography_status == 'Approve') 1 @else 0 @endif" data-toggle="toggle" data-onstyle="success" data-on="Approve" data-off="Unapproved" data-offstyle="danger">
                                    </td>
                    			</tr>
                			@endforeach
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
<script type="text/javascript">
jQuery(document).ready(function($) {
	jQuery('.toggle-group label, .toggle-group span').click(function(event) {
		if(jQuery(this).parent().parent().attr('class').search('btn-danger') > 0) {
			var value = 0;
			jQuery(this).parent().prev().val(0);
		} else {
			var value = 1;
			jQuery(this).parent().prev().val(1);
		}

		var token = jQuery('#_token').val();
		var userId = jQuery(this).parent().parent().parent().attr('data-userId');

		jQuery.ajax({
			url: "{{ url('/admin/change-biography-status') }}",
			type: 'POST',
			data: 'biography_status='+value+'&_token='+token+'&userId='+userId,
			success: function(data) {
				console.log('data', data);
			}
		});
	});

    $('#table_id').DataTable();
});
</script>

@endsection