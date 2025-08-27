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
	<section class="section d-none d-md-block">
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
        <div class="section-heading text-center">
            @if($section2->desc != '')
            <h5 class="section-subtitle">{{ $section2->desc }}</h5>
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
                        <div class="category-overlay"></div>
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">{{ $row->name }}</h3>
                       
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* ======================
   Enhanced Professional Category Grid
   ====================== */
.category-section {
    padding: 2.5rem 0;
    background: linear-gradient(180deg, #f9fafb 0%, #ffffff 100%);
}

.section-heading {
    margin-bottom: 2.5rem;
    padding: 0 1rem;
}

.section-subtitle {
    color: var(--theme-color);
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 0.75rem;
    display: block;
}

.section-title {
    color: #1f2937;
    font-size: 1.123rem;
    font-weight: 700;
    position: relative;
    padding-bottom: 0.888rem;
    margin-bottom: 0;
    line-height: 1.3;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--theme-color);
    border-radius: 2px;
}

/* Grid Layout - 3 columns for mobile */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.8rem;
    padding: 0 0.8rem;
    max-width: 1200px;
    margin: 0 auto;
}

.category-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
    position: relative;
}

.category-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
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
    background: #f8fafc;
    overflow: hidden;
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
    padding: 1rem;
    z-index: 2;
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(0deg, rgba(0,0,0,0.02) 0%, rgba(0,0,0,0) 100%);
    z-index: 1;
    transition: all 0.3s ease;
}

.category-card:hover .category-overlay {
    background: linear-gradient(0deg, rgba(0,0,0,0.04) 0%, rgba(0,0,0,0) 100%);
}

.category-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: all 0.3s ease;
}

.category-card:hover .category-img {
    transform: scale(1.06);
}

.category-content {
    padding: 0.9rem 0.5rem 1rem;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.category-title {
    font-size: 0.7525rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    
}

.category-cta {
    font-size: 0.75rem;
    color: var(--theme-color);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.2rem;
    transition: all 0.3s ease;
    margin-top: auto;
}

.category-cta i {
    transition: transform 0.3s ease;
}

.category-card:hover .category-cta i {
    transform: translateX(2px);
}

/* Very small mobile devices */
@media (max-width: 340px) {
    .categories-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.7rem;
        padding: 0 0.7rem;
    }
    
    .category-title {
        font-size: 0.75rem;
    }
}

/* Small mobile devices */
@media (min-width: 341px) and (max-width: 380px) {
    .categories-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 0.6rem;
        padding: 0 0.6rem;
    }
    
    .category-title {
        font-size: 0.75rem;
    }
    
    .category-content {
        padding: 0.7rem 0.4rem 0.8rem;
    }
}

/* Standard mobile devices */
@media (min-width: 381px) and (max-width: 480px) {
    .categories-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
        padding: 0 0.8rem;
    }
}

/* Larger mobile devices */
@media (min-width: 481px) and (max-width: 575px) {
    .categories-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 0.9rem;
        padding: 0 0.9rem;
    }
    
    .category-title {
        font-size: 0.7525rem;
    }
}

/* Tablet View */
@media (min-width: 576px) and (max-width: 767px) {
    .categories-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        padding: 0 1rem;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
    
    .category-content {
        padding: 1rem 0.5rem 1.1rem;
    }
    
    .category-title {
        font-size: 0.7525rem;
    }
}

/* Small Desktop View */
@media (min-width: 768px) and (max-width: 991px) {
    .categories-grid {
        grid-template-columns: repeat(5, 1fr);
        gap: 1.1rem;
    }
}

/* Desktop View - Hide completely */
@media (min-width: 992px) {
    .category-section {
        display: none;
    }
}

