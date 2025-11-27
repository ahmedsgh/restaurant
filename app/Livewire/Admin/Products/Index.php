<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $products;
    public $categories;
    public $name_en, $name_fr, $name_ar, $name_es;
    public $description_en, $description_fr, $description_ar, $description_es;
    public $category_id;
    public $price;
    public $image;
    public $is_active = true;
    public $productId;
    public $isOpen = false;

    protected $rules = [
        'name_en' => 'required',
        'name_fr' => 'required',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:1024',
    ];

    public function render()
    {
        $this->products = \App\Models\Product::with('category')->get();
        $this->categories = \App\Models\Category::where('is_active', true)->get();
        return view('livewire.admin.products.index')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        $product = new \App\Models\Product();
        $product->setTranslations('name', [
            'en' => $this->name_en,
            'fr' => $this->name_fr,
            'ar' => $this->name_ar,
            'es' => $this->name_es,
        ]);
        $product->setTranslations('description', [
            'en' => $this->description_en,
            'fr' => $this->description_fr,
            'ar' => $this->description_ar,
            'es' => $this->description_es,
        ]);
        $product->category_id = $this->category_id;
        $product->price = $this->price;
        $product->is_active = (bool) $this->is_active;

        if ($this->image) {
            $imageService = new \App\Services\ImageService();
            $product->image = $imageService->processAndSave($this->image, 'products', 800, 600);
        }

        $product->save();

        session()->flash('message', 'Product Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $this->productId = $id;
        $this->name_en = $product->getTranslation('name', 'en');
        $this->name_fr = $product->getTranslation('name', 'fr');
        $this->name_ar = $product->getTranslation('name', 'ar');
        $this->name_es = $product->getTranslation('name', 'es');
        $this->description_en = $product->getTranslation('description', 'en');
        $this->description_fr = $product->getTranslation('description', 'fr');
        $this->description_ar = $product->getTranslation('description', 'ar');
        $this->description_es = $product->getTranslation('description', 'es');
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->is_active = (bool) $product->is_active;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate([
            'name_en' => 'required',
            'name_fr' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:1024',
        ]);

        $product = \App\Models\Product::findOrFail($this->productId);
        $product->setTranslations('name', [
            'en' => $this->name_en,
            'fr' => $this->name_fr,
            'ar' => $this->name_ar,
            'es' => $this->name_es,
        ]);
        $product->setTranslations('description', [
            'en' => $this->description_en,
            'fr' => $this->description_fr,
            'ar' => $this->description_ar,
            'es' => $this->description_es,
        ]);
        $product->category_id = $this->category_id;
        $product->price = $this->price;
        $product->is_active = (bool) $this->is_active;

        if ($this->image) {
            $imageService = new \App\Services\ImageService();
            $product->image = $imageService->processAndSave($this->image, 'products', 800, 600);
        }

        $product->save();

        session()->flash('message', 'Product Updated Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        \App\Models\Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name_en = '';
        $this->name_fr = '';
        $this->name_ar = '';
        $this->name_es = '';
        $this->description_en = '';
        $this->description_fr = '';
        $this->description_ar = '';
        $this->description_es = '';
        $this->category_id = null;
        $this->price = null;
        $this->image = null;
        $this->is_active = true;
        $this->productId = null;
    }
}
