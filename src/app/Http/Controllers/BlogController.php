<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateRequest as CreateRequest;
use App\Models\BlogModel;

class BlogController extends MyBaseController
{

    public function anyIndex()
    {
        $blogs = BlogModel::all();

        return view('blog/index')
            ->with('blogs', $blogs);
    }

    public function getView($id)
    {
        $blog = BlogModel::findOrFail($id);
        return view('blog/view')->with('blog', $blog);
    }


    public function getCreate()
    {
        return view('blog/create');
    }

    public function postCreate(CreateRequest $request)
    {
        BlogModel::insert($request);
        session()->flash('flash_message', 'blog created successfully');
        return redirect("blog");
    }


    public function getEdit($id)
    {
        $blog = BlogModel::findOrFail($id);
        return view('blog/edit')->with('blog', $blog);
    }

    public function putEdit($id, CreateRequest $request)
    {
        BlogModel::edit($id, $request);
        session()->flash('flash_message', 'blog updated successfully');
        return redirect("blog");
    }


    public function postDelete($id)
    {
        BlogModel::find($id)->delete();
        session()->flash('flash_message', 'blog deleted successfully');
        return redirect("blog");
    }
}
