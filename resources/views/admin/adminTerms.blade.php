@extends('layouts.admin_dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <form method="post" action="{{url('/admin/aboutSave')}}">
                    {{csrf_field()}}

                    <div class="panel-heading">Description</div>
                    <div class="panel-body">
                        <textarea name="cbt" id="description">{{$content}}</textarea>

                        <input type="hidden" name="cms" value="terms">

                        <button type="submit" class="mt-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<script src="{{ asset('public/js/editor.js') }}"></script>

@endsection



 