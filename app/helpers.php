<?php

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Tp_option;
use App\Models\Media_setting;
use App\Models\Menu;
use App\Models\Menu_parent;
use App\Models\Mega_menu;
use App\Models\Menu_child;
use App\Models\Pro_category;
use App\Models\Attribute;
use App\Models\Tax;
use App\Models\Order_master;
use App\Models\Social_media;
use App\Models\Section_manage;
use Illuminate\Support\Facades\Auth;

//Page Variation
// function PageVariation(){
// 	// hello test

// 	$data = array();
// 	$results = Tp_option::where('option_name', 'page_variation')->get();

// 	$id = '';
// 	foreach ($results as $row){
// 		$id = $row->id;
// 	}

// 	if($id != ''){

// 		$sData = json_decode($results);
// 		$dataObj = json_decode($sData[0]->option_value);

// 		$data['home_variation'] = $dataObj->home_variation;
// 		$data['category_variation'] = $dataObj->category_variation;
// 		$data['brand_variation'] = $dataObj->brand_variation;
// 		$data['seller_variation'] = $dataObj->seller_variation;
// 	}else{
// 		$data['home_variation'] = 'home_1';
// 		$data['category_variation'] = 'left_sidebar';
// 		$data['brand_variation'] = 'left_sidebar';
// 		$data['seller_variation'] = 'left_sidebar';
// 	}

// 	return $data;
// }

function PageVariation()
{
    return [
        'home_variation'     => 'home_2',
        'category_variation' => 'left_sidebar',
        'brand_variation'    => 'left_sidebar',
        'seller_variation'   => 'left_sidebar',
    ];
}


//Get data for Language locale
function glan(){
	$lan = app()->getLocale();

	return $lan;
}

function CategoryMenuList()
{
    $lan = glan(); // current language
    $cacheKey = "category_menu_list_{$lan}";

    return Cache::remember($cacheKey, now()->addDays(2), function () use ($lan) {
        // শুধু main categories (parent_id = 0 বা NULL)
        $categories = Pro_category::with(['children' => function ($q) {
                $q->where('is_publish', 1)->orderBy('id', 'ASC');
            }])
            ->where('lan', $lan)
            ->where('is_publish', 1)
            ->where(function($q){
                $q->whereNull('parent_id')->orWhere('parent_id', 0);
            })
            ->orderBy('id', 'ASC')
            ->get();

        $li_List = '';
        $Path = asset('public/media');
        $count = 1;

        foreach ($categories as $row) {
            if (!$row) continue; // safety check

            $id   = $row->id;
            $slug = $row->slug;
            $thumbUrl = $Path . '/' . ltrim($row->thumbnail, '/');

            // parent item
            $li_List .= '<li class="category-item'.($count > 8 ? ' cat-list-hideshow' : '').'">';
            $li_List .= '<a class="category-link" href="' . route('frontend.product-category', [$id, $slug]) . '">
                            <span class="cat-icon"><img src="'. e($thumbUrl) .'" alt="'. e($row->name) .'"></span>
                            <span class="cat-label">'. e($row->name) .'</span>
                            <span class="cat-caret" aria-hidden="true">›</span>
                         </a>';

            // subcategories থাকলে flyout menu (image বাদ)
            if ($row->children && $row->children->count() > 0) {
                $li_List .= '<div class="sub-flyout">
                                <ul class="sub-category-menu">';
                foreach ($row->children as $sub) {
                    $li_List .= '<li>
                                    <a href="' . route('frontend.product-category', [$sub->id, $sub->slug]) . '">
                                        '. e($sub->name) .'
                                    </a>
                                 </li>';
                }
                $li_List .= '</ul></div>';
            }

            $li_List .= '</li>';
            $count++;
        }

        return $li_List;
    });
}



//Category List for Mobile
function CategoryListForMobile(){
	$lan = glan();

	$datalist = Pro_category::where('lan', '=', $lan)->where('is_publish', '=', 1)->orderBy('name','ASC')->get();
	$li_List = '';
	foreach($datalist as $row){
		$id = $row->id;
		$slug = $row->slug;

		$li_List .= '<li><a href="'.route('frontend.product-category', [$id, $slug]).'">'.$row->name.'</a></li>';
	}

	return $li_List;
}

//Category List for Option
function CategoryListOption(){
	$lan = glan();

	$datalist = Pro_category::where('lan', '=', $lan)->where('is_publish', '=', 1)->orderBy('name','ASC')->get();
	$option_List = '';
	foreach($datalist as $row){
		$id = $row->id;
		$slug = $row->slug;

		$option_List .= '<option value="'.$row->id.'">'.$row->name.'</option>';
	}

	return $option_List;
}

