@extends('new_app')



@section('left_button_section')



    <div name="button-import" id="button-import"> Import </div>
    <div name="button-data" id="button-data" > Data </div>
    <div name="button-list" id="button-list" >  </div>


@endsection

@section('right_form_section')
<div class="show-all-list" id="lblData">
adfadsadsfasdfadsfasdf
</div>

    @endsection




@section('custom_scripts')
    <script src="{{ asset('/js/show_list.js') }}"></script>
@endsection

@stop

