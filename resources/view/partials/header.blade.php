<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 21.04.2017
 * Time: 19:50
 */
?>

<header class="mdl-grid demo-blog__posts">

    <div class="mdl-layout__header--transparent mdl-cell mdl-cell--12-col" style="min-height: 0; display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    font-size: 16px;
    font-weight: 400;
    position: relative;
    border-radius: 2px;
    box-sizing: border-box;
    z-index:10;">

        <div class="mdl-layout__header-row mdl-color--accent-contrast mdl-color-text--primary">

            <span class="mdl-layout-title">{{ $title }}</span>
            <nav class="mdl-navigation ">
                <a class="mdl-navigation__link mdl-color-text--primary" href="{{ $route->route('home')->getRoute() }}">{{ \Libs\Languages::show('Homepage') }}</a>
                <a class="mdl-navigation__link mdl-color-text--primary" href="{{ $route->route('categories')->getRoute() }}">{{ \Libs\Languages::show('Categories') }}</a>
                <a class="mdl-navigation__link mdl-color-text--primary" href="{{ $route->route('about_us')->getRoute() }}">{{ \Libs\Languages::show('About us') }}</a>
                <a class="mdl-navigation__link mdl-color-text--primary" href="{{ $route->route('contact')->getRoute() }}">{{ \Libs\Languages::show('Contact') }}</a>
                @if(!\System\Session::exists("login"))
                <a class="mdl-navigation__link mdl-color-text--primary" href="{{ $route->route('login')->getRoute() }}">{{ \Libs\Languages::show('Log in') }}</a>
                <a class="mdl-navigation__link mdl-color-text--primary" href="{{ $route->route('register')->getRoute() }}">{{ \Libs\Languages::show('Register') }}</a>
                @endif
            </nav>

            <div class="mdl-layout-spacer"></div>

            <button id="select-language" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons mdl-color-text--primary">translate</i>
            </button>

            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="select-language">

                @foreach ($languages as $lang)
                <a style="text-decoration: none;" href="{{ $route->route('lang')->param($lang['code'])->getRoute() }}">
                    <li class="mdl-menu__item">
                        <img style="width: 15px; height:15px;" src=" {{ $lang['icon_url'] }}"/> &nbsp;
                        {{ \Libs\Languages::show($lang['title']) }}
                    </li>
                </a>
                @endforeach

            </ul>
            <button id="select-color" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons mdl-color-text--primary">invert_colors</i>
            </button>

            <ul style="max-height: 300px; overflow-y: scroll;" class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="select-color">
        
                @foreach (\Libs\CSS\CSS::$colors as $color => $hex)
                @if($color == 'brown')
                    <?php break; ?>
                @endif
                <a style="text-decoration: none;" href="{{ $route->route('color')->param($color)->getRoute()  }}">
                    <li style="background: {{ $hex  }}" class="mdl-menu__item">
                        {{ ucfirst($color) }}
                    </li>
                </a>
                @endforeach
            </ul>

        </div>

    </div>

</header>
