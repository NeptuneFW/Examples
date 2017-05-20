
<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title> {{ $title_head }}</title>

    <!-- Add to homescreen for Chrome on Android
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">
     -->

    <!-- Add to homescreen for Safari on iOS
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">
      -->
    <!-- Tile icon for Win8 (144x144 + tile color)
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">
 -->
    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    {!! $css !!}
    <style>
        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
    </style>
</head>
<body>
<div class="demo-blog demo-blog--blogpost mdl-layout mdl-js-layout has-drawer is-upgraded">
    <main class="mdl-layout__content">

        @include('partials/header')

        <div class="demo-back">
            <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href=" {{ $back }}" title="go back" role="button">
                <i class="material-icons" role="presentation">arrow_back</i>
            </a>
        </div>
        <div class="demo-blog__posts mdl-grid">
            <div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col">
                <div class="mdl-card__media mdl-color-text--grey-50">
                    <h3> {{ $post_title }}</h3>
                </div>
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
                    <div class="minilogo" style="background: url('  {{ $picture }}');"></div>
                    <div>
                        <strong> {{ $user }}</strong>
                        <span> {{ $time }}</span>
                    </div>
                    <div class="section-spacer"></div>
                    <div class="meta__favorites">
{{ $like_count }}
                            <a
                                @if (\System\Session::exists('login'))
                                    @if ($liked)
                                        href=" {{ $route->route('unlike')->param($post_id)->getRoute() }}"
                                        class="mdl-color-text--red-300"
                                    @else
                                        href=" {{ $route->route('like')->param($post_id)->getRoute() }}"
                                        style="color:grey;"
                                    @endif
                                @else
                                    style="color:grey;"
                                @endif
                            >
                                <i class="material-icons" role="presentation">favorite</i>
                            </a>
                        <span class="visuallyhidden">favorites</span>
                    </div>
                </div>
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text">
{!!  $post_content !!}
                </div>
                <div class="mdl-color-text--primary-contrast mdl-card__supporting-text comments">

                    @if (\System\Session::exists("login"))
                    <form method="POST" action=" {{ $route->route("commentAdd")->getRoute() }}">
                        <input type="hidden" name="post_id" value=" {{ $post_id }}" />
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea rows=1 name="comment" class="mdl-textfield__input" id="comment"></textarea>
                            <label for="comment" class="mdl-textfield__label"> {{ \Libs\Languages::show("Add comment") }}</label>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <i class="material-icons" role="presentation">check</i><span class="visuallyhidden">add comment</span>
                        </button>
                    </form>
                    @else
                    <div style="border-radius:2px; height: 30px; line-height: 30px; text-align: center;" class="mdl-color--red-300 mdl-color-text--grey-50">
{{ \Libs\Languages::temporarilySet(['tr_TR' => 'Yorum eklemek için oturum açmış olmanız gerekiyor.', 'en_US' => 'You must be logged in to post comments.']) }}
                    </div>
                    <br/>
                    @endif

                    @if ($comments !== false)
                    <?php $c =0; ?>
                    @foreach ($comments as $comment)
                    @if ($c !== 0)
                    <hr/>
                    @endif
                    <?php
                        $user = \Database\Databases\Ntuser\UsersTable::find($comment['user_id']);
                    ?>
                    <div class="comment mdl-color-text--grey-700">
                        <header class="comment__header">
                            <img src="{{ $user->picture }}" class="comment__avatar">
                            <div class="comment__author">
                                <strong> {{ $user->name . " " . $user->surname }}</strong>
                                <span> {{ $comment['created'] }} </span>
                            </div>
                        </header>
                        <div class="comment__text">
{{ $comment['text'] }}
                        </div>
                    </div>
                    <?php $c++; ?>
                    @endforeach
                    @else
                    <div style="border-radius:2px; height: 30px; line-height: 30px; text-align: center;" class="mdl-color--red-300 mdl-color-text--grey-50">
{{ \Libs\Languages::show("No comment") }}
                    </div>
                    @endif
                </div>
            </div>

            <nav class="demo-nav mdl-color-text--grey-50 mdl-cell mdl-cell--12-col">
                <a href="index.html" class="demo-nav__button">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    Newer
                </a>
                <div class="section-spacer"></div>
                <a href="index.html" class="demo-nav__button">
                    Older
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                        <i class="material-icons">arrow_forward</i>
                    </button>
                </a>
            </nav>
        </div>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer--left-section">
                <button class="mdl-mini-footer--social-btn social-btn social-btn__twitter">
                    <span class="visuallyhidden">Twitter</span>
                </button>
                <button class="mdl-mini-footer--social-btn social-btn social-btn__blogger">
                    <span class="visuallyhidden">Facebook</span>
                </button>
                <button class="mdl-mini-footer--social-btn social-btn social-btn__gplus">
                    <span class="visuallyhidden">Google Plus</span>
                </button>
            </div>
            <div class="mdl-mini-footer--right-section">
                <button class="mdl-mini-footer--social-btn social-btn__share">
                    <i class="material-icons" role="presentation">share</i>
                    <span class="visuallyhidden">share</span>
                </button>
            </div>
        </footer>
    </main>
    <div class="mdl-layout__obfuscator"></div>
</div>
{!! $js !!}
</body>
<script>
    Array.prototype.forEach.call(document.querySelectorAll('.mdl-card__media'), function(el) {
        var link = el.querySelector('a');
        if(!link) {
            return;
        }
        var target = link.getAttribute('href');
        if(!target) {
            return;
        }
        el.addEventListener('click', function() {
            location.href = target;
        });
    });
</script>
</html>
