<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Rules\GreatThanZero;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;

    #[Validate('required|min:3|max:100')]
    public $name = '';
    #[Validate('required')]
    public $category;
    #[Validate([new GreatThanZero])]
    public $price = 0;
    public $count;
    public $visible;

    public $categories;

    public $photos;
    #[Validate('image|max:32768')]
    public $loadedPhoto = '';


    public function mount()
    {
        $this->name = $this->product->name;
        $this->price = (float)($this->product->price / 100);
        $this->count = $this->product->count;
        $this->visible = (bool)$this->product->status;

        $this->category = $this->product->category->id;

        $this->categories = Category::all();

        $this->photos = $this->product->photos->pluck('url')->toArray();
    }

    public function updatedLoadedPhoto()
    {
        $this->photos[] = Storage::url($this->loadedPhoto->store(path: 'public/photos'));
//        $this->photos[] = $this->loadedPhoto->temporaryUrl();

        $this->dispatch('addedImage');
    }

    public function resetForm()
    {
        $this->name = $this->product->name;
        $this->price = (float)($this->product->price / 100);
        $this->count = $this->product->count;
        $this->visible = $this->product->status;
        $this->category = $this->product->category->id;

        $this->photos = $this->product->photos->pluck('url')->toArray();
        $this->dispatch('addedImage');
    }

    public function save()
    {
        $this->price = (integer)(floatval(str_replace(' ', '', $this->price)) * 100);

        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'price' => $this->price,
            'count' => $this->count,
            'category_id' => $this->category,
            'status' => $this->visible ?? false,
        ]);

        foreach($this->photos as $photo)
        {
            $this->product->photos()->updateOrCreate(
                [
                    'url' => $photo
                ]
            );
        }

        return redirect()->route('admin.products.show', $this->product);
    }

    #[On('addedImage')]
    public function render()
    {
        return view('livewire.admin.products.edit-product')
            ->layout('components.layouts.admin');
    }
}
