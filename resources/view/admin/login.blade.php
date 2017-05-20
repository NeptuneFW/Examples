<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $title }}</title>

    {!! $css !!}

</head>
<body>

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-2" type="radio" name="tab" checked class="sign-up"><label for="tab-2" class="tab"> {{ \Libs\Languages::show('Log in') }}</label>
            <div class="login-form">
                <div class="sign-up-htm">
                    <br/>
                    <br/>

                    @if (isset($error))
                    {{ $error }}
                    @endif

                    <form id="login" method="post" action=" {{ $route->route("login")->getRoute() }}">
                    <div class="group">
                        <label for="pass" class="label"> {{ \Libs\Languages::show("Email") }}</label>
                        <input id="pass" name="email" type="text" class="email input">
                    </div>
                    <br/>
                    <div class="group">
                        <label for="pass" class="label"> {{\Libs\Languages::show('Password') }}</label>
                        <input id="pass" name="password" autocomplete="off" class="input password" data-type="password">
                    </div>
                    <br/>
                    <div class="group">
                        <span style="cursor: pointer; text-align: center; font-weight: 500; " class="button submit"> {{  \Libs\Languages::show('Log in') }} </span>
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a style="cursor: pointer; z-index: 10;" href="{ BASE_URL }/register "> {{ \Libs\Languages::show("Register")  }}</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

{!! $js !!}

</html>