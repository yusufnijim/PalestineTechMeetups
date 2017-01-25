<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateRequest as CreateRequest;
use App\Repositories\Contracts\BlogRepository;
use App\Models\EventImageModel;

class BlogController extends MyBaseController
{
    const EVENT_IMAGES = 8;
    protected $blog_repo;

    public function __construct(BlogRepository $blog_repo)
    {
        $this->blog_repo = $blog_repo;
    }

    public function anyIndex()
    {
        can('blog.view');

        $blogs = $this->blog_repo->all();

        return view('blog/index')
            ->with('blogs', $blogs);
    }

    public function getCreate()
    {
        can('blog.create');

        $blog = $this->blog_repo->newInstance();

        return view('blog/create')
            ->with('blog', $blog);
    }

    public function postCreate(CreateRequest $request)
    {
        can('blog.create');

        $bolgId = $this->blog_repo->insert($request)->id;
        for ($i=1; $i <= self::EVENT_IMAGES; $i++) { 
            $image = 'image'. $i;
            $eventImage = new EventImageModel;
            $eventImage->blog_id = $bolgId;
            if ($uploaded_file = file_upload($image, EventImageModel::$image_upload_directory, EventImageModel::$image_allowed_extension)) {
                $eventImage->image = EventImageModel::$image_upload_directory . $uploaded_file;
            }
            $eventImage->save();
        }
        //return $this->blog_repo->id;
        flash('blog created successfully', 'success');
        return redirect('blog');
    }

    public function getView($id)
    {
        $blog = $this->blog_repo->find($id);
         $latestBlogs = $this->blog_repo->published()->latest()->paginate(2);
         $eventImages = EventImageModel::where('blog_id', $id)->get();

        return view('blog/view')->with('blog', $blog)
        ->with('latestBlogs',$latestBlogs)
        ->with('eventImages', $eventImages);
    }

    public function getEdit($id)
    {
        can('blog.edit');

        $blog = $this->blog_repo->find($id);
        $eventImages = EventImageModel::where('blog_id', $id)->get();
        //return $eventImages;
        return view('blog/edit')->with('blog', $blog)->with('eventImages', $eventImages);
    }

    public function putEdit($id, CreateRequest $request)
    {
        can('blog.edit');
        $this->blog_repo->edit($id, $request);
        $i =1;
        $bolgId = $id;
        $eventImages = EventImageModel::where('blog_id', $bolgId)->get();
        foreach ($eventImages as $eventImage) {
            $image = 'image'. $i;
            if ($uploaded_file = file_upload($image, EventImageModel::$image_upload_directory, EventImageModel::$image_allowed_extension)) {
                $eventImage->image = EventImageModel::$image_upload_directory . $uploaded_file;
            }
            $eventImage->save();
            $i++;
        }
        //$eventImages->save();
        flash('blog updated successfully', 'success');
        return redirect('blog');
    }

    public function deleteDelete($id)
    {
        can('blog.delete');

        $this->blog_repo->delete($id);
        flash('blog deleted successfully', 'success');

        return redirect('blog');
    }
}
