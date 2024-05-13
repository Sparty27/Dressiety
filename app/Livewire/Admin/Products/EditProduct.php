<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
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

    public ProductForm $form;

//    #[Validate('required|min:3|max:100')]
//    public $name = '';
//    #[Validate('required')]
//    public $category;
//    #[Validate([new GreatThanZero])]
//    public $price = 0;
//    public $count;
//    public $visible = false;

    public $categories;

    public $photos;


    public function mount()
    {
        $this->form->name = $this->product->name;
        $this->form->price = (float)($this->product->price / 100);
        $this->form->count = $this->product->count;
        $this->form->visible = (bool)$this->product->status;

        $this->form->category = $this->product->category->id;

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
        $this->form->name = $this->product->name;
        $this->form->price = (float)($this->product->price / 100);
        $this->form->count = $this->product->count;
        $this->form->visible = (bool)$this->product->status;
        $this->form->category = $this->product->category->id;

        $this->photos = $this->product->photos->pluck('url')->toArray();
    }

    public function save()
    {
        $this->price = (integer)(floatval(str_replace(' ', '', $this->price)) * 100);

        $this->product->update($this->validate());


//        $this->product->update([
//            'name' => $this->name,
//            'price' => $this->price,
//            'count' => $this->count,
//            'category_id' => $this->category,
//            'status' => $this->visible,
//        ]);

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

    public function render()
    {
        return view('livewire.admin.products.edit-product')
            ->layout('components.layouts.admin');
    }
}
