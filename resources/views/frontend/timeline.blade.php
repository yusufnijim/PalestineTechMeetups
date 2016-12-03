@extends ("layout/frontend")
@section("content")
        <!-- timeline -->
        <section class="timeline-container">
            <div class="dividor"></div>
            <div class="text-center">
              <h1 class="title-uppercase">Events</h1>
              <h3 class="subtitle-uppercase">Join our amazing community by attending one of our events</h3>
            </div>
            <div class="dividor"></div>
            <div class="container">
                <ul class="timeline">
                @foreach($events as $pos=>$event)
      <!-- block -->
       
      
      <?php
      $date=date("M, Y,d", strtotime('$event->date;'));
$fulldate=explode(",",$date);?>
                  <li class="timeline--item">
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
                        @if(!($event->is_registration_open))
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
                  </li>
              
          @endforeach
                  <!-- //timeline--item -->
                  
                  <!-- //timeline--item -->
                </ul>
                <!-- //timeline -->
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