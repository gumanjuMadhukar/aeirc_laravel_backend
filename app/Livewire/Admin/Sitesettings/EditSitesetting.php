<?php

namespace App\Livewire\Admin\Sitesettings;

use App\Models\Sitesetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditSitesetting extends Component
{
    use HandlesRedirects, LivewireAlert, WithFileUploads;

    public Sitesetting $sitesetting;

    #[Validate(['required', 'string', 'max:255'])]
    public string $site_title = '';

    // Use TemporaryUploadedFile for image uploads (nullable)
    public ?TemporaryUploadedFile $favicon = null;
    public ?TemporaryUploadedFile $nav_icon = null;
    public ?TemporaryUploadedFile $footer_icon = null;

    #[Validate(['required', 'string', 'max:255'])]
    public string $nav_title = '';

    #[Validate(['required', 'string', 'max:255'])]
    public string $footer_title = '';

    #[Validate('nullable|url|max:255')]
    public ?string $facebook_url = null;

    #[Validate('nullable|url|max:255')]
    public ?string $linkedin_url = null;

    #[Validate('nullable|url|max:255')]
    public ?string $twitter_url = null;

    #[Validate('nullable|url|max:255')]
    public ?string $instagram_url = null;

    #[Validate('nullable|url|max:255')]
    public ?string $youtube_url = null;

    #[Validate(['required', 'in:active,inactive'])]
    public string $status = 'active';


    public string $updated_by = '';

    public function mount(Sitesetting $sitesetting): void
    {
        $this->authorize('update sitesettings');

        $this->sitesetting = $sitesetting;

        $this->site_title = $sitesetting->site_title ?? '';
        $this->nav_title = $sitesetting->nav_title ?? '';
        $this->footer_title = $sitesetting->footer_title ?? '';
        $this->facebook_url = $sitesetting->facebook_url;
        $this->linkedin_url = $sitesetting->linkedin_url;
        $this->twitter_url = $sitesetting->twitter_url;
        $this->instagram_url = $sitesetting->instagram_url;
        $this->youtube_url = $sitesetting->youtube_url;
        $this->status = $sitesetting->status ?? 'active';

        $this->updated_by = $sitesetting->updated_by ?? Auth::user()?->name ?? 'system';
    }

    public function updateSitesetting(): void
    {
        $this->authorize('update sitesettings');

        $this->validate();

        // Handle file uploads if new files are provided
        $faviconPath = $this->favicon
            ? $this->favicon->store('images/sitesettings', 'public')
            : $this->sitesetting->favicon;

        $navIconPath = $this->nav_icon
            ? $this->nav_icon->store('images/sitesettings', 'public')
            : $this->sitesetting->nav_icon;

        $footerIconPath = $this->footer_icon
            ? $this->footer_icon->store('images/sitesettings', 'public')
            : $this->sitesetting->footer_icon;

        $this->sitesetting->update([
            'site_title' => $this->site_title,
            'favicon' => $faviconPath,
            'nav_icon' => $navIconPath,
            'nav_title' => $this->nav_title,
            'footer_icon' => $footerIconPath,
            'footer_title' => $this->footer_title,
            'facebook_url' => $this->facebook_url,
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
            'instagram_url' => $this->instagram_url,
            'youtube_url' => $this->youtube_url,
            'status' => $this->status,
            'updated_by' => Auth::user()?->name ?? 'system',
        ]);

        $this->flash('success', __('sitesettings.sitesetting_edited'));

        $this->redirect(route('admin.sitesettings.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.sitesettings.edit-sitesetting');
    }
}
