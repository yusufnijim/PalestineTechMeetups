<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateRequest as CreateRequest;
use App\Models\BlogModel;

class BlogController extends MyBaseController
{

    public function anyIndex()
    {
        can("blog.manage");

        $blogs = BlogModel::all();

        return view('blog/index')
            ->with('blogs', $blogs);
    }


    public function getCreate()
    {
        can("blog.manage");

        $blog = new BlogModel();
        return view('blog/create')
            ->with('blog', $blog);
    }

    public function postCreate(CreateRequest $request)
    {
        can("blog.manage");

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
        can("blog.manage");

        $blog = BlogModel::findOrFail($id);
        return view('blog/edit')->with('blog', $blog);
    }

    public function putEdit($id, CreateRequest $request)
    {
        can("blog.manage");

        BlogModel::edit($id, $request);
        flash('blog updated successfully', 'success');

        return redirect("blog");
    }


    public function postDelete($id)
    {
        can("blog.manage");

        BlogModel::find($id)->delete();
        flash('blog deleted successfully', 'success');
        return redirect("blog");
    }
}
