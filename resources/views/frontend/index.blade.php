@extends ("layout/frontend")

@section("content")

<!-- div id="wrapper" -->
      <!-- //Header and nav -->
      <!-- slider and carousel -->
      @include('partial/_index_slider')
      <!-- //slider and carousel -->
<div class="dividor"></div>
      <!-- About -->
      <section class="about">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <h2 class="title-uppercase text-center margin-bottom-4x">About</h2>
              <div class="content text-justify">
         
              {{$aboutus}}
               
              </div>
              <div class="text-center margin-top-4x">
                <a class="button large-btn green-btn radiused" href="/about">Read More About Us</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- //About -->
      <div class="dividor"></div>
      <!-- Programs -->
      <section class="programs backgrounded-section">
        <div class="container-fluid">
          <h2 class="title-uppercase text-center margin-bottom-6x">Programs</h2>
          <div class="row text-center">
            <div class="col-sm-4">
              <div class="f45 purple">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <div class="subtitle-uppercase ">
                Monthly Meetups
              </div>
              <div class="content text-justify padding-4x">
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College... <a href="#">more</a>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="f45 purple">
                <i class="fa fa-cogs" aria-hidden="true"></i>
              </div>
              <div class="subtitle-uppercase ">
                Hands-on
              </div>
              <div class="content text-justify padding-4x">
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College... <a href="/handson">more</a>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="f45 purple">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
              </div>
              <div class="subtitle-uppercase ">
                More Awesomeness
              </div>
              <div class="content text-justify padding-4x">
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College... <a href="#">more</a>
              </div>
            </div>
          </div>
        </div>
      </section>
        <!-- //Programs -->
        <div class="dividor"></div>
      <!-- Events -->
      <section class="events">
        <div class="container">
          <h2 class="title-uppercase text-center margin-bottom-6x">Events</h2>
          <div class="row">
          
      @foreach($events as $pos=>$event)
         <?php
      $date=date("M, Y,d", strtotime('$event->date;'));
$fulldate=explode(",",$date);

 ?>
      <!-- block -->
        @if($pos==0)
         <div class="col-sm-6">
   
              <div class="block block--vert">
                <a href="/registration/signup/{{ $event->id }}">
                  <div class="block--img_container image-bg">
                    <img src="{{ $event->featured_image }}" alt="" />
                  </div>
                  <div class="block--calendar_date">
                    <div class="block--calendar_date_number">{{$fulldate[2]}}</div>
                    <div class="">
                      {{$fulldate[0]}}
                    </div>
                  </div>
                  @if($event->is_registration_open)
                        <div class="block--open">
                          Open
                        </div>
            
                        @else
                         <div class="block--closed">
                         Closed
                         </div>
                           @endif
                  <div class="block--more">
                    MORE &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
                  </div>
                  <div class="padding-2x block--content-wrapper">
                    <div class="block--title subtitle">
                   {{ $event->title }}
                    </div>
                    <div class="block--content content">
{{ strip_tags(mb_substr($event->body,0,300,"UTF-8"))}}
                    </div>
                  </div>
                </a>
              </div>
                 </div>
              @endif
      @if($pos>0)
      @if($pos==1)<div class="col-sm-6"> @endif
      

              <div class="block block--hori">
                <a href="/registration/signup/{{ $event->id }}">
                  <div class="block--img_container image-bg">
                    <img src="{{ $event->featured_image }}" alt="" />
                  </div>
                  <div class="block--calendar_date">

                    <div class="block--calendar_date_number">{{$fulldate[2]}}</div>
                    <div class="">
                      {{$fulldate[0]}}
                    </div>
                  </div>
                  @if($event->is_registration_open)
                        <div class="block--open">
                          Open
                        </div>
            
                        @else
                         <div class="block--closed">
                         Closed
                         </div>
                           @endif
                  <div class="block--more">
                    MORE &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
                  </div>
                  <div class="block--content-wrapper padding-2x">
                    <div class="block--title subtitle">
                    {{ $event->title }}
                    </div>
                    <div class="block--content content">
                    {{ strip_tags(mb_substr($event->body,0,300,"UTF-8"))}}
                    </div>
                  </div>
                </a>
              </div>
                <div class="dividor"></div>
              <!-- //block -->
          
    @endif
   
     
          @endforeach
          </div>
          </div>
          
          <div class="more-btn-cont">
            <a class="green-btn button radiused" href="/timeline">
              More Events
              &nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
      <!-- //Events -->
      <div class="dividor"></div>
      <!-- news -->
      <section class="news backgrounded-section">
        <div class="container">
          <h2 class="title-uppercase text-center margin-bottom-6x">News</h2>
          <div class="row">
         
             @foreach($blogs as $pos=>$blog)

<div class="col-sm-6 margin-bottom-6x">
              <!-- block -->
              <div class="block block--hori">
                <a href="/blog/view/{{ $blog->id }}">
                  <div class="block--img_container image-bg">
                    <img src=" {{$blog->featured_image}}" alt="" />
                  </div>
                  <div class="block--more">
                    MORE &nbsp;<i class="fa fa-chevron-circle-right purple fa-lg" aria-hidden="true"></i>
                  </div>
                  <div class="block--content-wrapper padding-2x">
                    <div class="block--title subtitle">
                    {{$blog->title}}
                    </div>
                    <div class="block--content content">
                  
{{ strip_tags(mb_substr($blog->body,0,300,"UTF-8"))}}

                    </div>
                  </div>
                </a>
              </div>
              <!-- //block -->
            </div>

             @endforeach
           
          </div>
          <div class="more-btn-cont margin-bottom-4x">
            <a class="green-btn button radiused" href="/news">
              More News &nbsp;
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
      <!-- //News -->
       <div class="dividor"></div>
      <!-- Thank you -->
      <section class="thanks">
        <div class="container">
          <h2 class="title-uppercase text-center margin-bottom-3x">Well Done!</h2>
          <h2 class="subtitle-uppercase text-center margin-bottom-6x">Thanks to our awesome volunteers for the amazing work</h2>
          <div class="row">
            <div class="col-sm-12">
              <ul class="team">
                <li>
                  <div class="team--member">
                    <div class="team--member_img image-bg">
                      <img src="assets/frontend/images/team1.jpg" alt="" />
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
                      <img src="assets/frontend/images/team2.jpg" alt="" />
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
                      <img src="assets/frontend/images/team3.jpg" alt="" />
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
                      <img src="assets/frontend/images/team1.jpg" alt="" />
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
                      <img src="assets/frontend/images/team2.jpg" alt="" />
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
          </div>
        </div>
      </section>
      <!-- //Thank you -->
<div class="dividor"></div>
      
 
@endsection


<!--
@section("content")
    {{ trans('frontend/index.Welcome') }}

    <h2>Events</h2>
    <hr/>
    @foreach($events as $event)
        <h3>{{ $event->title }}</h3>
        <img src="{{ $event->featured_image }}" class='event-image' />
        {!! $event->summary  !!}<br/>
        <a href="/registration/signup/{{$event->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <h2>Blogs</h2>
    <hr/>

    @foreach($blogs as $blog)
        <h3>{{ $blog->title }}</h3>
        <img src="{{ $blog->featured_image }}" class='blog-image' />

        {!! $blog->summary  !!}<br/>

        <a href="/blog/view/{{$blog->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <hr/>


@endsection