<div class="item-card">
    <div class="item-image">
        @if(($row->is_discount == 1) && ($row->old_price !=''))
            @php
                $discount = number_format((($row->old_price - $row->sale_price)*100)/$row->old_price);
            @endphp
            <span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
        @endif
        <a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
            <img src="{{ asset('public/media/'.$row->f_thumbnail) }}" alt="{{ $row->title }}" loading="lazy" class="product-img" />
        </a>
    </div>
    <div class="item-content">
        <div class="item-title">
            <a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title, 50) }}</a>
        </div>
        <div class="rating-wrap">
            <div class="stars-outer">
                <div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
            </div>
            <span class="rating-count">({{ $row->TotalReview }})</span>
        </div>
        <div class="item-sold">
            {{ __('Sold By') }} <a href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}" class="seller-link">{{ str_limit($row->shop_name, 20) }}</a>
        </div>
        <div class="item-price-card">
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
            <ul class="item-action-list">
                <li><a class="action-btn addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);" title="{{ __('Add to Wishlist') }}"><i class="bi bi-heart"></i></a></li>
                <li><a class="action-btn" href="{{ route('frontend.product', [$row->id, $row->slug]) }}" title="{{ __('View Details') }}"><i class="bi bi-eye"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<style>
/* Product Card Styles */
.item-card {
    background: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
}

.item-image {
    position: relative;
    padding: 15px;
    text-align: center;
    background: #f9f9f9;
}

.item-image .product-img {
    width: 100%;
    height: 180px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.item-card:hover .product-img {
    transform: scale(1.03);
}

.item-label {
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--theme-color);
    color: white;
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 600;
}

.item-content {
    padding: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.item-title a {
    font-size: 15px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 42px;
}

.item-title a:hover {
    color: var(--theme-color);
}

.rating-wrap {
    display: flex;
    align-items: center;
    margin: 5px 0;
}

.stars-outer {
    position: relative;
    display: inline-block;
    font-size: 14px;
}

.stars-outer::before {
    content: "\2605 \2605 \2605 \2605 \2605";
    color: #ddd;
}

.stars-inner {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    overflow: hidden;
}

.stars-inner::before {
    content: "\2605 \2605 \2605 \2605 \2605";
    color: #ffb300;
}

.rating-count {
    font-size: 12px;
    color: #666;
    margin-left: 5px;
}

.item-sold {
    font-size: 12px;
    color: #666;
    margin: 5px 0;
}

.seller-link {
    color: var(--theme-color);
    font-weight: 500;
}

.item-price-card {
    margin: 8px 0 12px;
}

.new-price {
    font-size: 18px;
    font-weight: 700;
    color: var(--theme-color);
}

.old-price {
    font-size: 14px;
    color: #999;
    text-decoration: line-through;
    margin-left: 5px;
}

.item-card-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
}

.add-to-cart {
    background: var(--theme-color);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    flex: 1;
    text-align: center;
    transition: all 0.3s ease;
}

.add-to-cart:hover {
    background: #333;
    color: white;
}

.item-action-list {
    display: flex;
    margin-left: 10px;
}

.action-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    border-radius: 4px;
    color: #666;
    margin-left: 8px;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: var(--theme-color);
    color: white;
}

/* Mobile Specific Styles */
@media (max-width: 767px) {
    .item-image .product-img {
        height: 140px;
    }

    .item-title a {
        font-size: 14px;
        min-height: 38px;
    }

    .new-price {
        font-size: 16px;
    }

    .old-price {
        font-size: 13px;
    }

    .add-to-cart {
        padding: 7px 10px;
        font-size: 13px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
}
</style>