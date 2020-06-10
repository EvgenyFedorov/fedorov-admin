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
                        <span>Редактирование Юзера: <span>{{$edit_user->email}}</span></span>
                    </div>
                </div>
            </div>
            <div class="card">
{{--                <form method="PUT" action="{{ url('/users/' . $edit_user->id) }}">--}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Основная информация</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Приложения</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Задания</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Редактирование Юзера
                                <span style="font-weight: bold;">{{$edit_user->email}}</span>
                            </div>
                            <div class="card-body" style="padding: 20px 0 20px 0; margin: 0;">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$edit_user->users_name}}" required autocomplete="name" autofocus>

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
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$edit_user->email}}" required autocomplete="email">

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
                                        <input id="cpabro_login" type="text" class="form-control @error('cpabro_login') is-invalid @enderror" name="cpabro_login" value="{{$edit_user->cpabro_login}}" required autocomplete="cpabro_login" autofocus>

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

                                        <select id="user_time_zone" class="selectpicker form-control" title="Поиск по часовому поясу" data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
                                            @foreach($time_zones as $time_zone)
                                                @if($time_zone->id == $edit_user->time_zone_id)
                                                    <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$time_zone->id}}">{{$time_zone->name_ru}}:&nbsp;({{$time_zone->timezone_utc}})&nbsp;{{$time_zone->timezone_name}}</option>
                                                @else
                                                    <option data-tokens="mustard" style="font-size: 16px;" value="{{$time_zone->id}}">{{$time_zone->name_ru}}:&nbsp;({{$time_zone->timezone_utc}})&nbsp;{{$time_zone->timezone_name}}</option>
                                                @endif
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
                                                    @if($edit_user->enable == 1)
                                                        <input id="user_enable" type="checkbox" checked>
                                                    @else
                                                        <input id="user_enable" type="checkbox">
                                                    @endif
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

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="update_user_info">
                                            {{ __('Сохранить') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Приложения Юзера
                                <span style="font-weight: bold;">{{$edit_user->email}}</span>
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
                                                        @if(in_array($program->id, $edit_user->privileges->show_programs))
                                                            <input class="user_programs" id="{{$program->id}}" type="checkbox" checked>
                                                        @else
                                                            <input class="user_programs" id="{{$program->id}}" type="checkbox">
                                                        @endif
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
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Логи Юзера
                                <span style="font-weight: bold;">{{$edit_user->email}}</span>
                            </div>
                            <div class="card-body" style="padding: 0; margin: 0;">
                                <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Прилы</th>
                                        <th>Имя прилы</th>
                                        <th>Код</th>
                                        <th>Статус</th>
                                        <th>Создан</th>
                                        <th>Изменен</th>
                                        <th>Вкл/Выкл</th>
                                    </tr>
                                    @if(isset($jobs) AND count($jobs) > 0)

                                        @foreach($jobs as $job)

                                            <?php
                                                $class = ($job->status == 0) ? "default" : "table-success";
                                            ?>

                                            <tr class="{{$class}}">
                                                <td>{{$job->jobs_id}}</td>
                                                <td>{{$job->programs_id}}</td>
                                                <td>{{$job->name}}</td>
                                                <td>{{$job->code_id}}</td>
                                                <td>
                                                    @if($job->status == 0)
                                                        Ожидает
                                                    @else
                                                        Отгружен
                                                    @endif
                                                </td>
                                                <td>{{$job->jobs_created_at}}</td>
                                                <td>{{$job->jobs_updated_at}}</td>
                                                <td>
                                                    <label class="switch">
                                                        @if($job->status == 0)
                                                            <input class="user_jobs" id="{{$job->jobs_id}}" type="checkbox" checked>
                                                        @else
                                                            <input class="user_jobs" id="{{$job->jobs_id}}" type="checkbox">
                                                        @endif
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
{{--                </form>--}}
            </div>
        </div>
    </div>
</div>
<input id="program_id" value="" type="hidden">
<input id="job_id" value="" type="hidden">
<input id="user_id" value="{{$edit_user->id}}" type="hidden">
@endsection
