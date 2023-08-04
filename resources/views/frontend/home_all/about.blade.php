<!--for dynamic title-->
@section('title')

About | Blog website
    
@endsection 

@php
    use App\Models\About;
    use App\Models\MultiImage;
    $about = About::find(1);
    $get_image = MultiImage::orderBy('multi_image', 'ASC')->get();
@endphp
    
    
    <!-- about-area -->
    <section id="aboutSection" class="about">
        <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-6">
        <ul class="about__icons__wrap">
            @foreach ($get_image as $item)
                
           
        <li>    
        <img class="light" src="{{url($item->multi_image)}}" alt="XD">
        </li>
        @endforeach
        </ul>
        </div>
        <div class="col-lg-6">
        <div class="about__content">
        <div class="section__title">
        <span class="sub-title">01 - About me</span>
        <h2 class="title">{{$about->title}}</h2>
        </div>
        <div class="about__exp">
        <div class="about__exp__icon">
        <img src="{{asset('frontend/assets/img/icons/about_icon.png')}}" alt="">
        </div>
        <div class="about__exp__content">
        <p>{{$about->short_title}}</p>
        </div>
        </div>
        <p class="desc">{{$about->short_desc}}</p>
        <a href="{{route('about_details.page')}}" class="btn">Read More</a>
        </div>
        </div>
        </div>
        </div>
        </section>
        <!-- about-area-end -->