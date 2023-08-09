const mix = require('laravel-mix');

mix.copyDirectory("resources/assets/vendor", "public/vendor")
    .copyDirectory("resources/assets/img", "public/img")
    .copyDirectory("resources/theme/images", "public/images");


mix.js('resources/assets/js/app.js', 'public/js').postCss('resources/assets/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
]);

/**
 *
 * Copy Assets
 *
 * -----------------------------------------------------------------------------
 */
// jquery and icon fonts
mix.copy("node_modules/jquery/dist/jquery.min.js", "public/js/jquery.min.js")
    .copy("node_modules/@fortawesome/fontawesome-free/webfonts/*", "public/webfonts")
    .copy('node_modules/@coreui/icons/fonts', 'public/fonts');

/**
 *
 * Backend
 *
 * -----------------------------------------------------------------------------
 */
// Build Backend SASS
mix.sass("resources/assets/sass/backend.scss", "public/css/backend-theme.css");

// Backend CSS
mix.styles(
    [
        "public/css/backend-theme.css",
        "node_modules/@coreui/icons/css/all.css",
        "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
        "resources/assets/css/custom-backend.css"
    ],
    "public/css/backend.css"
);

// Backend JS
mix.scripts(
    [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js",
        "node_modules/@coreui/coreui/dist/js/coreui.bundle.js",
        "resources/assets/js/laravel.js",
        "resources/assets/js/custom-backend.js"
    ],
    "public/js/backend.js"
);

/**
 *
 * Frontend
 *
 * -----------------------------------------------------------------------------
 */
// frontend-theme
mix.styles(
    [
        // "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
        // "public/vendor/impact-design/front/css/front.css",
        "resources/theme/css/justifiedGallery.min.css",
        // "resources/theme/css/owl.carousel.min.css",
        // "resources/theme/css/owl.theme.default.min.css",
        "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
        "resources/theme/css/rateit.css",
        "resources/theme/css/pooja.css",
        "resources/theme/css/style.css",
        "resources/theme/css/responsive.css"
    ],
    "public/css/wed.css"
);

// frontend js
mix.scripts(
    [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/popper.js/dist/umd/popper.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "node_modules/headroom.js/dist/headroom.min.js",
        "node_modules/onscreen/dist/on-screen.umd.min.js",
        "node_modules/waypoints/lib/jquery.waypoints.min.js",
        "node_modules/jarallax/dist/jarallax.min.js",
        "node_modules/smooth-scroll/dist/smooth-scroll.polyfills.min.js",
        "public/vendor/impact-design/front/assets/js/front.js",
        "resources/theme/js/jquery.justifiedGallery.min.js",
        "resources/theme/js/owl.carousel.min.js",
        "resources/theme/js/jquery.rateit.min.js",
        "resources/theme/js/jquery-asRange.min.js",
        "resources/theme/js/custom.js",
        // "resources/theme/js/light.js",
        "resources/theme/js/lead.js",
    ],
    "public/js/wed.js"
);

mix.scripts(
    [
        "resources/theme/js/light.js",
    ],
    "public/js/light.js"
);


// frontend-dashboard-theme
mix.styles(
    [
        "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
        "public/vendor/impact-design/dashboard/css/dashboard.css",
        "resources/assets/css/custom-dashboard.css",
    ],
    "public/css/dashboard.css"
);

// frontend-dashboard js
mix.scripts(
    [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/popper.js/dist/umd/popper.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "public/vendor/impact-design/dashboard/assets/vendor/js-cookie/js.cookie.js",
        "public/vendor/impact-design/dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js",
        "public/vendor/impact-design/dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js",
        "public/vendor/impact-design/dashboard/assets/vendor/chart.js/dist/Chart.min.js",
        "public/vendor/impact-design/dashboard/assets/vendor/chart.js/dist/Chart.extension.js",
        "public/vendor/impact-design/dashboard/assets/js/dashboard.js",
        "resources/assets/js/custom-dashboard.js"
    ],
    "public/js/dashboard.js"
);

if (mix.inProduction()) {
    mix.version();
}