//Menu List
function HeaderMenuList($MenuType)
{
    $lan = glan();
    $cacheKey = "header_menu_list_{$MenuType}_{$lan}";

    return Cache::remember($cacheKey, now()->addDays(2), function () use ($lan, $MenuType) {
        $sql = "SELECT b.id, b.menu_id, b.menu_type, b.child_menu_type, b.item_id, b.item_label, b.custom_url,
                b.target_window, b.css_class, b.`column`, b.width_type, b.width, b.lan, b.sort_order
                FROM menus a
                INNER JOIN menu_parents b ON a.id = b.menu_id
                WHERE a.menu_position = 'header'
                AND a.lan = ?
                AND a.status_id  = 1
                ORDER BY sort_order ASC;";

        $datalist = DB::select($sql, [$lan]);

        $MenuList = '';
        foreach ($datalist as $row) {
            $menu_id        = $row->menu_id;
            $menu_parent_id = $row->id;
            $item_id        = $row->item_id;
            $custom_url     = $row->custom_url;

            $target_window = $row->target_window == '_blank' ? ' target="_blank"' : '';

            // === Desktop Menu ===
            if ($MenuType == 'HeaderMenuListForDesktop') {
                if ($row->child_menu_type == 'mega_menu') {
                    $MegaDropdownMenuList = makeMegaMenu($menu_id, $menu_parent_id, $row->width_type, $row->width, $MenuType);
                    $upDownClass = ' class="tp-updown"';
                } elseif ($row->child_menu_type == 'dropdown') {
                    $MegaDropdownMenuList = makeDropdownMenu($menu_id, $menu_parent_id, $MenuType);
                    $upDownClass = ' class="tp-updown"';
                } else {
                    $MegaDropdownMenuList = '';
                    $upDownClass = '';
                }

                $full_width = $row->width_type == 'full_width' ? 'class="tp-static"' : '';

                if ($row->menu_type == 'page') {
                    $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . route('frontend.page', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'brand') {
                    $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . route('frontend.brand', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'custom_link') {
                    $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . $custom_url . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'product') {
                    $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . route('frontend.product', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'product_category') {
                    $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . route('frontend.product-category', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'blog') {
                    if ($item_id == 0) {
                        $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . route('frontend.blog') . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                    } else {
                        $MenuList .= '<li ' . $full_width . '><a' . $upDownClass . $target_window . ' href="' . route('frontend.blog-category', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                    }
                }
            }
            // === Mobile Menu ===
            else {
                if ($row->child_menu_type == 'mega_menu') {
                    $MegaDropdownMenuList = makeMegaMenu($menu_id, $menu_parent_id, $row->width_type, $row->width, $MenuType);
                    $hasChildrenMenu = 'class="has-children-menu"';
                } elseif ($row->child_menu_type == 'dropdown') {
                    $MegaDropdownMenuList = makeDropdownMenu($menu_id, $menu_parent_id, $MenuType);
                    $hasChildrenMenu = 'class="has-children-menu"';
                } else {
                    $MegaDropdownMenuList = '';
                    $hasChildrenMenu = '';
                }

                if ($row->menu_type == 'page') {
                    $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . route('frontend.page', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'brand') {
                    $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . route('frontend.brand', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'custom_link') {
                    $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . $row->custom_url . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'product') {
                    $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . route('frontend.product', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'product_category') {
                    $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . route('frontend.product-category', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                } elseif ($row->menu_type == 'blog') {
                    if ($item_id == 0) {
                        $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . route('frontend.blog') . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                    } else {
                        $MenuList .= '<li ' . $hasChildrenMenu . '><a' . $target_window . ' href="' . route('frontend.blog-category', [$item_id, $custom_url]) . '">' . e($row->item_label) . '</a>' . $MegaDropdownMenuList . '</li>';
                    }
                }
            }
        }

        return $MenuList;
    });
}

function makeMegaMenu($menu_id, $menu_parent_id, $width_type, $width, $MenuType)
{
    // Cache key (unique per menu + params)
    $cacheKey = "mega_menu_{$menu_id}_{$menu_parent_id}_{$MenuType}";

    // Store in cache for 2 days
    return Cache::remember($cacheKey, now()->addDays(2), function () use ($menu_id, $menu_parent_id, $width_type, $width, $MenuType) {

        $sql = "SELECT a.id, a.mega_menu_title, a.is_title, a.is_image, a.image, a.sort_order,
                       b.column, b.width_type, b.width, b.css_class
                FROM mega_menus a
                INNER JOIN menu_parents b ON a.menu_parent_id = b.id
                WHERE a.menu_id = '".$menu_id."'
                AND a.menu_parent_id = '".$menu_parent_id."'
                ORDER BY a.sort_order ASC;";

        $datalist = DB::select($sql);

        $ul_List = '';
        $title = '';
        $imageOrMegaLiList = '';
        $is_title_for_mobile = 0;

        foreach ($datalist as $row) {
            $mega_menu_id = $row->id;

            if ($row->is_title == 0) {
                $is_title_for_mobile++;
            }

            // Menu list for Desktop
            if ($MenuType == 'HeaderMenuListForDesktop') {
                if ($row->is_title == 1) {
                    $title = '<li class="mega-title">'.$row->mega_menu_title.'</li>';
                } else {
                    $title = '';
                }

                if ($row->is_image == 1) {
                    if ($row->image != '') {
                        $Path = asset('public/media');
                        $imageOrMegaLiList = '<img src="'.$Path.'/'.$row->image.'" />';
                    } else {
                        $imageOrMegaLiList = '';
                    }
                } else {
                    $imageOrMegaLiList = mega_liList($menu_id, $menu_parent_id, $mega_menu_id, $MenuType);
                }

                if ($row->width_type == 'full_width') {
                    $ul_List .= '<ul class="mega-col-'.$row->column.' '.$row->css_class.'">
                                    '.$title.$imageOrMegaLiList.'
                                </ul>';
                } else {
                    $ul_List .= '<ul class="megafixed-col-'.$row->column.' '.$row->css_class.'">
                                    '.$title.$imageOrMegaLiList.'
                                </ul>';
                }
            } else {
                // Menu list for Mobile
                if ($row->is_image == 1) {
                    $imageOrMegaLiList = '';
                } else {
                    $imageOrMegaLiList = mega_liList($menu_id, $menu_parent_id, $mega_menu_id, $MenuType);
                }

                if ($is_title_for_mobile > 0) {
                    $ul_List .= $imageOrMegaLiList;
                } else {
                    $ul_List .= '<li class="has-children-menu"><a href="#">'.$row->mega_menu_title.'</a>
                                    <ul class="dropdown">'.$imageOrMegaLiList.'</ul>
                                </li>';
                }
            }
        }

        // Final render
        if ($MenuType == 'HeaderMenuListForDesktop') {
            if ($width_type == 'full_width') {
                $MenuList = '<div class="mega-menu mega-full">'.$ul_List.'</div>';
            } else {
                $MenuList = '<div class="mega-menu" style="width:'.$width.'px;">'.$ul_List.'</div>';
            }
        } else {
            $MenuList = '<ul class="dropdown">'.$ul_List.'</ul>';
        }

        return $MenuList;
    });
}




function mega_liList($menu_id, $menu_parent_id, $mega_menu_id, $MenuType){
    // Unique cache key for each variation
    $cacheKey = "mega_liList_{$menu_id}_{$menu_parent_id}_{$mega_menu_id}_{$MenuType}";

    return Cache::remember($cacheKey, 3600, function () use ($menu_id, $menu_parent_id, $mega_menu_id) {
        $datalist = Menu_child::where('menu_id', $menu_id)
            ->where('menu_parent_id', $menu_parent_id)
            ->where('mega_menu_id', $mega_menu_id)
            ->orderBy('sort_order', 'ASC')
            ->get();

        $li_List = '';
        foreach($datalist as $row){
            $item_id = $row->item_id;
            $custom_url = $row->custom_url;
            $target_window = ($row->target_window == '_blank') ? ' target="_blank"' : '';

            if($row->menu_type == 'page'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.page', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'brand'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.brand', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'custom_link'){
                $li_List .= '<li><a'.$target_window.' href="'.$custom_url.'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'product'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.product', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'product_category'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.product-category', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'blog'){
                if($item_id == 0){
                    $li_List .= '<li><a'.$target_window.' href="'.route('frontend.blog').'">'.$row->item_label.'</a></li>';
                }else{
                    $li_List .= '<li><a'.$target_window.' href="'.route('frontend.blog-category', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';
                }
            }
        }

        return $li_List;
    });
}

function makeDropdownMenu($menu_id, $menu_parent_id, $MenuType){
    // Unique cache key per menu & parent
    $cacheKey = "dropdown_menu_{$menu_id}_{$menu_parent_id}_{$MenuType}";

    return Cache::remember($cacheKey, 3600, function () use ($menu_id, $menu_parent_id, $MenuType) {
        $datalist = Menu_child::where('menu_id', $menu_id)
            ->where('menu_parent_id', $menu_parent_id)
            ->orderBy('sort_order', 'ASC')
            ->get();

        $li_List = '';
        foreach($datalist as $row){
            $item_id = $row->item_id;
            $custom_url = $row->custom_url;

            $target_window = ($row->target_window == '_blank') ? ' target="_blank"' : '';

            if($row->menu_type == 'page'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.page', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'brand'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.brand', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'custom_link'){
                $li_List .= '<li><a'.$target_window.' href="'.$custom_url.'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'product'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.product', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'product_category'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.product-category', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            }elseif($row->menu_type == 'blog'){
                if($item_id == 0){
                    $li_List .= '<li><a'.$target_window.' href="'.route('frontend.blog').'">'.$row->item_label.'</a></li>';
                }else{
                    $li_List .= '<li><a'.$target_window.' href="'.route('frontend.blog-category', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';
                }
            }
        }

        //Menu list for Desktop
        if($MenuType == 'HeaderMenuListForDesktop'){
            $MenuList = '<ul class="submenu">'.$li_List.'</ul>';
        //Menu list for Mobile
        }else{
            $MenuList = '<ul class="dropdown">'.$li_List.'</ul>';
        }

        return $MenuList;
    });
}

//Footer Menu List

function FooterMenuList($MenuType)
{
    $lan = glan();
    $cacheKey = "footer_menu_list_{$MenuType}_{$lan}";

    return Cache::remember($cacheKey, now()->addDays(2), function () use ($MenuType, $lan) {
        $sql = "SELECT b.id, b.menu_id, b.menu_type, b.item_id, b.item_label, b.custom_url, b.target_window, b.sort_order
                FROM menus a
                INNER JOIN menu_parents b ON a.id = b.menu_id
                WHERE a.menu_position = '".$MenuType."'
                AND a.lan = '".$lan."'
                AND a.status_id = 1
                ORDER BY sort_order ASC;";

        $datalist = DB::select($sql);

        $li_List = '';
        foreach($datalist as $row){
            $target_window = $row->target_window == '_blank' ? ' target="_blank"' : '';
            $item_id = $row->item_id;
            $custom_url = $row->custom_url;

            if($row->menu_type == 'page'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.page', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            } elseif($row->menu_type == 'brand'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.brand', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            } elseif($row->menu_type == 'custom_link'){
                $li_List .= '<li><a'.$target_window.' href="'.$custom_url.'">'.$row->item_label.'</a></li>';

            } elseif($row->menu_type == 'product'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.product', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            } elseif($row->menu_type == 'product_category'){
                $li_List .= '<li><a'.$target_window.' href="'.route('frontend.product-category', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';

            } elseif($row->menu_type == 'blog'){
                if($item_id == 0){
                    $li_List .= '<li><a'.$target_window.' href="'.route('frontend.blog').'">'.$row->item_label.'</a></li>';
                } else {
                    $li_List .= '<li><a'.$target_window.' href="'.route('frontend.blog-category', [$item_id, $custom_url]).'">'.$row->item_label.'</a></li>';
                }
            }
        }

        return $li_List;
    });
}

function gtext()
{
    return Cache::remember('gtext', 3600, function () {
        $data = [];

        // Define all required option names
        $optionNames = [
            'general_settings', 'theme_logo', 'currency', 'theme_option_header',
            'language_switcher', 'theme_option_footer', 'facebook', 'twitter',
            'theme_option_seo', 'facebook-pixel', 'google_analytics', 'google_tag_manager',
            'google_recaptcha', 'google_map', 'theme_color', 'mail_settings',
            'stripe', 'paypal', 'razorpay', 'mollie', 'cash_on_delivery', 'bank_transfer',
            'mailchimp', 'subscribe_popup', 'whatsapp', 'custom_css', 'custom_js', 'cookie_consent'
        ];

        // Fetch all options in one query and index by option_name
        $options = Tp_option::whereIn('option_name', $optionNames)
            ->pluck('option_value', 'option_name'); // More efficient than get()->keyBy()

        // Helper to safely decode JSON or return empty object
        $decode = function ($value) {
            return $value ? json_decode($value, true) : [];
        };

        // General Settings
        $general = $decode($options->get('general_settings'));
        $data['site_name'] = $general['site_name'] ?? 'bShop';
        $data['site_title'] = $general['site_title'] ?? 'Laravel eCommerce Shopping Platform';
        $data['company'] = $general['company'] ?? '';
        $data['invoice_email'] = $general['email'] ?? '';
        $data['invoice_phone'] = $general['phone'] ?? '';
        $data['invoice_address'] = $general['address'] ?? '';
        $data['timezone'] = $general['timezone'] ?? '';

        // Theme Logo
        $logo = $decode($options->get('theme_logo'));
        $data['favicon'] = $logo['favicon'] ?? '';
        $data['front_logo'] = $logo['front_logo'] ?? '';
        $data['back_logo'] = $logo['back_logo'] ?? '';

        // Currency
        $currency = $decode($options->get('currency'));
        $data['currency_name'] = $currency['currency_name'] ?? '';
        $data['currency_icon'] = $currency['currency_icon'] ?? '';
        $data['currency_position'] = $currency['currency_position'] ?? '';

        // Header
        $header = $decode($options->get('theme_option_header'));
        $data['address'] = $header['address'] ?? '';
        $data['phone'] = $header['phone'] ?? '';
        $data['is_publish'] = $header['is_publish'] ?? '';

        // Language Switcher
        $lang = $decode($options->get('language_switcher'));
        $data['is_language_switcher'] = $lang['is_language_switcher'] ?? '';

        // Footer
        $footer = $decode($options->get('theme_option_footer'));
        $data['about_logo_footer'] = $footer['about_logo'] ?? '';
        $data['about_desc_footer'] = $footer['about_desc'] ?? '';
        $data['is_publish_about'] = $footer['is_publish_about'] ?? '';
        $data['address_footer'] = $footer['address'] ?? '';
        $data['email_footer'] = $footer['email'] ?? '';
        $data['phone_footer'] = $footer['phone'] ?? '';
        $data['is_publish_contact'] = $footer['is_publish_contact'] ?? '';
        $data['copyright'] = $footer['copyright'] ?? '';
        $data['is_publish_copyright'] = $footer['is_publish_copyright'] ?? '';
        $data['payment_gateway_icon'] = $footer['payment_gateway_icon'] ?? '';
        $data['is_publish_payment'] = $footer['is_publish_payment'] ?? '';

        // RTL Detection
        $isRTL = Cache::remember('language_'.app()->getLocale(), 3600, function () {
            return Language::where('language_code', app()->getLocale())->first();
        });
        $data['is_rtl'] = $isRTL?->is_rtl ?? 0;

        // Facebook
        $facebook = $decode($options->get('facebook'));
        $data['fb_app_id'] = $facebook['fb_app_id'] ?? '';
        $data['fb_publish'] = $facebook['is_publish'] ?? '';

        // Twitter
        $twitter = $decode($options->get('twitter'));
        $data['twitter_id'] = $twitter['twitter_id'] ?? '';
        $data['twitter_publish'] = $twitter['is_publish'] ?? '';

        // SEO
        $seo = $decode($options->get('theme_option_seo'));
        $data['og_title'] = $seo['og_title'] ?? '';
        $data['og_image'] = $seo['og_image'] ?? '';
        $data['og_description'] = $seo['og_description'] ?? '';
        $data['og_keywords'] = $seo['og_keywords'] ?? '';
        $data['seo_publish'] = $seo['is_publish'] ?? '';

        // Facebook Pixel
        $fbPixel = $decode($options->get('facebook-pixel'));
        $data['fb_pixel_id'] = $fbPixel['fb_pixel_id'] ?? '';
        $data['fb_pixel_publish'] = $fbPixel['is_publish'] ?? '';

        // Google Analytics
        $ga = $decode($options->get('google_analytics'));
        $data['tracking_id'] = $ga['tracking_id'] ?? '';
        $data['ga_publish'] = $ga['is_publish'] ?? '';

        // Google Tag Manager
        $gtm = $decode($options->get('google_tag_manager'));
        $data['google_tag_manager_id'] = $gtm['google_tag_manager_id'] ?? '';
        $data['gtm_publish'] = $gtm['is_publish'] ?? '';

        // Google Recaptcha
        $gr = $decode($options->get('google_recaptcha'));
        $data['sitekey'] = $gr['sitekey'] ?? '';
        $data['secretkey'] = $gr['secretkey'] ?? '';
        $data['is_recaptcha'] = $gr['is_recaptcha'] ?? '';

        // Google Map
        $gm = $decode($options->get('google_map'));
        $data['googlemap_apikey'] = $gm['googlemap_apikey'] ?? '';
        $data['is_googlemap'] = $gm['is_googlemap'] ?? '';

        // Theme Colors
        $theme = $decode($options->get('theme_color'));
        $data['theme_color'] = $theme['theme_color'] ?? '#61a402';
        $data['green_color'] = $theme['green_color'] ?? '#65971e';
        $data['light_green_color'] = $theme['light_green_color'] ?? '#daeac5';
        $data['lightness_green_color'] = $theme['lightness_green_color'] ?? '#fdfff8';
        $data['gray_color'] = $theme['gray_color'] ?? '#8d949d';
        $data['dark_gray_color'] = $theme['dark_gray_color'] ?? '#595959';
        $data['light_gray_color'] = $theme['light_gray_color'] ?? '#e7e7e7';
        $data['black_color'] = $theme['black_color'] ?? '#232424';
        $data['white_color'] = $theme['white_color'] ?? '#ffffff';

        // Mail Settings
        $mail = $decode($options->get('mail_settings'));
        $data['ismail'] = $mail['ismail'] ?? '';
        $data['from_name'] = $mail['from_name'] ?? '';
        $data['from_mail'] = $mail['from_mail'] ?? '';
        $data['to_name'] = $mail['to_name'] ?? '';
        $data['to_mail'] = $mail['to_mail'] ?? '';
        $data['mailer'] = $mail['mailer'] ?? '';
        $data['smtp_host'] = $mail['smtp_host'] ?? '';
        $data['smtp_port'] = $mail['smtp_port'] ?? '';
        $data['smtp_security'] = $mail['smtp_security'] ?? '';
        $data['smtp_username'] = $mail['smtp_username'] ?? '';
        $data['smtp_password'] = $mail['smtp_password'] ?? '';

        // Payment Gateways
        $paymentOptions = ['stripe','paypal','razorpay','mollie','cash_on_delivery','bank_transfer'];
        foreach ($paymentOptions as $p) {
            $pData = $decode($options->get($p));
            $data[$p.'_data'] = (object) $pData; // Convert to object for consistency
        }

        // Mailchimp
        $mc = $decode($options->get('mailchimp'));
        $data['mailchimp_api_key'] = $mc['mailchimp_api_key'] ?? '';
        $data['audience_id'] = $mc['audience_id'] ?? '';
        $data['is_mailchimp'] = $mc['is_mailchimp'] ?? '';

        // Subscribe Popup
        $sp = $decode($options->get('subscribe_popup'));
        $data['subscribe_title'] = $sp['subscribe_title'] ?? '';
        $data['subscribe_popup_desc'] = $sp['subscribe_popup_desc'] ?? '';
        $data['bg_image_popup'] = $sp['bg_image_popup'] ?? '';
        $data['subscribe_background_image'] = $sp['background_image'] ?? '';
        $data['is_subscribe_popup'] = $sp['is_subscribe_popup'] ?? '';
        $data['is_subscribe_footer'] = $sp['is_subscribe_footer'] ?? '';

        // WhatsApp
        $wa = $decode($options->get('whatsapp'));
        $data['whatsapp_id'] = $wa['whatsapp_id'] ?? '';
        $data['whatsapp_text'] = $wa['whatsapp_text'] ?? '';
        $data['position'] = $wa['position'] ?? '';
        $data['is_whatsapp_publish'] = $wa['is_publish'] ?? '';

        // Custom CSS/JS
        $data['custom_css'] = $options->get('custom_css') ?? '';
        $data['custom_js'] = $options->get('custom_js') ?? '';

        // Cookie Consent
        $cc = $decode($options->get('cookie_consent'));
        $data['cookie_title'] = $cc['title'] ?? '';
        $data['cookie_message'] = $cc['message'] ?? '';
        $data['button_text'] = $cc['button_text'] ?? '';
        $data['learn_more_url'] = $cc['learn_more_url'] ?? '';
        $data['learn_more_text'] = $cc['learn_more_text'] ?? '';
        $data['cookie_position'] = $cc['position'] ?? '';
        $data['cookie_style'] = $cc['style'] ?? '';
        $data['is_publish_cookie_consent'] = $cc['is_publish'] ?? '';

        return $data;
    });
}

//Blog Category List for Filter
function BlogCategoryListForFilter(){
	$lan = glan();

	$sql = "SELECT b.id, b.slug, b.name, COUNT(a.id) TotalProduct
	FROM blogs a
	RIGHT JOIN blog_categories b ON a.category_id = b.id
	WHERE b.is_publish = 1 AND b.lan = '".$lan."'
	GROUP BY b.id, b.slug, b.name
	ORDER BY b.name;";
	$datalist = DB::select($sql);

	return $datalist;
}

//Category List for Filter
function CategoryListForFilter(){
	$lan = glan();

	$sql = "SELECT b.id, b.slug, b.name, b.thumbnail, COUNT(a.id) TotalProduct
	FROM products a
	RIGHT JOIN pro_categories b ON a.cat_id = b.id
	WHERE b.is_publish = 1 AND b.lan = '".$lan."'
	GROUP BY b.thumbnail, b.id, b.slug, b.name
	ORDER BY b.name;";
	$datalist = DB::select($sql);

	return $datalist;
}

//Brand List for Filter
function BrandListForFilter(){
	$lan = glan();

	$sql = "SELECT b.id, b.name, b.thumbnail, COUNT(a.id) TotalProduct
	FROM products a
	RIGHT JOIN brands b ON a.brand_id = b.id
	WHERE b.is_publish = 1 AND b.lan = '".$lan."'
	GROUP BY b.thumbnail, b.id, b.name
	ORDER BY b.name;";
	$datalist = DB::select($sql);

	return $datalist;
}

//Color List for Filter
function ColorListForFilter(){

	$datalist = Attribute::where('att_type', 'Color')->orderBy('id','asc')->get();
	$li_List = '';
	foreach($datalist as $row){
		$id = $row->id;
		$name = $row->name;
		$color = $row->color;

		$li_List .= '<li class="active_color" id="color_'.$id.'"><a data-color="'.$id.'" id="'.$name.'|'.$color.'" class="filter_by_color" href="javascript:void(0);" title="'.$name.'"><span style="background:'.$color.';"></span></a></li>';
	}

	return $li_List;
}

//Size List for Filter
function SizeListForFilter(){
	$lan = glan();

	$datalist = Attribute::where('att_type', 'Size')->orderBy('id','asc')->get();

	$li_List = '';
	foreach($datalist as $row){
		$id = $row->id;
		$li_List .= '<li class="active_size" id="size_'.$id.'"><a data-size="'.$id.'" id="'.$row->name.'" class="filter_by_size" href="javascript:void(0);">'.$row->name.'</a></li>';
	}

	return $li_List;
}

//Social Media List
function SocialMediaList(){

	$datalist = Social_media::where('is_publish', '=', 1)->orderBy('id','ASC')->get();
	$li_List = '';
	foreach($datalist as $row){
		$id = $row->id;
		$url = $row->url;
		$target = $row->target == '' ? '' : "target=".$row->target;
		$social_icon = $row->social_icon;

		$li_List .= '<a href="'.$url.'" '.$target.'><i class="'.$social_icon.'"></i></a>';
	}

	return $li_List;
}

function vipc(){

	$datalist = Tp_option::where('option_name', 'vipc')->get();

	$id = '';
	$option_value = '';
	foreach ($datalist as $row){
		$id = $row->id;
		$option_value = json_decode($row->option_value);
	}

	$data = array();
	if($id != ''){
		$data['bkey'] = $option_value->resetkey;
	}else{
		$data['bkey'] = 0;
	}
	return $data;
}

function getPurchaseData( $code ) {

	$header   = array();
	$header[] = 'Content-length: 0';
	$header[] = 'Content-type: application/json; charset=utf-8';
	$header[] = 'Authorization: bearer LkIHSQR0WsV9MADhIhiLPg4XmYqcu2TQ';
	$verify_url = 'https://api.envato.com/v3/market/author/sale/';
	$ch_verify = curl_init( $verify_url . '?code=' . $code );
	curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
	curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
	curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

	$cinit_verify_data = curl_exec( $ch_verify );
	curl_close( $ch_verify );

	if ($cinit_verify_data != ""){
		return json_decode($cinit_verify_data);
	}else{
		return false;
	}
}

function verifyPurchase($code) {
	return 1;
	$verify_obj = getPurchaseData($code);

	$itemCode = 39645166; //Item Code for organis
	$verifyItemCode = isset($verify_obj->item->id) ? $verify_obj->item->id : 0;

	if ((false === $verify_obj) || !is_object($verify_obj) || isset($verify_obj->error) || !isset($verify_obj->sold_at)){
		return 0;
	}else{
		//This code open for item approved
		if($itemCode == $verifyItemCode){
			return 1;
		}else{
			return 0;
		}
	}
}

//Get data for Language
function language(){

	$locale_language = glan();

	$data = Language::where('status', 1)->orderBy('language_name', 'ASC')->get();

	$base_url = url('/');

	$language = '';
	$selected_language = '';
	foreach ($data as $row){
		if($locale_language == $row['language_code']){
			$selected_language = $row['language_name'];
		}

		$language .= '<li><a class="dropdown-item" href="'.$base_url.'/lang/'.$row['language_code'].'">'.$row['language_name'].'</a></li>';
	}

	$languageList = '<div class="btn-group language-menu">
					<a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-translate"></i>'.$selected_language.'
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
						'.$language.'
					</ul>
				</div>';

	return $languageList;
}

function thumbnail($type){

	$datalist = array('width' => '', 'height' => '');
	$data = Media_setting::where('media_type', $type)->first();
	$datalist = array(
		'width' => $data['media_width'],
		'height' => $data['media_height']
	);

	return $datalist;
}

function getReviews($item_id) {

	$sql = "SELECT COUNT(id) TotalReview, SUM(IFNULL(rating, 0)) TotalRating,
	(SUM(IFNULL(rating, 0))/COUNT(id))*20 ReviewPercentage
	FROM reviews WHERE item_id = $item_id;";
	$datalist = DB::select($sql);

	return $datalist;
}

function getReviewsBySeller($seller_id) {

	$sql = "SELECT COUNT(a.id) TotalReview, SUM(IFNULL(a.rating, 0)) TotalRating,
	(SUM(IFNULL(a.rating, 0))/COUNT(a.id))*20 ReviewPercentage
	FROM reviews a
	INNER JOIN products b ON a.item_id = b.id
	WHERE b.user_id = $seller_id;";
	$datalist = DB::select($sql);

	return $datalist;
}

function OrderCount($status_id) {
	if($status_id == 0){
		$count = Order_master::count();
	}else{
		$count = Order_master::where('order_status_id', '=', $status_id)->count();
	}

	return $count;
}

function OrderCountForSeller($status_id) {

	$seller_id = Auth::user()->id;

	if($status_id == 0){
		$count = Order_master::where('seller_id', '=', $seller_id)->count();
	}else{
		$count = Order_master::where('order_status_id', '=', $status_id)->where('seller_id', '=', $seller_id)->count();
	}

	return $count;
}

function getTax() {

	$results = Tax::offset(0)->limit(1)->get();

	$datalist = array('id' => '', 'title' => 'VAT', 'percentage' => 0, 'is_publish' => 2);
	foreach ($results as $row){
		$datalist['id'] = $row->id;
		$datalist['title'] = $row->title;
		if($row->is_publish == 2){
			$datalist['percentage'] = 0;
		}else{
			$datalist['percentage'] = $row->percentage;
		}
		$datalist['is_publish'] = $row->is_publish;
	}
	return $datalist;
}

function str_slug($str) {

	$str_slug = Str::slug($str, "-");

	return $str_slug;
}

function str_url($string) {
	$string = (string) $string;

	if ( 0 === strlen($string) ) {
		return '';
	}

	$str_slug = Str::slug($string, "+");

	return $str_slug;
}

function str_limit($str) {

	$str_limit = Str::limit($str, 25, '...');

	return $str_limit;
}

function sub_str($str, $start=0, $end=1) {

	$string = Str::substr($str, $start, $end);

	return $string;
}

function comma_remove($string) {

	$replaced = Str::remove(',', $string);

	return $replaced;
}

function esc($string){
	$string = (string) $string;

	if ( 0 === strlen($string) ) {
		return '';
	}

	$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

	return $string;
}

function NumberFormat($number){

 	$currency = Tp_option::where('option_name', 'currency')->get();

	$currency_id = '';
	foreach ($currency as $row){
		$currency_id = $row->id;
	}

	$thousands_separator = ",";
	$decimal_separator = ".";
	$decimal_digit = 2;

	if($currency_id != ''){
		$currencyData = json_decode($currency);
		$currencyObj = json_decode($currencyData[0]->option_value);

		$ThouSep = $currencyObj->thousands_separator;
		if($ThouSep == 'comma'){
			$thousands_separator = ",";
		}elseif($ThouSep == 'point'){
			$thousands_separator = ".";
		}else{
			$thousands_separator = " ";
		}

		$DecimalSep = $currencyObj->decimal_separator;
		if($DecimalSep == 'comma'){
			$decimal_separator = ",";
		}elseif($DecimalSep == 'point'){
			$decimal_separator = ".";
		}else{
			$decimal_separator = " ";
		}

		$decimal_digit = $currencyObj->decimal_digit;
	}

	$numFormat = number_format($number , $decimal_digit , $decimal_separator , $thousands_separator);

	return $numFormat;
}

function gSellerSettings(){

	$datalist = Tp_option::where('option_name', 'seller_settings')->get();
	$id = '';
	$option_value = '';
	foreach ($datalist as $row){
		$id = $row->id;
		$option_value = json_decode($row->option_value);
	}

	$data = array();
	if($id != ''){
		$data['fee_withdrawal'] = $option_value->fee_withdrawal;
		$data['product_auto_publish'] = $option_value->product_auto_publish;
		$data['seller_auto_active'] = $option_value->seller_auto_active;
	}else{
		$data['fee_withdrawal'] = 0;
		$data['product_auto_publish'] = 0;
		$data['seller_auto_active'] = 0;
	}

	return $data;
}

function gMenuUpdate($item_id, $menu_type, $item_label, $slug) {

	$data = array(
		'item_label' => $item_label,
		'custom_url' => $slug
	);

	Menu_parent::where('item_id', '=', $item_id)->where('menu_type', '=', $menu_type)->update($data);
	Menu_child::where('item_id', '=', $item_id)->where('menu_type', '=', $menu_type)->update($data);
}




function FooterSection(){
    $PageVariation = PageVariation();
    $HomeVariation = $PageVariation['home_variation'];

    return Cache::remember("footer_section_{$HomeVariation}", 3600, function () use ($HomeVariation) {
        $section15 = Section_manage::where('manage_type', $HomeVariation)
            ->where('section', 'section_15')
            ->where('is_publish', 1)
            ->first();

        if (!$section15) {
            $section15_array = [
                'title'      => '',
                'desc'       => '',
                'image'      => '',
                'is_publish' => 2,
            ];
            $section15 = (object) $section15_array;
        }

        return $section15;
    });
}