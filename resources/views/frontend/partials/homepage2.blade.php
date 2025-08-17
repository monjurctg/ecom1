<main class="main {{ $PageVariation['home_variation'] }}">
	<!-- Home Slider -->
	@if($section1->is_publish == 1)
	<section class="slider-section">
		<div class="home-slider owl-carousel">
			<!-- Slider Item -->
			@foreach ($slider as $row)
			@php $aRow = json_decode($row->desc); @endphp
			<div class="single-slider">
				<div class="slider-screen h1-height" style="background-image: url({{ asset('public/media/'.$row->image) }});">
					<div class="container">
						<div class="row">
							<div class="order-1 col-sm-12 order-sm-1 col-md-6 order-md-0 col-lg-5 order-lg-0">
								<div class="slider-content">
									<h1>{{ $row->title }}</h1>
									@if($aRow->sub_title != '')
									<p class="relative">{{ $aRow->sub_title }}</p>
									@endif

									@if($aRow->button_text != '')
									<a href="{{ $row->url }}" class="btn theme-btn" {{ $aRow->target =='' ? '' : "target=".$aRow->target }}>{{ $aRow->button_text }}</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<!-- /Slider Item/ -->
		</div>
	</section>
	@endif
	<!-- /Home Slider/ -->

	<!-- Featured Categories -->
	@if($section2->is_publish == 1)
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading text-center">
						@if($section2->desc !='')
						<h5>{{ $section2->desc }}</h5>
						@endif

						@if($section2->title !='')
						<h2>{{ $section2->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common featured-categories">
				@foreach ($pro_category as $row)
				<div class="col-lg-12">
					<div class="featured-card">
						<div class="featured-image">
							<a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->thumbnail) }}" alt="{{ $row->name }}" />
							</a>
						</div>
						<div class="featured-title">
							<a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}">{{ $row->name }}</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- for mobile section -->

@if($section2->is_publish == 1)
<section class="category-section">
    <div class="container">
        <div class="section-header">
            @if($section2->desc != '')
            <p class="section-subtitle">{{ $section2->desc }}</p>
            @endif

            @if($section2->title != '')
            <h2 class="section-title">{{ $section2->title }}</h2>
            @endif
        </div>

        <!-- Mobile/Tablet Grid -->
        <div class="categories-grid">
            @foreach ($pro_category as $row)
            <div class="category-card">
                <a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}" class="category-link">
                    <div class="category-img-container">
                        <div class="category-img-wrapper">
                            <img src="{{ asset('public/media/'.$row->thumbnail) }}"
                                 alt="{{ $row->name }}"
                                 class="category-img"
                                 loading="lazy">
                        </div>
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">{{ $row->name }}</h3>
                        <span class="category-cta">Shop Now <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* ======================
   Professional Mobile Category Grid
   ====================== */
.category-section {
    padding: 2rem 0;
    background: #f8f9fa;
}

.section-header {
    text-align: center;
    margin-bottom: 1.5rem;
    padding: 0 1rem;
}

.section-subtitle {
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.section-title {
    color: #212529;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}

/* Grid Layout */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    padding: 0 1rem;
}

.category-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
}

.category-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

.category-link {
    display: flex;
    flex-direction: column;
    height: 100%;
    text-decoration: none;
    color: inherit;
}

.category-img-container {
    position: relative;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    background: #f1f3f5;
}

.category-img-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}

.category-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.category-card:hover .category-img {
    transform: scale(1.05);
}

.category-content {
    padding: 1rem;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.category-title {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #212529;
    margin: 0 0 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 2.8rem;
}

.category-cta {
    font-size: 0.8125rem;
    color: var(--theme-color);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    margin-top: auto;
}

/* Tablet View */
@media (min-width: 576px) {
    .categories-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        padding: 0 1.5rem;
    }

    .category-img-container {
        padding-top: 80%; /* Slightly rectangular */
    }
}

/* Desktop View - Hide completely */
@media (min-width: 992px) {
    .category-section {
        display: none;
    }
}

/* Animation Enhancements */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.category-card {
    animation: fadeIn 0.4s ease forwards;
    opacity: 0;
}

