@extends('new_app')


@section('left_button_section')


    <div name="button-import" id="button-import"> Import </div>
    <div name="button-data" id="button-data" > Data </div>
    <div name="button-list" id="button-list" > List </div>


@endsection

@section('right_form_section')

    <div class="div-right-form-list">

        {!! Form::open(
        array(
        'action' => 'ArticleController@listout',
        'method' => 'post',
        'id'=>'checboxlist-form'
        )) !!}

           {{--{{ var_dump($allCsvData) }}--}}
        <ul>
            {!! $allCsvData !!}
        </ul>
    </div>

    <div class="show-csv-button-section">
        <input type="button" class="button-submit" value="Generate List"/>
        <input type="button" class="button-cancel" value="Cancel"/>
    </div>

    {!! Form::close() !!}
@endsection

@section('right_description_section')

    <div class="div-right-description">
        this is des
    </div>
@endsection
sfgsdfg
<div id="result1" name="result1">
dfg
</div>
@section('custom_scripts')
    <script src="{{ asset('/js/csv_parse.js') }}"></script>
    <script src="{{ asset('/js/lib/papa.min.js') }}"></script>
@endsection

@stop


{{--@for( $j = 0 ; $j < count($allCsvData[0]) ; $j++)--}}
    {{--@if($allCsvData[$j][0] == $allCsvData[$i][0])--}}
        {{--@for( $k = 0 ; $k < count($allCsvData[$i]) ; $k++)--}}

        {{--@endfor--}}
    {{--@endif--}}
{{--@endfor--}}