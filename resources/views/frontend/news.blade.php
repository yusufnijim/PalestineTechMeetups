@extends ("layout/frontend")
@section("content")
        <!-- news -->
        <section class="news">
            <div class="dividor"></div>
            <div class="text-center">
              <h1 class="title-uppercase">{{trans('frontend/index.News') }}</h1>
              <h3 class="subtitle-uppercase">{{trans('frontend/index.updated') }}</h3>
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
                        {{trans('frontend/index.More') }} &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
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
@if(isset($_GET['page']) && $_GET['page']>1)
                      <a href="/news?page={{$_GET['page']-1}}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
@else
<a href="\news" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                      @endif
                    </li>
@if((!(isset($_GET['page']))) || $_GET['page']==1)
                    <li class="active">
                      <span>1 <span class="sr-only">(current)</span></span>
                    </li>
                    @else
                    <li><a href="/news">1</a></li>
                    @endif
              @for($i=2;$i<=$numberOfPages;$i++)
                    @if( (isset($_GET['page'])) && $_GET['page']==$i)

                    <li class="active">
                      <span>{{$i}} <span class="sr-only">(current)</span></span>
                    </li>
                    @else
                    <li><a href="/news?page={{$i}}"> {{$i}}</a></li>
                    @endif
                    @endfor
                      <li>
                      @if(isset($_GET['page'])&& $_GET['page']==$numberOfPages)
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                      @else
                      @if(isset($_GET['page']))
                      <a href="news?page={{$_GET['page']+1}}" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      @else
                      <a href="news?page=2" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      @endif
                      </a>
                      @endif
                    </li>
                  </ul>
                </nav>
            </div>
            <!-- //news-container -->
        </section>
        <!-- //news -->
        <div class="dividor"></div>
       @endsection
