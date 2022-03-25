@extends('layouts.full_dashboard')
@section('content')
<ul class="nav-inner">
	<li><a href="/user/dashboard">Home</a></li>
	<li class="active"><a href="/user/mailbox">Mailbox</a></li>
</ul>
<div class="row" id="chat-page">
	<div class="col-md-9 account-section">
		<div class="">
			<div class="col-md-12">
				<div class="min-content-box message_page_box">
					<h3 style="padding-bottom:25px" >Messages</h3>
					<ul class="tab-menu">
						<li class="active inbox"><a href="{{ url('/user/mailbox') }}">Inbox</a></li>	
						<li class="sent"><a href="{{ url('/user/mailbox') }}">Sent</a></li>
						<li class="last_li pull-right"><button class="tpad20 btn custom-btn" href="#" data-toggle="modal" data-target="#my_message">Compose a Message</button></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9 account-section">
		<div class="profile-box profile-box-1">
			<div class="mail_box_outter">

				<div class="text-center"><b>Subject : </b> {{ $msg[0]->subject }}</div>
				@foreach ($msg as $data)
					<?php $mid = $data->mid; ?>
					@if($data->from == Auth::id())
					<?php $to = $data->to; ?>
					@else
					<?php $to = $data->from; ?>
					@endif
					<div class="mail_box message_box">
						<div class="pro-img flex-item">
							<a href="viewprofile.php?ifid=94">
								@if($data->send_user->image)
								<img src="{{ url('/public/img/').'/'.$data->send_user->image }}" style="width: 70px;height: 70px; margin-right: 10px;">
								@else 
								<img src="{{ url('/public/img/profile.png') }}" style="width: 70px;height: 70px; margin-right: 10px;">
								@endif
							</a>
						</div><!-- pro-img -->
						<div class="mail-text mail-text-left flex-item">
							<div class="date pull-right">{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</div>
							<div class="text">{{-- {{ $data->subject }}<br> --}}@if($data->send_user->name) {{ $data->send_user->name }} @else {{ $data->send_user->email }} @endif said :</div>
							{{ $data->message  }}	
						</div><!-- mail-text -->
					</div>
				@endforeach


				<div class="textarea-box">
					<form method="post" action="{{ url('/user/send-chat-msg') }}" id="chat-conversation">
						@csrf
						<textarea placeholder="Message" name="message" id="chat-msg"></textarea>
						<input type="hidden" name="to" value="{{ $to }}">
						<input type="hidden" name="mid" value="{{ $mid }}">
						<div class="text-right"><input style="float:none;" class="btn custom-btn acc-submit" id="chat-send-msg" type="submit" value="Send"></div>
						<span class="red-span-error" id="chat-msg-error"></span>
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
