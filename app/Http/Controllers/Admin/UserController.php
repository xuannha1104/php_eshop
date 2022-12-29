<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;
use App\Ultities\Common;
use App\Ultities\Validation\FormValidationException;
use App\Ultities\Validation\UserCreateFrom;
use App\Ultities\Validation\UserEditFormNoPassword;
use App\Ultities\Validation\UserEditFrom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private UserService $userService;

    protected UserCreateFrom $createFrom;
    protected UserEditFrom $userEditFrom;
    protected UserEditFormNoPassword $userEditFormNoPassword;

    public function __construct(UserService $userService,UserCreateFrom $createFrom,
                                UserEditFrom $userEditFrom,UserEditFormNoPassword $userEditFormNoPassword)
    {
        $this->userService = $userService;
        $this->createFrom = $createFrom;
        $this->userEditFrom = $userEditFrom;
        $this->userEditFormNoPassword = $userEditFormNoPassword;
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        $users = $this->userService->searchAndPaginate('name',$request->get('search')) ;
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $this->createFrom->validate($data);
        }
        catch (FormValidationException $e){
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
        $data['password'] = bcrypt($request->get('password'));

        // xu ly file
        if($request->hasFile('image'))
        {
            $data['avatar'] = Common::uploadFile($request->file('image'),'front/img/user');
        }

        $user = $this->userService->Create($data);
        return redirect(route('UserManager'))->with('notification','Create UserId #'. $user->id .' completed!');;
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return
     */
    public function show($id)
    {
        $user = $this->userService->find($id);

        return view('admin.user.details',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return
     */
    public function edit(int $id)
    {
        $user = $this->userService->Find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     * @return
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $setPassword = $request->get('password') != null;
        if(!$setPassword)
        {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        try {
            if($setPassword){
                $this->userEditFrom->validate($data);
            }
            else
            {
                $this->userEditFormNoPassword->validate($data);
            }

        }
        catch (FormValidationException $e){
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
        if($setPassword) $data['password'] = bcrypt($request->get('password'));

        if($request->hasFile('image')){
            $data['avatar'] = Common::uploadFile($request->file('image'),'front/img/user');

            $file_name_old = $request->get('image_old');
            if($file_name_old != 'default-avatar.jpg'){
                unlink('front/img/user/' . $file_name_old);
            }
        }

        $this->userService->Update($data,$id);
        return redirect(route('UserManager'))->with('notification','Update UserId #'. $id .' completed!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function destroy(int $id)
    {
        $image_name = $this->userService->Find($id)->avatar;
        if($image_name != null){
            unlink('front/img/user/' . $image_name);
        }

        $this->userService->Delete($id);

        return redirect(route('UserManager'))->with('notification','Delete User completed!');
    }
}
