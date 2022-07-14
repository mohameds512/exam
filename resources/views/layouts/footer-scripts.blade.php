<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

<!-- JQuery min js -->
<script src="{{URL::asset('assets/plugins/jquery/jquery-3.6.0.min.js')}}"></script>

<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- toastr -->
{{-- <script src="{{ URL::asset('assets/js/toastr.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{URL::asset('assets/js/toastr.min.js')}}"></script> --}}

<script>
    window.addEventListener('toastr', event => {

        switch (event.detail.type) {
            case 'success':
                toastr.success(event.detail.message);
                break;
            case 'info':
                toastr.info(event.detail.message);
                break;
            case 'warning':
                toastr.warning(event.detail.message);
                break;
            case 'error':
                toastr.error(event.detail.message);
                break;
            default:
                toastr.info(event.detail.message);
                break;
        }
    });

</script>
{{-- time_cut_down  --}}
<script>

    window.addEventListener('time_cute_down', event => {

        var duration = event.detail.time_duration ;
        var msg_time_out = event.detail.msg_time_out ;
        var end_timer = event.detail.end_timer ;

        var hours = Math.floor(duration/ 60) ;
        var mins  = duration % 60 ;
        var seconds = 00 ;

        window.timer = setInterval(function() {
            seconds = seconds - 1 ;
            if (seconds < 0 ) {
                mins = mins - 1 ;
                seconds = 59;
            }
            if (mins < 0 ) {
                hours = hours -1 ;
                mins = 59 ;
            }
            var time = hours + ':' + mins + ':' + seconds ;
            document.getElementById("cuteDown").innerHTML= time;

            if (hours == 0) {
                if (mins == 0) {
                    if(seconds == 0){
                        clearInterval(window.timer);
                        document.getElementById("cuteDown"). innerHTML = msg_time_out ;
                    }
                }
            }

        },1000 );

    });
    // end_timer
    window.addEventListener('end_timer', event=>{
        clearInterval(window.timer);
    });


</script>
<!-- Sticky js -->
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

{{-- x-dsoft dateTimePicker --}}
<script src="{{URL::asset('assets/plugins/xdsoft_dateTimePicker/js/jquery.datetimepicker.full.min.js')}}"></script>

    <script>
        jQuery.datetimepicker.setLocale('ar');

        jQuery('#datetimepicker').datetimepicker({
            formatDate:'Y/m/d hh:ii',
            minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
            onChangeDateTime:function(dp,$input){
                // alert($input.val())
            }
        });
    </script>

{{-- dropify with prof_avt --}}
<script>
    document.addEventListener('add_dropify' , event => {
        $('.dropify').dropify();
    });
</script>
{{-- ckeditor --}}
<script src="{{ URL::asset('ckeditor_clasic/ckeditor.js') }}"></script>
<script src="{{ URL::asset('ckfinder/ckfinder.js') }}"></script>
<script>

    document.addEventListener('add_editor' , event =>  {
        CKEDITOR.replace('create_editor');
        CKEDITOR.instances.create_editor.on('blur', function () {
            let qu = $('#create_editor').data('question_name');
            let my_qu = CKEDITOR.instances.create_editor.getData();
            eval(qu).set('question_name', my_qu);
        });
    });

    document.addEventListener('reset_qu_editor',event => {
        CKEDITOR.instances.create_editor.setData('');

    });

    document.addEventListener('update_qu_name', function (data) {
        let my_data  = data.detail ;
        CKEDITOR.instances.create_editor.setData(my_data);

    });

    document.addEventListener('openEdExMod' , event => {
        $('#openeditExmodel').modal('show');
    });

    document.addEventListener('closeEdExMod' , event => {
        $('#openeditExmodel').modal('hide');
    });

    document.addEventListener('openEdPerMod' , event => {
        $('#openeditpermodel').modal('show');
    });
    document.addEventListener('closEdPerMod' , event => {
        $('#openeditpermodel').modal('hide');
    });
    document.addEventListener('openDelPerModel' , event => {
        $('#DelPermodel').modal('show');
    });
    document.addEventListener('closDelPerModel' , event => {
        $('#DelPermodel').modal('hide');
    });
    document.addEventListener('openDelRole' , event =>  {
        $("#closDelRolmodel").modal('show');
    });

    document.addEventListener('closDelRol' , event =>  {
        $("#closDelRolmodel").modal('hide');
    });

    document.addEventListener('openDeleteModel' , event =>  {
        $("#deleteModal").modal('show');
    });
    document.addEventListener('closDeleteModel' , event =>  {
        $("#deleteModal").modal('hide');
    });


</script>

    {{-- print test
        the print don't print the correct and falt answer
        so we discard it and will print student degry
        --}}
<script>
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>

{{-- show_linkes_with_social --}}
<script>
    function show_social(id) {

        document.getElementById('social-links-icons_'+id+'').style.display = 'block';

        setTimeout(function () {
            document.getElementById('social-links-icons_'+id+'').style.display = 'none';
        } , 3500);
    }
