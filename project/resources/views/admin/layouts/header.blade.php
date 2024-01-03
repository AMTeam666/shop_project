<header class="header-main">
    <section class="sidebar-header bg-gray">
        <section class="d-flex justify-content-between flex-md-row-reverse px-2">

            <span id="sidebar-toggle-show"  class="d-inline d-md-none pointer"><i class="fas fa-toggle-off"></i></span>
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer"><i class="fas fa-toggle-on"></i></span>
            <span><img class="logo " src="{{ asset('admin-assets/images/logo.png') }}" alt=""></span>
            <span id="menu-toggle" class="d-md-none"><i class="fas fa-ellipsis-h"></i></span>

        </section>
    </section>
    <section id="body-header" class="body-header">
        <section class="d-flex justify-content-between">
            <section>
					<span class="mr-5">
						<span id="search-area" class="search-area  d-none">
							<i id="search-area-hide" class="fas fa-times pointer"></i>
							<input id="search-input" type="text" class="search-input" style="height: 26.59px">
							<i class="fas fa-search pointer"></i>
						</span>
						<i id="search-toggle" class="fas fa-search p-1 d-none d-md-inline pointer"></i>
					</span>


            </section>

            <section>
				 <span class="ml-2 ml-md-4 position-relative">
					 <span id="header-notification-toggle" class="pointer">
					 <i class="far fa-bell"></i><sup class="badge badge-dark">@if(!$unseenUsers->count() == 0){{ $unseenUsers->count() }}  @endif</sup>
					 </span>
					 <section id="header-notification" class="header-notification rounded">
						 <section class="d-flex justify-content-between">
							<span class="px-2">درخواست فروشنده</span>
							 <span class="px-2">
								 <span class="badge badge-dark">جدید</span>
							 </span>
						 </section>

						 <ul class="list-group rounded px-0">
							@foreach($unseenUsers as $unseenUser)
							@php
							
							$time =((new \Carbon\Carbon($unseenUser->created_at))->timestamp)
		
							@endphp
							<li class="list-group-item list-group-item-action">
								<section class="media">
									<img class="notification-img" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar">
									<section class="media-body pr-1">
										<h5 class="notification-user">{{ $unseenUser->first_name . ' ' . $unseenUser->last_name }}</h5>
										<p class="notification-text">{{ $unseenUser->email }}</p>
										<p class="notification-time">{{ timeAgo($time) }}  قبل</p>
									</section>
								</section>
							</li>
							@endforeach
						 </ul>
					 </section>
				 </span>
                <span class="ml-2 ml-md-4 position-relative">
					<span id="header-comment-toggle" class="pointer">
						<i class="far fa-comment"></i><sup class="badge badge-dark">@if(!$unseenComments->count() == 0){{ $unseenComments->count() }}  @endif</sup>
					</span>

					<section id="header-comment" class="header-comment">
						<section class="border-bottom px-4">
							<input type="text" class="form-control form-control-sm my-4" placeholder="جستجو ...">
						</section>

						<section class="header-comment-wrapper">
							<ul class="list-group rounded px-0">
								@foreach($unseenComments as $unseenComments)
								@php
								
								$time =((new \Carbon\Carbon($unseenComments->created_at))->timestamp)
			
								@endphp
								<li class="list-group-item list-group-item-action">
									<section class="media">
										<img class="notification-img" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar">
										<section class="media-body pr-1">
											<h5 class="notification-user">{{ $unseenComments->user->first_name . ' ' . $unseenComments->user->last_name }}</h5>
											<p class="notification-text">{!! Str::limit($unseenComments->body, 10) !!}</p>
											<p class="notification-time">{{ timeAgo($time) }}  قبل</p>
										</section>
									</section>
								</li>
								@endforeach
							</ul>
						</section>
					</section>

				</span>
                <span class="ml-3 ml-md-5 position-relative">
					<span id="header-profile-toggle" class="pointer">
						<img  class="header-avatar" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar">
						<span class="header-username">{{ auth()->user()->first_name. ' '. auth()->user()->last_name }}</span>
						<i class="fas fa-angle-down"></i>
					</span>

					<section id="header-profile" class="header-profile rounded">
						<section class="list-group rounded">
							<a href="#" class="list-group-item list-group-item-action header-profile-link">
								<i class="fas fa-cog"></i>تنظیمات
							</a>

							<a href="#" class="list-group-item list-group-item-action header-profile-link">
								<i class="fas fa-user"></i>کاربر
							</a>

							<a href="#" class="list-group-item list-group-item-action header-profile-link">
								<i class="fas fa-envelope"></i>پیام ها
							</a>

							<a href="#" class="list-group-item list-group-item-action header-profile-link">
								<i class="fas fa-lock"></i>قفل صفحه
							</a>

							<a href="#" class="list-group-item list-group-item-action header-profile-link">
								<i class="fas fa-sign-out-alt"></i>خروج
							</a>
						</section>
					</section>

				</span>
            </section>

        </section>
    </section>

</header>
