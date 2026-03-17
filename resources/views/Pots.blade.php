@extends('nova::layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">My Resource</h4>
    </div>
    <div class="card-body">
        <h5>File Upload Field</h5>
        <p>{{ $resource->file('file_name') }}</p>
    </div>
</div>

@endsection
