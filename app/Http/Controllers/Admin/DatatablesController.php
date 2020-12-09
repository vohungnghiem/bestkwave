<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Post;
use App\Models\Subscribe;
class DatatablesController extends Controller
{
    public function post() {
        $posts = Post::join('categories','categories.id','=','posts.category')
                ->whereNotIn('type_post', [2])
                ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                    DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"))
                ->orderBy('id','desc')
                ->get();
        $datatables =  DataTables::of($posts);
        $datatables->setRowClass(function ($posts) {
            return 'wraptr'.$posts->id;
        });
        $datatables->editColumn('title', function ($posts) {
	        return '<a href="'.$posts->slug.'"><i class="fas fa-eye"></i> ' .$posts->title .'</a>';
        });
        $datatables->editColumn('category', function ($posts) {
	        return '<a href="admincp/category/'.$posts->parent.'/list">'.$posts->title_cat.'</a>';
        });
        $datatables->editColumn('image', function ($posts) {
	        return '<img src="public/uploads/thumb/'.$posts->year.'/'.$posts->month.'/'.$posts->image.'?v='.time().'" onerror="this.onerror=null; this.src=\'public/home/image/non_image.png\'" alt="'.$posts->title.'" />';
        });
        $datatables->editColumn('sort', function ($posts) {
	        return '<div class="wrapsort">'.
                '<input class="form-control sort" idsort="'.$posts->id.'" type="number" value="'.$posts->sort.'">'.
            '</div>';
        });
        $datatables->editColumn('status', function ($posts) {
            if ($posts->status == 1) {
                $sicon = '<span class="text-success"> <i class="fas fa-check-square fa-2x"></i> </span>';
                $status = 0;
            }else {
                $sicon = '<span class="text-warning"> <i class="fas fa-exclamation-circle fa-2x"></i> </span>';
                $status = 1;
            }
	        return '<div class="wrapstatus">'.
                    '<a class="status" idstatus="'.$posts->id.'"rootstatus="'.$posts->status.'" status="'.$status.'">'. $sicon .'</a>'.
                '</div>';
        });
        $datatables->editColumn('action', function ($posts) {
            return '<a  href="admincp/post/'.$posts->id.'/edit" data-popup="popover" data-trigger="hover" data-content="edit">
                    <span class="badge badge-light"><i class="fas fa-pen-nib fa-2x"></i></span>
                </a>
                <a class="badge badge-light swalDefaultSuccess" idmethod="destroy" iddeleted="'.$posts->id.'" idmodule="post" data-popup="popover" data-trigger="hover" data-content="remove">
                    <i class="fas fa-trash-alt fa-2x"></i>
                </a>';
        });
        $datatables->rawColumns(['id','title','category','image','sort','status','action']);
        return $datatables->make();
    }
    public function banner() {
        $posts = Post::join('categories','categories.id','=','posts.category')
            ->where('type_post',2)
            ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"))
            ->orderByDesc('id')
            ->get();
        $datatables =  DataTables::of($posts);
        $datatables->setRowClass(function ($posts) {
            return 'wraptr'.$posts->id;
        });
        $datatables->editColumn('title', function ($posts) {
	        return '<a href="'.$posts->slug.'"><i class="fas fa-eye"></i> ' .$posts->title .'</a>';
        });
        $datatables->editColumn('category', function ($posts) {
	        return '<a href="admincp/category/'.$posts->parent.'/list">'.$posts->title_cat.'</a>';
        });
        $datatables->editColumn('image', function ($posts) {
	        return '<img src="public/uploads/thumb/'.$posts->year.'/'.$posts->month.'/'.$posts->image.'?v='.time().'" onerror="this.onerror=null; this.src=\'public/home/image/non_image.png\'" alt="'.$posts->title.'" />';
        });
        $datatables->editColumn('sort', function ($posts) {
	        return '<div class="wrapsort">'.
                '<input class="form-control sort" idsort="'.$posts->id.'" type="number" value="'.$posts->sort.'">'.
            '</div>';
        });
        $datatables->editColumn('status', function ($posts) {
            if ($posts->status == 1) {
                $sicon = '<span class="text-success"> <i class="fas fa-check-square fa-2x"></i> </span>';
                $status = 0;
            }else {
                $sicon = '<span class="text-warning"> <i class="fas fa-exclamation-circle fa-2x"></i> </span>';
                $status = 1;
            }
	        return '<div class="wrapstatus">'.
                    '<a class="status" idstatus="'.$posts->id.'"rootstatus="'.$posts->status.'" status="'.$status.'">'. $sicon .'</a>'.
                '</div>';
        });
        $datatables->editColumn('action', function ($posts) {
            return '<a  href="admincp/banner/'.$posts->id.'/edit" data-popup="popover" data-trigger="hover" data-content="edit">
                    <span class="badge badge-light"><i class="fas fa-pen-nib fa-2x"></i></span>
                </a>
                <a class="badge badge-light swalDefaultSuccess" idmethod="destroy" iddeleted="'.$posts->id.'" idmodule="post" data-popup="popover" data-trigger="hover" data-content="remove">
                    <i class="fas fa-trash-alt fa-2x"></i>
                </a>';
        });
        $datatables->rawColumns(['id','title','category','image','sort','status','action']);
        return $datatables->make();
    }
    public function subscribe() {
        $subscribes = Subscribe::orderBy('id','desc')->get();
        $datatables =  DataTables::of($subscribes);
        $datatables->setRowClass(function ($subscribes) {
            return 'wraptr'.$subscribes->id;
        });
        $datatables->editColumn('sort', function ($subscribes) {
	        return '<div class="wrapsort">'.
                '<input class="form-control sort" idsort="'.$subscribes->id.'" type="number" value="'.$subscribes->sort.'">'.
            '</div>';
        });
        $datatables->editColumn('status', function ($subscribes) {
            if ($subscribes->status == 1) {
                $sicon = '<span class="text-success"> <i class="fas fa-check-square fa-2x"></i> </span>';
                $status = 0;
            }else {
                $sicon = '<span class="text-warning"> <i class="fas fa-exclamation-circle fa-2x"></i> </span>';
                $status = 1;
            }
	        return '<div class="wrapstatus">'.
                    '<a class="status" idstatus="'.$subscribes->id.'"rootstatus="'.$subscribes->status.'" status="'.$status.'">'. $sicon .'</a>'.
                '</div>';
        });
        $datatables->editColumn('action', function ($subscribes) {
            return '<a  href="admincp/subscribe/'.$subscribes->id.'/edit" data-popup="popover" data-trigger="hover" data-content="edit">
                    <span class="badge badge-light"><i class="fas fa-pen-nib fa-2x"></i></span>
                </a>
                <a class="badge badge-light swalDefaultSuccess" idmethod="destroy" iddeleted="'.$subscribes->id.'" idmodule="post" data-popup="popover" data-trigger="hover" data-content="remove">
                    <i class="fas fa-trash-alt fa-2x"></i>
                </a>';
        });
        $datatables->rawColumns(['id',
        // 'title','category','image',
        'sort','status','action']);
        return $datatables->make();
    }

}
