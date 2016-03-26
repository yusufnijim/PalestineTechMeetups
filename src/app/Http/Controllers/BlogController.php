<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateRequest as CreateRequest;
use App\Models\BlogModel;

class BlogController extends MyBaseController
{

    public function anyIndex()
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

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
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        return view('blog/create');
    }

    public function postCreate(CreateRequest $request)
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        BlogModel::insert($request);
        session()->flash('flash_message', 'blog created successfully');
        return redirect("blog");
    }


    public function getEdit($id)
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        $blog = BlogModel::findOrFail($id);
        return view('blog/edit')->with('blog', $blog);
    }

    public function putEdit($id, CreateRequest $request)
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        BlogModel::edit($id, $request);
        session()->flash('flash_message', 'blog updated successfully');
        return redirect("blog");
    }


    public function postDelete($id)
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        BlogModel::find($id)->delete();
        session()->flash('flash_message', 'blog deleted successfully');
        return redirect("blog");
    }
}
