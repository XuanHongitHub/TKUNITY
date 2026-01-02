<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;

class ManageGeneralSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?int $navigationSort = 99;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | \UnitEnum | null $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'General';
    protected static ?string $title = 'General Settings';
    protected ?string $subheading = 'Manage your site identity, contact info, and core configurations.';

    protected string $view = 'filament.pages.manage-general-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(GeneralSettings::class);
        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        // Tab 1: Identity
                        Tabs\Tab::make('Identity')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                Section::make('Brand Identity')
                                    ->description('Set the core identity of your website.')
                                    ->aside()
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->label('Site Name')
                                            ->placeholder('e.g. TK Unity')
                                            ->required()
                                            ->live(),
                                        Textarea::make('site_description')
                                            ->label('Site Description')
                                            ->placeholder('Briefly describe your company...')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Tab 2: Contact
                        Tabs\Tab::make('Contact')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Section::make('Contact Details')
                                    ->description('Publicly visible contact information.')
                                    ->aside()
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('contact_email')
                                                ->label('Email Address')
                                                ->placeholder('support@tkunity.com')
                                                ->email()
                                                ->prefixIcon('heroicon-m-envelope'),
                                            TextInput::make('contact_phone')
                                                ->label('Phone Number')
                                                ->placeholder('+84 935 309 099')
                                                ->tel()
                                                ->prefixIcon('heroicon-m-phone'),
                                            Textarea::make('contact_address')
                                                ->label('Physical Address')
                                                ->placeholder('Lot 01 A3 Nguyen Sinh Sac...')
                                                ->rows(3)
                                                ->columnSpanFull(),
                                        ]),
                                    ]),
                                Section::make('Social Profiles')
                                    ->description('Links to your social media presence.')
                                    ->aside()
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('social_facebook')
                                                ->label('Facebook')
                                                ->prefix('facebook.com/')
                                                ->placeholder('username')
                                                ->prefixIcon('heroicon-m-user-group'),
                                            TextInput::make('social_twitter')
                                                ->label('X (Twitter)')
                                                ->prefix('twitter.com/')
                                                ->placeholder('username'),
                                            TextInput::make('social_linkedin')
                                                ->label('LinkedIn')
                                                ->prefix('linkedin.com/in/')
                                                ->placeholder('username')
                                                ->prefixIcon('heroicon-m-briefcase'),
                                            TextInput::make('social_youtube')
                                                ->label('YouTube')
                                                ->prefix('youtube.com/@')
                                                ->placeholder('channel')
                                                ->prefixIcon('heroicon-m-play-circle'), 
                                        ]),
                                    ]),
                            ]),

                        // Tab 3: Home Page
                        Tabs\Tab::make('Home Page')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Hero Branding')
                                    ->description('Main visual and headline for the homepage.')
                                    ->aside()
                                    ->schema([
                                        FileUpload::make('home_hero_bg')
                                            ->label('Hero Background Image')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image()
                                            ->columnSpanFull(),
                                        Grid::make(2)->schema([
                                            TextInput::make('home_hero_label')
                                                ->label('Hero Label')
                                                ->placeholder('Architecting Virtual Worlds')
                                                ->columnSpanFull(),
                                            TextInput::make('home_hero_title')
                                                ->label('Headline')
                                                ->placeholder('Innovation in Every Pixel')
                                                ->columnSpanFull(),
                                            Textarea::make('home_hero_subtitle')
                                                ->label('Subheadline')
                                                ->placeholder('Brief description below the title...')
                                                ->rows(3)
                                                ->columnSpanFull(),
                                            TextInput::make('home_hero_cta_text')
                                                ->label('Primary CTA Text')
                                                ->placeholder('Explore Games'),
                                            TextInput::make('home_hero_cta_url')
                                                ->label('Primary CTA URL')
                                                ->placeholder('/games'),
                                            TextInput::make('home_hero_cta2_text')
                                                ->label('Secondary CTA Text')
                                                ->placeholder('AI Solutions'),
                                            TextInput::make('home_hero_cta2_url')
                                                ->label('Secondary CTA URL')
                                                ->placeholder('/ai-trainer'),
                                        ]),
                                    ]),

                                Section::make('Focus Area')
                                    ->description('Section highlighting core business focus.')
                                    ->aside()
                                    ->schema([
                                        FileUpload::make('home_focus_image')
                                            ->label('Focus Section Image')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image()
                                            ->columnSpanFull(),
                                        Grid::make(2)->schema([
                                            TextInput::make('home_focus_badge_label')
                                                ->label('Badge Label')
                                                ->placeholder('Core Architecture'),
                                            TextInput::make('home_focus_badge_text')
                                                ->label('Badge Text')
                                                ->placeholder('Dual-Engine Growth'),
                                            TextInput::make('home_focus_label')
                                                ->label('Section Label')
                                                ->placeholder('Our Focus')
                                                ->columnSpanFull(),
                                            TextInput::make('home_focus_title')
                                                ->label('Focus Title')
                                                ->placeholder('Focused on Impact')
                                                ->columnSpanFull(),
                                            Textarea::make('home_focus_desc')
                                                ->label('Focus Description')
                                                ->rows(3)
                                                ->columnSpanFull(),
                                        ]),
                                    ]),

                                Section::make('Game Section')
                                    ->description('Specific branding for the games area.')
                                    ->aside()
                                    ->schema([
                                        FileUpload::make('home_section_games_image')
                                            ->label('Games Image')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image(),
                                        Grid::make(2)->schema([
                                            TextInput::make('home_section_games_badge_label')
                                                ->label('Badge Label')
                                                ->placeholder('Engine'),
                                            TextInput::make('home_section_games_badge_text')
                                                ->label('Badge Text')
                                                ->placeholder('Unity'),
                                        ]),
                                        TextInput::make('home_section_games_title')
                                            ->label('Games Title')
                                            ->columnSpanFull(),
                                        Textarea::make('home_section_games_desc')
                                            ->label('Games Description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Forms\Components\TagsInput::make('home_section_games_features')
                                            ->label('Games Features/Bullets')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('AI Section')
                                    ->description('Specific branding for the AI area.')
                                    ->aside()
                                    ->schema([
                                        FileUpload::make('home_section_ai_image')
                                            ->label('AI Image')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image(),
                                        Grid::make(2)->schema([
                                            TextInput::make('home_section_ai_badge_label')
                                                ->label('Badge Label')
                                                ->placeholder('Technology'),
                                            TextInput::make('home_section_ai_badge_text')
                                                ->label('Badge Text')
                                                ->placeholder('Computer Vision'),
                                        ]),
                                        TextInput::make('home_section_ai_title')
                                            ->label('AI Title')
                                            ->columnSpanFull(),
                                        Textarea::make('home_section_ai_desc')
                                            ->label('AI Description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Forms\Components\TagsInput::make('home_section_ai_features')
                                            ->label('AI Features/Bullets')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('CTA Footer')
                                    ->description('Large call-to-action before the site footer.')
                                    ->aside()
                                    ->schema([
                                        TextInput::make('home_cta_title')
                                            ->label('CTA Title')
                                            ->columnSpanFull(),
                                        Textarea::make('home_cta_desc')
                                            ->label('CTA Description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Grid::make(2)->schema([
                                            TextInput::make('home_cta_btn1_text')
                                                ->label('Button 1 Text'),
                                            TextInput::make('home_cta_btn1_url')
                                                ->label('Button 1 URL'),
                                            TextInput::make('home_cta_btn2_text')
                                                ->label('Button 2 Text'),
                                            TextInput::make('home_cta_btn2_url')
                                                ->label('Button 2 URL'),
                                        ]),
                                    ]),
                            ]),

                        // Tab 4: Assets (Media)
                        Tabs\Tab::make('Assets')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Brand Assets')
                                    ->description('Manage logos and icons.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            FileUpload::make('site_logo')
                                                ->label('Primary Logo')
                                                ->helperText('Main header logo.')
                                                ->disk('public')
                                                ->directory('settings')
                                                ->image()
                                                ->imageEditor(),
                                            FileUpload::make('logo_light')
                                                ->label('Light Version')
                                                ->helperText('For dark backgrounds (Footer).')
                                                ->disk('public')
                                                ->directory('settings')
                                                ->image(),
                                            FileUpload::make('logo_dark')
                                                ->label('Dark Version')
                                                ->helperText('For light backgrounds.')
                                                ->disk('public')
                                                ->directory('settings')
                                                ->image(),
                                            FileUpload::make('logo_red')
                                                ->label('Accent (Red)')
                                                ->disk('public')
                                                ->directory('settings')
                                                ->image(),
                                            FileUpload::make('logo_icon')
                                                ->label('App Icon')
                                                ->helperText('Small square icon.')
                                                ->disk('public')
                                                ->directory('settings')
                                                ->image(),
                                            FileUpload::make('favicon')
                                                ->label('Favicon')
                                                ->disk('public')
                                                ->directory('settings')
                                                ->image(),
                                        ]),
                                    ]),
                            ]),

                        // Tab 5: SEO & Integration
                        Tabs\Tab::make('SEO & Advanced')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Search Engine Optimization')
                                    ->description('Improve your visibility on Google.')
                                    ->schema([
                                        View::make('filament.components.seo-preview')
                                            ->viewData(fn ($get) => [
                                                'seo_title' => $get('seo_title'),
                                                'seo_description' => $get('seo_description'),
                                                'site_name' => $get('site_name'),
                                            ])
                                            ->columnSpanFull(),
                                        Grid::make(1)->schema([
                                            TextInput::make('seo_title')
                                                ->label('Meta Title')
                                                ->placeholder('Page Title | Site Name')
                                                ->live(debounce: 500)
                                                ->maxLength(60),
                                            Textarea::make('seo_description')
                                                ->label('Meta Description')
                                                ->placeholder('A concise summary of the page content...')
                                                ->live(debounce: 500)
                                                ->rows(3)
                                                ->maxLength(160),
                                        ]),
                                    ]),
                                Section::make('Custom Scripts')
                                    ->description('Inject third-party scripts (Analytics, Chat, Pixels).')
                                    ->collapsed()
                                    ->schema([
                                        Textarea::make('google_tags')
                                            ->label('Google Tags (Head)')
                                            ->placeholder('<script>...</script>')
                                            ->extraInputAttributes(['style' => 'font-family: monospace; background-color: #1e1e1e; color: #d4d4d4; padding: 10px; border-radius: 6px; border: 1px solid #3c3c3c; line-height: 1.5;'])
                                            ->rows(8),
                                        Textarea::make('tiktok_pixel')
                                            ->label('TikTok Pixel')
                                            ->placeholder('<script>...</script>')
                                            ->extraInputAttributes(['style' => 'font-family: monospace; background-color: #1e1e1e; color: #d4d4d4; padding: 10px; border-radius: 6px; border: 1px solid #3c3c3c; line-height: 1.5;'])
                                            ->rows(8),
                                        Textarea::make('site_footer')
                                            ->label('Footer Scripts')
                                            ->placeholder('<script>...</script>')
                                            ->extraInputAttributes(['style' => 'font-family: monospace; background-color: #1e1e1e; color: #d4d4d4; padding: 10px; border-radius: 6px; border: 1px solid #3c3c3c; line-height: 1.5;'])
                                            ->rows(8),
                                    ]),
                            ]),
                    ])
                    ->vertical() // Attempting vertical tabs based on Filament standard
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = app(GeneralSettings::class);

        foreach ($data as $key => $value) {
            if (property_exists($settings, $key)) {
                $settings->{$key} = $value;
            }
        }
        
        $settings->save();

        Notification::make() 
            ->success()
            ->title('Settings updated')
            ->body('Changes have been saved successfully.')
            ->send();
    }
    
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }
}
