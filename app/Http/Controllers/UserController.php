<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getDanhSach(){
        $user=User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){

        return view('admin.user.them');
        
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'name'=>"required",
            'email'=>'required',
            'password'=>'required|min:8',
            'passwordAgain'=>'required|same:password'
        ],[
            'name.required'=>'Bạn cần nhập tên người dùng',
            'email.required'=>'Bạn cần nhập email',
            'password.required'=>'Bạn cần nhập password',
            'password.min'=>'Mật khẩu cần hơn 8 kí tự',
            'passwordAgain.same'=>'Mật khẩu không trùng khớp'

        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->quyen=$request->quyen;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Đã thêm user thành công');
    }
    public function getdangnhapAdmin(){
        return view('admin/login');
    }
    public function postdangnhapAdmin(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Ban can nhap email',
            'password.required'=>'Ban can nhap password'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect ('admin/theloai/danhsach');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','Dang nhap that bai');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
