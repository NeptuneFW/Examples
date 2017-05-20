
<div class="card">
    <div class="header">
        <h4 class="title">
            <a style="color: #333333; font-weight: 300;" href=" {{ $route->route('userList')->getRoute() }}">
                {{ ucwords(\Libs\Languages::show("Users")) }}
            </a>
        </h4>
    </div>
    @include('partials/admin/alertshow')

    @if ($users != false)
    <div class="content table-responsive table-full-width">

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th> {{ \Libs\Languages::show('User name') }}</th>
                <th> {{ \Libs\Languages::show('Email') }}</th>
                <th> {{ \Libs\Languages::show('Rank') }}</th>
                <th> {{ \Libs\Languages::show('Created time') }}</th>
                <th> {{ \Libs\Languages::show('Transactions') }}</th>
                <div class="clearfix"></div>

            </tr></thead>
            <tbody>

            @foreach ($users as $user)
            <tr>
                <td> {{ $user['name'] . ' ' . $user['surname'] }}</td>
                <td> {{ $user['email'] }}</td>
                <td> {{ \Database\Databases\Model\UserModel::rank($user['rank']) }}</td>
                <td> {{ $user['created_time'] }}</td>
                <td>
                    @if ($user['banned'] == 0)
                    <a style="padding:1px 5px 1px 5px; margin:0;" href=" {{ $route->route('user_ban')->param($user['id'])->getRoute() }}" type="button" class="btn btn-danger btn-fill"> <i class="material-icons">block</i></a>
                    @else
                    <a style="padding:1px 5px 1px 5px; margin:0;" href=" {{ $route->route('user_ban')->param($user['id'])->getRoute() }}" type="button" class="btn btn-success btn-fill"> <i class="material-icons">done</i></a>
                    @endif
                </td>
                <div class="clearfix"></div>

            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="width: 100%; align-items: center; text-align: center;">
            <div class="btn-group btn-group-raised">
                @for ($i = 1; $i <= $page_users; $i++)
                <a type="button" href="?s= { $i } " class="@if (!isset($_GET['s'])) @if ($i==1) active @endif @else  @if ($i==$_GET['s']) active @endif @endif btn btn-fill btn-info"> {{ $i }}</a>
                @endfor
            </div>
        </div>
    </div>
    @else
    <div class="content">
        <div class="alert alert-danger">
            {{ \Libs\Languages::show('No user') }}!
        </div>
    </div>

    @endif
</div>