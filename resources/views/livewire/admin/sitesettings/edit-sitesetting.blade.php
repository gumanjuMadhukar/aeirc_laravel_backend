<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('sitesettings.edit_sitesetting') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('sitesettings.edit_sitesetting_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="updateSitesetting" class="space-y-6">

        {{-- Site Title --}}
        <flux:input wire:model.live="site_title" label="{{ __('sitesettings.site_title') }}" />

        {{-- Favicon --}}
        <flux:input type="file" wire:model="favicon" label="{{ __('sitesettings.favicon') }}" />

        {{-- Navigation Title --}}
        <flux:input wire:model.live="nav_title" label="{{ __('sitesettings.nav_title') }}" />

        {{-- Navigation Icon --}}
        <flux:input type="file" wire:model="nav_icon" label="{{ __('sitesettings.nav_icon') }}" />

        {{-- Footer Title --}}
        <flux:input wire:model.live="footer_title" label="{{ __('sitesettings.footer_title') }}" />

        {{-- Footer Icon --}}
        <flux:input type="file" wire:model="footer_icon" label="{{ __('sitesettings.footer_icon') }}" />

        {{-- Social media links --}}
        <flux:input wire:model.live="facebook_url" label="{{ __('sitesettings.facebook_url') }}"
            placeholder="https://facebook.com/..." />
        <flux:input wire:model.live="twitter_url" label="{{ __('sitesettings.twitter_url') }}"
            placeholder="https://twitter.com/..." />
        <flux:input wire:model.live="instagram_url" label="{{ __('sitesettings.instagram_url') }}"
            placeholder="https://instagram.com/..." />
        <flux:input wire:model.live="linkedin_url" label="{{ __('sitesettings.linkedin_url') }}"
            placeholder="https://linkedin.com/in/..." />
        <flux:input wire:model.live="youtube_url" label="{{ __('sitesettings.youtube_url') }}"
            placeholder="https://youtube.com/..." />

        {{-- Status --}}
        <flux:select wire:model="status" label="{{ __('sitesettings.status') }}"
            placeholder="{{ __('sitesettings.select_status') }}" name="status">
            <flux:select.option value="active">{{ __('sitesettings.status_active') }}</flux:select.option>
            <flux:select.option value="inactive">{{ __('sitesettings.status_inactive') }}</flux:select.option>
        </flux:select>

        {{-- Updated By (readonly, current user) --}}
        <flux:input label="{{ __('sitesettings.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        {{-- Submit Button --}}
        <flux:button type="submit" icon="save" variant="primary">
            {{ __('sitesettings.edit_sitesetting') }}
        </flux:button>

    </x-form>
</section>
