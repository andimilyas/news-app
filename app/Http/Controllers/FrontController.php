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

    public function category(Category $category)
    {
        $categories = Category::all();
        
        $bannerAds = BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first();

        return view('front.category', compact('category', 'categories', 'bannerAds')); 
    }

    public function author(Author $author)
    {
        $categories = Category::all();
        
        $bannerAds = BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first();

        return view('front.author', compact('author', 'categories', 'bannerAds')); 
    }

    public function search(Request $request)
    {
        $request->validate([ 
            'keyword' => [
                'required',
                'string',
                'max:255',
            ]
        ]);
        
        $categories = Category::all();
        $keyword = $request->keyword;
        $articles = ArticleNews::with('category', 'author')->where('name', 'like', '%' . $keyword . '%')->paginate(6);

        return view('front.search', compact('categories', 'articles', 'keyword'));
    }

    public function detail(ArticleNews $articleNews)
    {
        $categories = Category::all();

        $articles = ArticleNews::with('category')
            ->where('is_featured', 'not_featured')
            ->where('id', '!=', $articleNews->id)
            ->latest()
            ->take(3)
            ->get();

        $bannerAds = BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first();

        $bannerAdsSquare = BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'square')
            ->inRandomOrder()
            ->take(2)
            ->get();

            if($bannerAdsSquare->count() < 2){
                $squareAds_1 = $bannerAdsSquare->first();
                $squareAds_2 = $bannerAdsSquare->first();
            } else {
                $squareAds_1 = $bannerAdsSquare->get(0);
                $squareAds_2 = $bannerAdsSquare->get(1);
            }

        $authorNews = ArticleNews::where('author_id', $articleNews->author_id)
            ->where('id', '!=', $articleNews->id)
            ->latest()
            ->take(3)
            ->get();

        return view('front.detail', compact('categories', 'articleNews', 'articles', 'bannerAds', 'squareAds_1', 'squareAds_2', 'authorNews'));
    }
}
