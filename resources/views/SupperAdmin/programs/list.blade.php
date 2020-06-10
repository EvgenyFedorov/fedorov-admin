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
                            Приложения
                        </span>
                    </div>
                </div>
            </div>
            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="nav-home-tab" href="{{ url('/users') }}" role="tab" aria-controls="nav-home" aria-selected="true">Юзеры</a>
                        <a class="nav-item nav-link active" id="nav-profile-tab" href="{{ url('/programs') }}" role="tab" aria-controls="nav-profile" aria-selected="false">Приложения</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" href="{{ url('/logs') }}" role="tab" aria-controls="nav-contact" aria-selected="false">Задания</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Список приложений</div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="{{url('/programs/create')}}" style="color: #ffffff;" type="submit" class="btn btn-primary">
                                        {{ __('Добавить приложение') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0; margin: 0;">
                            <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                <tr>
                                    <th>ID</th>
                                    <th>Имя прилы</th>
                                    <th>Имя прилы для бота</th>
                                    <th>Статус</th>
                                    <th>Создана</th>
                                    <th>Изменена</th>
                                    <th>Вкл/Выкл</th>
                                </tr>
                                @if(isset($data_programs) AND count($data_programs) > 0)

                                    @foreach($data_programs as $data_program)

                                        <?php
                                            $class = ($data_program->enable == 1) ? "default" : "table-danger";
                                        ?>

                                        <tr id="tr_program_{{$data_program->id}}" class="{{$class}}">
                                            <td>{{$data_program->id}}</td>
                                            <td>
                                                <a style="display: block; width: 100%; height: 100%;" href="{{ url('/programs/edit/' . $data_program->id) }}">{{$data_program->name}}</a>
                                            </td>
                                            <td>{{$data_program->bot_name}}</td>
                                            <td>{{$data_program->enable}}</td>
                                            <td>{{$data_program->created_at}}</td>
                                            <td>{{$data_program->updated_at}}</td>
                                            <td>
                                                <label class="switch">
                                                    @if($data_program->enable == 1)
                                                        <input class="program_enable" id="{{$data_program->id}}" type="checkbox" checked>
                                                    @else
                                                        <input class="program_enable" id="{{$data_program->id}}" type="checkbox">
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
                                    <td colspan="7" style="text-align: center;">
                                        <div style="display: inline-block;">
                                            <?=$data_programs->render(); ?>
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
