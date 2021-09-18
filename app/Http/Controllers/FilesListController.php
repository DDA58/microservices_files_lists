<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Lists;
use Illuminate\Http\JsonResponse as Response;

class FilesListController extends Controller
{
    private const PER_PAGE = 10;

    public function __invoke(Lists $list): Response
    {
        $result = $list->filter()->paginate(static::PER_PAGE);

        return response()->json($result);
    }
}
