<!-- main-header opened -->
	<div class="topbar stick">
		<div class="logo">
			<a title="" href="{{ route('home') }}"><img src="{{URL::asset('assets/images/logo.png')}}" alt=""></a>
		</div>
		<div class="top-area">

			<ul class="setting-area">

				<li><a href="{{ route('home') }}" title="Home" data-ripple=""><i class="ti-home"></i></a></li>

			<li class="Notifi">
				<a href="#" title="Notification" data-ripple="">
				   <i id="reNotififf"class="ti-bell"></i>
                   <span id="notifications_count">{{ auth()->user()->unreadNotifications->count() }}</span>
				</a>
                      <div id="unread">
				<div class="dropdowns Notifications">

			        <span>{{ auth()->user()->unreadNotifications->count() }} New Notifications</span>
				    <ul class="drops-menu"id="drops-menu">
                    @foreach(auth()->user()->unreadNotifications as $notification)
 			            <li>
							<a href="{{ route('user_profile',$notification->data['user_id']) }}" title="">
							<img src="{{ asset('assets/Users_Img/' . $notification->data['user_img']) }}" alt="">
								<div class="mesg-meta">
									<h6>{{ $notification->data['user_name'] }}</h6>
										<span>{{ $notification->data['titel'] }}</span>
									<i>{{ $notification->created_at }}</i>
								</div>
							</a>
						    <span class="tag green">New</span>
						</li>
                    @endforeach
					</ul>
						<a href="{{ route('mark') }}" title="" class="more-mesg">clear all notification</a>
				</div>
                </div>
			</li>

                <li class="lang">
            	<a href="#" title="Languages" data-ripple=""><i class="fa fa-globe"></i></a>
					<div class="dropdowns languages">
						<a href="#" title=""><i class="ti-check"></i>English</a>
						<a href="#" title="">Arabic</a>
						<a href="#" title="">Dutch</a>
						<a href="" title="">French</a>
				    </div>
             </li>
			</ul>

			<div class="user-img" style="margin-right:25px">
				<img style="height:45px;width:45px" src="{{ asset('assets/Users_Img/'.Auth::user()->img)}}" alt="">
				<span class="status f-online"></span>
				<div class="user-setting">
                    <a  href="{{route('profile')}}"><i class="ti-user"></i>view profile</a>
                    <a  href="{{ route('logout') }}"onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="ti-power-off"></i>
                    {{ __('Logout') }}</a>
		            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                    </form>
				</div>
			</div>
		</div>
	</div><!-- topbar -->
<!-- /main-header -->
