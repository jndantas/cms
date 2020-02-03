<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
        $this->middleware('verifyTagsCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.posts.create')->with('categories', Category::all())
                                          ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads/posts', $image_new_name);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => 'uploads/posts/' . $image_new_name,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->user()->id
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        alert()->success('Post criado com Sucesso!!', 'Salvo');

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.create')->with('post', $post)
                                    ->with('categories', Category::all())
                                    ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);
        if($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('uploads/posts', $image_new_name);
            File::delete($post->image);
            $data['image'] = 'uploads/posts/' . $image_new_name;
        }

            if ($request->tags) {
                $post->tags()->sync($request->tags);
            }
            $post->update($data);
            alert()->success('Post atualizado com Sucesso!!', 'Atualizado');

            return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $image_path = $post->image;
        if ($post->trashed()) {
            File::delete($image_path);
            $post->forceDelete();
        } else {
            $post->delete();
        }
        alert()->success('Post apagado com Sucesso!!', 'Deletado');
        return redirect(route('post.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('admin.posts.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        alert()->success('Post restaurado com Sucesso!!', 'Restaurado');

        return redirect(route('post.index'));
    }
}
