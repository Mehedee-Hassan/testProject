@extends('new_app')



@section('left_button_section')



    <div name="button-import" id="button-import"> Import </div>
    <div name="button-data" id="button-data" > Data </div>
    <div name="button-list" id="button-list" style="background-color: #00b3ee"> List </div>


@endsection

@section('right_form_section')
<div class="show-all-list" id="lblData">
<h3>Name</h3>
</div>

@endsection


@section('animated_List_Details_Section')
    <div class="final-list-box">
    <div class="list-details">

        </div>

        <div class="list-details-change-parent">
                {!! $html2 !!}
        </div>

        <div class="list-details-change">

        </div>

    <div id="button-section-details-list">
            <input type="button" id="back-to-list-content" value="Back">
        </div>
    </div>
{{--input event triggering multiple time why??--}}
@endsection




@section('custom_scripts')
    <script src="{{ asset('/js/show_list.js') }}"></script>

@endsection

@stop