/* Create staggered animation */
@for $i from 1 through 12 {
    .category-card:nth-child(#{$i}) {
        animation-delay: $i * 0.05s;
    }
}
</style>

	<!-- /Featured Categories/ -->

	<!-- Offer Section -->
	@if($section3->is_publish == 1)
	@if(count($offer_ad_position1)>0)
	<section class="section offer-section" style="background-image: url({{ $section3->image ? asset('public/media/'.$section3->image) : '' }});">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading text-center">
						@if($section3->desc !='')
						<h5>{{ $section3->desc }}</h5>
						@endif

						@if($section3->title !='')
						<h2>{{ $section3->title }}</h2>
						@endif
					</div>
				</div>
			</div>

			<div class="row">
				@foreach ($offer_ad_position1 as $row)
				@php $aRow = json_decode($row->desc); @endphp
				<div class="col-lg-4">
					<div class="offer-card" style="background:{{ $aRow->bg_color == '' ? '#daeac5' : $aRow->bg_color }};">
						@if($aRow->text_1 != '')
						<div class="offer-heading">
							<h2>{{ $aRow->text_1 }}</h2>
						</div>
						@endif
						@if($aRow->text_1 != '')
						<div class="offer-body">
							<p>{{ $aRow->text_2 }}</p>
						</div>
						@endif
						<div class="offer-footer">
							@if($aRow->button_text != '')
							<a href="{{ $row->url }}" class="btn theme-btn" {{ $aRow->target =='' ? '' : "target=".$aRow->target }}>{{ $aRow->button_text }}</a>
							@endif
							<div class="offer-image">
								<img src="{{ asset('public/media/'.$row->image) }}" alt="{{ $aRow->text_1 }}" />
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	@endif
	<!-- /Offer Section/ -->

	<!-- New Products -->
	@if($section4->is_publish == 1)
	<section class="section product-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">
						@if($section4->desc !='')
						<h5>{{ $section4->desc }}</h5>
						@endif

						@if($section4->title !='')
						<h2>{{ $section4->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">

				@foreach ($new_products as $row)
				<div class="col-lg-12">
					<div class="item-card">
						<div class="item-image">
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@php
									$discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
								@endphp
							<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
							@endif
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" />
							</a>
						</div>
						<div class="item-title">
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
						</div>
						<div class="rating-wrap">
							<div class="stars-outer">
								<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
							</div>
							<span class="rating-count">({{ $row->TotalReview }})</span>
						</div>
						<div class="item-sold">
							{{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
						</div>
						<div class="item-pric-card">
							@if($row->sale_price != '')
								@if($gtext['currency_position'] == 'left')
								<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
								@else
								<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@if($gtext['currency_position'] == 'left')
								<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
								@else
								<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
						</div>
						<div class="item-card-bottom">
							<a data-id="{{ $row->id }}" href="javascript:void(0);" class="btn add-to-cart addtocart">{{ __('Add To Cart') }}</a>
							<ul class="item-cart-list">
								<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="bi bi-heart"></i></a></li>
								<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i class="bi bi-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- /New Products/ -->

	<!-- Popular Products -->
	@if($section5->is_publish == 1)
	<section class="section product-section" style="background-image: url({{ $section5->image ? asset('public/media/'.$section5->image) : '' }});">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">
						@if($section5->desc !='')
						<h5>{{ $section5->desc }}</h5>
						@endif

						@if($section5->title !='')
						<h2>{{ $section5->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">
				@foreach ($popular_products as $row)
				<div class="col-lg-12">
					<div class="item-card">
						<div class="item-image">
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@php
									$discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
								@endphp
							<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
							@endif
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" />
							</a>
						</div>
						<div class="item-title">
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
						</div>
						<div class="rating-wrap">
							<div class="stars-outer">
								<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
							</div>
							<span class="rating-count">({{ $row->TotalReview }})</span>
						</div>
						<div class="item-sold">
							{{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
						</div>
						<div class="item-pric-card">
							@if($row->sale_price != '')
								@if($gtext['currency_position'] == 'left')
								<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
								@else
								<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@if($gtext['currency_position'] == 'left')
								<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
								@else
								<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
						</div>
						<div class="item-card-bottom">
							<a data-id="{{ $row->id }}" href="javascript:void(0);" class="btn add-to-cart addtocart">{{ __('Add To Cart') }}</a>
							<ul class="item-cart-list">
								<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="bi bi-heart"></i></a></li>
								<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i class="bi bi-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- /Popular Products/ -->

	<!-- Top Selling Products -->
	@if($section6->is_publish == 1)
	<section class="section product-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">
						@if($section6->desc !='')
						<h5>{{ $section6->desc }}</h5>
						@endif

						@if($section6->title !='')
						<h2>{{ $section6->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">
				@foreach ($top_selling as $row)
				<div class="col-lg-12">
					<div class="item-card">
						<div class="item-image">
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@php
									$discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
								@endphp
							<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
							@endif
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" />
							</a>
						</div>
						<div class="item-title">
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
						</div>
						<div class="rating-wrap">
							<div class="stars-outer">
								<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
							</div>
							<span class="rating-count">({{ $row->TotalReview }})</span>
						</div>
						<div class="item-sold">
							{{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
						</div>
						<div class="item-pric-card">
							@if($row->sale_price != '')
								@if($gtext['currency_position'] == 'left')
								<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
								@else
								<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@if($gtext['currency_position'] == 'left')
								<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
								@else
								<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
						</div>
						<div class="item-card-bottom">
							<a data-id="{{ $row->id }}" href="javascript:void(0);" class="btn add-to-cart addtocart">{{ __('Add To Cart') }}</a>
							<ul class="item-cart-list">
								<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="bi bi-heart"></i></a></li>
								<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i class="bi bi-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- /Top Selling Products/ -->

	<!-- Trending Products -->
	@if($section8->is_publish == 1)
	<section class="section product-section" style="background-image: url({{ $section8->image ? asset('public/media/'.$section8->image) : '' }});">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">
						@if($section8->desc !='')
						<h5>{{ $section8->desc }}</h5>
						@endif

						@if($section8->title !='')
						<h2>{{ $section8->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">
				@foreach ($trending_products as $row)
				<div class="col-lg-12">
					<div class="item-card">
						<div class="item-image">
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@php
									$discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
								@endphp
							<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
							@endif
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" />
							</a>
						</div>
						<div class="item-title">
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
						</div>
						<div class="rating-wrap">
							<div class="stars-outer">
								<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
							</div>
							<span class="rating-count">({{ $row->TotalReview }})</span>
						</div>
						<div class="item-sold">
							{{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
						</div>
						<div class="item-pric-card">
							@if($row->sale_price != '')
								@if($gtext['currency_position'] == 'left')
								<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
								@else
								<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@if($gtext['currency_position'] == 'left')
								<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
								@else
								<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
						</div>
						<div class="item-card-bottom">
							<a data-id="{{ $row->id }}" href="javascript:void(0);" class="btn add-to-cart addtocart">{{ __('Add To Cart') }}</a>
							<ul class="item-cart-list">
								<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="bi bi-heart"></i></a></li>
								<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i class="bi bi-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- /Trending Products/ -->

	<!-- Top Rated Products -->
	@if($section9->is_publish == 1)
	<section class="section product-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">
						@if($section9->desc !='')
						<h5>{{ $section9->desc }}</h5>
						@endif

						@if($section9->title !='')
						<h2>{{ $section9->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">
				@foreach ($top_rated as $row)
				<div class="col-lg-12">
					<div class="item-card">
						<div class="item-image">
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@php
									$discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
								@endphp
							<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
							@endif
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" />
							</a>
						</div>
						<div class="item-title">
							<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
						</div>
						<div class="rating-wrap">
							<div class="stars-outer">
								<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
							</div>
							<span class="rating-count">({{ $row->TotalReview }})</span>
						</div>
						<div class="item-sold">
							{{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
						</div>
						<div class="item-pric-card">
							@if($row->sale_price != '')
								@if($gtext['currency_position'] == 'left')
								<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
								@else
								<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@if($gtext['currency_position'] == 'left')
								<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
								@else
								<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
								@endif
							@endif
						</div>
						<div class="item-card-bottom">
							<a data-id="{{ $row->id }}" href="javascript:void(0);" class="btn add-to-cart addtocart">{{ __('Add To Cart') }}</a>
							<ul class="item-cart-list">
								<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="bi bi-heart"></i></a></li>
								<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i class="bi bi-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- /Top Rated Products/ -->

	<!-- Video Section -->
	@if($home_video['is_publish'] == 1)
	<section class="section video-section" style="background-image: url({{ asset('public/media/'.$home_video['image']) }});">
		<div class="container">
			<div class="row justify-content-start">
				<div class="col-xl-7 text-center">
					<div class="video-card">
						<a href="{{ $home_video['video_url'] }}" class="play-icon popup-video">
							<i class="bi bi-play-fill"></i>
						</a>
					</div>
				</div>
				<div class="col-xl-5">
					<div class="video-desc">
						<h1>{{ $home_video['title'] }}</h1>
						@if($home_video['short_desc'] !='')
						<p>{{ $home_video['short_desc'] }}</p>
						@endif
						<a href="{{ $home_video['url'] }}" {{ $home_video['target'] =='' ? '' : "target=".$home_video['target'] }} class="btn theme-btn">{{ $home_video['button_text'] }}</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	<!-- /Video Section/ -->

	<!-- Deals Section -->
	@if($section10->is_publish == 1)
	<section class="section deals-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">
						@if($section10->desc !='')
						<h5>{{ $section10->desc }}</h5>
						@endif

						@if($section10->title !='')
						<h2>{{ $section10->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				@if(count($offer_ad_position2)>0)
				<div class="order-1 col-sm-12 order-sm-1 col-md-4 order-md-1 col-lg-3 order-lg-0">
					@foreach ($offer_ad_position2 as $row)
					@php $aRow = json_decode($row->desc); @endphp
					<div class="deals-card" style="background:{{ $aRow->bg_color == '' ? '#d7eabf' : $aRow->bg_color }};">
						<img src="{{ asset('public/media/'.$row->image) }}" alt="{{ $aRow->text_1 }}" />
						@if($aRow->text_1 != '')
						<div class="deals-desc">{{ $aRow->text_1 }}</div>
						@endif
						<div class="deals-bottom">
							@if($aRow->button_text != '')
							<a href="{{ $row->url }}" class="btn theme-btn" {{ $aRow->target =='' ? '' : "target=".$aRow->target }}>{{ $aRow->button_text }}</a>
							@endif
						</div>
					</div>
					@endforeach
				</div>
				<div class="order-0 col-sm-12 order-sm-0 col-md-8 order-md-0 col-lg-9 order-lg-1">
				@else
				<div class="order-0 col-sm-12 order-sm-0 col-md-12 order-md-0 col-lg-12 order-lg-1">
				@endif
					<div class="row owl-carousel caro-common deals-carousel">
						@foreach ($deals_products as $row)
						<div class="col-lg-12">
							<div class="item-card">
								<div class="item-image">
									@if(($row->is_discount == 1) && ($row->old_price !=''))
										@php
											$discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
										@endphp
									<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
									@endif
									<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
										<img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" />
									</a>
									@if(($row->is_discount == 1) && ($row->end_date !=''))
									<div class="deals-countdown-card">
										<div data-countdown="{{ date('Y/m/d', strtotime($row->end_date)) }}" class="deals-countdown"></div>
									</div>
									@endif
								</div>
								<div class="item-title">
									<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
								</div>
								<div class="rating-wrap">
									<div class="stars-outer">
										<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
									</div>
									<span class="rating-count">({{ $row->TotalReview }})</span>
								</div>
								<div class="item-sold">
									{{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
								</div>
								<div class="item-pric-card">
									@if($row->sale_price != '')
										@if($gtext['currency_position'] == 'left')
										<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
										@else
										<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
										@endif
									@endif
									@if(($row->is_discount == 1) && ($row->old_price !=''))
										@if($gtext['currency_position'] == 'left')
										<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
										@else
										<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
										@endif
									@endif
								</div>
								<div class="item-card-bottom">
									<a data-id="{{ $row->id }}" href="javascript:void(0);" class="btn add-to-cart addtocart">{{ __('Add To Cart') }}</a>
									<ul class="item-cart-list">
										<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="bi bi-heart"></i></a></li>
										<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i class="bi bi-eye"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	<!-- /Deals Section/ -->
</main>