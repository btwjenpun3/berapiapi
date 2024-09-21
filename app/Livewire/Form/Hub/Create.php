<?php

namespace App\Livewire\Form\Hub;

use App\Models\Category;
use App\Models\Hub;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $title, $base_url, $description, $category, $price, $resultLogging;

    public function submit()
    {
        $this->validate([
            'title'         => 'required|max:255',
            'base_url'      => 'required',
            'description'   => 'max:2000',
            'category'      => 'required',
            'price'         => 'required',
            'resultLogging' => 'required|boolean',
        ]); 

        DB::beginTransaction();

        try {
            $slug = Str::slug($this->title);

            $originalSlug = $slug;
            $counter = 1;

            while (Hub::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $hub = Hub::create([
                'title'             => $this->title,
                'slug'              => $slug,
                'base_url'          => $this->base_url,
                'description'       => $this->description,
                'category_slug'     => $this->category,
                'price'             => $this->price,
                'result_logging'    => $this->resultLogging,
            ]);

            DB::commit();

            return redirect()->route('hub.definitions', ['slug' => $hub->slug]);

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('error', $e->getMessage());
        }
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('livewire.form.hub.create', [
            'categories' => $categories
        ]);
    }
}
