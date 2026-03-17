@extends('nova::layout')

@section('content')
    <pot-detail :resource="{{ $resource }}" :fields="{{ json_encode($fields) }}"></pot-detail>
@endsection

<a href="{{ route('pdf.generate') }}">Download PDF</a>
