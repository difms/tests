<?php

namespace App\Http\Controllers;

use App\Contracts\iCategoryFilter;
use App\Contracts\iCategoryRequestFilter;
use App\Http\Requests\CategoryListRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param iCategoryFilter $cf
     * @return CategoryCollection
     */
    public function index(Request $request, iCategoryFilter $cf): ?CategoryCollection
    {
        // return CategoryCollection json response
        return $cf->categoryFilterResponse($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): ?CategoryResource
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): ?CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category): ?CategoryResource
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): ?JsonResponse
    {
        try {
            $category->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
