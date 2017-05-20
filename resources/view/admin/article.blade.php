@extends('layouts/admin')

@section ('content')

    <div class="row">
        <div class="col-md-4">
            @include('partials/admin/article/add')
        </div>
        <div class="col-md-8">
            @include('partials/admin/article/list')
        </div>
    </div>

@endsection