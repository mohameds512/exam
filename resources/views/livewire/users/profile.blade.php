<div>

    @if ($mode_test == true)
        @include('livewire.users.test_exam')
    @else
        @include('livewire.users.profile_data')
    @endif

</div>
