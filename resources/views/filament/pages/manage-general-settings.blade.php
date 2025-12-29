<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        
        <!-- Site Identity Section -->
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-header flex flex-col gap-3 px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    Site Identity
                </h3>
                <p class="fi-section-header-description text-sm text-gray-500 dark:text-gray-400">
                    Manage your website's core branding and identity.
                </p>
            </div>

            <div class="fi-section-content p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Site Name -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                            Site Name <span class="text-red-600">*</span>
                        </label>
                        <input type="text" wire:model="site_name" 
                            class="block w-full rounded-lg border-none bg-white/5 py-1.5 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-950/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500">
                        @error('site_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Theme Color -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                            Theme Color <span class="text-red-600">*</span>
                        </label>
                        <div class="flex items-center gap-3">
                            <div class="relative overflow-hidden w-10 h-10 rounded-lg ring-1 ring-gray-200 dark:ring-gray-700">
                                <input type="color" wire:model="theme_color" class="absolute inset-0 w-[150%] h-[150%] -top-[25%] -left-[25%] cursor-pointer p-0 border-0">
                            </div>
                            <input type="text" wire:model="theme_color" 
                                class="block w-32 rounded-lg border-none bg-white/5 py-1.5 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-950/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500">
                        </div>
                        @error('theme_color') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-span-1 md:col-span-2 space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                            Site Description
                        </label>
                        <textarea wire:model="site_description" rows="3" 
                            class="block w-full rounded-lg border-none bg-white/5 py-1.5 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-950/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500"></textarea>
                    </div>

                    <!-- Logo -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Site Logo</label>
                        <div class="mt-2 flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800 ring-1 ring-gray-950/5 dark:ring-white/10">
                            <div class="flex items-center gap-4">
                                @if($site_logo)
                                    <img src="{{ $site_logo->temporaryUrl() }}" class="h-12 w-auto rounded border border-gray-200 dark:border-gray-700">
                                @elseif($existing_site_logo)
                                    <img src="{{ Storage::url($existing_site_logo) }}" class="h-12 w-auto rounded border border-gray-200 dark:border-gray-700">
                                @else
                                    <div class="h-12 w-12 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="text-sm text-gray-500">
                                    <span class="block font-medium text-gray-900 dark:text-gray-200">Current Logo</span>
                                    <span class="text-xs">PNG, JPG, SVG up to 1MB</span>
                                </div>
                            </div>
                             <div class="flex items-center gap-2">
                                <label class="cursor-pointer inline-flex items-center gap-2 px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Change</span>
                                    <input type="file" wire:model="site_logo" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                         <div wire:loading wire:target="site_logo" class="text-xs text-indigo-500 mt-1">Uploading...</div>
                         @error('site_logo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Favicon -->
                     <div class="space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Favicon</label>
                        <div class="mt-2 flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800 ring-1 ring-gray-950/5 dark:ring-white/10">
                            <div class="flex items-center gap-4">
                                @if($favicon)
                                    <img src="{{ $favicon->temporaryUrl() }}" class="h-8 w-8 rounded border border-gray-200 dark:border-gray-700">
                                @elseif($existing_favicon)
                                    <img src="{{ Storage::url($existing_favicon) }}" class="h-8 w-8 rounded border border-gray-200 dark:border-gray-700">
                                @else
                                    <div class="h-8 w-8 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                 <div class="text-sm text-gray-500">
                                    <span class="block font-medium text-gray-900 dark:text-gray-200">Icon</span>
                                    <span class="text-xs">ICO, PNG up to 512KB</span>
                                </div>
                            </div>
                             <div class="flex items-center gap-2">
                                <label class="cursor-pointer inline-flex items-center gap-2 px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Change</span>
                                    <input type="file" wire:model="favicon" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                        <div wire:loading wire:target="favicon" class="text-xs text-indigo-500 mt-1">Uploading...</div>
                         @error('favicon') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-header flex flex-col gap-3 px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    SEO Configuration
                </h3>
                 <p class="fi-section-header-description text-sm text-gray-500 dark:text-gray-400">
                    Set default meta tags for better search engine visibility.
                </p>
            </div>
            <div class="fi-section-content p-6">
                 <div class="grid grid-cols-1 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">SEO Title</label>
                        <input type="text" wire:model="seo_title" 
                            class="block w-full rounded-lg border-none bg-white/5 py-1.5 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-950/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500">
                    </div>
                     <div class="space-y-2">
                        <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">SEO Description</label>
                        <textarea wire:model="seo_description" rows="2" 
                            class="block w-full rounded-lg border-none bg-white/5 py-1.5 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-950/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-x-3 pt-4">
             <button type="button" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save Changes
            </button>
        </div>
    </form>
</x-filament-panels::page>
