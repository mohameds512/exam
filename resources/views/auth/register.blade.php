<head>
    <title>{{ config('app.name', '3mexam') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


    <!-- Styles -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/edit_style.css')}}" >

    <style>

    </style>
</head>
<body class="font-sans antialiased">
    <div class=" reg_cont center">

        <div class=" glass_shape register_div center">
            <div class="reg_logo">
                <img src="{{URL::asset('assets/img/logo/logo1.PNG')}}" alt="{{ trans('main_trans.logo') }}">
            </div>
            @if ($errors->any())
                <div class="reg_errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal"  method="POST" action="{{ route('register') }}" style="direction: rtl">
                {{csrf_field()}}
                {{method_field('post')}}
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text"  class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="{{ trans('users_trans.name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12  ">
                            <div class="form-group">
                                <input type="email"  class="form-control" id="email" name="email" value="{{old('email')}}"  placeholder="{{ trans('users_trans.email') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="password"  class="form-control" id="password" name="password" placeholder="{{ trans('users_trans.password') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12  ">
                            <div class="form-group">
                                <input type="password"  class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('users_trans.confirmed_password') }}">
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" id="phoneNumber" name="phoneNumber" value="{{old('phoneNumber')}}"  placeholder="{{ trans('users_trans.phone_number') }}">
                        </div>

                        <div  class="main-content-label mg-b-5"   >
                            <p> {{ trans('users_trans.user_role') }} : </p>
                        </div>
                        <div class="row " id="role" >
                            <div class="col">
                                <label class="rdiobox"><input  name="role" value="3" type="radio"> <span>{{ trans('register_trans.teacher') }}</span></label>
                            </div>
                            <div class="col" >
                                <label class="rdiobox" ><input  name="role" value="4" type="radio"> <span>{{ trans('register_trans.student') }}</span></label>
                            </div>
                        </div>

                        <div class="row center">
                            <a class="btn btn-sm  btn-outline-primary" href = "{{ url('redirectSocial/facebook') }}">
                            {{ trans('register_trans.FB_register') }}
                            </a>
                        </div>

                <div class="form-group mb-0 mt-3  center">
                    <div class="flex items-center justify-end mt-4" >
                        <button type="submit" class="btn btn-sm btn-info" style="margin-left: 20px">
                            {{ trans('register_trans.register') }}
                        </button >

                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ trans('register_trans.already_registered?') }}
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>
<footer>

</footer>
