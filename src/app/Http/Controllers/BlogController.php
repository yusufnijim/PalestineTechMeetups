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


    public function getCreate()
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }
        $blog = new BlogModel();
        return view('blog/create')
            ->with('blog', $blog);
    }

    public function postCreate(CreateRequest $request)
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        BlogModel::insert($request);
        flash('blog created successfully', 'success');

        return redirect("blog");
    }


    public function getView($id)
    {
        $blog = BlogModel::findOrFail($id);
        return view('blog/view')->with('blog', $blog);
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
        flash('blog updated successfully', 'success');

        return redirect("blog");
    }


    public function postDelete($id)
    {
        if (!auth()->user()->hasPermission('blog.manage')) {
            abort(403, 'Access denied');
        }

        BlogModel::find($id)->delete();
        flash('blog deleted successfully', 'success');
        return redirect("blog");
    }
}
