<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('pages.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'  => 'required|max:100',
            'color'     => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $slug = Str::slug($request->category);

            $originalSlug = $slug;
            $counter = 1;

            while (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            Category::create([
                'name'  => $request->category,
                'slug'  => $slug,
                'color' => $request->color
            ]);

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category successfully created');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();

        if (! $category) {
            abort(404);
        }

        return view('pages.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'category'  => 'required|max:100',
            'color'     => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $slug = Str::slug($request->category);

            $originalSlug = $slug;
            $counter = 1;

            while (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            Category::where('slug', $request->slug)->update([
                'name'  => $request->category,
                'slug'  => $slug,
                'color' => $request->color
            ]);

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category successfully updated');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {        
        DB::beginTransaction();

        try {
            $category = Category::where('slug', $request->slug)->first();

            if (! $category) {
                abort(404);
            }

            $category->delete();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category successfully deleted');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
