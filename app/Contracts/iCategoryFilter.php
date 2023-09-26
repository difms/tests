<?php

namespace App\Contracts;

use App\Http\Resources\CategoryCollection;
use Illuminate\Contracts\Database\Query\Builder;

interface iCategoryFilter
{
    public function categoryFilterResponse(array $filters): CategoryCollection;
}
