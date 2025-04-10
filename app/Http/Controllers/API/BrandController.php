<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        Cache::remember('user_country_'.$request->ip(), 3600, function () use ($request) {
            $cfCountryHeader = $request->header('CF-IPCountry');

            return $cfCountryHeader ?: 'Unknown';
        });
        $brands = Brand::query()->orderBy('rating', 'desc')->get();

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $imagePath = null;
        $validator = Validator::make($request->all(), [
            'brand_name' => 'bail|required|string',
            'brand_tag' => 'nullable|bail|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'bail|integer|min:0|max:5',
            'is_exclusive' => 'nullable|bail|boolean',
            'description' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->file('brand_image')) {
            $imagePath = $request->file('brand_image')->store('public');  // @phpstan-ignore-line
        }

        $validatedData = $validator->validated();

        $brand = new Brand;
        $brand->brand_name = $validatedData['brand_name'];
        $brand->brand_tag = $validatedData['brand_tag'];
        $brand->description = $validatedData['description'];
        $brand->is_exclusive = $validatedData['is_exclusive'];
        $brand->brand_image = ($imagePath) ? url('/storage/'.$imagePath) : '';
        $brand->rating = $validatedData['rating'] ?? 0;
        $brand->save();

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $brand = Brand::query()->where('id', $id)->first();

        if (! $brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $brand = Brand::query()->where('id', $id)->first();

        if (! $brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'brand_name' => 'bail|required|string',
            'brand_tag' => 'nullable|bail|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'bail|integer|min:0|max:5',
            'is_exclusive' => 'nullable|bail|boolean',
            'description' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->file('brand_image')) {
            $imagePath = $request->file('brand_image')->store('public'); // @phpstan-ignore-line
            $request->brand_image = url('/storage/'.$imagePath);
        }

        $brand->update($request->all());

        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $brand = Brand::query()->where('id', $id)->first();

        if (! $brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $brand->delete();

        return response()->json(['message' => 'Brand deleted']);
    }
}
