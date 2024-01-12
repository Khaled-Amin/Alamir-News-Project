<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Adds;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\PinnedPage;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home() {
        $pinned = PinnedPage::get();
        $Adds = Adds::first();
        $settings = Setting::firstOrFail();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        // dd($category);
        // $getNameCategoryURL = Category::select('id')->first();
        $articles = Article::select('id','title', 'title_slug', 'image', 'content','category_id')->get();
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views','category_id')
            ->orderBy('views', 'desc')
            ->get();
        return view('frontend.index', compact('pinned','Adds','getMoreReadArticle','commetns','is_Trending','getLatestNews','category', 'settings', 'articles'));
    }

    public function getArticlePage($idCate, $id) {
        $pinned = PinnedPage::get();
        $Adds = Adds::first();
        $settings = Setting::firstOrFail();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        $categoryWithSlug = Category::where('id', $idCate)->first();
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $articles = Article::select('id','title', 'title_slug', 'image', 'content','category_id')
                ->where('category_id', $categoryWithSlug->id)
                ->where('id', $id)->first();
        // dd($articles);
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $getRandomArticle = Article::inRandomOrder()->get();
        $is_setTags = Article::with('tags')->where('id', $id)->where('category_id', $categoryWithSlug->id)->first();
        $getterTage = '';
        $articaleSites = Article::where('id', $id)->where('category_id', $categoryWithSlug->id)->first();
        foreach($is_setTags->tags as $key => $checke){
            $getterTage = $checke;

        }
        // dd($getterTage);
        $getTitleArtcileMeta = Article::where('id', $id)->where('category_id', $categoryWithSlug->id)->first();
        // dd($getTitleArtcileMeta);
        $viewsSites = Article::select('id','views' , 'title', 'category_id')->where('id', $id)->where('category_id', $categoryWithSlug->id)->first();
        $views=$viewsSites->views;
        $views=$views+1;
        Article::where('id', $id)->where('category_id', $categoryWithSlug->id)->update(['views'=>$views]);
        $viewsArt = Article::select('id' , 'title' , 'views', 'category_id')->where('id', $id)->where('category_id', $categoryWithSlug->id)->first();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
            ->orderBy('views', 'desc')
            ->get();
        $articlesAlbums = Article::select('id' , 'albums', 'category_id')->where('id', $id)->where('category_id', $categoryWithSlug->id)->get();
        
        return view('frontend.ArtcilePage', compact('pinned','articlesAlbums','settings','Adds','getMoreReadArticle','viewsArt','getTitleArtcileMeta','commetns','getRandomArticle','categoryWithSlug','is_Trending','getLatestNews','category', 'articles'));
    }

    public function getShowCategory($slug) {
        $pinned = PinnedPage::get();
        $Adds = Adds::first();
        $settings = Setting::firstOrFail();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $categoryMain = Category::select('id', 'name', 'slug', 'parent_id')
            ->where('slug', $slug)
            ->where('parent_id', null)->first();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        $categoryGetIds = Category::select('id', 'slug', 'parent_id')->where('parent_id', null)
        ->where('slug', $slug)
        ->first();
        // dd($categoryGetIds);
        $getArticlesByCate = Article::select('id', 'title', 'title_slug', 'content', 'image', 'trending', 'category_id')
        ->where('category_id', $categoryGetIds->id)
        ->paginate(12)->withQueryString();
        // dd($categorySub);
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $getNameCategorySetTitleMeta = Category::select('name', 'slug')->where('slug', $slug)->first();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
            ->orderBy('views', 'desc')
            ->get();
        return view('frontend.ArticleBycategory_page', compact('pinned','categoryGetIds','getArticlesByCate','Adds','getMoreReadArticle','getNameCategorySetTitleMeta','categoryMain','commetns','settings', 'category', 'getLatestNews', 'is_Trending'));
    }
    // public function getAllArticleBySubCategory($id)
    // {
    //     // $slug = str_replace('-', '', $slug);
    //     // dd($slug);
    //     $Adds = Adds::first();
    //     $settings = Setting::firstOrFail();
    //     $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
    //     $SubCategoryMain = Category::select('id', 'name', 'slug', 'parent_id')

    //         ->where('id', $id)->first();
    //         // dd($SubCategoryMain);
    //     $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
    //     $getArticlesBySubCate = Article::select('id', 'title', 'title_slug', 'content', 'image', 'trending', 'category_id', 'subcategory_id')
    //     ->where('subcategory_id', $id)
    //     ->paginate(12)->withQueryString();
    //     // dd($getArticlesBySubCate);
    //     $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
    //     $is_Trending = Article::select('id', 'title', 'image', 'trending')->where('trending', 1)->get();
    //     $getNameSubCategorySetTitleMeta = Category::select('id','name')->where('id', $id)->first();
    //     $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
    //         ->orderBy('views', 'desc')
    //         ->get();
    //     return view('frontend.allArticleBySubCateOfCategory', compact('Adds','getMoreReadArticle','getNameSubCategorySetTitleMeta','SubCategoryMain','commetns','settings', 'getArticlesBySubCate', 'category', 'getLatestNews', 'is_Trending'));
    // }

    public function storeComment(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|regex:/^[^0-9!@#$%^&*()_+={};:\'"<>,.?\\/`~]*$/',
            'email' => 'unique:comments,email',
            'title' => 'required|regex:/^[^0-9!@#$%^&*()_+={};:\'"<>,.?\\/`~]*$/',
            'bio' => 'required',
        ]);


        Comment::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'title'  => $request->title,
            'bio'  => $request->bio,
        ]);

        return redirect()->back()->with('success', 'تم اضافة التعليق, سيتم مراجعته');
    }
    public function getOpinions()
    {
        $pinned = PinnedPage::get();
        $Adds = Adds::first();
        $commentsAll = Comment::where('isApprove', 1)->latest()->paginate(12)->withQueryString();
        $settings = Setting::firstOrFail();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $getRandomArticle = Article::inRandomOrder()->get();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
            ->orderBy('views', 'desc')
            ->get();
        return view('frontend.opinionsPage', compact('pinned','Adds','getMoreReadArticle','getRandomArticle','commentsAll','settings', 'commetns', 'category', 'getLatestNews', 'is_Trending'));
    }

    public function getPersonOpinions($id)
    {
        $pinned = PinnedPage::get();
        $Adds = Adds::first();
        $settings = Setting::firstOrFail();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $getRandomArticle = Article::inRandomOrder()->get();
        $getOpinion = Comment::where('isApprove', 1)->where('id', $id)->first();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
            ->orderBy('views', 'desc')
            ->get();
        return view('frontend.openOpinions', compact('pinned','Adds','getMoreReadArticle', 'getOpinion','getRandomArticle','settings', 'commetns', 'category', 'getLatestNews', 'is_Trending'));
    }

    public function getAboutPage()
    {
        $pinned = PinnedPage::get();
        $Adds = Adds::first();
        $settings = Setting::firstOrFail();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $getRandomArticle = Article::inRandomOrder()->get();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
            ->orderBy('views', 'desc')
            ->get();
        return view('frontend.about', compact('pinned','Adds','getMoreReadArticle','getRandomArticle','settings', 'commetns', 'category', 'getLatestNews', 'is_Trending'));
    }
    public function getAboutPinnedPage($slug)
    {
        $Adds = Adds::first();
        $settings = Setting::firstOrFail();
        $pinned = PinnedPage::get();
        // dd($pinned);
        $getPinned = PinnedPage::where('href', $slug)->first();
        $commetns = Comment::where('isApprove', 1)->latest()->limit(4)->get();
        $category = Category::with('article')->select('id', 'name', 'slug', 'parent_id')->where('parent_id', null)->get();
        $getLatestNews = Article::select('id', 'title', 'image', 'category_id')->latest()->get();
        $is_Trending = Article::select('id', 'title', 'image', 'trending', 'category_id')->where('trending', 1)->get();
        $getRandomArticle = Article::inRandomOrder()->get();
        $getMoreReadArticle = Article::select('id', 'title', 'image', 'views', 'category_id')
            ->orderBy('views', 'desc')
            ->get();
        return view('frontend.pinnedPageAbout', compact('getPinned','pinned','Adds','getMoreReadArticle','getRandomArticle','settings', 'commetns', 'category', 'getLatestNews', 'is_Trending'));
    }
}
