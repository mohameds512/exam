@extends('layouts.master')
@section('css')
    @livewireStyles
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="col">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.public_content') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
                <div class="card custom-card" >
                    <div class="card-body">
                        <livewire:home.home-page/>
                    </div>
                </div>

				<!-- row closed -->
@endsection
@section('js')
@livewireScripts

@toastr_js
@toastr_render
@endsection
