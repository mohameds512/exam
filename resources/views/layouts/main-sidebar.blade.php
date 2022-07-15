<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
                    @if (Auth::check())
                        <div class="dropdown user-pro-body">
                            <div class="">
                                <img alt="user-img" class="avatar avatar-xl brround" src="{{Auth::user()->img_path}}">
                                <span class="avatar-status profile-status bg-green"></span>
                            </div>
                            <div class="user-info">
                                <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
                                <span class="mb-0 text-muted">{{Auth::user()->role_name}}</span>
                            </div>
                        </div>
                    @endif

				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">{{ trans('main_trans.main') }}</li>
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
                                <path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">{{ trans('main_trans.dashboard') }}</span></a>
					</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fas fa-theater-masks "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.roles') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('per_roles') }}">{{ trans('main_trans.roles_and_permissions') }}</a></li>
						</ul>
					</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fas fa-users "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.users') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('users.index') }}">{{ trans('main_trans.users_list') }}</a></li>
							<li><a class="slide-item" href="{{ route('users.show', 'admin') }}">{{ trans('users_trans.admins') }}</a></li>
							<li><a class="slide-item" href="{{ route('users.show' , 'teacher') }}">{{ trans('users_trans.teachers') }}</a></li>
							<li><a class="slide-item" href="{{ route('users.show' , 'student') }}">{{ trans('users_trans.students') }}</a></li>
						</ul>
					</li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fas fa-school "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.grade_school') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('grades.index') }}">{{ trans('main_trans.grades_list') }}</a></li>
						</ul>
					</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-building "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.classes') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('classes.index') }}">{{ trans('main_trans.classes_list') }}</a></li>
						</ul>
					</li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-chalkboard "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.sections') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('sections.index') }}">{{ trans('main_trans.sections_list') }}</a></li>
						</ul>
					</li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-calendar-alt "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.subjects') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('subjects.index') }}">{{ trans('main_trans.subjects_list') }}</a></li>
						</ul>
					</li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fas fa-shapes "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.unites') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('unites.index') }}">{{ trans('main_trans.unites_list') }}</a></li>
						</ul>
					</li>
                    {{-- ss  --}}
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-calendar-alt "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.specialist') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('specialists.index') }}">{{ trans('main_trans.specialist_list') }}</a></li>
						</ul>
					</li>
                    {{-- ff  --}}
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-chalkboard-teacher "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.teachers') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('teachers.index') }}">{{ trans('main_trans.teachers_list') }}</a></li>
						</ul>
					</li>

                    {{-- dd --}}
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-book-open "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.exams') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('exams.index') }}">{{ trans('main_trans.exams_list') }}</a></li>
						</ul>
					</li>
                    {{-- aa --}}
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"> <i class="side-menu__icon fa fa-question-circle "  ></i>
                            <span class="side-menu__label" style="margin-top: 15px">{{ trans('main_trans.questions') }}</span><i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('questions.index') }}">{{ trans('main_trans.questions_list') }}</a></li>
							<li><a class="slide-item" href="get_trashed/{trashed}">{{ trans('questions_trans.trashed_questions_list') }}</a></li>
						</ul>
					</li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
