<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\BannerAdvertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        $articles = ArticleNews::with('category')
            ->where('is_featured', 'not_featured')
            ->latest()
            ->take(3)
            ->get();

        $featuredArticles = ArticleNews::with('category')
            ->where('is_featured', 'featured')
            ->inRandomOrder()
            ->take(3)
            ->get();

        //automotive
        $automotiveArticles = ArticleNews::whereHas('category', function ($query) {
            $query->where('slug', 'automotive');
        })
                ->where('is_featured', 'not_featured')
                ->latest()
                ->take(6)
                ->get();

        $featuredAutomotiveArticles = ArticleNews::whereHas('category', function ($query) {
            $query->where('slug', 'automotive');
        })
                ->where('is_featured', 'featured')
                ->inRandomOrder()
                ->first();

        //entertainment
        $entertainmentArticles = ArticleNews::whereHas('category', function ($query) {
            $query->where('slug', 'entertainment');
        })
                ->where('is_featured', 'not_featured')
                ->latest()
                ->take(6)
                ->get();

        $featuredEntertainmentArticles = ArticleNews::whereHas('category', function ($query) {
            $query->where('slug', 'entertainment');
        })
                ->where('is_featured', 'featured')
                ->inRandomOrder()
                ->first(); 

        //business
        $businessArticles = ArticleNews::whereHas('category', function ($query) {
            $query->where('slug', 'business');
        })
                ->where('is_featured', 'not_featured')
                ->latest()
                ->take(6)
                ->get();

        $featuredBusinessArticles = ArticleNews::whereHas('category', function ($query) {
            $query->where('slug', 'business');
        })
                ->where('is_featured', 'featured')
                ->inRandomOrder()
                ->first();

        $bannerAds = BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first();

        $authors = Author::all();

        return view('front.index', compact(
            'categories',
            'articles',
            'authors',
            'featuredArticles',
            'bannerAds',
            'businessArticles',
            'featuredBusinessArticles',
            'automotiveArticles',
            'featuredAutomotiveArticles',
            'entertainmentArticles',
            'featuredEntertainmentArticles',
        ));
    }
}
