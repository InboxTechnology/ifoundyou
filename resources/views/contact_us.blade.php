@extends('layouts.app')

@section('content')
<style>
  span{
    color:red;
  }
  .form-control
  {
    width:36%;
  }
</style>
<div class="container">
  <form action="{{url('/sendcontactmail')}}" method="POST">
  @csrf
  <div class="form-group">
      <label for="nam">Country's Name:</label>
      <input type="text" class="form-control" id="name" value="{{ $country_name }}" placeholder="Country's name" name="name" readonly="true">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" maxlength="30" class="form-control" id="email" placeholder="Enter email" name="email">
      <span id="error_email"></span>
    </div>
    <div class="form-group">
      <label for="sub">Subject:</label>
      <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
      <span id="error_subject"></span>
    </div>
    <div class="form-group">
      <label for="mess">Message:</label>
      <textarea class="form-control" rows="5" placeholder="Message" id="message" name="message"></textarea>
      <span id="error_message"></span>
    </div>
    
    <button type="submit" id="submit_contact" class="btn btn-primary">Contact Us</button>
  </form>
</div>

</body>
</html>

@endsection   
  
        
        
         
         
      
    