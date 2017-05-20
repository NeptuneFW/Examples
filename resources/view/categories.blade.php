@extends('layouts.template')

@section ('content')

<div class="mdl-cell mdl-cell--12-col mdl-color--primary-dark mdl-typography--text-center mdl-typography--body-2-force-preferred-font-color-contrast">
    <h5 class="mdl-typography--headline mdl-typography--font-regular mdl-color-text--grey-300"> {{ \Libs\Languages::show('Categories') }} </h5>
</div>
<?php $i =0; ?>
@foreach ($categories as $category)
<?php $i++ ?>
<div  style="min-height: 100px;" class="mdl-card mdl-cell mdl-cell--4-col">
    <div style="min-height: 100px;" class="demo-card-event @if ($i%2 == 0) mdl-color--accent @else mdl-color--primary-dark @endif mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mdl-card--expand">
            <h4>
                {{ $category['name'] }} <br/>
                <span class="mdl-color-text--grey-900 mdl-card__subtitle-text">
                    {{ $category['description'] }}
                </span>
            </h4>
        </div>

        <div class="mdl-card__actions mdl-card--border">
            <a href=" {{ $route->route('category')->param(\System\Helper::permalink($category['name']), $category['id'])->getRoute() }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                {{ \Libs\Languages::show('Show category') }}
            </a>
            <div class="mdl-layout-spacer"></div>
            <i class="material-icons">remove_red_eye</i>
        </div>
    </div>
</div>
@endforeach

@endsection