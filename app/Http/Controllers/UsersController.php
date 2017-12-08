<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        //提倡在控制器 Auth 中间件使用中，首选 except 方法，这样的话，当你新增一个控制器方法时，默认是安全的，
        $this->middleware('auth',['except'=>['show']]);

    }

    public function show(User $user)
    {

        return view('users.show',compact('user'));

    }

    public function edit(User $user)
    {
        //authorize 方法接收两个参数，第一个为授权策略的名称，第二个为进行授权验证的数据
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));

    }

    public function update(UserRequest $request,User $user,ImageUploadHandler $uploader)
    {
        //authorize 方法接收两个参数，第一个为授权策略的名称，第二个为进行授权验证的数据
        //这里 update 是指授权类里的 update 授权方法，$user 对应传参 update 授权方法的第二个参数。正如上面定义 update 授权方法时候提起的，调用时，默认情况下，我们 不需要 传递第一个参数，也就是当前登录用户至该方法内，因为框架会 自动 加载当前登录用户。
        $this->authorize('update', $user);
        $data=$request->all();
        if($request->avatar){
            $result=$uploader->save($request->avatar,'avatar',$user->id,362);
            if($result){
                $data['avatar']=$result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功！');
        
    }
}
