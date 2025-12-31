<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Support/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('settings', function ($expression) {
            return "<?php echo setting({$expression}); ?>";
        });

        \Illuminate\Support\Facades\View::composer('components.site-header', function ($view) {
            $homeRoute = route('home');

            $items = [
                // Mega Menu Content (Hidden from Top Nav, triggered by Logo)
                [
                    'label' => 'Main Menu',
                    'url' => '#',
                    'target' => '_self',
                    'active' => false,
                    'type' => 'mega_menu',
                    'hidden_from_nav' => true,
                    'featured_image' => 'images/nav/home_banner_nav.png',
                    'featured_title' => 'Top Up Instantly',
                    'featured_description' => 'Secure payments and fast delivery for your games.',
                    'columns' => [
                        [
                            'title' => 'Games',
                            'links' => [
                                ['label' => 'Game 1', 'url' => $homeRoute . '#games', 'image' => 'images/LOGO_3D.webp', 'caption' => 'Topup ready'],
                                ['label' => 'Game 2', 'url' => $homeRoute . '#games', 'image' => 'images/tkunity_red.webp', 'caption' => 'Topup ready'],
                                ['label' => 'Game 3', 'url' => $homeRoute . '#games', 'image' => 'images/tkunity_white.webp', 'caption' => 'Topup ready'],
                                ['label' => 'Game 4', 'url' => $homeRoute . '#games', 'image' => 'images/LOGO_3D.webp', 'caption' => 'Topup ready'],
                            ],
                        ],
                        [
                            'title' => 'Support',
                            'links' => [
                                ['label' => 'Help Center', 'url' => route('help'), 'image' => 'images/nav/help_center_banner.png', 'caption' => 'Get Support 24/7'],
                                ['label' => 'FAQs', 'url' => route('faqs'), 'image' => 'images/nav/faqs_banner.png', 'caption' => 'Quick Answers'],
                                ['label' => 'Contact Us', 'url' => route('contact'), 'image' => 'images/nav/contact_us_banner.png', 'caption' => 'We are here to help'],
                                ['label' => 'Terms of Service', 'url' => route('terms'), 'image' => 'images/nav/terms_service_banner.png', 'caption' => 'Read our Terms'],
                                ['label' => 'Privacy Policy', 'url' => route('privacy'), 'image' => 'images/nav/privacy_policy_banner.png', 'caption' => 'Your Privacy Matters'],
                            ],
                        ],
                        [
                            'title' => 'Company',
                            'links' => [
                                ['label' => 'Home', 'url' => route('home'), 'image' => 'images/nav/home_banner_nav.png', 'caption' => 'Return to Home'],
                                ['label' => 'About Us', 'url' => route('about'), 'image' => 'images/nav/about_us_banner_nav.png', 'caption' => 'Our Story'],
                                ['label' => 'Careers', 'url' => route('careers'), 'image' => 'images/nav/careers_banner_nav.png', 'caption' => 'Join Our Team'],
                                ['label' => 'Partners', 'url' => route('partners'), 'image' => 'images/nav/partners_banner_nav.png', 'caption' => 'Our Partners'],
                            ],
                        ],
                    ],
                ],
                // Top Navigation Links
                [
                    'label' => 'Home',
                    'url' => route('home'),
                    'target' => '_self',
                    'active' => request()->routeIs('home'),
                    'type' => 'link',
                ],
                [
                    'label' => 'About Us',
                    'url' => route('about'),
                    'target' => '_self',
                    'active' => request()->routeIs('about'),
                    'type' => 'link',
                ],
                [
                    'label' => 'Contact',
                    'url' => route('contact'),
                    'target' => '_self',
                    'active' => request()->routeIs('contact'),
                    'type' => 'link',
                ],
                [
                    'label' => 'News',
                    'url' => route('news.index'),
                    'target' => '_self',
                    'active' => request()->routeIs('news.index', 'news.show'),
                    'type' => 'link',
                ],
            ];

            $view->with('items', $items);
        });
    }
}
