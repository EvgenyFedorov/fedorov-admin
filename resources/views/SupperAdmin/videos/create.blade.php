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
                            <a href="{{url('/videos')}}">Видео</a>
                        </span>&nbsp;-&nbsp;
                        <span>Добавление видео</span>
                    </div>
                </div>
            </div>
            <div class="card">
{{--                <form method="POST" action="{{ url('/programs') }}">--}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link" id="nav-home-tab" href="{{ url('/users') }}" role="tab" aria-controls="nav-home" aria-selected="true">Пользователи</a>
                            <a class="nav-item nav-link active" id="nav-profile-tab" href="{{ url('/videos') }}" role="tab" aria-controls="nav-profile" aria-selected="false">Видео</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" href="{{ url('/orders') }}" role="tab" aria-controls="nav-contact" aria-selected="false">Платежи</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card-header" style="text-align: center; font-size: 19px;">
                                Добавление видео
                            </div>
                            <div class="card-body" style="padding: 20px 0 20px 0; margin: 0;">
                                @csrf

                                <div class="form-group row">
                                    <label for="video_name" class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>

                                    <div class="col-md-6">
                                        <input id="video_name" type="text" class="form-control @error('video_name') is-invalid @enderror" name="video_name" value="" required autocomplete="video_name" autofocus>

                                        @error('video_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="video_description" class="col-md-4 col-form-label text-md-right">{{ __('Описание видео') }}</label>

                                    <div class="col-md-6">
                                        <textarea style="min-height: 200px;" id="video_description" class="form-control @error('video_description') is-invalid @enderror" name="video_description" required autocomplete="video_description"></textarea>

                                        @error('video_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="video_keyword" class="col-md-4 col-form-label text-md-right">{{ __('Теги видео') }}</label>

                                    <div class="col-md-6">
                                        <textarea style="min-height: 200px;" id="video_keyword" class="form-control @error('video_keyword') is-invalid @enderror" name="video_keyword" required autocomplete="video_keyword"></textarea>

                                        @error('video_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="video_html_code" class="col-md-4 col-form-label text-md-right">{{ __('HTML код видео') }}</label>

                                    <div class="col-md-6">
                                        <textarea style="min-height: 200px;" id="video_html_code" class="form-control @error('video_html_code') is-invalid @enderror" name="video_html_code" required autocomplete="video_html_code"></textarea>

                                        @error('video_html_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="" id="upload_images">
                                    <label for="" class="col-md-4 col-form-label text-md-right">
                                        <!-- Кнопка запуска модального окна -->
                                        <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#myModalImage">
                                            {{ __('Загрузить картинку') }}
                                        </button>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="block_upload_image_all">
                                            <div class="delete_upload_image" style="display: none;">
                                                <div style="position: absolute; right: 20px; top: 5px;" class="btn btn-danger" id="delete_upload_image">Удалить</div>
                                            </div>
                                            <img style="width: 100%;" src="{{asset('img/noimage.png')}}" id="show_upload_image">
                                        </div>
                                        <div class="form-group row">
                                            <!-- Модальное окно -->
                                            <div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 style="display: block; text-align: center;" class="modal-title" id="myModalLabel">Загрузка изображение</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="file" id="file" class="form-control" value="ЗАГРУЗИТЬ">
                                                            <input type="hidden" id="upload_file">
                                                            <div id="content_upload_image"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="col-md-6" style="text-align: left;">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                                                            </div>
                                                            <div class="col-md-6" style="text-align: right;">
                                                                <button type="button" class="btn btn-success" data-dismiss="modal" id="save_images_server">Сохранить</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Вкл/Выкл') }}
                                    </label>

                                    <div class="col-md-6">
                                        <label class="switch">
                                            <input type="checkbox" checked id="video_enable">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Доступно всем') }}
                                    </label>

                                    <div class="col-md-6">
                                        <label class="switch">
                                            <input type="checkbox" checked id="video_status">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="video_add_execute">
                                            {{ __('Добавить видео') }}
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
            </div>
        </div>
    </div>
</div>
<input id="users_id" value="" type="hidden">
@endsection
