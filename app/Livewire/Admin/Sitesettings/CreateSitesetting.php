<?php

namespace App\Livewire\Admin\Sitesettings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Models\Sitesetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateSitesetting extends Component
{
    use LivewireAlert, WithFileUploads;

    public string $site_title = '';
    public ?TemporaryUploadedFile $favicon = null;
    public ?TemporaryUploadedFile $nav_icon = null;
    public string $nav_title = '';
    public ?TemporaryUploadedFile $footer_icon = null;
    public string $footer_title = '';
    public string $facebook_url = '';
    public string $linkedin_url = '';
    public string $twitter_url = '';
    public string $instagram_url = '';
    public string $youtube_url = '';
    public string $updated_by = '';

    public function mount(): void
    {
        $this->authorize('create sitesettings');
        $this->updated_by = Auth::user()?->name ?? 'system';
    }

    public function createSitesetting(): void
    {
        $this->validate([
            'site_title' => 'required|string|max:255',
            'favicon' => 'nullable|image|max:1024',
            'nav_icon' => 'nullable|image|max:1024',
            'nav_title' => 'required|string|max:255',
            'footer_icon' => 'nullable|image|max:1024',
            'footer_title' => 'required|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',

        ]);

        $faviconPath = $this->favicon ? $this->favicon->store('images/sitesettings', 'public') : null;
        $navIconPath = $this->nav_icon ? $this->nav_icon->store('images/sitesettings', 'public') : null;
        $footerIconPath = $this->footer_icon ? $this->footer_icon->store('images/sitesettings', 'public') : null;

        Sitesetting::create([
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
            'updated_by' => Auth::user()?->name ?? 'system',
        ]);

        $this->flash('success', __('sitesettings.sitesetting_created'));
        $this->redirect(route('admin.sitesettings.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.sitesettings.create-sitesetting');
    }
}
