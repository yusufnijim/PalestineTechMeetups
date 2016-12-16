   <section class="footer">
        <div class="top-footer">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <div class="footer--subscribe">
                  <span class="footer--input envelop">
                    <input type="text" class="" placeholder=  {{trans('frontend/index.Newsletter') }}/>
                  </span>
                  <button type="button" class="button green-btn">
                  {{trans('frontend/index.Subscribe') }}
                  </button>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="footer--social_links">
                  <ul>
                    <li>
                      <a class="footer--social_links-facebook" href="#">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                      <a class="footer--social_links-twitter" href="#">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                      <a class="footer--social_links-youtube" href="#">
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bottom-footer">
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                <div class="footer--logo">
                  <div class="margin-bottom-3x">
                    <img src="{{url('assets/frontend/images/logo-light.png')}}" class="full-width " alt="" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4 hidden-xs">
                <ul class="footer--links">
                  <li><a href="#">{{trans('frontend/index.Programs') }}</a></li>
                  <li><a href="/news">{{trans('frontend/index.News') }}</a></li>
                  <li><a href="/timeline">{{ trans('frontend/index.Events') }}</a></li>
                  <li><a href="#">{{ trans('frontend/index.Team') }}</a></li>
                  <li><a href="/about">{{trans('frontend/index.About') }}</a></li>
                  <li><a href="#">{{trans('frontend/index.Contact') }}</a></li>
                </ul>
              </div>
              <div class="col-sm-4">

                <div class="footer--contact">
                  <div class="footer--input name full-width margin-bottom-2x">
                    <input type="text" class="full-width" placeholder="{{trans('frontend/index.Name') }}">
                  </div>
                  <div class="footer--input envelop full-width margin-bottom-2x">
                    <input type="text" class="full-width" placeholder= {{trans('frontend/index.Email') }}>
                  </div>
                  <div class="footer--input message full-width margin-bottom-2x">
                    <textarea class="full-width" placeholder=  {{trans('frontend/index.Message') }}></textarea>
                  </div>
                  <div class="footer--contact_button">
                    <button type="button" class="button green-btn large-btn">
                        {{trans('frontend/index.Send') }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer--legal">
            Copyright (c) 2016 Palestine Technical Meetups All Rights Reserved.
          </div>
        </div>
      </section>
