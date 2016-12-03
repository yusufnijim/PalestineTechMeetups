@extends ("layout/frontend")
@section("content")
        <!-- news -->
        <section class="news">
            <div class="dividor"></div>
            <div class="text-center">
              <h1 class="title-uppercase">News</h1>
              <h3 class="subtitle-uppercase">Keep updated with our latest news and stuff</h3>
            </div>
            <div class="dividor"></div>
            <div class="container">
                <div class="row">
@foreach($blogs as $pos=>$blog)
<?php
$date_time=explode(" ",$blog->created_at);
      $date=date("M, Y,d", strtotime($date_time[0]));
$fulldate=explode(",",$date);?>

                  <div class="col-md-4 col-sm-6 margin-bottom-6x">
                    <div class="block block--vert">
                      <a href="/blog/view/{{ $blog->id }}">
                        <div class="block--img_container image-bg">
                          <img src="{{$blog->featured_image}}" alt="" />
                        </div>
                        <div class="block--calendar_date">
                          <div class="block--calendar_date_number">{{$fulldate[2]}}</div>
                          <div class="">
                            {{$fulldate[0]}}
                          </div>
                        </div>
                        <!-- div class="block--open">
                          Open
                        </div-->
                        <div class="block--more">
                          MORE &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
                        </div>
                        <div class="padding-2x block--content-wrapper">
                          <div class="block--title subtitle">
                            {{$blog->title}}
                          </div>
                          <div class="block--content content">
                           {{ strip_tags(mb_substr($blog->body,0,300,"UTF-8"))}}
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                 @endforeach
                </div>
                <!-- //news -->
                <nav class="pagination-container">
                  <ul class="pagination pagination-sm">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li class="active">
                      <span>1 <span class="sr-only">(current)</span></span>
                    </li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
            <!-- //timeline-container -->
        </section>
        <!-- //timeline -->
        <div class="dividor"></div>
       @endsection