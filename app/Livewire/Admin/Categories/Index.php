<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $categories;
    public $name_en, $name_fr, $name_ar, $name_es;
    public $slug;
    public $image;
    public $is_active = true;
    public $categoryId;
    public $isOpen = false;

    protected $rules = [
        'name_en' => 'required',
        'name_fr' => 'required',
        'slug' => 'required|unique:categories,slug',
        'image' => 'nullable|image|max:1024',
    ];

    public function render()
    {
        $this->categories = \App\Models\Category::all();
        return view('livewire.admin.categories.index')->layout('layouts.admin', ['title' => __('all.Categories')]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        $category = new \App\Models\Category();
        $category->setTranslations('name', [
            'en' => $this->name_en,
            'fr' => $this->name_fr,
            'ar' => $this->name_ar,
            'es' => $this->name_es,
        ]);
        $category->slug = $this->slug;
        $category->is_active = (bool) $this->is_active;

        if ($this->image) {
            $imageService = new \App\Services\ImageService();
            $category->image = $imageService->processAndSave($this->image, 'categories', 400, 300);
        }

        $category->save();

        session()->flash('message', 'Category Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name_en = $category->getTranslation('name', 'en');
        $this->name_fr = $category->getTranslation('name', 'fr');
        $this->name_ar = $category->getTranslation('name', 'ar');
        $this->name_es = $category->getTranslation('name', 'es');
        $this->slug = $category->slug;
        $this->is_active = (bool) $category->is_active;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate([
            'name_en' => 'required',
            'name_fr' => 'required',
            'slug' => 'required|unique:categories,slug,' . $this->categoryId,
            'image' => 'nullable|image|max:1024',
        ]);

        $category = \App\Models\Category::findOrFail($this->categoryId);
        $category->setTranslations('name', [
            'en' => $this->name_en,
            'fr' => $this->name_fr,
            'ar' => $this->name_ar,
            'es' => $this->name_es,
        ]);
        $category->slug = $this->slug;
        $category->is_active = (bool) $this->is_active;

        if ($this->image) {
            $imageService = new \App\Services\ImageService();
            $category->image = $imageService->processAndSave($this->image, 'categories', 400, 300);
        }

        $category->save();

        session()->flash('message', 'Category Updated Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        \App\Models\Category::find($id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');
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
        $this->slug = '';
        $this->image = null;
        $this->is_active = true;
        $this->categoryId = null;
    }
}
