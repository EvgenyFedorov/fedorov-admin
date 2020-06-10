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
                            <a href="{{url('/programs')}}">Приложения</a>
                        </span>&nbsp;-&nbsp;
                        <span>Редактирование приложения: <span>{{$program->name}}</span></span>
                    </div>
                </div>
            </div>
            <div class="card">
{{--                <form method="POST" action="{{ url('/programs') }}">--}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link" id="nav-home-tab" href="{{ url('/users') }}" role="tab" aria-controls="nav-home" aria-selected="true">Юзеры</a>
                            <a class="nav-item nav-link active" id="nav-profile-tab" href="{{ url('/programs') }}" role="tab" aria-controls="nav-profile" aria-selected="false">Приложения</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" href="{{ url('/logs') }}" role="tab" aria-controls="nav-contact" aria-selected="false">Задания</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Редактирование приложения:
                                <span style="font-weight: bold;">{{$program->name}}</span>
                            </div>
                            <div class="card-body" style="padding: 20px 0 20px 0; margin: 0;">
                                @csrf

                                <div class="form-group row">
                                    <label for="program_name" class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>

                                    <div class="col-md-6">
                                        <input id="program_name" type="text" class="form-control @error('program_name') is-invalid @enderror" name="program_name" value="{{$program->name}}" required autocomplete="program_name" autofocus>

                                        @error('program_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="program_bot_name" class="col-md-4 col-form-label text-md-right">{{ __('Название для бота') }}</label>

                                    <div class="col-md-6">
                                        <input id="program_bot_name" type="text" class="form-control @error('program_bot_name') is-invalid @enderror" name="program_bot_name" value="{{$program->bot_name}}" required autocomplete="program_bot_name">

                                        @error('program_bot_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Вкл/Выкл') }}
                                    </label>

                                    <div class="col-md-6">
                                        <label class="switch">
                                            @if($program->enable == 1)
                                                <input type="checkbox" checked id="program_enable">
                                            @else
                                                <input type="checkbox" id="program_enable">
                                            @endif
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Добавить всем') }}
                                    </label>

                                    <div class="col-md-6">
                                        <label class="switch">
                                            <input type="checkbox" id="program_add_all_btn" value="true">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row" id="program_block_select_users_btn">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Выбрать юзеров') }}
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
                                                        <th>Email</th>
                                                        <th>Login (CPABRO)</th>
                                                        <th>Группа</th>
                                                        <th>Дата регистрации</th>
                                                        <th>Вкл/Выкл</th>
                                                    </tr>
                                                    @if(isset($data_users) AND count($data_users) > 0)

                                                        <?php
                                                            $ids = "";
                                                        ?>

                                                        @foreach($data_users as $data_user)

                                                            <?php
                                                                $class = ($data_user->enable == 1) ? "default" : "table-danger";
                                                                $privileges = json_decode($data_user->privileges);

                                                            ?>

                                                            <tr class="{{$class}}">
                                                                <td>{{$data_user->id}}</td>
                                                                <td>{{$data_user->email}}</td>
                                                                <td>{{$data_user->cpabro_login}}</td>
                                                                <td>{{$data_user->name}}</td>
                                                                <td>{{$data_user->created_at}}</td>
                                                                <td>
                                                                    <label class="switch">
                                                                        @if(in_array($program->id, $privileges->show_programs))

                                                                            <?php
                                                                                $ids .= "[".$data_user->id."],"
                                                                            ?>

                                                                            <input class="program_users_list" id="{{$data_user->id}}" checked type="checkbox">
                                                                        @else
                                                                            <input class="program_users_list" id="{{$data_user->id}}" type="checkbox">
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
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="program_save_execute">
                                            {{ __('Сохранить приложение') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                        </div>
                    </div>
{{--                </form>--}}
            </div>
        </div>
    </div>
</div>
<input id="users_id" value="{{$ids}}" type="hidden">
<input id="program_id" value="{{$program->id}}" type="hidden">
@endsection
