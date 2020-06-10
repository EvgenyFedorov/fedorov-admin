@extends('SupperAdmin.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 0 0 20px 0;">
                        <span>
                            <a href="{{url('/')}}">Главная</a>
                        </span>&nbsp;-&nbsp;
                            <span>
                            Юзеры
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('register') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="FilterSelectUserEmail" class="selectpicker form-control" title="Поиск по Email(у)" multiple data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
                                    @foreach($users as $user)
                                        @if(isset($params['email']['in']) AND in_array($user->id, $params['email']['in']))
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$user->id}}">{{$user->email}}</option>
                                        @elseif(isset($params['email']) AND $user->id == $params['email'])
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$user->id}}">{{$user->email}}</option>
                                        @else
                                            <option data-tokens="mustard" style="font-size: 16px;" value="{{$user->id}}">{{$user->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="FilterSelectUserCpabrologin" class="selectpicker form-control" title="Поиск по логину CPABRO" multiple data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
                                    @foreach($users as $user)
                                        @if(isset($params['cpabro_login']['in']) AND in_array($user->id, $params['cpabro_login']['in']))
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$user->id}}">{{$user->cpabro_login}}</option>
                                        @elseif(isset($params['cpabro_login']) AND $user->id == $params['cpabro_login'])
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$user->id}}">{{$user->cpabro_login}}</option>
                                        @else
                                            <option data-tokens="mustard" style="font-size: 16px;" value="{{$user->id}}">{{$user->cpabro_login}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" href="{{ url('/users') }}" role="tab" aria-controls="nav-home" aria-selected="true">Юзеры</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" href="{{ url('/programs') }}" role="tab" aria-controls="nav-profile" aria-selected="false">Приложения</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" href="{{ url('/logs') }}" role="tab" aria-controls="nav-contact" aria-selected="false">Задания</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Список пользователей</div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="{{url('/users/create')}}" style="color: #ffffff;" type="submit" class="btn btn-primary">
                                        {{ __('Зарегистрировать юзера') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0; margin: 0;">
                            <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Login (CPABRO)</th>
                                    <th>Имя</th>
                                    <th>Дата регистрации</th>
                                    <th>Вкл/Выкл</th>
                                </tr>
                                @if(isset($data_users) AND count($data_users) > 0)

                                    @foreach($data_users as $data_user)

                                        <?php
                                            $class = ($data_user->enable == 1) ? "default" : "table-danger";
                                        ?>

                                        <tr id="tr_user_{{$data_user->id}}" class="{{$class}}">
                                            <td>{{$data_user->id}}</td>
                                            <td>
                                                <a style="display: block; width: 100%; height: 100%;" href="{{url('/users/edit/' . $data_user->id)}}">{{$data_user->email}}</a>
                                            </td>
                                            <td>{{$data_user->cpabro_login}}</td>
                                            <td>{{$data_user->name}}</td>
                                            <td>{{$data_user->created_at}}</td>
                                            <td>
                                                <label class="switch">
                                                    @if($data_user->enable == 1)
                                                        <input class="users_enable" id="{{$data_user->id}}" type="checkbox" checked>
                                                    @else
                                                        <input class="users_enable" id="{{$data_user->id}}" type="checkbox">
                                                    @endif
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
{{--                                            <td>--}}
{{--                                                <a href="{{ url('/users/' . $data_user->id . '/edit') }}">--}}
{{--                                                    <i class="fa fa-pencil"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ url('/users/delete/' . $data_user->id) }}">--}}
{{--                                                    <i class="fa fa-trash-o"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Пользователей не найдено!</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="7" style="text-align: center;">
                                        <div style="display: inline-block;">
                                            <?=$data_users->render(); ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="FilterIsset" value="<?=(count($params) > 0) ? 1 : ''; ?>">

    <input type="hidden" id="FilterSelectUserEmailIds" value="<?=(isset($input['email'])) ? $input['email'] : ''; ?>">
    <input type="hidden" id="FilterSelectUserCpabrologinIds" value="<?=(isset($input['cpabro_login'])) ? $input['cpabro_login'] : ''; ?>">

</div>
@endsection
