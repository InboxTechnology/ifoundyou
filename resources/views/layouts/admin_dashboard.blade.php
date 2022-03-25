<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IFoundYou</title>
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ii3w0iprq4sqaz4oo1x4dpnxxim152f0ui8u6cydman5of91"></script>
     <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</head>
<style>
    body
    {
        background:#B9B3A4;
    }
    .header
    {
        background:#B9B3A4;
        width:100%;
        margin:auto;
        height:50px;
    }
    .container
    {
        margin:auto;
        background:#B9B3A4;
        height:1100px;
    }
    .header-menu
    {
        background:#B9B3A4;
        width:730px;
        height:50px;
        position:relative;
        left:113px;
        float:left;
        
    }
    .mnu
    {
        background:#D4D0C7;
        height:25px;
        /*width:750px;*/
        width: 900px;
        position:relative;
        top:13px;
    }
    .mnutab
    {
        border-right:1px solid white;
        float:left;
        line-height:25px;
        color:black;
        width:150px;
        text-align:center;
        font-weight:bold;
        font-size:13px;
    }
    .mnutab a
    {
        text-decoration:none;
        color:black;
    }
    .mnutab a:hover
    {
        background:white;
        float:left;
        line-height:25px;
        width:100%;
        color:black;
        font-size:13px;       
    }

    .dropdown-content {
        display: none;
	    position: absolute;
	    background-color: #f9f9f9;
	    min-width: 220px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	    text-align: left;
    }   
    .dropdown-content a {
        color: black;
        padding: 2px 11px;
        text-decoration: none;
        display: block;
        border-bottom:1px solid white;
        background: #D4D0C7;
        font-weight:bold;
        font-size:13px;
    }
    .dropdown-content a:hover {background-color: #f1f1f1}

    .mnutab.parent {
	    position: relative;
	}
	.mnutab.parent:hover .dropdown-content {
	    top: 25px !important;
	    display: block;
	}
    .mnutab.parent:hover{
        background-color: #fff; 
    }
    .mnutab.parent a:hover{
        float: unset;
        background-color: transparent; 
    }

	.foot
    {
        background:#B9B3A4;
        height: 50px;
        width:100%;
    }
	.footr
    {
    	width:960px;
    	background:#B9B3A4;
    	margin:auto;
    	height:50px;
    }
    .footur
    {
    	background:#B9B3A4;
    	height:30px;
    	width:500px;
    	margin:auto;
    	position:relative;
    	top:10px;
    }
    .footurtab
    {
    	border-right:1px solid white;
    	line-height:30px;
    	text-align:center;
    	float:left;
    	color:black;
    }
    .footurtab a 
    {
    	text-decoration:none;
    	color:black;
    }
    @media only screen and (min-width:240px) and (max-width:1024px)
    {
        .header
        {
            width:100%;
            height:50px;
        }
        .container
        {
            width:80%;
            margin:auto;
        }
        .header-menu
        {
            background:#B9B3A4;
            width:100%;
            height:auto;
            position:relative;
            left:0px;
        }
        .mnu
        {
            background:#D4D0C7;
            width:100%;
            height:100px;
        }
        .mnutab
        {
            border-bottom:1px solid white;
            float:none;
            line-height:25px;
            width:100%;
            text-align:center;
            color:black;
            font-size:13px;
            border-right:none;

        }
        .mnutab:last-child
        {
            border-bottom:none;
        }
        .foot
    	{
        	background:#B9B3A4;
        	height: 50px;
        	width:100%;
    	}
		.footr
    	{
    		width:100%;
    		background:#B9B3A4;
    		margin:auto;
    		height:50px;
    	}
    	.footur
    	{
    		background:#B9B3A4;
    		height:30px;
    		width:100%;
    		margin:auto;
    		position:relative;
    		top:10px;
   	 	}
    	.footurtab
    	{
    		border-right:1px solid white;
    		line-height:30px;
    		text-align:center;
    		float:left;
    		color:black;
    	}
       
    }
</style>
<body>
    <div class="header">
        <div class="container">

            <div class="header-menu">
                <div class="mnu">
                    <div class="mnutab parent">
                        <a href="#">Users</a>
                        <div class="dropdown-content">
                        	<a href="{{ url('/admin/get-users') }}">View All</a>
                            <a href="{{ route('admin.usersprofileimage') }}">User Images</a>
                            <a href="{{ route('admin.biography') }}">User Biography</a>
                            <a href="{{ url('/admin/contact-members') }}">Contact Request</a>
                            <!-- <a href="{{ route('admin.usersprofilepicture') }}">User Profile Pictures</a> -->
                        </div>
                    </div>

                    <div class="mnutab"><a href="{{ url('/admin/changepassword') }}">Change Password</a></div>
                    <div class="mnutab"><a href="{{ url('/admin/paypalamount') }}">Paypal</a></div>
                    <div class="mnutab parent"><a href="#">Pages</a>
                        <div class="dropdown-content">
                            <a href="{{ url('admin/aboutus') }}">About Us</a>
                            <a href="{{ url('admin/adminTerms') }}">Terms of Service</a>
                            <a href="{{ url('admin/adminPrivacy') }}">Privacy</a>
                            <a href="{{ url('admin/adminSafety') }}">Safety</a>
                        </div>
                    </div>

                    <div class="mnutab parent">
                        <a href="#">My Match</a>
                        <div class="dropdown-content">
                            <a href="{{ url('/admin/Findmatch') }}">Find Match</a>
                        </div>
                    </div>

                    <div class="mnutab"><a href="{{ url('/admin/logout') }}">Logout</a></div>
                </div>
            </div>

            <main class="py-4">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>


