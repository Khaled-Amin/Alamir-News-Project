<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ArticlesRequest;
use App\Traits\UploadSingleImageTrait;
use App\Traits\UploadMultipleImagesTrait;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    use UploadSingleImageTrait, UploadMultipleImagesTrait;
    protected $articlemodel;
    protected $countROW = 12;
    
    public function __construct(Article $article)
    {
        // $this->middleware('auth:admin');
        $this->articlemodel = $article;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $articles = Article::select('id', 'title', 'title_slug', 'trending', 'user_id')->orderBy('id', 'desc')->paginate($this->countROW);
        // $artmodel = $this->articlemodel;
        return view('backend.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::select('id', 'name')->where('parent_id', Null)->get();
        return view('backend.articles.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'      => ['required', 'max:255'],
            'category'   =>['required'],
        ]);
        // Process when a single image is uploaded
        $image = $request->file('image');
        $uploadedImage = $this->processSingleImage($image, 'articlePic/', true, 615, 460);
        // Process when multiple images are uploaded as albums
        $images = $request->file('albums');
        // dd($images);
        $uploadedImagesAlbums = $this->processMultipleImages($images, 'articlePic/', true, 615, 460);
        $insertArticles = Article::create([
            'title'             => $request->input('title'),
            'title_slug'        => strtolower(str_replace(' ', '-', $request->title)),
            'image'             => $uploadedImage,
            'albums'            => !empty($uploadedImagesAlbums) && is_array($uploadedImagesAlbums) ? implode(',', $uploadedImagesAlbums) : null,
            'content'           => $request->input('content'),
            'meta_description'  => $request->input('meta_description'),
            'key_words'         => $request->input('key_words'),
            'category_id'       => $request->input('category'),
            'subcategory_id'    => $request->input('subcategory'),
            'user_id'           => auth('admin')->user()->id,
        ]);

        if ($request->tags) {
            foreach (explode(',', $request->tags) as $tagss) {
                $taggs = Tag::create([
                    'name' => $tagss,
                ]);
                $insertArticles->tags()->attach($taggs);
            }
        }

        return redirect()->route('articles.main')->with('success', 'Successfully added data');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Article $article)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $articles = Article::with(['tags'])->findOrFail($id);
        $this->authorize('update', $articles);
        $cate = Category::find($articles->category_id);
        $category = Category::select('id', 'name')->where('parent_id', Null)->get();
        $sub_category = Category::select('id', 'name', 'parent_id')->where('parent_id', '!=', Null)->get();

        return view('backend.articles.edit', compact('articles', 'category', 'sub_category', 'cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article, $id)
    {
        $articles = Article::findOrFail($id);

        $this->authorize('update', $articles);
        // Process when a single image is uploaded
        $image = $request->file('image');
        if ($image) {
            // Delete the old image if it exists
            $pathImage = public_path('articlePic/' . $articles->image);
            if (File::exists($pathImage)) {
                File::delete($pathImage);
            }
            $uploadedImage = $this->processSingleImage($image, 'articlePic/', true, 615, 460);
            DB::table('articles')->where('id', $articles->id)->update([
                'image' => $uploadedImage,
            ]);
        }

        // Process when multiple images are uploaded as albums
        $images = $request->file('albums');
        if ($images) {
            $explodeAlbums = explode(',', $articles->albums);
            foreach ($explodeAlbums as $key => $val) {
                $pathImage = public_path('articlePic/' . $val);
                if (File::exists($pathImage)) {
                    File::delete($pathImage);
                }
            }
            $uploadedImagesAlbums = $this->processMultipleImages($images, 'articlePic/', true, 615, 460);
            // dd($uploadedImagesAlbums);
            $implodedImages = implode(',', $uploadedImagesAlbums);
            $albums = $implodedImages !== '' ? $implodedImages : '';
            DB::table('articles')->where('id', $articles->id)->update([
                'albums' => $albums,
            ]);
        }
        // dd(explode(',', $request->tags));
        // $currentTagIds = $articles->tags()->pluck('tags.id')->toArray();

$explodeTags = explode(',', $request->tags);


$newTagIds = [];

foreach ($explodeTags as $newTagName) {
    $tag = Tag::firstOrCreate(['name' => $newTagName]);
    $newTagIds[] = $tag->id;
}
// dd($newTagIds);
$articles->tags()->sync($newTagIds);
Tag::whereNotIn('id', $newTagIds)->delete();


        $articles->title             = $request->title;
        $articles->title_slug        = strtolower(str_replace(' ', '-', $request->title));
        $articles->content           = $request->content;
        $articles->meta_description  = $request->meta_description;
        $articles->key_words         = $request->key_words;
        $articles->category_id       = $request->category;
        $articles->subcategory_id    = $request->subcategory;
        $articles->trending          = $request->trending;

        $articles->update();
        return redirect()->route('articles.main')
            ->with('success', 'Successfuly updated data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, $id)
    {
        $articles = Article::findOrFail($id);
        $this->authorize('forceDelete', $articles);
        $pathImg = str_replace('\\', '/', public_path('articlePic/')) . $articles->image;
        if (File::exists($pathImg)) {
            File::delete($pathImg);
        }
        $show_Pic = Article::select('id', 'albums')->where('id', $articles->id)->first();
        $get_Pictrue = explode(",", $show_Pic->albums);

        foreach ($get_Pictrue as $index => $val) {
            $pathImg_slider =  str_replace('\\', '/', public_path('articlePic/')) . $val;
            if (File::exists($pathImg_slider)) {
                File::delete($pathImg_slider);
            }
        }
        $getArticle_id = DB::table('article_tag')->where('article_id', $articles->id)->get();
        foreach ($getArticle_id as $val) {
            DB::table('tags')->where('id', $val->tag_id)->delete();
        }
        DB::table('article_tag')->where('article_id', $articles->id)->delete();
        $articles->delete();
        return redirect()->route('articles.main')
            ->with('success', 'Successfuly deleted data');
    }
    public function toggle($id)
    {
        $articles = Article::findOrFail($id);
        $articles->update([
            'trending' => !$articles->trending
        ]);

        return back();
    }
    public function ckUpload(Request $request)
    {
        $uploadedImage = $request->file('upload');
        $uploadedImage = $this->ckProcessSingleImage($uploadedImage, 'articlePic/', true, 615, 460);
        $url = url('../public/articlePic/'. $uploadedImage);
        $CkeditorFuncNum = $request->input('CKEditorFuncNum');
        $status = "<script>window.parent.CKEDITOR.tools.callFunction('$CkeditorFuncNum','$url', 'File Uploaded Successfully')</script>";
        echo $status;

    }
}
