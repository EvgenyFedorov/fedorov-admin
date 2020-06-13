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
                            Видео
                        </span>
                    </div>
                </div>
            </div>
            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="nav-home-tab" href="{{ url('/users') }}" role="tab" aria-controls="nav-home" aria-selected="true">Пользователи</a>
                        <a class="nav-item nav-link active" id="nav-profile-tab" href="{{ url('/videos') }}" role="tab" aria-controls="nav-profile" aria-selected="false">Видео</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" href="{{ url('/orders') }}" role="tab" aria-controls="nav-contact" aria-selected="false">Платежи</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Список видео</div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="{{url('/videos/create')}}" style="color: #ffffff;" type="submit" class="btn btn-primary">
                                        {{ __('Добавить видео') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0; margin: 0;">
                            <table class="table table-hover table-bordered" style="margin: -1px 0 0 0;">
                                <tr>
                                    <th>ID</th>
                                    <th>Название видео</th>
                                    <th>Лайки</th>
                                    <th>Комментарии</th>
                                    <th>Просмотры</th>
                                    <th>Создана</th>
                                    <th>Вкл/Выкл</th>
                                </tr>
                                @if(isset($data_videos) AND count($data_videos) > 0)

                                    @foreach($data_videos as $data_video)

                                        <?php
                                            $class = ($data_video->enable == 1) ? "default" : "table-danger";
                                        ?>

                                        <tr id="tr_program_{{$data_video->id}}" class="{{$class}}">
                                            <td>{{$data_video->id}}</td>
                                            <td>
                                                <a style="display: block; width: 100%; height: 100%;" href="{{ url('/videos/edit/' . $data_video->id) }}">{{$data_video->name}}</a>
                                            </td>
                                            <td>{{$data_video->likes}}</td>
                                            <td>{{$data_video->comments}}</td>
                                            <td>{{$data_video->views}}</td>
                                            <td>{{$data_video->created_at}}</td>
                                            <td>
                                                <label class="switch">
                                                    @if($data_video->enable == 1)
                                                        <input class="program_enable" id="{{$data_video->id}}" type="checkbox" checked>
                                                    @else
                                                        <input class="program_enable" id="{{$data_video->id}}" type="checkbox">
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
                                            <?=$data_videos->render(); ?>
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
