<?php

namespace App\Http\Controllers\User\SupperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\RolesController;
use App\Http\Controllers\User\UserController;
use App\Models\User;
use App\Models\Users\Accesses;
use App\Models\Users\Programs;
use App\Models\Users\Roles;
use App\Repositories\Filter\FilterRepository;
use App\Repositories\QueryBuilder\QueryBuilderRepository;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CabinetUsersController extends UserController
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

    public function index(Request $request, UserRepository $userRepository, FilterRepository $filterRepository, QueryBuilderRepository $queryBuilderRepository)
    {

        if($result = $this->isRole()){

            $input = $request->input();
            $params = $filterRepository->getParams();

            $users = $userRepository->getAllForFilter();

            $response = $this->response()->Json()->getResult();

            $queries = $queryBuilderRepository->getParamsQueryUsers();

            if(isset($queries['where']['in'])){
                $data_users = $userRepository->getAllIn($queries['where']['in']);
            }else{
                $data_users = $userRepository->getAll($queries['where']);
            }

            return view($result['role']['dir'] . '.users.list', [
                'user' => $result['user'],
                'role' => $result['role'],
                'data_users' => $data_users,
                'input' => $input,
                'users' => $users,
                'params' => $params,
            ]);

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

            $programs = $this->programs()->getEditUser();
            $roles = Roles::all();

            $time_zones = $this->time_zones()->getAll();

            return view($result['role']['dir'] . '.users.create', [
                'user' => $result['user'],
                'role' => $result['role'],
                'programs' => $programs,
                'roles' => $roles,
                'time_zones' => $time_zones
            ]);

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($result = $this->isRole()){

            $input = $request->input();
            $response = $this->response()->Json();

            if(isset($input['name']) && isset($input['cpabro_login']) && isset($input['email']) && isset($input['password']) && isset($input['password_confirm'])){

                if(isset($input['programs_id'])) {

                    $user = new User();
                    $user->parent_user = $result['user']->id;
                    $user->name = $input['name'];
                    $user->roles_id = 4;
                    $user->email = $input['email'];
                    $user->cpabro_login = $input['cpabro_login'];
                    $user->time_zone_id = $input['time_zone_id'];
                    $user->email_verified_code = Str::random(10);
                    $user->password = bcrypt($input['password']);
                    $user->enable = ($input['user_enable'] == "true") ? 1 : 0;
                    $user->remember_token = Str::random(10);
                    $user->created_at = date("Y-m-d H:i:s");
                    $user->save();

                    $programs_ids = explode(",", $input['programs_id']);

                    if (in_array("[all]", $programs_ids)) {

                        $programs = $this->programs()->getEditUser();

                        foreach ($programs as $program) {

                            // Пишем массив всех прил массив
                            $new_programs[] = $program->id;
                        }

                        // Сораняем данные
                        $accesses = new Accesses();
                        $accesses->user_id = $user->id;
                        $accesses->role_id = 4;
                        $accesses->privileges = json_encode(["show_programs" => $new_programs]);
                        $accesses->created_at = date("Y-m-d H:i:s");
                        $accesses->save();

                        $response->setData('error_status', 'false');
                        $response->setData('id', $user->id);

                    } else {

                        foreach ($programs_ids as $programs_id) {

                            if(isset($programs_id) && !empty($programs_id)){

                                // Пишем массив ID прил
                                $new_programs[] = str_replace("[", "", str_replace("]", "", $programs_id));

                            }

                        }

                        // Сораняем данные
                        $accesses = new Accesses();
                        $accesses->user_id = $user->id;
                        $accesses->role_id = 4;
                        $accesses->privileges = json_encode(["show_programs" => $new_programs]);
                        $accesses->created_at = date("Y-m-d H:i:s");
                        $accesses->save();

                        $response->setData('error_status', 'false');
                        $response->setData('id', $user->id);

                    }

                }else{

                    $response->setData('error_status', 'true');
                    $response->setData('error_message', 'Необходимо выбрать приложения!');

                }

            }else{

                $response->setData('error_status', 'true');
                $response->setData('error_message', 'Не заполнено одно из обязательных полей!');

            }

            return $response->jsonEncode();

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
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

            $edit_user = $this->users()->getEdit($id);
            $edit_user[0]->privileges = json_decode($edit_user[0]->privileges);

            $time_zones = $this->time_zones()->getAll();

            $programs = $this->programs()->getEditUser();

            $jobs = $this->jobs()->getEdit($id);

            return view($result['role']['dir'] . '.users.edit', [
                'user' => $result['user'],
                'role' => $result['role'],
                'edit_user' => $edit_user[0],
                'programs' => $programs,
                'jobs' => $jobs,
                'time_zones' => $time_zones
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

            if(isset($input['name']) && isset($input['email']) && isset($input['cpabro_login'])){

                $user = User::find($id);
                $user->name = $input['name'];
                $user->email = $input['email'];
                $user->cpabro_login = $input['cpabro_login'];
                $user->time_zone_id = $input['user_time_zone'];
                $user->enable = ($input['user_enable'] == "true") ? 1 : 0;
                $user->updated_at = date("Y-m-d H:i:s");

                if(isset($input['password']) && isset($input['password_confirm']) && ($input['password'] == $input['password_confirm'])) {

                    $user->password = bcrypt($input['password']);
                    $user->save();
                    $response->setData('error_status', 'false');
                    $response->setData('user_id', $id);

                }elseif(isset($input['password']) && isset($input['password_confirm']) && ($input['password'] != $input['password_confirm'])){

                    $response->setData('error_status', 'true');
                    $response->setData('error_message', 'Введенные пароли не совпадают!');

                }else{

                    $user->save();
                    $response->setData('error_status', 'false');
                    $response->setData('user_id', $id);

                }

            }else{

                $response->setData('error_status', 'true');
                $response->setData('error_message', 'Заполнены не все обязательные поля!');

            }

            return $response->jsonEncode();

        }else{
            Auth::logout();
            return redirect('/access-denied');
        }
    }

    public function enableUser(Request $request){

        if($result = $this->isRole()){

            $input = $request->input();
            $response = $this->response()->Json();

            $user = User::find($input['user_id']);
            $user->enable = ($user->enable == "1") ? 0 : 1;
            $user->updated_at = date("Y-m-d H:i:s");
            $user->save();

            $response->setData('error_status', 'false');
            $response->setData('user_id', $input['user_id']);
            $response->setData('user_class', ($user->enable == "1") ? "default" : "table-danger");

            return $response->jsonEncode();

        }else{
            return redirect('/logout');
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
