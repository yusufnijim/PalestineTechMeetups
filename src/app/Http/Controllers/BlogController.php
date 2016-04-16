<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateRequest as CreateRequest;
use App\Repositories\Contracts\BlogRepository;

class BlogController extends MyBaseController
{
    protected $blog_repo;

    public function __construct(BlogRepository $blog_repo)
    {
        $this->blog_repo = $blog_repo;
    }

    public function anyIndex()
    {
        can("blog.view");

        $blogs = $this->blog_repo->all();

        return view('blog/index')
            ->with('blogs', $blogs);
    }


    public function getCreate()
    {
        can("blog.create");

        $blog = $this->blog_repo->newInstance();
        return view('blog/create')
            ->with('blog', $blog);
    }

    public function postCreate(CreateRequest $request)
    {
        can("blog.create");

        $this->blog_repo->insert($request);
        flash('blog created successfully', 'success');

        return redirect("blog");
    }


    public function getView($id)
    {
        $blog = $this->blog_repo->find($id);
        return view('blog/view')->with('blog', $blog);
    }

    public function getEdit($id)
    {
        can("blog.edit");

        $blog = $this->blog_repo->find($id);
        return view('blog/edit')->with('blog', $blog);
    }

    public function putEdit($id, CreateRequest $request)
    {
        can("blog.edit");
        $this->blog_repo->edit($id, $request);
        flash('blog updated successfully', 'success');

        return redirect("blog");
    }


    public function deleteDelete($id)
    {
        can("blog.delete");

        $this->blog_repo->delete($id);
        flash('blog deleted successfully', 'success');
        return redirect("blog");
    }
}
