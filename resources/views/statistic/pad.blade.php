@extends('app')

@section('content')
    @if($medicines)
    <div class="form-group">
        <div class="form-inline">
            {!! Form::label('med_name', 'Med Name :') !!}
            {!! Form::select('med_name', $medicines, $med_name, ['class' => 'form-control med-select med-record-field']) !!}
        </div>
    </div>

    <script src="{{ asset('/js/vendor.js') }}"></script>
    <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">

    <script>
    $('.med-select').each(function () {
        $(this).select2();
        $(this).change(function(event) {
            window.location='{{ url('/statistic/pad') . ($hr ? '/med_hr' : '/med') }}/' + $(this).val();
        })
    });
    </script>
    @endif

    @if($data)
    <table width="100%" border="1px black">
        <thead>
            <tr>
            @foreach ($data[0] as $key => $value)
                <th>{{ $key }}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                @foreach ($row as $value)
                <td>{{ $value }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@stop