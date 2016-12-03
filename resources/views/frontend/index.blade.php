@extends ("layout/frontend")

@section("content")
	{{ trans('frontend/index.Welcome') }}

<!-- youtube -->

<div class="container">
  <div class="row">
    <div class="col-sm-12">
   <!-- div class="row">
  <div class="col-sm-10 col-sm-offset-1" -->
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3zGxmcqXRCk"></iframe>


    <!-- /div -->
    </div>

</div>
    </div>

  </div>
</div>

<!-- end of youtube -->
   <div class="container">
 <h2 class="text-center" >Programs (ana jaybeh al events )</h2>
	<div class="row">
	@foreach($events as $event)
		

<section class="col-sm-4">
  <img src="{{ $event->featured_image }}"  class="img-responsive center-block"
	alt="Dr Winthrop Photo">
  <a href="/registration/signup/{{$event->id}}"><h3 class="text-center" >{{ $event->title }}</h3> </a>

  <!-- monthly meetups , hands-on , others -->
</section>

	@endforeach
</div></div>
   <div class="container">
 <h2 class="text-center" >Events</h2>
	<div class="row">
	@foreach($events as $event)
		

<section class="col-sm-4">
  <img src="{{ $event->featured_image }}"  class="img-responsive center-block"
	alt="Dr Winthrop Photo">
  <a href="/registration/signup/{{$event->id}}"><h3 class="text-center" >{{ $event->title }}</h3> </a>

  <!-- monthly meetups , hands-on , others -->
</section>

	@endforeach
  </div></div>

  
<!-- home about -->
<h2 class="text-center" >About US</h2>
<div class="container">
  <div class="row">
	<section class="col-sm-6">



<p>Wisdom Pet Medicine strives to blend the best in traditional and alternative medicine in the diagnosis and treatment of companion animals including dogs, cats, birds, reptiles, rodents, and fish. We apply the wisdom garnered in the centuries old tradition of veterinary medicine, to find the safest treatments and cures.</p>





	</section>
	 <section class="col-sm-6">


<p>Wisdom Pet Medicine strives to blend the best in traditional and alternative medicine in the diagnosis and treatment of companion animals including dogs, cats, birds, reptiles, rodents, and fish. We apply the wisdom garnered in the centuries old tradition of veterinary medicine, to find the safest treatments and cures.</p>



	</section>
  </div><!-- row -->
</div><!-- content container -->
<!-- end of About -->

</div><!-- row -->
</div><!-- content container -->


<!-- end of home about -->
<!-- team slider -->


<h2 class="text-center" >Team</h2>
<div class="container">
  <div class="row">
<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden; visibility: hidden;">
		<!-- Loading Screen -->
		<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
			<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
			<div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
		</div>
		<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">
			<div style="display: none;">
				<img data-u="image" src="img/005.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/006.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/011.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/013.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/014.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/019.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/020.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/021.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/022.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/024.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/025.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/027.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/029.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/030.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/031.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/030.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/034.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/038.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/039.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/043.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/044.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/047.jpg" />
			</div>
			<div style="display: none;">
				<img data-u="image" src="img/050.jpg" />
			</div>
			<a data-u="add" href="http://www.jssor.com" style="display:none">Jssor Slider</a>
		
		</div>
		<!-- Bullet Navigator -->
		<div data-u="navigator" class="jssorb03" style="bottom:10px;right:10px;">
			<!-- bullet navigator item prototype -->
			<div data-u="prototype" style="width:21px;height:21px;">
				<div data-u="numbertemplate"></div>
			</div>
		</div>
		<!-- Arrow Navigator -->
		<span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
		<span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
	</div>
	<script>
		jssor_1_slider_init();
	</script>

	<!-- #endregion Jssor Slider End -->
  
  
  </div>
  
  </div>

  <!-- end of team slider -->
<!-- end of team slider -->
@include('partial/_footer')


@endsection