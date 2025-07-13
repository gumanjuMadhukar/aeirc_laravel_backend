<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewProduct extends Component
{
    public Product $product;

    public function mount(Product $service): void
    {
        $this->authorize('view products');
        $this->service = $service;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.products.view-product');
    }
}
