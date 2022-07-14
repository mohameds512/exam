<div>
    <div class="card ">
        <div class="card-body">
            {{-- <button class=" btn btn-sm btn-info" wire:click= "back" > {{ trans('users_trans.back') }} </button> --}}
            @if ($exam != null)
                    @if ($get_result)
                        @include('livewire.test.test_result')
                    @else
                        @include('livewire.test.testPage')
                    @endif
            @endif
        </div>
    </div>
</div>
