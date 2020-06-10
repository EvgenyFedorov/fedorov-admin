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
                            Задания
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('/logs') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <select id="FormFilterSelectUserEmail" class="selectpicker form-control" title="Поиск по Email(у)" multiple data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
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
                            <div class="col-md-2">
                                <select id="FormFilterSelectUserCpabrologin" class="selectpicker form-control" title="Поиск по логину CPABRO" multiple data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
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
                            <div class="col-md-3">
                                <select id="FormFilterSelectProgram" class="selectpicker form-control" title="Поиск по приложению" multiple data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
                                    @foreach($programs as $program)
                                        @if(isset($params['program']['in']) AND in_array($program->id, $params['program']['in']))
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$program->id}}">{{$program->name}}</option>
                                        @elseif(isset($params['program']) AND $program->id == $params['program'])
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$program->id}}">{{$program->name}}</option>
                                        @else
                                            <option data-tokens="mustard" style="font-size: 16px;" value="{{$program->id}}">{{$program->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="FormFilterSelectCode" class="selectpicker form-control" title="Поиск по Коду" multiple data-actions-box="true" data-live-search="true" style="font-size: 16px; height: 45px;">
                                    @foreach($jobs as $job)
                                        @if(isset($params['code']['in']) AND in_array($job->id, $params['code']['in']))
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$job->id}}">{{$job->code_id}}</option>
                                        @elseif(isset($params['code']) AND $job->id == $params['code'])
                                            <option data-tokens="mustard" style="font-size: 16px;" selected value="{{$job->id}}">{{$job->code_id}}</option>
                                        @else
                                            <option data-tokens="mustard" style="font-size: 16px;" value="{{$job->id}}">{{$job->code_id}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="FilterSelectUserEmailIds" name="email" value="<?=(isset($input['email'])) ? $input['email'] : ''; ?>">
                            <input type="hidden" id="FilterSelectUserCpabrologinIds" name="cpabro_login" value="<?=(isset($input['cpabro_login'])) ? $input['cpabro_login'] : ''; ?>">
                            <input type="hidden" id="FilterSelectProgramIds" name="program" value="<?=(isset($input['program'])) ? $input['program'] : ''; ?>">
                            <input type="hidden" id="FilterSelectCodeIds" name="code" value="<?=(isset($input['code'])) ? $input['code'] : ''; ?>">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success form-control">
                                    {{ __('Применить') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="nav-home-tab" href="{{ url('/users') }}" role="tab" aria-controls="nav-home" aria-selected="true">Юзеры</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" href="{{ url('/programs') }}" role="tab" aria-controls="nav-profile" aria-selected="false">Приложения</a>
                        <a class="nav-item nav-link active" id="nav-contact-tab" href="{{ url('/logs') }}" role="tab" aria-controls="nav-contact" aria-selected="false">Задания</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Список приложений</div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="{{url('/logs/create')}}" style="color: #ffffff;" type="submit" class="btn btn-primary">
                                        {{ __('Добавить задание') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0; margin: 0;">
                            <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                <tr>
                                    <th>ID</th>
                                    <th>ID Прилы</th>
                                    <th>Юзер</th>
                                    <th>Имя прилы</th>
                                    <th>Имя прилы Для Бота</th>
                                    <th>Код</th>
                                    <th>Статус</th>
                                    <th>Создан</th>
{{--                                    <th>Изменен</th>--}}
                                    <th>Вкл/Выкл</th>
                                </tr>
                                <?php

                                /*
                                 * Отсчитываем время исходя из настроек юзера
                                 * */

                                $sh = 3600; // секунд в часе
                                $sm = 60; // секунд в минуте
                                $mat_operator = null; // математический оператор
                                $datetime = 0; // Сколько часов и минут нужно вычесть или прибавить

                                if($time_zone->timezone_utc != "UTC"){

                                    // Берем математический оператор сложения или вычитания
                                    preg_match('/(\+|\-)/', $time_zone->timezone_utc, $result_symbol);
                                    $mat_operator = $result_symbol[0];

                                    // Проверяем ровно ли часов или с минутами
                                    preg_match('/[0-9\:]{1,5}/', $time_zone->timezone_utc, $result_hours);

                                    $explode_hours = explode(":", $result_hours[0]);

                                    if(isset($explode_hours[0])){
                                        $datetime = $datetime + ($sh * $explode_hours[0]);
                                    }
                                    if(isset($explode_hours[1])){
                                        $datetime = $datetime + ($sm * $explode_hours[1]);
                                    }

                                }

                                ?>
                                @if(isset($data_jobs) && count($data_jobs) > 0)

                                    @foreach($data_jobs as $data_job)

                                        <?php
                                            $class = ($data_job->jobs_enable == 1) ? "default" : "table-danger";
                                        ?>

                                        <tr id="tr_job_{{$data_job->jobs_id}}" class="{{$class}}">
                                            <td>
                                                <a href="{{url('/logs/edit/' . $data_job->jobs_id)}}">{{$data_job->jobs_id}}</a>
                                            </td>
                                            <td>{{$data_job->programs_id}}</td>
                                            <td>
                                                <a target="_blank" href="{{url('/users/edit/' . $data_job->user_id)}}">{{$data_job->users_email}}</a>
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{url('/programs/edit/' . $data_job->programs_id)}}">{{$data_job->programs_name}}</a>
                                            </td>
                                            <td>{{$data_job->bot_name}}</td>
                                            <td>{{$data_job->code_id}}</td>
                                            <td style="text-align: center;">
                                                @if(isset($job_statuses[$data_job->status]))
                                                    <!-- Кнопка запуска модального окна -->
                                                        <div class="open_log btn {{$job_statuses[$data_job->status]->class}}" data-toggle="modal" data-target="#myModal{{$data_job->jobs_id}}">
                                                            {{$job_statuses[$data_job->status]->text}}
                                                        </div>

                                                        <!-- Модальное окно -->
                                                        <div class="modal fade" id="myModal{{$data_job->jobs_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 style="display: block; text-align: center;" class="modal-title" id="myModalLabel">Задача №{{$data_job->jobs_id}}</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @if(isset($data_job->log_desc) && !empty($data_job->log_desc))
                                                                            {{$data_job->log_desc}}
                                                                        @else
                                                                            {{$job_statuses[$data_job->status]->text}}
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @else
                                                    <div>
                                                        <div class="btn btn-default">Не определено</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($time_zone->timezone_utc) && !empty($time_zone->timezone_utc))
                                                    @if($mat_operator == "-")
                                                        {{date("Y-m-d H:i:s", strtotime($data_job->jobs_created_at) - $datetime)}}
                                                    @elseif($mat_operator == "+")
                                                        {{date("Y-m-d H:i:s", strtotime($data_job->jobs_created_at) + $datetime)}}
                                                    @else
                                                        {{$data_job->jobs_created_at}}
                                                    @endif
                                                @else
                                                    {{$data_job->jobs_created_at}}
                                                @endif
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    @if($data_job->enable == 1)
                                                        <input class="jobs_enable" id="{{$data_job->jobs_id}}" type="checkbox" checked>
                                                    @else
                                                        <input class="jobs_enable" id="{{$data_job->jobs_id}}" type="checkbox">
                                                    @endif
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Пользователей не найдено!</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="10" style="text-align: center;">
                                        <div style="display: inline-block;">
                                            @if(isset($data_jobs))
                                                <?=$data_jobs->render(); ?>
                                            @endif
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
</div>
@endsection
