<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Contracts\iCategoryFilter;
use App\Http\Resources\CategoryCollection;
use Illuminate\Contracts\Database\Query\Builder;

class CategoryFilter implements iCategoryFilter
{
    public function categoryFilterResponse(array $filters): CategoryCollection
    {
        $query = Category::query();
        $apply_filter_count = 0;

        // Фильтрация по полю "name" (поиск по названию)
        if (isset($filters['name']) && !empty($filters['name'])) {
            $name = $filters['name'];
            $query->where('name', 'like', "%$name%");
            $apply_filter_count++;
        }

        // Фильтрация по полю "description" (поиск по описанию)
        if (isset($filters['description']) && !empty($filters['description'])) {
            $description = $filters['description'];
            $query->where('description', 'like', "%$description%");
            $apply_filter_count++;
        }

        // Фильтрация по полю "active"
        if (isset($filters['active']) && !empty($filters['active'] && !preg_match('/\s/', $filters['active']))) {
            $active = filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN);
            $query->where('active', $active);
            $apply_filter_count++;
        }

        // Сортировка
        if (isset($filters['sort']) && !empty($filters['sort'] && !preg_match('/\s/', $filters['sort']))) {
            $sortField = str_replace('-', '', $filters['sort']);
            if (in_array($sortField, ['name', 'active', 'created_at'])) {
                $sortDirection = Str::startsWith($filters['sort'], '-') ? 'desc' : 'asc';
                $query->orderBy($sortField, $sortDirection);
                $apply_filter_count++;
            }
        } else {
            // Сортировка по умолчанию
            $query->orderBy('created_at', 'desc');
        }

        if ($apply_filter_count) {
            return new CategoryCollection($query->simplePaginate($filters['per_page'] ?? 20));
        }

        return new CategoryCollection($query->latest()->take(2)->get());
    }
}
