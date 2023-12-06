<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->breed = $request->breed; // 새로 추가한 부분
        $post->location = $request->location; // 새로 추가한 부분

        // 이미지 파일이 있을 경우에만 이미지를 저장
        if ($request->hasFile('image')) {
            $imagePaths = [];
            foreach($request->file('image') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = basename($path);
            }
            $post->image = json_encode($imagePaths);
        }

        $post->save();

        return redirect()->route('list');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.show', ['post' => $post])->with('error', 'You are not authorized to edit this post.');
        }

        return view('posts.edit', compact('post'));
    }

    
    public function update(Request $request, Post $post)
    {
        // 권한 확인
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.show', ['post' => $post])->with('error', 'You are not authorized to edit this post.');
        }

        // 데이터 업데이트
        $post->title = $request->title;
        $post->body = $request->body;
        $post->breed = $request->breed;
        $post->location = $request->location;

        // 이미지 파일이 있을 경우에만 이미지를 저장
        if ($request->hasFile('image')) {
            // 기존 이미지 삭제
            if ($post->image) {
                $oldImages = json_decode($post->image);

                foreach($oldImages as $oldImage) {
                    // storage/images 폴더에서 이미지 삭제
                    Storage::delete('public/images/' . $oldImage);
                }
            }

            // 새 이미지 저장
            $imagePaths = [];
            foreach($request->file('image') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = basename($path);
            }
            $post->image = json_encode($imagePaths);
        }

        // 변경사항 저장
        $post->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        // 게시글에 첨부된 이미지가 있다면
        if ($post->image) {
            $images = json_decode($post->image);
            foreach ($images as $image) {
                // 이미지 파일이 실제로 존재하는지 확인 후 삭제
                if (Storage::exists('public/images/'.$image)) {
                    Storage::delete('public/images/'.$image);
                }
            }
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
