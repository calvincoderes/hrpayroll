<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="{{ asset(url('img/logo.jpg')) }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ ucfirst(\Auth::user()->firstname) }} {{ ucfirst(\Auth::user()->lastname) }}
					</div>
					<div class="profile-usertitle-job">
						ADMIN
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
				
					<a href="{{ url('/home') }}" type="button" class="btn btn-success btn-sm"><i class="fa fa-user"></i> My Account</a>
				
					<a href="{{ url('/logout') }}" type="button" class="btn btn-danger btn-sm prevent" ><i class="fa fa-sign-out"></i> Logout</a>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="{{ url('/home') }}">
								<i class="fa fa-home"></i>
								Dashboard
							</a>
						</li>
						<li>
							<a href="{{ url('products') }}">
								<i class="fa fa-users"></i>
								Patients Record
							</a>
						</li>
						<li>
							<a href="{{ url('categories') }}" target="_blank">
								<i class="fa fa-plus-square"></i>
								Drug Records
							</a>
						</li>
						<li>
							<a href="{{ url('vendors') }}">
								<i class="fa fa-gear"></i>
								Settings
							</a>
						</li>
            <li>
							<a href="{{ url('draft') }}">
								<i class="fa fa-gear"></i>
								Drafts
							</a>
						</li>
						<li>
							<a href="{{ url('sizes') }}">
							<i class="fa fa-bar-chart"></i>
							Reports </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9 crud-content">
            <div class="profile-content">
            	<h1><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i></h1>
            </div>
		</div>
	</div>
</div>