/* Animation Enhancements */
@keyframes fadeInUp {
    from { 
        opacity: 0; 
        transform: translateY(10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.category-card {
    animation: fadeInUp 0.4s ease forwards;
    opacity: 0;
}

/* Manual staggered animation delays */
.category-card:nth-child(1) { animation-delay: 0.05s; }
.category-card:nth-child(2) { animation-delay: 0.1s; }
.category-card:nth-child(3) { animation-delay: 0.15s; }
.category-card:nth-child(4) { animation-delay: 0.2s; }
.category-card:nth-child(5) { animation-delay: 0.25s; }
.category-card:nth-child(6) { animation-delay: 0.3s; }
.category-card:nth-child(7) { animation-delay: 0.35s; }
.category-card:nth-child(8) { animation-delay: 0.4s; }
.category-card:nth-child(9) { animation-delay: 0.45s; }
.category-card:nth-child(10) { animation-delay: 0.5s; }
.category-card:nth-child(11) { animation-delay: 0.55s; }
.category-card:nth-child(12) { animation-delay: 0.6s; }

/* Focus states for accessibility */
.category-link:focus {
    outline: 2px solid var(--theme-color);
    outline-offset: 2px;
    border-radius: 12px;
}
</style>
@endif
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
<section class="modern-product-section">
    <div class="container">
        <div class="section-header">
            @if($section4->desc != '')
            <p class="section-subtitle">{{ $section4->desc }}</p>
            @endif

            @if($section4->title != '')
            <h2 class="section-title">{{ $section4->title }}</h2>
            @endif
        </div>

        <div class="products-grid">
            @foreach ($new_products as $row)
            <div class="product-card">
                <div class="product-badge">
                    @if(($row->is_discount == 1) && ($row->old_price != ''))
                        @php
                            $discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
                        @endphp
                    <span class="discount-badge">{{ $discount }}% {{ __('Off') }}</span>
                    @endif
                </div>
                
                <div class="product-image">
                    <a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
                        <img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" loading="lazy" />
                    </a>
                    <button class="wishlist-btn addtowishlist" data-id="{{ $row->id }}" aria-label="Add to wishlist">
                        <i class="bi bi-heart"></i>
                    </button>
                </div>
                
                <div class="product-info">
                    <div class="product-vendor">
                        {{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
                    </div>
                    
                    <h3 class="product-title">
                        <a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
                    </h3>
                    
                    <div class="product-rating">
                        <div class="stars-outer">
                            <div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
                        </div>
                        <span class="rating-count">({{ $row->TotalReview }})</span>
                    </div>
                    
                    <div class="product-price">
                        @if($row->sale_price != '')
                            @if($gtext['currency_position'] == 'left')
                            <div class="current-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
                            @else
                            <div class="current-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
                            @endif
                        @endif
                        
                        @if(($row->is_discount == 1) && ($row->old_price != ''))
                            @if($gtext['currency_position'] == 'left')
                            <div class="original-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
                            @else
                            <div class="original-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
                            @endif
                        @endif
                    </div>
                    
                    <div class="product-actions">
                        <a data-id="{{ $row->id }}" href="javascript:void(0);" class="add-to-cart-btn addtocart">
                            <i class="bi bi-cart-plus"></i> {{ __('Add To Cart') }}
                        </a>
                        <a href="{{ route('frontend.product', [$row->id, $row->slug]) }}" class="view-details-btn" aria-label="View product details">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Modern Product Section Styles */
.modern-product-section {
    padding: 3rem 0;
    background: #fafafa;
}

.section-header {
    text-align: center;
    margin-bottom: 2.5rem;
    padding: 0 1rem;
}

.section-subtitle {
    color: var(--theme-color);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.75rem;
    display: block;
}

.section-title {
    color: #1a1a1a;
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    padding-bottom: 1rem;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--theme-color);
    border-radius: 2px;
}

/* Products Grid - 2 columns on mobile */
.products-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    padding: 0 1rem;
    max-width: 1200px;
    margin: 0 auto;
}

.product-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.product-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 2;
}

.discount-badge {
    background: #ff4444;
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    display: inline-block;
}

.product-image {
    position: relative;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    background: #f8f9fa;
    overflow: hidden;
}

.product-image a {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.product-image img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.4s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.wishlist-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
}

.wishlist-btn:hover {
    background: #fff;
    color: #ff4444;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.product-info {
    padding: 1rem;
}

.product-vendor {
    font-size: 0.75rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.product-vendor a {
    color: #495057;
    text-decoration: none;
    font-weight: 500;
}

.product-vendor a:hover {
    color: var(--theme-color);
}

.product-title {
    margin: 0 0 0.75rem;
    font-size: 0.9375rem;
    font-weight: 600;
    line-height: 1.4;
}

.product-title a {
    color: #1a1a1a;
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-title a:hover {
    color: var(--theme-color);
}

.product-rating {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
}

.stars-outer {
    position: relative;
    display: inline-block;
    font-size: 0.875rem;
}

.stars-outer::before {
    content: "★★★★★";
    color: #e0e0e0;
}

.stars-inner {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    overflow: hidden;
    width: 0;
}

.stars-inner::before {
    content: "★★★★★";
    color: #ffc107;
}

.rating-count {
    font-size: 0.75rem;
    color: #6c757d;
    margin-left: 0.5rem;
}

.product-price {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.current-price {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
}

.original-price {
    font-size: 0.875rem;
    color: #6c757d;
    text-decoration: line-through;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}

.add-to-cart-btn {
    flex: 1;
    background: var(--theme-color);
    color: white;
    border: none;
    border-radius: 6px;
    padding: 0.6rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    text-decoration: none;
}

.add-to-cart-btn:hover {
    background: var(--theme-color-dark);
    transform: translateY(-2px);
}

.view-details-btn {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    background: #f8f9fa;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.view-details-btn:hover {
    background: #e9ecef;
    color: var(--theme-color);
}

/* Tablet View */
@media (min-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        padding: 0 1.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

/* Desktop View */
@media (min-width: 992px) {
    .products-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 1.75rem;
    }
    
    .modern-product-section {
        padding: 4rem 0;
    }
}

/* Small mobile devices */
@media (max-width: 360px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
        padding: 0 0.8rem;
    }
    
    .product-info {
        padding: 0.75rem;
    }
    
    .product-title {
        font-size: 0.875rem;
    }
    
    .add-to-cart-btn {
        font-size: 0.8125rem;
        padding: 0.5rem;
    }
}

/* Animation Enhancements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.product-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

/* Staggered animation delays */
.product-card:nth-child(1) { animation-delay: 0.05s; }
.product-card:nth-child(2) { animation-delay: 0.1s; }
.product-card:nth-child(3) { animation-delay: 0.15s; }
.product-card:nth-child(4) { animation-delay: 0.2s; }
.product-card:nth-child(5) { animation-delay: 0.25s; }
.product-card:nth-child(6) { animation-delay: 0.3s; }
.product-card:nth-child(7) { animation-delay: 0.35s; }
.product-card:nth-child(8) { animation-delay: 0.4s; }
.product-card:nth-child(9) { animation-delay: 0.45s; }
.product-card:nth-child(10) { animation-delay: 0.5s; }
.product-card:nth-child(11) { animation-delay: 0.55s; }
.product-card:nth-child(12) { animation-delay: 0.6s; }
</style>
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