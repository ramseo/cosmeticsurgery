<link rel="canonical" href="<?= url()->current() ?>">

<meta property="og:locale" content="en_US" />

<?php
$meta_img_target = asset("img/Buccal-Fat-Removal-Cheek-Reduction-1-1024x683.jpg");
$meta_description_target = "";

$request = $_SERVER['REQUEST_URI'];
$params     = explode("/", $request);
//echo $params[1];
//echo $params[2];

  $geturl = $params[1];


//print_r($$module_name_singular);
//exit();



if (isset($$module_name_singular)) {
    if (isset($$module_name_singular->meta_description)) {
        $meta_description_target = $$module_name_singular->meta_description;
        if($geturl=='blog'){ 
        $meta_img = $$module_name_singular->featured_image; 
        $meta_img_target = asset($meta_img);
         } else {
            $meta_img_target = asset("img/Buccal-Fat-Removal-Cheek-Reduction-1-1024x683.jpg");
         }      
        
    }
}

if (!isset($meta_page_type)) {
    $meta_page_type = 'website';
}

switch ($meta_page_type) {
    case "website":
        echo "<meta property='og:type' content='website' />";
        break;
    case "article":
        echo '<meta property="og:type" content="article" />';
        echo '<meta property="article:published_time" content="' . $$module_name_singular->published_at . '" />';
        echo '<meta property="article:modified_time" content="' . $$module_name_singular->updated_at . '" />';
        echo '<meta property="article:publisher" content="' . isset($$module_name_singular->created_by_alias) ? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name . '" />';
        echo '<meta property="article:author" content="' . isset($$module_name_singular->created_by_alias) ? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name . '" />';
        echo '<meta property="article:section" content="' . $$module_name_singular->category_name . '" />';
        foreach ($$module_name_singular->tags as $tag) {
            echo  '<meta property="article:tag" content="' . $tag->name . '" />';
        }
        break;
    case "profile":
        echo '<meta property="og:type" content="profile" />';
        echo '<meta property="profile:first_name" content="' . $$module_name_singular->first_name . '" />';
        echo '<meta property="profile:last_name" content="' . $$module_name_singular->last_name . '" />';
        echo '<meta property="profile:username" content="' . $$module_name_singular->email . '" />';
        echo '<meta property="profile:gender" content="' . $$module_name_singular->gender . '" />';
        break;
    default:
        echo "";
}
?> 

<!-- OG Meta -->
<meta property="og:title" content="@yield('title') | {{ config('app.name') }}" />
<meta property="og:description" content="<?= $meta_description_target ?>" />
<meta property="og:url" content="<?= url()->full() ?>" />
<meta property="og:site_name" content="CosmeticSurgery.in" />
<meta property="og:image" content="<?= $meta_img_target ?>" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<!-- Twitter Meta -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@CosmeticSurgIN">
<meta name="twitter:title" content="@yield('title') | {{ config('app.name') }}">
<meta name="twitter:description" content="<?= $meta_description_target ?>">
<meta name="twitter:creator" content="<?= url()->current() ?>">
<meta name="twitter:image" content="<?= $meta_img_target ?>">
<meta name="twitter:url" content="<?= url()->full() ?>" />



