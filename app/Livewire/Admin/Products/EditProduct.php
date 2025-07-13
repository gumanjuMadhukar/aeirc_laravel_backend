<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use LivewireAlert, WithFileUploads;

    public Product $product;

    public string $product_title = '';
    public string $product_description = '';
    public string $updated_by = '';
    public ?TemporaryUploadedFile $newProductImage = null;
    public ?string $product_image = null;

    public function mount(Product $product): void
    {
        $this->authorize('update products');

        $this->product = $product;
        $this->product_title = $product->product_title;
        $this->product_description = $product->product_description;
        $this->updated_by = $product->updated_by;
        $this->product_image = $product->product_image;
    }

    public function updateProduct(): void
    {
        $rules = [
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'updated_by' => 'nullable|string',
        ];

        if ($this->newProductImage) {
            $rules['newProductImage'] = 'image|max:2048';
        }

        $this->validate($rules);

        if ($this->newProductImage) {
            $this->product_image = $this->newProductImage->store('images/products', 'public');
        }

        $this->product->update([
            'product_title' => $this->product_title,
            'product_description' => $this->product_description,
            'updated_by' => $this->updated_by,
            'product_image' => $this->product_image,
        ]);

        $this->flash('success', __('products.product_updated'));
        $this->redirect(route('admin.products.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.products.edit-product');
    }
}
