<div class="container-fluid">
    <div class="row profile">
		<div class="col-md-3 nopadding">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					{{--  --}}
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="company-logo">
					<img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="Responsive image" style="height: 130px">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						John Doe
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
							<a href="{{ url('employee-management') }}">
								<i class="fa fa-users"></i>
								Employee Management
							</a>
						</li>
						<li>
							<a href="{{ url('shift-management') }}" target="_blank">
								<i class="fa fa-plus-square"></i>
								Shift Management
							</a>
						</li>
						<li>
							<a href="{{ url('company-management') }}">
								<i class="fa fa-gear"></i>
								Company Management
							</a>
						</li>
            <li>
							<a href="{{ url('holiday-management') }}">
								<i class="fa fa-calendar"></i>
								Holidays Management
							</a>
						</li>
						<li>
							<a href="{{ url('timekeeping') }}">
							<i class="fa fa-clock-o"></i>
							Time-Keeping </a>
						</li>
						<li>
							<a href="{{ url('reports') }}">
							<i class="fa fa-bar-chart"></i>
							Reports </a>
						</li>
						<li>
							<a href="{{ url('reports') }}">
							<i class="fa fa-bar-chart"></i>
							Reports </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9 top-bar">
				<h4 class="text-right">Hello Admin</h4>
		</div>
		<div class="col-md-9 crud-content">
				<div class="profile-content">
					<h1><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i></h1>
				</div>
		</div>
	</div>
</div>
