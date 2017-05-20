@extends('layouts/template')

@section ('content')

    @if ($posts !== false)
        <?php $i =0; ?>
        @foreach ( $posts as $post )
            <?php $i++ ?>
            <div  style="min-height: 100px;" class="mdl-card mdl-cell mdl-cell--4-col">
                <div style="min-height: 100px;" class="demo-card-event @if ($i%2 == 0); mdl-color--accent @else mdl-color--primary-dark @endif  mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4 style="display: block;">
                            {{ $post['title'] }} <br/>
                            <span style="display: block; max-height: 200px; overflow: hidden; " class="mdl-color-text--grey-900 mdl-card__subtitle-text">
                    {!! html_entity_decode($post['content'])  !!}
                </span>
                        </h4>
                    </div>
                    <div style="
        margin-top: -50px;/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,000000+100&0+10,0.65+99 */
background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(230,230,230,0) 10%, rgba(3,3,3,0.65) 99%, rgba(0,0,0,0.65) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(230,230,230,0) 10%,rgba(3,3,3,0.65) 99%,rgba(0,0,0,0.65) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(230,230,230,0) 10%,rgba(3,3,3,0.65) 99%,rgba(0,0,0,0.65) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#a6000000',GradientType=0 ); /* IE6-9 */
    width: 100%; height: 20px;
   "
                         class="articleContiune
">
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href=" {{ $route->route('article')->param(\System\Helper::permalink($post['title']), $post['id'])->getRoute() }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            {{ \Libs\Languages::show('Show article') }}
                        </a>
                        <div class="mdl-layout-spacer"></div>
                        <i class="material-icons">remove_red_eye</i>
                    </div>
                </div>
            </div>
        @endforeach
    @else

        <div class="mdl-card mdl-cell mdl-cell--12-col mdl-color--red-300 mdl-typography--text-center" style="line-height:100px; font-size: 18px; color: white; min-height: 100px;" >
            {{ \Libs\Languages::show('No article') }}
        </div>

    @endif

@endsection
