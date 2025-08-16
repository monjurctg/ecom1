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
                @if($section2->desc !='')
                <p class="section-subtitle">{{ $section2->desc }}</p>
                @endif

                @if($section2->title !='')
                <h2 class="section-title">{{ $section2->title }}</h2>
                @endif
            </div>

            <!-- Mobile/Tablet Grid Only -->
            <div class="categories-grid">
                @foreach ($pro_category as $row)
                <div class="category-item">
                    <a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}" class="category-link">
                        <div class="category-img-container">
                            <img src="{{ asset('public/media/'.$row->thumbnail) }}"
                                 alt="{{ $row->name }}"
                                 class="category-img"
                                 loading="lazy">
                        </div>
                        <h3 class="category-title">{{ $row->name }}</h3>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
    /* ======================
       Mobile/Tablet Category Grid Only
       ====================== */
    .category-section {
        padding: 30px 0;
        background: #f9f9f9;
    }

    .section-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-subtitle {
        color: #666;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .section-title {
        color: #333;
        font-size: 22px;
        font-weight: 600;
    }

    /* Grid Layout */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .category-item {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s ease;
    }

    .category-item:active {
        transform: scale(0.98);
    }

    .category-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .category-img-container {
        padding: 15px;
        text-align: center;
        background: #f5f5f5;
    }

    .category-img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .category-title {
        padding: 12px 8px;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        margin: 0;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Responsive Adjustments */
    @media (max-width: 575px) {
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .category-img-container {
            padding: 12px;
        }

        .category-img {
            width: 45px;
            height: 45px;
        }
    }

    @media (min-width: 992px) {
        .categories-grid {
            display: none; /* Hide completely on desktop */
        }

        .category-section {
            padding: 0;
            background: transparent;
        }
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
				<div class="product-card">
    <!-- Discount Badge -->
    @if($row->is_discount == 1 && $row->old_price != '')
        @php
            $discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
        @endphp
        <span class="discount-badge">{{ $discount }}% {{ __('Off') }}</span>
    @endif

    <!-- Product Image -->
    <div class="product-image">
        <a href="{{ route('frontend.product', ['id' => $row->id, 'slug' => $row->slug ?? Str::slug($row->title)]) }}">
            <img src="{{ asset('storage/'.$row->f_thumbnail) }}"
                 alt="{{ $row->title }}"
                 class="product-img"
                 loading="lazy">
        </a>
    </div>

    <!-- Product Content -->
    <div class="product-content">
        <!-- Title -->
        <h3 class="product-title">
            <a href="{{ route('frontend.product', ['id' => $row->id, 'slug' => $row->slug ?? Str::slug($row->title)]) }}">
                {{ \Illuminate\Support\Str::limit($row->title, 50) }}
            </a>
        </h3>

        <!-- Rating -->
        <div class="product-rating">
            <div class="stars" style="--rating: {{ $row->ReviewPercentage / 20 }};"></div>
            <span class="rating-count">({{ $row->TotalReview }})</span>
        </div>

        <!-- Seller -->
        <div class="product-seller">
            {{ __('Sold By') }}
            <a href="{{ route('frontend.stores', ['id' => $row->seller_id, 'shop' => Str::slug($row->shop_url ?? $row->shop_name)]) }}" class="seller-link">
                {{ \Illuminate\Support\Str::limit($row->shop_name, 20) }}
            </a>
        </div>

        <!-- Price -->
        <div class="product-pricing">
            @if($row->sale_price != '')
                <div class="current-price">
                    {{ $gtext['currency_position'] == 'left' ? $gtext['currency_icon'] : '' }}
                    {{ NumberFormat($row->sale_price) }}
                    {{ $gtext['currency_position'] == 'right' ? $gtext['currency_icon'] : '' }}
                </div>

                @if($row->is_discount == 1 && $row->old_price != '')
                    <div class="original-price">
                        {{ $gtext['currency_position'] == 'left' ? $gtext['currency_icon'] : '' }}
                        {{ NumberFormat($row->old_price) }}
                        {{ $gtext['currency_position'] == 'right' ? $gtext['currency_icon'] : '' }}
                    </div>
                @endif
            @endif
        </div>

        <!-- Actions -->
        <div class="product-actions">
            <button class="add-to-cart-btn" data-id="{{ $row->id }}">
                <i class="bi bi-cart-plus"></i> {{ __('Add To Cart') }}
            </button>

            <div class="action-buttons">
                <button class="wishlist-btn" data-id="{{ $row->id }}" title="{{ __('Add to Wishlist') }}">
                    <i class="bi bi-heart"></i>
                </button>
                <a href="{{ route('frontend.product', ['id' => $row->id, 'slug' => $row->slug ?? Str::slug($row->title)]) }}" class="quick-view-btn" title="{{ __('View Details') }}">
                    <i class="bi bi-eye"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Product Card Styles */
.product-card {
    position: relative;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-3px);
}

/* Discount Badge */
.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #e53935;
    color: white;
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
}

/* Product Image */
.product-image {
    position: relative;
    padding: 15px;
    background: #f9f9f9;
    text-align: center;
}

.product-img {
    width: 100%;
    height: 160px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

/* Product Content */
.product-content {
    padding: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    margin: 0 0 8px;
}

.product-title a {
    font-size: 15px;
    font-weight: 600;
    color: #333;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 42px;
    text-decoration: none;
}

.product-title a:hover {
    color: var(--theme-color);
}

/* Rating */
.product-rating {
    display: flex;
    align-items: center;
    margin: 5px 0;
}

.stars {
    --percent: calc(var(--rating) / 5 * 100%);
    display: inline-block;
    font-size: 14px;
    position: relative;
}

.stars::before {
    content: '★★★★★';
    background: linear-gradient(90deg, #ffb300 var(--percent), #ddd var(--percent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.rating-count {
    font-size: 12px;
    color: #666;
    margin-left: 5px;
}

/* Seller */
.product-seller {
    font-size: 12px;
    color: #666;
    margin: 5px 0;
}

.seller-link {
    color: var(--theme-color);
    font-weight: 500;
}

/* Pricing */
.product-pricing {
    margin: 8px 0 12px;
}

.current-price {
    font-size: 18px;
    font-weight: 700;
    color: var(--theme-color);
}

.original-price {
    font-size: 14px;
    color: #999;
    text-decoration: line-through;
}

/* Actions */
.product-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.add-to-cart-btn {
    flex: 1;
    padding: 8px 12px;
    background: var(--theme-color);
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.add-to-cart-btn:hover {
    background: #333;
}

.action-buttons {
    display: flex;
    margin-left: 10px;
    gap: 5px;
}

.wishlist-btn, .quick-view-btn {
    width: 36px;
    height: 36px;
    border-radius: 4px;
    background: #f5f5f5;
    border: none;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.wishlist-btn:hover, .quick-view-btn:hover {
    background: var(--theme-color);
    color: white;
}

/* Mobile Styles */
@media (max-width: 767px) {
    .product-img {
        height: 120px;
    }

    .product-title a {
        font-size: 14px;
        min-height: 38px;
    }

    .current-price {
        font-size: 16px;
    }

    .original-price {
        font-size: 13px;
    }

    .add-to-cart-btn {
        padding: 7px 10px;
        font-size: 13px;
    }

    .wishlist-btn, .quick-view-btn {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
}
</style>
				 <!-- @include('frontend.partials.product-card', ['row' => $row, 'gtext' => $gtext]) -->
				<!-- <div class="col-lg-12">
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
				</div> -->
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