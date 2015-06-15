@extends('new_app')


@section('left_button_section')


    <a href="{{ URL::action('ArticleController@create') }}">
        <div name="button-import" id="button-import"> Import </div>
    </a>


    <div name="button-data" id="button-data" style="background-color: #00b3ee"> Data </div>


    <a href="{{ URL::action('ArticleController@showOnlyList') }}">
        <div name="button-list" id="button-list"> List </div>
    </a>

@endsection

@section('right_form_section')

    <div class="div-right-form-list">
     <form id="checboxlist-form" action = "/articles/list" method="post">

            {!! $allCsvData !!}

            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="hidden" name="__form_generated_name__" id="__form_generated_name__" value="list"/>
      </form>
    </div>

    <div class="show-csv-button-section">
        <input type="submit" form="checboxlist-form" class="button-submit" value="Generate List"/>
        <input type="button" class="button-cancel" value="Clear"/>
    </div>


@endsection

@section('right_description_section')


        <div class="div-right-description" id="div-right-description">
        </div>



@endsection

@section('dummy_section')
    {{--<form id="hidden_list" action = "/articles/list_show_only" method="post">--}}
        {{--<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />--}}
        {{--<input type="hidden" name="" id="" value=""/>--}}
        {{--<input type="submit" form="" class="" value=""/>--}}
    {{--</form>--}}
    @endsection

@section('custom_scripts')
    <script src="{{ asset('/js/csv_parse.js') }}"></script>
    <script src="{{ asset('/js/lib/papa.min.js') }}"></script>

@endsection

@stop

