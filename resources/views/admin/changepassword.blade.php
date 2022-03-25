@extends('layouts.admin_dashboard')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Change Password</div>
        <div class="panel-body">
          <form method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="pwd"> &nbspNew Password:</label>
              <input type="password" class="form-control" id="password" placeholder="New Password" name="password">
                 @if( count($errors) > 0 )
                    <div style="color:red">
                      @foreach ($errors->all() as $error)
                        {{ $error }}
                      @endforeach
                    </div>
                @endif
            </div>

            <div class="form-group">
              <label for="pwd"> &nbspConfirm Password:</label>
              <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>&nbsp&nbsp
            <a href="/admin/dashboard" class="btn btn-default">Close</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection