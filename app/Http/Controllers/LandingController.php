<?php

namespace App\Http\Controllers;

use App\Models\JobAds;
use Filament\Schemas\Components\View;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        // $category = $request->get('category');
        // $search = $request->get('search');
        // $sort = $request->get('sort', 'created_at');
        // $direction = $request->get('direction', 'desc');
        $perPage = $request->get('per_page', 3);

        // Validate sort direction
        // $direction = in_array(strtolower($direction), ['asc', 'desc']) ? $direction : 'desc';

        // Start query
        $query = JobAds::query();

        // Get items with pagination
        $items = $query->paginate($perPage);

        // Apply search filter
        // if ($search) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('name', 'LIKE', "%{$search}%")
        //             ->orWhere('description', 'LIKE', "%{$search}%")
        //             ->orWhere('category', 'LIKE', "%{$search}%");
        //     });
        // }

        // Apply category filter
        // if ($category && $category !== 'all') {
        //     $query->where('category', $category);
        // }

        // // Apply sorting
        // $validSortColumns = ['name', 'price', 'quantity', 'created_at', 'category'];
        // if (in_array($sort, $validSortColumns)) {
        //     $query->orderBy($sort, $direction);
        // } else {
        //     $query->orderBy('created_at', 'desc');
        // }

        // Get items with pagination
        $items = $query->paginate($perPage);

        $categories = [];

        // Return view for web requests
        // return view('landing', compact('items', 'categories', 'search', 'category', 'sort', 'direction'));
        return view('pages.landing.index', compact('items', 'categories'));
    }
}
