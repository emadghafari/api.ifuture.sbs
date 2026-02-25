<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('translations')->orderBy('sort_order')->get();
    }

    public function store(Request $request)
    {
        if (is_string($request->translations)) {
            $request->merge(['translations' => json_decode($request->translations, true)]);
        }

        $validated = $request->validate([
            'slug' => 'required|unique:products,slug',
            'url' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'status' => 'boolean',
            'featured' => 'boolean',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|in:ar,he,en',
            'translations.*.title' => 'required|string',
            'translations.*.description' => 'nullable|string',
        ]);

        $data = $request->only(['slug', 'url', 'status', 'featured', 'sort_order']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = '/files/' . $path;
        }

        $product = Product::create($data);

        foreach ($request->translations as $trans) {
            $product->translations()->create($trans);
        }

        return response()->json($product->load('translations'), 201);
    }

    public function show(Product $product)
    {
        return $product->load('translations');
    }

    public function update(Request $request, Product $product)
    {
        if (is_string($request->translations)) {
            $decoded = json_decode($request->translations, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request->merge(['translations' => $decoded]);
            }
        }

        $validated = $request->validate([
            'slug' => 'required|unique:products,slug,' . $product->id,
            'url' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'status' => 'boolean',
            'featured' => 'boolean',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|in:ar,he,en',
            'translations.*.title' => 'required|string',
            'translations.*.description' => 'nullable|string',
        ]);

        $data = $request->only(['slug', 'url', 'status', 'featured', 'sort_order']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = '/files/' . $path;
        }

        $product->update($data);

        foreach ($request->translations as $trans) {
            $product->translations()->updateOrCreate(
            ['locale' => $trans['locale']],
                $trans
            );
        }

        return response()->json($product->load('translations'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
