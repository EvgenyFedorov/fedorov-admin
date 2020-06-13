<?php

namespace App\Http\Controllers\User\SupperAdmin;

use App\Http\Controllers\User\UserController;
use App\Models\User;
use App\Models\Users\Videos;
use App\Repositories\Api\Imgur\ImgurRepository;
use Auth;
use Composer\DependencyResolver\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CabinetVideosController extends UserController
{
    public $request = null;
    public $user = null;

    public $roles = null;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }

    public function redirect($url = null){
        return ($url == null) ? redirect('/users') : redirect($url);
    }

    public function changeProgram(){

        $request = $this->request();
        $inputs = $this->inputs();
        return $this->update($request, $inputs['user_id']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($result = $this->isRole()){

            $data_videos = $this->videos()->getPaginate();

            return view($result['role']['dir'] . '.videos.list', [
                'user' => $result['user'],
                'role' => $result['role'],
                'data_videos' => $data_videos
            ]);

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    public function upload_image(Request $request){

        if($result = $this->isRole()){

            $input = $request->input();
            $response = $this->response()->Json();

            $response->setData('error_status', 'false');
            return $response->jsonEncode();

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = $this->isRole()){

            //$data_users = $this->users()->getForSelect();

            return view($result['role']['dir'] . '.videos.create', [
                'user' => $result['user'],
                'role' => $result['role'],
                //'data_users' => $data_users
            ]);

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    public function store(Request $request, ImgurRepository $imgurRepository)
    {
        if($result = $this->isRole()){

            $input = $request->input();
            $response = $this->response()->Json();

            DB::beginTransaction();

            $video = $this->videos();

            $video->user_id = $input['users_id'];

            $video->alias = (string) Str::uuid() . '-' . Str::slug($input['video_name'], '-');

            $upload_image = $imgurRepository->curlUploadImages($input['upload_file']);
            $upload_image = json_decode($upload_image);
            $video->link = $upload_image->success->data->link;

            $video->name = $input['video_name'];
            $video->description = $input['video_description'];

            $video->keywords = $input['video_keyword'];
            $video->hashtags = $this->getHashTags($input['video_keyword']);

            $video->html_code = str_replace('width="560"', 'width="100%"', $input['video_html_code']);

            $video->enable = ($input['video_enable'] == "true") ? 1 : 0;
            $video->status = ($input['video_status'] == "true") ? 1 : 0;

            $video->created_at = date("Y-m-d H:i:s", date("U") + (3600 * 3));

            $video->save();

            DB::commit();

            $response->setData('error_status', 'false');
            $response->setData('id', $video->id);

            return $response->jsonEncode();

        }else{

            Auth::logout();
            return redirect('/access-denied');

        }
    }

    public function getHashTags($keywords){

        $hashtags = explode(",", $keywords);
        $string = "";
        $i = 0;
        foreach ($hashtags as $hashtag){
            $i++;
            if(count($hashtags) != $i){
                $string .= str_replace(" ", "", $hashtag).",";
            }else{
                $string .= str_replace(" ", "", $hashtag);
            }

        }

        return $string;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($result = $this->isRole()){



        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($result = $this->isRole()){

            $video = Videos::find($id);

            return view($result['role']['dir'] . '.videos.edit', [
                'user' => $result['user'],
                'role' => $result['role'],
                'video' => $video,
            ]);

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($result = $this->isRole()){

            $input = $request->input();
            $response = $this->response()->Json();

            DB::beginTransaction();

            $video = Videos::find($input['video_id']);

            $video->name = $input['video_name'];
            $video->description = $input['video_description'];
            $video->keywords = $input['video_keyword'];
            $video->html_code = $input['video_html_code'];

            $video->enable = ($input['video_enable'] == "true") ? 1 : 0;
            $video->updated_at = date("Y-m-d H:i:s");

            $video->save();

            DB::commit();

            $response->setData('error_status', 'false');
            $response->setData('id', $input['video_id']);

            return $response->jsonEncode();

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    public function enableProgram(Request $request){

        if($result = $this->isRole()){

            $input = $request->input();
            $response = $this->response()->Json();

            $program = Programs::find($input['program_id']);
            $program->enable = ($program->enable == "1") ? 0 : 1;
            $program->updated_at = date("Y-m-d H:i:s");
            $program->save();

            $response->setData('error_status', 'false');
            $response->setData('program_id', $input['program_id']);
            $response->setData('program_class', ($program->enable == "1") ? "default" : "table-danger");

            return $response->jsonEncode();

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($result = $this->isRole()){



        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }
}
