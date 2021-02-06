@extends('app')

@section('content')
<table width="100%" border="1px black">
    <thead>
        <tr>
        @foreach ($pads[0] as $key => $value)
            <th>{{ $key }}</th>
        @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($pads as $row)
        <tr>
            @foreach ($row as $value)
            <td>{{ $value }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
@stop