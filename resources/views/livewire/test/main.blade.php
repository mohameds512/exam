@extends('layouts.master')
@section('css')
    @livewireStyles
    <link rel="stylesheet" href="{{URL::asset('css/edit_style.css')}}" >
    {{-- for_cards  --}}
    {{-- <link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet"> --}}
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h5 class="content-title mb-0 my-auto">
                                {{-- {{ trans('users_trans.profile') }} --}}
                            </h5>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    <livewire:test.test/>
@endsection
@section('js')
    @livewireScripts
@endsection
