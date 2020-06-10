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
                            <a href="{{url('/users')}}">Юзеры</a>
                        </span>&nbsp;-&nbsp;
                        <span>Регистрация Юзера</span>
                    </div>
                </div>
            </div>
            <div class="card">
{{--                <form method="PUT" action="{{ url('/users/' . $edit_user->id) }}">--}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Основная информация</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Регистрация Юзера
                            </div>
                            <div class="card-body" style="padding: 20px 0 20px 0; margin: 0;">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cpabro_login" class="col-md-4 col-form-label text-md-right">{{ __('Логин на CPABRO') }}</label>

                                    <div class="col-md-6">
                                        <input id="cpabro_login" type="text" class="form-control @error('cpabro_login') is-invalid @enderror" name="cpabro_login" value="" required autocomplete="cpabro_login" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="time_zone" class="col-md-4 col-form-label text-md-right">{{ __('Часовой пояс') }}</label>

                                    <div class="col-md-6">

                                        <select id="time_zone_id" class="selectpicker form-control" title="Поиск по часовому поясу" data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
                                            @foreach($time_zones as $time_zone)
                                                <option data-tokens="mustard" style="font-size: 16px;" value="{{$time_zone->id}}">{{$time_zone->name_ru}}:&nbsp;({{$time_zone->timezone_utc}})&nbsp;{{$time_zone->timezone_name}}</option>
                                            @endforeach
                                        </select>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_enable" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Активация') }}
                                    </label>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="switch">
                                                    <input id="user_enable" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6" style="text-align: center;">
                                                <div class="btn btn-default" style="margin: 0 -60px 0 0;" id="generic_password">
                                                    <span style="font-size: 17px; color: #007bff; text-decoration: underline; cursor: pointer; ">Сгенерировать пароль</span>&nbsp;
                                                    <i class="fa fa-random"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="program_add_all_create_user_btn" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Добавить все приложения') }}
                                    </label>

                                    <div class="col-md-6">
                                        <label class="switch">
                                            <input type="checkbox" id="program_add_all_create_user_btn" value="true">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row" id="program_block_select_users_btn">
                                    <label for="" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Выбрать приложения') }}
                                    </label>

                                    <div class="col-md-6">
                                        <div type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-success">
                                            {{ __('Показать список') }}
                                        </div>
                                    </div>

                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Название прилы</th>
                                                        <th>Название прилы для бота</th>
                                                        <th>Дата добавления</th>
                                                        <th>Выбрать</th>
                                                    </tr>
                                                    @if(isset($programs) AND count($programs) > 0)

                                                        <?php
                                                        $ids = "";
                                                        ?>

                                                        @foreach($programs as $program)

                                                            <?php
                                                            $class = ($program->enable == 1) ? "default" : "table-danger";

                                                            ?>

                                                            <tr class="{{$class}}">
                                                                <td>{{$program->id}}</td>
                                                                <td>{{$program->name}}</td>
                                                                <td>{{$program->bot_name}}</td>
                                                                <td>{{$program->created_at}}</td>
                                                                <td>
                                                                    <label class="switch">
                                                                        <input class="program_add_users_list" id="{{$program->id}}" type="checkbox">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="7" style="text-align: center;">Приложений не найдено!</td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="register_user_info">
                                            {{ __('Зарегистрировать') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Все приложения
                            </div>
                            <div class="card-body" style="padding: 0; margin: 0;">
                                <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя прилы</th>
                                        <th colspan="2">Имя прилы для бота</th>
                                    </tr>
                                    @if(isset($programs) AND count($programs) > 0)

                                        @foreach($programs as $program)

                                            <?php
                                                $class = ($program->enable == 1) ? "default" : "table-danger";
                                            ?>

                                            <tr class="{{$class}}">
                                                <td>{{$program->id}}</td>
                                                <td>{{$program->name}}</td>
                                                <td>{{$program->bot_name}}</td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="user_programs" id="{{$program->id}}" type="checkbox">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" style="text-align: center;">Приложений не найдено!</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                        </div>
                    </div>
{{--                </form>--}}
            </div>
        </div>
    </div>
</div>
<input id="programs_id" value="" type="hidden">
@endsection
