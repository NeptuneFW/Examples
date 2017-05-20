@extends('layouts/admin')

@section ('content')

    <div class="row">
        <div class="col-md-4">
            @include('partials/admin/category/add')
        </div>
        <div class="col-md-8">
            @include('partials/admin/category/list')
        </div>
    </div>

@endsection