</script>
{{-- copyToClipboard --}}

<script>
    function copyToClipboard() {
        const data = document.getElementById('validation_code');
        let text = data.value ;
        text.select();
        text.setSelectionRange(0,99999);
        // dose not work with http
        navigator.clipboard.writeText(text);
        alert("Copied the text: " + data.value);
    }
</script>

    {{-- get_classes_from_grade_id --}}
<script>
    $(document).ready(function(){
        $('select[name = "Grade_id"]').on('change', function(){
            var $grade_id =$(this).val();
            if ($grade_id) {
                $.ajax({
                    url : "{{URL::to('get_classes')}}/"+$grade_id,
                    type : "GET",
                    dataType : "json",
                    success : function (data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append('<option selected disabled >{{ trans('sections_trans.select_class') }}</option>')
                        $.each(data , function (key , value) {
                            $('select[name="class_id"]').append('<option value= "'+ key +'" > ' +value+ ' </option>')
                        })
                    }
                });
            }
        });
    });
</script>

    {{-- get_sections_from_class_id --}}
<script>
    $(document).ready(function(){
        $('select[name = "class_id"]').on('change', function(){
            var $class_id =$(this).val();
            if ($class_id) {
                $.ajax({
                    url : "{{URL::to('get_sections')}}/"+$class_id,
                    type : "GET",
                    dataType : "json",
                    success : function (data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled >{{ trans('subjects_trans.select_section') }}</option>')
                        $.each(data , function (key , value) {
                            $('select[name="section_id"]').append('<option value= "'+ key +'" > ' +value+ ' </option>')
                        })
                    }
                });
            }
        });
    });
</script>


{{-- get_subjects_from_section_id --}}
<script>
    $(document).ready(function(){
        $('select[name = "section_id"]').on('change', function(){
            var $section_id =$(this).val();
            if ($section_id) {
                $.ajax({
                    url : "{{URL::to('get_subjects')}}/"+$section_id,
                    type : "GET",
                    dataType : "json",
                    success : function (data) {
                        $('select[name="subject_id"]').empty();
                        $('select[name="subject_id"]').append('<option selected disabled >{{ trans('questions_trans.select_subject') }}</option>')
                        $.each(data , function (key , value) {
                            $('select[name="subject_id"]').append('<option value= "'+ key +'" > ' +value+ ' </option>')
                        })
                    }
                });
            }
        });
    });

</script>

{{-- get_unites_from_subject_id --}}
<script>
    $(document).ready(function(){
        $('select[name = "subject_id"]').on('change', function(){
            var $subject_id =$(this).val();
            if ($subject_id) {
                $.ajax({
                    url : "{{URL::to('get_unites')}}/"+$subject_id,
                    type : "GET",
                    dataType : "json",
                    success : function (data) {
                        $('select[name="unite_id"]').empty();
                        $('select[name="unite_id"]').append('<option selected disabled >{{ trans('questions_trans.select_unite') }}</option>')
                        $.each(data , function (key , value) {
                            $('select[name="unite_id"]').append('<option value= "'+ key +'" > ' +value+ ' </option>')
                        })
                    }
                });
            }
        });
    });

</script>


{{-- select_all  --}}
<script>
    function checkAll(class_name , elem){
        var elements = document.getElementsByClassName(class_name);
        var len =elements.length;

        if (elem.checked) {
            for (var i = 0; i < len; i++) {

                elements[i].checked = true;
            }
        } else {

            for (var i = 0; i < len; i++) {

                elements[i].checked = false;

            }
        }
    }
</script>

{{-- active_delete_all_rows --}}
<script>
    $(function(){
        $("#btn_delete_all").click(function () {
            var selected =new Array();
            $(".select_all_data input[type=checkbox]:checked").each(function(){
                selected.push(this.value);
            });

            if (selected.length > 0 ) {
                $("#delete_all").modal('show');
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>

{{-- active_restore_all_rows --}}
<script>
    $(function(){
        $("#btn_restore_all").click(function () {
            var selected =new Array();
            $(".select_all_data input[type=checkbox]:checked").each(function(){
                selected.push(this.value);
            });

            if (selected.length > 0 ) {
                $("#restore_all").modal('show');
                $('input[id="restore_all_id"]').val(selected);
            }
        });
    });
</script>

{{-- exam_show_hide_exam_date --}}
<script>

    // $(document).ready(function check_exam_date(val) {
    //     var item = document.getElementById('get_exam_date');
    //     if (val == 1) {
    //         item.append(<label for="date">{{ trans('exams_trans.exam_date') }} :</label>);
    //     }
    // }
    // function check_exam_date(x) {
    //     var item = document.getElementById('get_exam_date');
    //     if (x == 0) {
            // item.appendChild(<label for="date">{{ trans('exams_trans.exam_date') }} :</label>);
    //     }
    //     console.log('fff');
    // }

</script>
