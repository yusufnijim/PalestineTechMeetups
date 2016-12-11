 @extends('layout.articlepage')
  @section('title')
 <title>  {{ $blog->title }}</title>
 @stop
  @section('title')
 <title> {{ $blog->title }}</title>
 @stop
 @section('content')
      <!-- Article -->
      <?php
      $date=date("M, Y,d", strtotime('$blog->date;'));
$fulldate=explode(",",$date);?>
      <article class="article">
        <section class="article--head image-bg">
          <img src="{{ $blog->featured_image }}" alt="" />
          <div class="container">
            <div class="article--head_calendar_container">
              <div class="article--head_calendar">
                <div class="article--head_calendar_number">{{$fulldate[2]}}</div>
                <div class="">
                 {{$fulldate[0]}}
                </div>
              </div>
              <div class="article--head_open">
                Open
              </div>
              <!-- <div class="article--head_closed">
                closed
              </div> -->

              <div class="article--social_links_container">
                <ul class="article--social_links">
                  <li>
                    <a class="article--social_links-facebook" href="#">
                      <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li>
                    <a class="article--social_links-twitter" href="#">
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li>
                    <a class="article--social_links-linkedin" href="#">
                      <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="article--head_title">
            <div class="container">
              <div class="with-calendar">

              </div>
              <h1>
               {{strip_tags($blog->title)}} 
              </h1>
            </div>
          </div>
        </section>
        <div class="dividor"></div>
        <!-- article content -->
        <section class="article--content">
          <div class="container">
            <div class="row">
              <!-- main col -->
              <div class="col-sm-8">
                <!-- description -->
                <div class="description">
                  <h3 class="subtitle-uppercase">Description</h3>
                  <p>
                   
{{ strip_tags($blog->body,"UTF-8")}}
                  </p>
                  <p>
                    <img src="{{url('/assets/frontend/images/speaker.png')}}" alt="" />
                  </p>
                  <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                  </p>
                </div>
                <!-- //description -->
                <!-- volunteers -->
                <div class="volunteers">
                  <h3 class="subtitle-uppercase margin-bottom-3x">Volunteers</h3>
                  <ul class="team small-team">
                    <li>
                      <div class="team--member">
                        <div class="team--member_img image-bg">
                          <img src="../../assets/frontend/images/team1.jpg" alt="" />
                        </div>
                        <div class="team--member_name">
                          Jafar Hajeer
                        </div>
                        <div class="team--member_social">
                          <a class="purple" href="#">
                            <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="team--member">
                        <div class="team--member_img image-bg">
                          <img src="../../assets/frontend/images/team2.jpg" alt="" />
                        </div>
                        <div class="team--member_name">
                          Salahuddin Assi
                        </div>
                        <div class="team--member_social">
                          <a class="purple" href="#">
                            <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="team--member">
                        <div class="team--member_img image-bg">
                          <img src="../../assets/frontend/images/team3.jpg" alt="" />
                        </div>
                        <div class="team--member_name">
                          Adel Jodallah
                        </div>
                        <div class="team--member_social">
                          <a class="purple" href="#">
                            <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="team--member">
                        <div class="team--member_img image-bg">
                          <img src="../../assets/frontend/images/team2.jpg" alt="" />
                        </div>
                        <div class="team--member_name">
                          Salah Assi
                        </div>
                        <div class="team--member_social">
                          <a class="purple" href="#">
                            <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i>
                          </a>
                          <a class="purple" href="#">
                            <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- //volunteers -->
                <!-- images -->
                <section class="images">
                  <h3 class="subtitle-uppercase margin-bottom-3x">Images</h3>

                  <ul class="images-list">
                    <li class="images-list--item">
                      <a onClick="return false;" class="image-bg" data-lightbox="roadtrip" href="../../assets/frontend/images/news1.jpg">
                        <img src="../../assets/frontend/images/news1.jpg" alt="" />
                      </a>
                    </li>
                    <li class="images-list--item">
                      <a class="image-bg" data-lightbox="roadtrip" href="../../assets/frontend/images/news2.jpg">
                        <img src="../../assets/frontend/images/news2.jpg" alt="" />
                      </a>
                    </li>
                    <li class="images-list--item">
                      <a class="image-bg" data-lightbox="roadtrip" href="../../assets/frontend/images/news3.jpg">
                        <img src="../../assets/frontend/images/news3.jpg" alt="" />
                      </a>
                    </li>
                    <li class="images-list--item">
                      <a class="image-bg" data-lightbox="roadtrip" href="../../assets/frontend/images/news4.jpg">
                        <img src="../../assets/frontend/images/news4.jpg" alt="" />
                      </a>
                    </li>
                    <li class="images-list--item">
                      <a class="image-bg" data-lightbox="roadtrip" href="../../assets/frontend/images/news5.jpg">
                        <img src="../../assets/frontend/images/news5.jpg" alt="" />
                      </a>
                    </li>
                    <li class="images-list--item">
                      <a class="image-bg" data-lightbox="roadtrip" href="../../assets/frontend/images/news6.jpg">
                        <img src="../../assets/frontend/images/news6.jpg" alt="" />
                      </a>
                    </li>
                  </ul>
                </section>
                <!-- //images -->
              </div>
              <!-- //main col -->
              <!-- side col -->
              <div class="col-sm-4">
                <div class="dividor"></div>
                <!-- div class="margin-bottom-3x">
                  <a href="#" class="button green-btn green-btn radiused full-width large-btn text-center">Attend this event</a>
                </div>
                <div class="content margin-bottom-2x">
                    <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                    Sun. 22/10/2016, 10:00 AM - 03:00 PM
                </div>
                <div class="content">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                    Engineers Syndicate / Al-mraij Str. / Nablus
                </div -->
                <div class="dividor"></div>
                <!-- more articles -->
                <div class="more_articles">
                  <!-- block -->
                  <div class="subtitle-uppercase margin-bottom-2x">More News</div>
                  @foreach($latestBlogs as $pos=>$latestBlog)
                  <?php
      $date=date("M, Y,d", strtotime('$latestBlog->date;'));
