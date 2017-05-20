
@extends('layouts.admin')

@section ('content')

<div class="row">
    <div class="col-md-5">

        @include('partials/admin/category/add')

    </div>

    <div class="col-md-7">

        @include('partials/admin/category/list')

    </div>

</div>

<div class="row">
    <div class="col-md-5">

        @include('partials/admin/article/add')

    </div>

    <div class="col-md-7">

        @include('partials/admin/article/list')

    </div>


</div>

<div class="row">

    <div class="col-md-12">

        @include('partials/admin/user/list')

    </div>

</div>


@endsection
