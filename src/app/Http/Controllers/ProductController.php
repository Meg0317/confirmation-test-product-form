<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;
use App\Http\Requests\RegisterRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        $seasons = Season::all();
        $product_season = ProductSeason::all();

        return view('product', compact('products', 'seasons', 'product_season'));
    }

    public function search(Request $request)
    {
        // $sort = $request->input('sort'); // この1行は必要

        $query = Product::query();

        if ($request->filled('name')) {
            $query->keywordSearch($request->input('name'));
        }

        // 並び順の処理
        if ($request->input('sort') === 'price-high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->input('sort') === 'price-low') {
            $query->orderBy('price', 'asc');
        }

         // 検索結果または全件を6件ずつページネーション
        $products = $query->paginate(6);
        $seasons = Season::all();
        $product_season = ProductSeason::all();

        return view('product', compact('products', 'seasons', 'product_season'));
    }
    //  商品登録用
    public function create()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    //詳細画面に遷移
    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('detail', compact('product', 'seasons'));
    }

    public function store(RegisterRequest $request)
    {

        // 戻る処理
        if ($request->has('back')) {
            return redirect('/products');
        }

        //アップロードされた画像を storage/app/public/products ディレクトリに保存し、その保存パスを変数 $path に格納
        $path = $request->file('image')->store('products', 'public');

        // 商品情報を配列にまとめる
        $data = $request->only(['name', 'price', 'description']);
        $data['image'] = $path;
        //DBに保存
        $product = Product::create($data);

        // seasonはproductにないので、別で表記
        $product->seasons()->attach($request->season_ids);

         // 登録後に一覧へ
        return redirect('/products');
    }


    public function update(RegisterRequest $request,$ProductId)
    {
        if ($request->has('back')) {
            return redirect('/products');
        }

        $path = $request->file('image')->store('products', 'public');
        $data = $request->only(['name', 'price', 'description']);
        $data['image'] = $path;

        $product = Product::find($ProductId);
        $product->update($data);

        $product->seasons()->sync($request->season_ids);

        return redirect('/products');
    }

    public function destroy($productId)
    {
        Product::find($productId)->delete();
        return redirect('/products');
    }
}
