<center>
    <div class="get_category "  >


        {{-- grades  --}}
        @foreach ($grades as $grade)
            <button class="btn btn-info" wire:click="pass_Classes({{$grade->id}})" style="display: {{ $grade_id != '' ? 'none' : '' }} ; margin-top: 5px"  >{{ $grade->name }}</button>
        @endforeach
        {{-- classes  --}}
        @foreach ($classes as $class)
            <button class="btn btn-info" wire:click="pass_Sections({{$class->id}})" style="display: {{ $class_id != '' ? 'none' : '' }} ; margin-top: 5px">{{ $class->name }}</button>
        @endforeach
        {{-- sections  --}}
        @foreach ($sections as $section)
            <button class="btn btn-info" wire:click="pass_subjects({{$section->id}})" style="  display: {{ $section_id != '' ? 'none' : '' }} ; margin-top: 5px">{{ $section->name }}</button>
        @endforeach
        {{-- subjects  --}}
        @foreach ($subjects as $subject)
            <button class="btn btn-info" wire:click="pass_unite({{$subject->id}})" style="display: {{ $subject_id != '' ? 'none' : '' }} ; margin-top: 5px"  >{{ $subject->name }}</button>
        @endforeach

        {{-- unites --}}
        @if (!empty($unites))
            <button class="btn btn-success-gradient" wire:click="pass_unite_id('all')"  style=" display: {{ $unite_id != '' ? 'none' : '' }} ; margin-top: 5px"  >{{ trans('exams_trans.all_unites') }}</button>
        @endif
        @foreach ($unites as $unite)
            <button class="btn btn-info" wire:click="pass_unite_id({{$unite->id}})" style=" display: {{ $unite_id != '' ? 'none' : '' }} ;  margin-top: 5px"  >{{ $unite->name }}</button>
        @endforeach

    </div>
</center>

