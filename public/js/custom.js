$(document).ready(function(){

    console.log(location);

    ////////////////////////////////////////////////////////////////////////////////////////////////

    $('input[type]:file').change(function () {

        var element = document.getElementById("file");
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            //console.log('RESULT', reader.result)
            $('#upload_file').val(reader.result);

            $('#content_upload_image').html('<img id="submit_upload_image" style="width: 100%;" src="data:' + $('#upload_file').val() + '">');

        }

        reader.readAsDataURL(file);

    });

    $('#save_images_server').click(function(){

        //startPreLoader();

        $.ajax({
            url: '../../../videos/image/upload',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                upload_file: $('#upload_file').val().replace(/.*,/, '')
            },
            dataType: 'json',
            success: function (return_upload_image) {

                if(return_upload_image.error_status == "false"){

                    //stopPreLoader();
                    $('#show_upload_image').attr('src', $('#upload_file').val());
                    $('#delete_upload_image').show();

                    $('#content_upload_image').val('');
                    $('input[type]:file').val('');

                    $('#submit_upload_image').remove();

                }

            }

        });

    });

    $('#delete_upload_image').click(function () {

        const loc = location;

        startPreLoader();

        $.ajax({
            url: '../../../api/server/delete_upload_image',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                server_id: $('#server_id').val()
            },
            dataType: 'json',
            success: function (return_delete_upload_image) {

                if(return_delete_upload_image.error_status == "false"){

                    stopPreLoader();
                    setDefaultImage();
                    //$('#success_image_upload').html('<div><div><div style="position: absolute; right: 20px; top: 5px;" class="btn btn-danger" id="delete_upload_image">Удалить</div><div id="success_image_upload"><img style="width: 100%;" src="http://' + loc.host + '/img/noimage.png" id="show_upload_image"></div></div></div>');

                }

            }

        });

    });

    function setDefaultImage(){

        const loc = location;

        $('.block_upload_image_all').html('<div class="delete_upload_image"></div>');
        $('.block_upload_image_all').append('<img style="width: 100%;" src="http://' + loc.host + '/img/noimage.png" id="show_upload_image">');

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    $('#FilterSelectUserEmail').on('change', function (e, clickedIndex, isSelected, previousValue) {

        if($('#FilterSelectUserEmailIds').val().length > 0 && $(this).val() !== null) {

            location.href = location.search.replace("email=" + $('#FilterSelectUserEmailIds').val(), "email=" + $(this).val());

        }else if($(this).val() === null){

            var location_href_replace = location.href.replace("?email=" + $('#FilterSelectUserEmailIds').val(), "");
            location.href = location_href_replace.replace("&email=" + $('#FilterSelectUserEmailIds').val(), "");

        }else{

            if($('#FilterIsset').val() === "1"){

                var location_replace = replaceParams('cpabro_login');
                location.href = "?email=" + $(this).val();

            }else{

                location.href = "?email=" + $(this).val();

            }

        }

    });

    $('#FilterSelectUserCpabrologin').on('change', function (e, clickedIndex, isSelected, previousValue) {

        if($('#FilterSelectUserCpabrologinIds').val().length > 0 && $(this).val() !== null) {

            location.href = location.search.replace("cpabro_login=" + $('#FilterSelectUserCpabrologinIds').val(), "cpabro_login=" + $(this).val());

        }else if($(this).val() === null){

            var location_href_replace = location.href.replace("?cpabro_login=" + $('#FilterSelectUserCpabrologinIds').val(), "");
            location.href = location_href_replace.replace("&cpabro_login=" + $('#FilterSelectUserCpabrologinIds').val(), "");

        }else{

            if($('#FilterIsset').val() === "1"){

                var location_replace = replaceParams('email');
                location.href = "?cpabro_login=" + $(this).val();

            }else{

                location.href = "?cpabro_login=" + $(this).val();

            }

        }

    });

    $('#FormFilterSelectUserEmail').on('change', function (e, clickedIndex, isSelected, previousValue) {
        $('#FilterSelectUserEmailIds').val($(this).val());
    });
    $('#FormFilterSelectUserCpabrologin').on('change', function (e, clickedIndex, isSelected, previousValue) {
        $('#FilterSelectUserCpabrologinIds').val($(this).val());
    });
    $('#FormFilterSelectProgram').on('change', function (e, clickedIndex, isSelected, previousValue) {
        $('#FilterSelectProgramIds').val($(this).val());
    });
    $('#FormFilterSelectCode').on('change', function (e, clickedIndex, isSelected, previousValue) {
        $('#FilterSelectCodeIds').val($(this).val());
    });

    function replaceParams(param){

        var location_replace = "";

        if(param === "email"){
            location_replace = location.search.replace("?email=" + $('#FilterSelectUserEmailIds').val(), "/");
            return location_replace.replace("&email=" + $('#FilterSelectUserEmailIds').val(), "/");
        }else if(param === "cpabro_login"){
            location_replace = location.search.replace("?cpabro_login=" + $('#FilterSelectUserEmailIds').val(), "/");
            return location_replace.replace("&cpabro_login=" + $('#FilterSelectUserEmailIds').val(), "/");
        }

    }

    $('.user_programs').click(function () {

        const this_status = $(this).attr('checked');

        $.ajax({
            url: '../../api/admin/helper/change_program',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                program_id: $(this).attr('id'),
                user_id: $('#user_id').val(),
                change: this_status,
                response_type: "json"
            },
            dataType: 'json',
            success: function (return_change_program) {

            }

        });

    });

    $('#job_add_execute').click(function () {

        $.ajax({
            url: '/logs/store',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                job_code: $('#job_code').val(),
                program_id: $('#program_id').val(),
                user_id: $('#user_id').val(),
                //response_type: "json"
            },
            dataType: 'json',
            success: function (return_add_job) {
                if(return_add_job.error_status === "false") {
                    alert(return_add_job.success_message)
                    setTimeout(function () {
                        location.href = location.origin + "/logs";
                    }, 5000);
                }else{
                    alert(return_add_job.error_message + return_add_job.error_code)
                }
            }

        });

    });

    $('.jobs_enable').click(function () {

        const this_status = $(this).attr('checked');

        $.ajax({
            url: '/logs/enable',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                job_id: $(this).attr('id'),
                change: this_status,
                response_type: "json"
            },
            dataType: 'json',
            success: function (return_job_enable) {
                if(return_job_enable.error_status === "false") {
                    $('#tr_job_' + return_job_enable.job_id).removeClass("table-danger");
                    $('#tr_job_' + return_job_enable.job_id).removeClass("default");
                    $('#tr_job_' + return_job_enable.job_id).addClass(return_job_enable.job_class);
                }
            }

        });

    });

    $('#job_save_execute').click(function () {

        $.ajax({
            url: '/logs/update/' + $('#job_id').val(),
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                job_code: $('#job_code').val(),
                job_id: $('#job_id').val(),
                program_id: $('#program_id').val()
            },
            dataType: 'json',
            success: function (return_save_log) {

                if(return_save_log.error_status === "false") {
                    location.href = location.origin + "/logs";
                }
            }

        });

    });

    $('.program_job_select').click(function () {

        $('.program_job_select').prop('checked', false);
        $(this).prop('checked', true);

        $('#program_id').val($(this).attr('id'));

        const this_status = $(this).attr('checked');

    });

    $('.program_enable').click(function () {

        const this_status = $(this).attr('checked');

        $.ajax({
            url: '/programs/enable',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                program_id: $(this).attr('id'),
                change: this_status,
                response_type: "json"
            },
            dataType: 'json',
            success: function (return_program_enable) {
                if(return_program_enable.error_status === "false") {
                    // $('[id="' + return_program_enable.program_id + '"][class="program_enable"]').toggle();
                    $('#tr_program_' + return_program_enable.program_id).removeClass("table-danger");
                    $('#tr_program_' + return_program_enable.program_id).removeClass("default");
                    $('#tr_program_' + return_program_enable.program_id).addClass(return_program_enable.program_class);
                }
            }

        });

    });

    $('.users_enable').click(function () {

        const this_status = $(this).attr('checked');

        $.ajax({
            url: '/users/enable',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                user_id: $(this).attr('id'),
                change: this_status,
                response_type: "json"
            },
            dataType: 'json',
            success: function (return_user_enable) {
                if(return_user_enable.error_status === "false") {
                    // $('[id="' + return_program_enable.program_id + '"][class="program_enable"]').toggle();
                    $('#tr_user_' + return_user_enable.user_id).removeClass("table-danger");
                    $('#tr_user_' + return_user_enable.user_id).removeClass("default");
                    $('#tr_user_' + return_user_enable.user_id).addClass(return_user_enable.user_class);
                }
            }

        });

    });

    $('#update_user_info').click(function () {

        const this_status = $(this).attr('checked');

        $.ajax({
            url: '/users/update/' + $('#user_id').val(),
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                name: $('#name').val(),
                email: $('#email').val(),
                cpabro_login: $('#cpabro_login').val(),
                user_time_zone: $('#user_time_zone').val(),
                password: $('#password').val(),
                password_confirm: $('#password-confirm').val(),
                user_enable: $('#user_enable').prop('checked'),
                response_type: "json"
            },
            dataType: 'json',
            success: function (return_user_update) {
                if(return_user_update.error_status === "false") {
                    location.href = location.origin + "/users";
                }else{
                    alert(return_user_update.error_message)
                }
            }

        });

    });

    $('#register_user_info').click(function () {

        const this_status = $(this).attr('checked');

        $.ajax({
            url: '/users/store',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                password_confirm: $('#password-confirm').val(),
                user_enable: $('#user_enable').prop('checked'),
                response_type: "json"
            },
            dataType: 'json',
            success: function (return_user_create) {
                if(return_user_create.error_status === "false") {
                    location.href = location.origin + "/users";
                }else{
                    alert(return_user_create.error_message)
                }
            }

        });

    });

    $('#video_add_execute').click(function () {

        $.ajax({
            url: '/videos/store',
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                video_name: $('#video_name').val(),
                video_description: $('#video_description').val(),
                video_keyword: $('#video_keyword').val(),
                video_html_code: $('#video_html_code').val(),
                video_enable: $('#video_enable').prop('checked'),
                video_status: $('#video_status').prop('checked'),
                users_id: $('#users_id').val(),
                upload_file: $('#upload_file').val().replace(/.*,/, '')
                //response_type: "json"
            },
            dataType: 'json',
            success: function (return_add_video) {
                if(return_add_video.error_status === "false") {
                    location.href = location.origin + "/videos";
                }
            }

        });

    });

    $('#video_save_execute').click(function () {

        $.ajax({
            url: '/videos/update/' + $('#video_id').val(),
            type : 'POST',
            data : {
                _token: $('#_token').attr('content'),
                video_name: $('#video_name').val(),
                video_description: $('#video_description').val(),
                video_keyword: $('#video_keyword').val(),
                video_html_code: $('#video_html_code').val(),
                video_enable: $('#video_enable').prop('checked'),
                video_id: $('#video_id').val()
            },
            dataType: 'json',
            success: function (return_save_video) {

                if(return_save_video.error_status === "false") {
                    location.href = location.origin + "/videos";
                }
            }

        });

    });

    $('.program_users_list').click(function () {

        const this_user_id = $(this).attr('id');

        if($(this).prop('checked') === true){

            const users_id = $('#users_id').val();
            const replaced_users_id = users_id.replace("[" + this_user_id + "],", "");
            $('#users_id').val(replaced_users_id + "[" + this_user_id + "],");

        }else{

            const users_id = $('#users_id').val();
            const replaced_users_id = users_id.replace("[" + this_user_id + "],", "");
            $('#users_id').val(replaced_users_id);

        }

    });

    $('#program_add_all_btn').click(function () {

        $('#program_block_select_users_btn').toggle();

        if($(this).prop('checked') === true){

            const users_id = $('#users_id').val();
            const replaced_users_id = users_id.replace('[all],', "");
            $('#users_id').val(replaced_users_id + "[all],");

        }else{

            const users_id = $('#users_id').val();
            const replaced_users_id = users_id.replace('[all],', "");
            $('#users_id').val(replaced_users_id);

        }
    });

    $('.program_add_users_list').click(function () {

        const this_program_id = $(this).attr('id');

        if($(this).prop('checked') === true){

            const programs_id = $('#programs_id').val();
            const replaced_programs_id = programs_id.replace("[" + this_program_id + "],", "");
            $('#programs_id').val(replaced_programs_id + "[" + this_program_id + "],");

        }else{

            const programs_id = $('#programs_id').val();
            const replaced_programs_id = programs_id.replace("[" + this_program_id + "],", "");
            $('#programs_id').val(replaced_programs_id);

        }

    });

    $('#program_add_all_create_user_btn').click(function () {

        $('#program_block_select_users_btn').toggle();

        if($(this).prop('checked') === true){

            const programs_id = $('#programs_id').val();
            const replaced_programs_id = programs_id.replace('[all],', "");
            $('#programs_id').val(replaced_programs_id + "[all],");

        }else{

            const programs_id = $('#programs_id').val();
            const replaced_programs_id = programs_id.replace('[all],', "");
            $('#programs_id').val(replaced_programs_id);

        }
    });

    $('#generic_password').click(function(){

        const length_password = 10;
        const password = generatePwd(length_password);

        $('#password').val(password);
        $('#password-confirm').val(password);

    });

    function getRandomInRange(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function generatePwd(len)
    {
        var chars=['','0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','j','k','l','m','n','o','p','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        var min = 1;
        var max = chars.length;
        var pass='';
        for(var i=0;i<len;i++){
            pass += chars[getRandomInRange(min, max)];
        }
        return pass;
    }

    $('#select_time_zone_id').change(function () {

        $('#time_zone_id').val($(this).val());

    });

});