$fulldate=explode(",",$date);

 ?>
                  <div class="block block--vert margin-bottom-6x">
                    <a href="/blog/view/{{ $latestBlog->id }}" >
                      <div class="block--img_container image-bg">
                        <img src={{$latestBlog->featured_image}} alt="" />
                      </div>
                     
                      <div class="block--more">
                        MORE &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
                      </div>
                      <div class="padding-2x block--content-wrapper">
                        <div class="block--title subtitle">
                         {{$latestBlog->title}}
                        </div>
                        <div class="block--content content">
                          {{ strip_tags(mb_substr($latestBlog->body,0,300,"UTF-8"))}}
                        </div>
                      </div>
                    </a>
                  </div>
                  @endforeach
                  <!-- div class="block block--vert margin-bottom-6x">
                    <a href="#">
                      <div class="block--img_container image-bg">
                        <img src="../../assets/frontend/images/event2.png" alt="" />
                      </div>
                      <div class="block--calendar_date">
                        <div class="block--calendar_date_number">16</div>
                        <div class="">
                          NOV
                        </div>
                      </div>
                      <div class="block--closed">
                        Closed
                      </div>
                      <div class="block--more">
                        MORE &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
                      </div>
                      <div class="padding-2x block--content-wrapper">
                        <div class="block--title subtitle">
                          Contrary to popular belief, Lorem Ipsum is
                        </div>
                        <div class="block--content content">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...
                        </div>
                      </div>
                    </a>
                  </div -->
                  <!-- //block -->
                </div>
                <!-- //more articles -->
              </div>
              <!-- //side col -->
            </div>
          </div>
        </section>
        <!-- //article content -->
      </article>
      <!-- //Article -->
      <div class="dividor"></div>
      <!-- Footer -->
       @stop