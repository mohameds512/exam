<style>
    .prof_avt{
        width:225px ;
        height: 225px;
        border: 0.5px solid #558fec;
        border-radius: 1px
    }
</style>
<div>
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="form-group">
                        @if ($mode_edit_avt == true)
                        <form wire:submit.prevent="update_avt" enctype="multipart/form-data">
                            <div wire:ignore>
                                <input type="file" accept="image/*" wire:model= "avt_prof"  class="dropify" name="img" data-default-file="{{$user->img_path}}" data-height="225" data-width="225"  >
                            </div>
                            @error('avt_prof') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            <div class="row">
                                <button style="margin: 10px" class="btn btn-sm btn-success" type="submit" > {{ trans('users_trans.update') }} </button>
                                <button style="margin: 10px" class="btn btn-sm btn-danger" wire:click= "cancel_edit_avt"> {{ trans('users_trans.cancel') }} </button>
                            </div>
                        </form>
                        @else
                            <div style="display: {{$user->id == Auth::user()->id ? '' : 'none'}}">
                                <label for="img"> <button class="btn btn-sm btn-secondary" wire:click="edit_avt"> {{ trans('users_trans.edit_avt') }}</button></label>
                            </div>
                            <div >
                                <img alt="user-img" class="prof_avt" src="{{$user->img_path}}">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <div class="row">
                            @if ($mode_edit_name == true)
                                <div >
                                    <input class="form-control" type="text" wire:model.defer= "user_name">
                                </div>
                                {{-- <div wire:loading wire:target="user_name">Uploading...</div> --}}
                                @error('user_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="row">
                                    <button style="margin: 10px" class="btn btn-sm btn-success" wire:click="update_name" > {{ trans('users_trans.save') }} </button>
                                    <button style="margin: 10px" class="btn btn-sm btn-primary" wire:click="cancel_update_name" > {{ trans('users_trans.cancel') }} </button>
                                </div>
                            @else
                                <h4 class="tx-15 text-uppercase mb-3">{{$user->name}}
                                    @if (Auth::user()->id == $user->id)
                                        <button class="btn btn-lg" title="{{ trans('users_trans.edit_bio') }}" wire:click= 'edit_name' > <i class="bx bx-cog" style="color: #558fec" ></i> </button>
                                    @endif
                                    </h4>
                            @endif
                        </div>
                        <div class="row">
                            @if ($mode_edit_email == true )
                                <div>
                                    <input class="form-control" type="email" wire:model.defer= "user_email">
                                </div>
                                @error('user_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="row">
                                    <button style="margin: 10px" class="btn btn-sm btn-success" wire:click="update_email" > {{ trans('users_trans.save') }} </button>
                                    <button style="margin: 10px" class="btn btn-sm btn-primary" wire:click="cancel_update_email" > {{ trans('users_trans.cancel') }} </button>
                                </div>
                            @else
                                <h4 class="tx-15 text-uppercase mb-3">{{$user->email}}
                                    @if (Auth::user()->id == $user->id)
                                    <button class="btn btn-lg" title="{{ trans('users_trans.edit_email') }}" wire:click= 'edit_email' > <i class="bx bx-cog" style="color: #558fec" ></i> </button>
                                    @endif
                                </h4>
                            @endif
                        </div>
                        <div class="row">
                            @if ($mode_edit_phone == true )
                                <div>
                                    <input class="form-control" type="email" wire:model.defer= "user_phone">
                                </div>
                                @error('user_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="row">
                                    <button style="margin: 10px" class="btn btn-sm btn-success" wire:click="update_phone" > {{ trans('users_trans.save') }} </button>
                                    <button style="margin: 10px" class="btn btn-sm btn-primary" wire:click="cancel_update_phone" > {{ trans('users_trans.cancel') }} </button>
                                </div>
                            @else
                                <h4 class="tx-15 text-uppercase mb-3">{{$user->phoneNumber}}
                                    @if (Auth::user()->id == $user->id)
                                    <button class="btn btn-lg" title="{{ trans('users_trans.edit_phone') }}" wire:click= 'edit_phone' > <i class="bx bx-cog" style="color: #558fec" ></i> </button>
                                    @endif
                                </h4>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <h4 class="tx-15 text-uppercase mb-3">{{ trans('users_trans.about_me') }}
                        @if (Auth::user()->id == $user->id)
                            <button class="btn btn-lg" title="{{ trans('users_trans.edit_bio') }}" wire:click= 'edit_bio' > <i class="bx bx-cog" style="color: #558fec" ></i> </button>
                        @endif
                        </h4>
                    @if ($mode_edit_bio == true)
                        <div >
                            <input class="input_bio" type="text" wire:model.defer= "user_bio">
                        </div>
                        <div class="row">
                            <button style="margin: 10px" class="btn btn-sm btn-success" wire:click="update_bio" > {{ trans('users_trans.save') }} </button>
                            <button style="margin: 10px" class="btn btn-sm btn-primary" wire:click="cancel_update_bio" > {{ trans('users_trans.cancel') }} </button>
                        </div>
                    @else
                        <p class="m-b-5">{{$user_bio}}</p>
                    @endif
                </div>
            </div>

            </div>
        </div>
    </div>


    <hr>

    <div>
    @if ($user->hasPermission('teacher_prof'))
        @include('livewire.users.teacherProf')
    @endif
    @if ($user->hasPermission('stud_prof'))
        @include('livewire.users.studProf')
    @endif

    </div>



</div>
