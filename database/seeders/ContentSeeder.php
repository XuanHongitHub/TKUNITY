<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::query()->where('email', 'admin@tkunity.com')->first()
            ?? User::query()->first();

        $this->cleanupLegacyContent();

        $categories = $this->seedCategories();
        $this->seedPages();

        if ($author) {
            $this->seedPosts($author->id, $categories);
        }
    }

    private function cleanupLegacyContent(): void
    {
        Post::query()->whereIn('slug', [
            'season-4-championship-begins',
            'new-game-added-shadow-realms',
            'discord-milestone-100k-members',
            'double-rewards-weekend',
            'tkunity-partners-with-razer',
        ])->delete();

        Category::query()->whereIn('slug', [
            'tournaments',
            'events',
            'partnership',
        ])->delete();
    }

    private function seedCategories(): array
    {
        $items = [
            [
                'name' => 'Updates',
                'slug' => 'updates',
                'description' => 'Platform updates and service improvements.',
            ],
            [
                'name' => 'Guides',
                'slug' => 'guides',
                'description' => 'How-to guides for topups and account management.',
            ],
            [
                'name' => 'Community',
                'slug' => 'community',
                'description' => 'Community updates and guidelines.',
            ],
            [
                'name' => 'Maintenance',
                'slug' => 'maintenance',
                'description' => 'Service availability and maintenance updates.',
            ],
            [
                'name' => 'Promotions',
                'slug' => 'promotions',
                'description' => 'Rewards and promotional offers for topups.',
            ],
        ];

        $results = [];

        foreach ($items as $item) {
            $results[$item['slug']] = Category::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'is_visible' => true,
                ]
            );
        }

        return $results;
    }

    private function seedPages(): void
    {
        $helpCenterContent = <<<'HTML'
<h2>Help Center</h2>
<p>Have questions? We are here to help with topups, account access, and order support. Send us a message and we will respond as soon as possible.</p>

<h3>Contact Channels</h3>
<ul>
    <li><strong>Email Support:</strong> support@tkunity.com</li>
    <li><strong>Business Partnerships:</strong> business@tkunity.com</li>
</ul>

<h3>Response Time</h3>
<p>We typically respond within 24 hours. For urgent issues, please use our live chat support.</p>

<h3>Frequently Asked Questions</h3>
<ul>
    <li><strong>How long until I get a response?</strong> We typically respond within 24 hours. For urgent issues, use live chat support.</li>
    <li><strong>My topup has not arrived yet.</strong> Check your email for confirmation. If it has been more than 30 minutes, contact support with your order ID.</li>
    <li><strong>Can I request a refund?</strong> Refunds are handled on a case-by-case basis. Contact support with your order details so we can review your request.</li>
    <li><strong>How do I become a partner?</strong> Email business@tkunity.com with your proposal.</li>
</ul>

<h3>Support Hours</h3>
<ul>
    <li><strong>Live Chat:</strong> 24/7 available</li>
    <li><strong>Email Support:</strong> Mon - Fri, 9AM - 6PM</li>
</ul>
HTML;

        $faqsContent = <<<'HTML'
<h2>FAQs</h2>
<p>Quick answers to common questions about TKUnity topups, orders, and accounts.</p>

<h3>Topups</h3>
<ul>
    <li><strong>How fast is delivery?</strong> Most orders are delivered within minutes after payment confirmation. Some games may take longer.</li>
    <li><strong>Which games are supported?</strong> We currently support Game 1 through Game 6. The catalog is updated regularly.</li>
</ul>

<h3>Payments</h3>
<ul>
    <li><strong>What payment methods are available?</strong> We support common cards, bank transfers, and local e-wallets where available.</li>
    <li><strong>My payment failed.</strong> Check your card limit or try a different method. If it continues, contact support.</li>
</ul>

<h3>Orders</h3>
<ul>
    <li><strong>How do I track my order?</strong> Use your order ID from the confirmation email and contact support if needed.</li>
    <li><strong>Can I request a refund?</strong> Refunds are reviewed on a case-by-case basis. Contact support with your order details.</li>
</ul>

<h3>Account</h3>
<ul>
    <li><strong>I entered the wrong game ID.</strong> Contact support immediately with your order ID.</li>
    <li><strong>How do I secure my account?</strong> Use a strong password and keep your login details private.</li>
</ul>
HTML;

        $partnersContent = <<<'HTML'
<h2>Partners</h2>
<p>TKUnity collaborates with partners to deliver fast and secure topups for gamers.</p>

<h3>Who We Work With</h3>
<ul>
    <li><strong>Game publishers:</strong> Offer official topups and in-game credit bundles.</li>
    <li><strong>Payment providers:</strong> Support secure and reliable checkout options.</li>
    <li><strong>Marketing affiliates:</strong> Run campaigns that grow the TKUnity community.</li>
</ul>

<h3>Why Partner with TKUnity</h3>
<ul>
    <li>Focused on fast delivery and transparent order tracking.</li>
    <li>Collaborative campaigns with clear reporting.</li>
    <li>Security-first approach to payments and data handling.</li>
</ul>

<h3>How to Apply</h3>
<p>Email business@tkunity.com with your company details, website, and partnership goals. Our team will review and respond.</p>
HTML;

        $termsContent = <<<'HTML'
<h2>Terms of Service</h2>
<p>These terms outline how you can use TKUnity services, including topups and account features. By using TKUnity, you agree to follow these terms and any rules provided for specific services.</p>

<h3>1. Using TKUnity</h3>
<p>TKUnity provides a platform for gamers to access topups, events, and community updates. You agree to use the service responsibly and in accordance with applicable policies.</p>

<h3>2. Accounts and Access</h3>
<p>You are responsible for maintaining the security of your account and for all activity that happens under your account.</p>

<h3>3. Payments and Topups</h3>
<p>Topup purchases must use supported payment methods and accurate account information. Orders are processed as submitted to ensure fast delivery.</p>

<h3>4. Promotions and Offers</h3>
<p>Promotions may include eligibility requirements and limited-time conditions. Please review the details before participating in any offer.</p>

<h3>5. Community Conduct</h3>
<p>Respectful conduct is required across TKUnity channels. Harassment, cheating, or abuse may result in restrictions or account actions.</p>

<h3>6. Service Availability</h3>
<p>We may update, suspend, or maintain parts of the service to keep TKUnity reliable and secure. Scheduled maintenance will be announced whenever possible.</p>

<h3>7. Contact</h3>
<p>If you have questions about these terms, contact support at support@tkunity.com.</p>
HTML;

        $privacyContent = <<<'HTML'
<h2>Privacy Policy</h2>
<p>This policy explains what information TKUnity collects and how it is used to operate our services.</p>

<h3>1. Information We Collect</h3>
<ul>
    <li>Account details such as name and email.</li>
    <li>Contact requests submitted through our support channels.</li>
    <li>Order and transaction details to deliver topups accurately.</li>
    <li>Usage data to improve performance and security.</li>
</ul>

<h3>2. How We Use Information</h3>
<ul>
    <li>Provide and support TKUnity services.</li>
    <li>Process orders and verify transactions.</li>
    <li>Maintain platform security and prevent abuse.</li>
    <li>Improve user experience and service reliability.</li>
</ul>

<h3>3. Sharing and Disclosure</h3>
<ul>
    <li>We share information only with service providers needed to operate TKUnity, or when required by law.</li>
</ul>

<h3>4. Your Choices</h3>
<p>You can update your account information or contact support to request changes to your data.</p>

<h3>5. Contact</h3>
<p>Questions about privacy can be sent to support@tkunity.com.</p>
HTML;

        $aboutContent = <<<'HTML'
<h2>Empowering Gamers Worldwide</h2>
<p>Founded by gamers, for gamers. TKUnity is building the future of digital gaming commerce.</p>

<h3>Our Story</h3>
<p>TKUnity started from a simple frustration: topping up games should be fast, clear, and secure. Our team set out to build a better experience for gamers.</p>
<p>What began as a small project has grown into a platform trusted by a growing community across Southeast Asia. We believe everyone deserves instant access to their favorite games without the hassle.</p>
<p>Today, we keep expanding our game catalog and improving the topup flow with a team of gamers who care about every detail.</p>
<ul>
    <li><strong>Fast topups</strong> with clear order status</li>
    <li><strong>Secure payments</strong> and reliable delivery</li>
    <li><strong>Always-on support</strong> when you need help</li>
</ul>

<h3>Mission & Vision</h3>
<p><strong>Mission:</strong> Make gaming accessible to everyone by providing instant, secure, and affordable game topup services.</p>
<p><strong>Vision:</strong> Become the leading gaming platform in Southeast Asia, known for trust, speed, and an unmatched user experience.</p>

<h3>Our Values</h3>
<ul>
    <li><strong>Speed First:</strong> Credits should arrive immediately, every time.</li>
    <li><strong>Trust & Security:</strong> Bank-grade encryption protects every transaction.</li>
    <li><strong>Community:</strong> We are gamers too, and we listen to the community.</li>
    <li><strong>Continuous Improvement:</strong> We never stop improving.</li>
</ul>

<h3>Meet the Team</h3>
<ul>
    <li><strong>Tran Hung</strong> - CEO & Founder</li>
    <li><strong>CTO</strong> - CTO</li>
    <li><strong>Pham Nam</strong> - Head of Operations</li>
    <li><strong>Van Linh</strong> - Community Lead</li>
</ul>

<h3>Partners</h3>
<p>Game 1, Game 2, Game 3, Game 4</p>

<h3>Join Our Journey</h3>
<p>We are always looking for talented people who share our passion for gaming.</p>
HTML;

        $careersContent = <<<'HTML'
<h2>Build the Future of Gaming</h2>
<p>Join a team of passionate gamers and innovators. We are on a mission to make gaming accessible to everyone.</p>

<h3>Why TKUnity?</h3>
<ul>
    <li><strong>Competitive Pay:</strong> Top of market salary and equity packages.</li>
    <li><strong>Flexible Work:</strong> Remote-first culture with flexible hours.</li>
    <li><strong>Unlimited PTO:</strong> Take the time you need.</li>
    <li><strong>Top Equipment:</strong> Provide the gear you need to do your best work.</li>
    <li><strong>Learning Budget:</strong> Grow with training and development support.</li>
    <li><strong>Great Culture:</strong> Team events, game nights, and a supportive community.</li>
</ul>

<h3>Open Positions</h3>
<ul>
    <li>Senior Frontend Developer - Remote / Ho Chi Minh City - Full-time</li>
    <li>Senior Backend Developer - Remote / Hanoi - Full-time</li>
    <li>DevOps Engineer - Remote - Full-time</li>
    <li>Product Designer - Ho Chi Minh City - Full-time</li>
    <li>UI/UX Designer - Remote - Full-time</li>
    <li>Growth Marketing Manager - Ho Chi Minh City - Full-time</li>
    <li>Content Writer - Remote - Full-time</li>
    <li>Customer Support Lead - Da Nang - Full-time</li>
</ul>

<h3>Culture</h3>
<p>We are gamers first and foremost. Our culture is built on transparency, ownership, and a relentless pursuit of excellence. From weekly game nights to quarterly hackathons, there is always something exciting happening at TKUnity.</p>

<h3>Ready to Join?</h3>
<p>Do not see a role that fits? We are always looking for talented people. Reach out and let us chat.</p>
HTML;

        $contactContent = <<<'HTML'
<h2>Get in Touch</h2>
<p>Have questions? We would love to hear from you. Send us a message and we will respond as soon as possible.</p>

<h3>Email Us</h3>
<ul>
    <li><strong>General inquiries:</strong> support@tkunity.com</li>
    <li><strong>Business partnerships:</strong> business@tkunity.com</li>
</ul>

<h3>Response Time</h3>
<p>We typically respond within 24 hours. For urgent issues, please use live chat support.</p>

<h3>Support Hours</h3>
<ul>
    <li><strong>Live Chat:</strong> 24/7 available</li>
    <li><strong>Email Support:</strong> Mon - Fri, 9AM - 6PM</li>
</ul>

<h3>Frequently Asked Questions</h3>
<ul>
    <li><strong>How long until I get a response?</strong> We typically respond within 24 hours. For urgent issues, use live chat support.</li>
    <li><strong>My topup has not arrived yet.</strong> Check your email for confirmation. If it has been more than 30 minutes, contact support with your order ID.</li>
    <li><strong>Can I request a refund?</strong> Refunds are handled on a case-by-case basis. Contact support with your order details so we can review your request.</li>
    <li><strong>How do I become a partner?</strong> Email business@tkunity.com with your proposal.</li>
</ul>
HTML;

        $pages = [
            [
                'title' => 'Help Center',
                'slug' => 'help-center',
                'code' => 'help-center',
                'content' => $helpCenterContent,
            ],
            [
                'title' => 'FAQs',
                'slug' => 'faqs',
                'code' => 'faqs',
                'content' => $faqsContent,
            ],
            [
                'title' => 'Partners',
                'slug' => 'partners',
                'code' => 'partners',
                'content' => $partnersContent,
            ],
            [
                'title' => 'Terms',
                'slug' => 'terms',
                'code' => 'terms',
                'content' => $termsContent,
            ],
            [
                'title' => 'Privacy',
                'slug' => 'privacy',
                'code' => 'privacy',
                'content' => $privacyContent,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'code' => null,
                'content' => $aboutContent,
            ],
            [
                'title' => 'Careers',
                'slug' => 'careers',
                'code' => null,
                'content' => $careersContent,
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'code' => null,
                'content' => $contactContent,
            ],
        ];

        foreach ($pages as $page) {
            $query = Page::query()->where('slug', $page['slug']);
            if ($page['code']) {
                $query->orWhere('code', $page['code']);
            }

            $record = $query->first();

            $payload = [
                'title' => $page['title'],
                'slug' => $page['slug'],
                'code' => $page['code'],
                'content' => $page['content'],
                'is_active' => true,
            ];

            if ($record) {
                $record->fill($payload)->save();
            } else {
                Page::query()->create($payload);
            }
        }
    }



    private function seedPosts(int $authorId, array $categories): void
    {
        $featuredContent = <<<'HTML'
<p>Welcome to TKUnity. This guide walks you through the quickest way to top up and manage your order from start to finish.</p>

<h2>Top Up in 4 Steps</h2>
<ol>
    <li><strong>Choose your game.</strong> Pick the title you want to top up.</li>
    <li><strong>Enter your player details.</strong> Provide the correct in-game ID.</li>
    <li><strong>Select an amount.</strong> Review the price and confirm.</li>
    <li><strong>Complete payment.</strong> Credits are delivered once payment is confirmed.</li>
</ol>

<h2>Order Status Guide</h2>
<ul>
    <li><strong>Pending:</strong> We are verifying your payment.</li>
    <li><strong>Processing:</strong> Credits are being delivered to your account.</li>
    <li><strong>Delivered:</strong> Your top up is complete.</li>
</ul>

<h2>Supported Games</h2>
<p>Top ups are currently available for: Game 1, Game 2, Game 3, Game 4.</p>
<p>We add new games regularly. If you want to request a game, contact support.</p>

<h2>Need Help?</h2>
<p>Visit the Help Center or email support@tkunity.com and our team will assist you.</p>
HTML;

        $posts = [
            [
                'title' => 'Getting Started with TKUnity',
                'slug' => 'getting-started-with-tkunity',
                'category' => 'guides',
                'published_at' => Carbon::now()->subDays(2),
                'content' => $featuredContent,
                'seo_description' => 'Learn how to top up, track orders, and get help on TKUnity.',
                'is_featured' => true,
                'tags' => ['guide', 'topup', 'getting-started'],
            ],
            [
                'title' => 'Order Status Guide: From Payment to Delivery',
                'slug' => 'order-status-guide',
                'category' => 'updates',
                'published_at' => Carbon::now()->subDays(3),
                'content' => '<p>Track your orders with clear statuses from payment verification to delivery. If an order stays pending for too long, contact support with your order ID.</p><h2>Status Definitions</h2><ul><li><strong>Pending:</strong> Payment is being verified.</li><li><strong>Processing:</strong> Delivery is in progress.</li><li><strong>Delivered:</strong> Credits have reached your account.</li></ul>',
                'seo_description' => 'Understand TKUnity order statuses and what each step means.',
                'tags' => ['updates', 'order-status', 'support'],
            ],
            [
                'title' => 'Supported Games on TKUnity',
                'slug' => 'supported-games-on-tkunity',
                'category' => 'updates',
                'published_at' => Carbon::now()->subDays(5),
                'content' => '<p>We are steadily expanding our catalog. Currently available: Game 1, Game 2, Game 3, Game 4.</p><p>If you want to request a new game, contact our support team.</p>',
                'seo_description' => 'See the current list of games supported on TKUnity.',
                'tags' => ['updates', 'games'],
            ],
            [
                'title' => 'Community Guidelines',
                'slug' => 'community-guidelines',
                'category' => 'community',
                'published_at' => Carbon::now()->subDays(7),
                'content' => '<p>TKUnity is built for gamers. Please keep conversations respectful and follow our rules to keep the community helpful and safe.</p><ul><li>Be respectful and constructive.</li><li>No cheating, fraud, or abuse.</li><li>Protect your account and personal information.</li></ul>',
                'seo_description' => 'Community guidelines for TKUnity users.',
                'tags' => ['community', 'guidelines'],
            ],
            [
                'title' => 'Rewards and Loyalty Overview',
                'slug' => 'rewards-and-loyalty-overview',
                'category' => 'promotions',
                'published_at' => Carbon::now()->subDays(10),
                'content' => '<p>Earn rewards on eligible topups and redeem them for bonuses and offers. Available rewards may vary by game and payment method.</p>',
                'seo_description' => 'Overview of TKUnity rewards and loyalty benefits.',
                'tags' => ['promotions', 'rewards'],
            ],
            [
                'title' => 'Service Status and Maintenance',
                'slug' => 'service-status-and-maintenance',
                'category' => 'maintenance',
                'published_at' => Carbon::now()->subDays(12),
                'content' => '<p>We announce maintenance windows here when they are scheduled. During maintenance, some services may be temporarily unavailable.</p><p>Check this page for the latest status updates.</p>',
                'seo_description' => 'Service status and maintenance updates for TKUnity.',
                'tags' => ['maintenance', 'status'],
            ],
        ];

        foreach ($posts as $postData) {
            $category = $categories[$postData['category']] ?? null;

            $post = Post::query()->updateOrCreate(
                ['slug' => $postData['slug']],
                [
                    'title' => $postData['title'],
                    'content' => $postData['content'],
                    'published_at' => $postData['published_at'],
                    'status' => 'published',
                    'author_id' => $authorId,
                    'category_id' => $category?->id,
                    'seo_title' => $postData['title'],
                    'seo_description' => $postData['seo_description'],
                    'is_featured' => $postData['is_featured'] ?? false,
                ]
            );

            // Tags temporarily disabled due to Spatie Tags complexity
            // TODO: Re-enable tags with proper format
            /*
            if (! empty($postData['tags'])) {
                $tags = collect($postData['tags'])
                    ->map(fn ($tag) => \Illuminate\Support\Str::slug($tag))
                    ->map(fn ($slug) => ucfirst(str_replace('-', ' ', $slug)))
                    ->toArray();

                if (method_exists($post, 'attachTags')) {
                    $post->attachTags($tags);
                }
            }
            */

            // Image attachment logic
            $slugImageMap = [
                'getting-started-with-tkunity' => 'images/news/flat/getting-started.png',
                'order-status-guide' => 'images/news/flat/order-status.png',
                'supported-games-on-tkunity' => 'images/news/flat/supported-games.png',
                'community-guidelines' => 'images/news/flat/community.png',
            ];

            $imagePath = $slugImageMap[$postData['slug']] ?? null;
            
            // Fallback to hero if specific image not found or not defined
            if (!$imagePath || !file_exists(public_path($imagePath))) {
                if ($postData['slug'] === 'getting-started-with-tkunity') {
                     // specific fallback for getting started if the flat one is missing 
                     $imagePath = 'images/home/hero.png';
                } else {
                     $imagePath = null; // Don't attach anything for others if no specific image, let blade handle generic fallback or attach generic here?
                     // Let's attach generic here so DB has data
                     $imagePath = 'images/home/hero.png';
                }
            }

            if ($imagePath && file_exists(public_path($imagePath)) && $post->getMedia('thumbnail')->isEmpty()) {
                $post->addMedia(public_path($imagePath))
                    ->preservingOriginal()
                    ->toMediaCollection('thumbnail');
            }
        }
    }
}
