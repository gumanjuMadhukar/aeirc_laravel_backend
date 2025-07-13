<?php

namespace App\Livewire\Admin\Products;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateProduct extends Component
{
    use LivewireAlert, WithFileUploads;

    public string $product_title = '';
    public string $product_description = '';
    public string $updated_by = '';
    public ?TemporaryUploadedFile $product_image = null;

    public function mount(): void
    {
        $this->authorize('create products');  
    }

    public function createProduct(): void
    {
        $this->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'product_image' => 'nullable|image|max:2048',
            'updated_by' => 'nullable|string|max:255',
        ]);

        $productImagePath = $this->product_image
            ? $this->product_image->store('images/products', 'public')
            : null;

        Product::create([
            'product_title' => $this->product_title,
            'product_description' => $this->product_description,
            'updated_by' => $this->updated_by,
            'product_image' => $productImagePath,
        ]);

        $this->flash('success', __('products.product_created'));
        $this->redirect(route('admin.products.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.products.create-product');
    }
}
?>