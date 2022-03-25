@extends('layouts.full_dashboard')
@section('content')
<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
	<ul class="nav-inner">
		<li><a href="/user/dashboard">Home</a></li>
		<li class="active"><a href="/user/mailbox">Mailbox</a></li>
	</ul>
	<div class="row" id="mailbox_page">
		<div class="col-md-9 account-section">
			<div class="">
				<div class="col-md-12">
					<div class="min-content-box message_page_box">
						<h3 style="padding-bottom:25px" >Messages</h3>
						<ul class="tab-menu">
							<li class="active inbox"><a href="javascript:void(0);">Inbox</a></li>	
							<li class="sent"><a href="javascript:void(0);">Sent</a></li>

							@if(Auth::check())

								@if($payments)
									<li class="last_li pull-right"><button class="tpad20 btn custom-btn" href="#" data-toggle="modal" data-target="#my_message">Compose a Message</button></li>
								@else
								 	<li class="last_li pull-right"><a class="tpad20 btn custom-btn return_url_btn" href="{{ url('/') }}/join-today/{{ Auth::user()->id }}" returnurl = "{{ url('/user/mailbox') }}">Compose a Message</a>
								@endif

							@endif
								
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9 account-section">
			<div class="row">
				<div class="col-md-12">
					<form action="{{ url('/user/delete-chat') }}" method="post" id="sign-form" class="" enctype="multipart/form-data">
						@csrf
						<div class="profile-box profile-box-1">				
							<div class="table-responsive" id="inbox">
								<table class="table table-hover" id="allMails">
									<thead>
										<tr>
											<th class="text-center">&nbsp;</th>
											<th>&nbsp;</th>
											<th style="padding: 10px!important;">Subject</th>
											<th style="padding: 10px!important;">Message</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										@foreach($allMails as $msg)
											{{-- @if($msg[0]->to == Auth::id()) --}}
											<tr class="inbox">
												<td class=""><input class="checkboxall" type="checkbox" name="delmail[]" id="delp[]" value="{{ $msg->id }}"></td> 
												<td class="">
													<a href="{{ url('/user/chat/').'/'.$msg->mid }}" hcref="#" style="color:#0071e0">
														@if($msg->send_user->name) {{ $msg->send_user->name }} @else {{ $msg->send_user->email }} @endif
													</a>
												</td> 
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" style="color:#47525d">{{ $msg->subject }}</td> 
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" style="color:#47525d">{{ $msg->message}}</td>  
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" style="color:#47525d">{{ Carbon\Carbon::parse($msg->created_at)->format('d-m-Y') }}</a></td>
											</tr>
											@endforeach
											@foreach($allMails2 as $msg)
											{{-- @else	 --}}
											<tr class="sent" style="display: none;">
												<td class=""><input class="checkboxall" type="checkbox" name="delmail[]" id="delp[]" value="{{ $msg->id }}"></td> 
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" hcref="#" style="color:#0071e0">@if($msg->rec_user->name) {{ $msg->rec_user->name }} @else {{ $msg->rec_user->email }} @endif</a></td> 
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" style="color:#47525d">{{ $msg->subject }}</td> 
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" style="color:#47525d">{{ $msg->message }}</td>  
												<td class=""><a href="{{ url('/user/chat/').'/'.$msg->mid }}" style="color:#47525d">{{ Carbon\Carbon::parse($msg->created_at)->format('d-m-Y') }}</a></td>
											</tr>
											{{-- @endif --}}

										@endforeach
										<tr class="submit_tr">
											<td colspan="5" class="5 text-right">
												<button id="checkAll" class="custom-btn"> Select All</button>
												<button type="submit" class="custom-btn btn-danger">Delete</button>
											</td>        	
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>

</div>

<div class="modal fade" id="my_message" role="dialog">
	<div class="modal-dialog">    
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Write a Message</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('/user/send-message') }}" method="post" id="send-message-form" class="form-box" enctype="multipart/form-data">
					@csrf
					<div class="profile-box profile-box-1">				

						<div class="row">
							<div class="col-sm-3"><label>To:</label></div>
							<div class="col-sm-8">
								<input type="hidden" name="to" id="to">
								<input type="text" name="name" id="search-box33" autocomplete="off">
								<div id="suggesstion-box"></div>
								<span class="red-span-error" id="to_error"></span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3"><label>Subject:</label></div>
							<div class="col-sm-8">
								<input type="text" name="subject" id="subject">
								<span class="red-span-error" id="subject_error"></span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3"><label>Message:</label></div>
							<div class="col-sm-8">
								<textarea name="message" id="msg" placeholder="Type Your Message" style="margin-bottom:0;"></textarea>
								<span class="red-span-error" id="msg_error"></span>
							</div>
						</div>				

					</div>

					<div class="title-box">&nbsp;</div>

					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="actg214" value="go21">
							<input class="btn custom-btn acc-submit" type="submit" value="Submit" id="send-message">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@endsection
