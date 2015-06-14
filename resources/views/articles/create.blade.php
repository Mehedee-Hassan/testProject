@extends('new_app')



@section('left_button_section')



    <div name="button-import" id="button-import"> <a href="{{ URL::action('ArticleController@create') }}">Import </a></div>
    <div name="button-data" id="button-data" > Data </div>
    <div name="button-list" id="button-list">  </div>


@endsection

@section('right_form_section')



    {!! Form::open(
    array(
    'action' => 'ArticleController@uploadFile',
    'enctype' => 'multipart/form-data'
    )) !!}

    <div class=".div-right-section ">




            {!! Form::file('csvfile',
                array(
                    'class'=>'file-browse',
                    'id'=>'file',
                    'style'=>'display:none'
            )) !!}


            <div class="custom-form-label">{!! Form::label('file','Name' ) !!}</div>
            <div class="file-input-field">

                <div class="file-path"></div>
                <div class="button-browse">
                    Browse
                </div>
            </div>
        <div class="form-button-section">
        {!! Form::submit('upload',['class'=>'button-submit']) !!}
        {!! Form::button('cancel',['class'=>'button-cancel','name'=>'button-cancel','id'=>'button-cancel']) !!}

        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('custom_scripts')
    <script src="{{ asset('/js/file_upload.js') }}"></script>
    @endsection




@stop



