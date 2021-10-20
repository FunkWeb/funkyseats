<div class="dropdown-menu dropdown-menu-end me-1">
	<a href="javascript:;" class="dropdown-item">Edit Profile</a>
	<!-- <a href="javascript:;" class="dropdown-item"><span class="badge bg-danger float-end rounded-pill">2</span> Inbox</a>
	<a href="javascript:;" class="dropdown-item">Calendar</a>
	<a href="javascript:;" class="dropdown-item">Setting</a>-->
	<div class="dropdown-divider"></div>
	@if (Auth::check())
	<a href="/auth/logout" class="dropdown-item position-relative">Log Out</a>
	@endif
</div>
