<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
class CommentController extends Controller
{
    public function getXoa($idCM,$idTT){
        $cmt=Comment::find($idCM);
        $cmt->delete();
        return redirect('admin/tintuc/sua/'.$idTT)->with('thongbao','Đã xóa comment thành công');

    }
}
