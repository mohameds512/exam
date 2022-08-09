<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

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
            {{-- @if ($status)
                <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
                    {{ $status }}
                </div>
            @endif
            @if ($errors->any())
                <div {{ $attributes }}>
                    <div class="font-medium text-red-600">
                        {{ __('Whoops! Something went wrong.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            @if ($errors->any())
                <div class="reg_errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal"  method="POST" action="{{ route('login') }}" style="direction: rtl">
                {{csrf_field()}}
                {{method_field('post')}}

                    <div class="form-group">
                        <input type="email"  class="form-control" id="email" name="email" value="{{old('email')}}"  placeholder="{{ trans('users_trans.email') }}">
                    </div>

                    <div class="form-group">
                        <input type="password"  class="form-control" id="password" name="password" placeholder="{{ trans('users_trans.password') }}">
                    </div>


                <div class="form-group mb-0 mt-3  center">
                    <div class="flex items-center justify-end mt-4" >
                        <button type="submit" class="btn btn-sm btn-info" style="margin-left: 20px">
                            {{ trans('register_trans.enter') }}
                        </button >

                        <a href="{{ route('register') }}"> {{ trans('register_trans.register') }} </a>

                    </div>
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ trans('main_trans.Forgot_password?') }}
                    </a>
                @endif
                    {{-- <div class="flex items-center justify-end mt-4" >
                        <a href="{{ route('register') }}"> {{ trans('register_trans.register') }} </a>
                    </div> --}}
                </div>

            </form>
        </div>
    </div>
</body>
<footer>

</footer>
