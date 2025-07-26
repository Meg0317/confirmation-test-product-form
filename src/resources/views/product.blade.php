@extends('layouts.app')

<style>
    svg.w-5.h-5 {
    width: 30px;
    height: 30px;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css')}}">
@endsection

@section('content')
<div class="product-form">
    <div class="product-form__heading">
        <h2 class="product-form__heading content__heading">商品一覧</h2>
        <a href="/products/register" class="product-form__btn btn">+商品を追加</a>
    </div>

    <!-- 検索＋一覧全体をまとめるブロック -->
    <form class="search-and-list" action="/products/search" method="get" >
    @csrf
        <!-- 左側：検索フォーム -->
        <div class="search-block">
            <div class="search-form__group-name">

                <label class="search-form__label" >
                    <input class="search-form__input" type="text" name="name" placeholder="商品名で検索" value= "{{request('name') }}"/>
                </label>
                <input class="search-form__btn btn" type="submit" value="検索">
            </div>

            <div class="search-form__group-price">
                <p>価格順で表示</p>
                <select class="search-form__select" name="sort">
                    <option value="" disabled {{ request('sort') == null ? 'selected' : '' }}>価格で並び替え</option>
                    <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>低い順に表示</option>
                </select>
                @if(request('sort') === 'price-high')
                    <span class="tag">
                        高い順に表示
                        <a class="tag__close" href="/products">×</a>
                    </span>
                @endif

                @if(request('sort') === 'price-low')
                    <span class="tag">
                        低い順に表示
                        <a class="tag__close" href="/products">×</a>
                    </span>
                @endif
            </div>
        </div>

        <!-- 右側：商品一覧 -->
        <div class="list-block">
            <div class="fruit-grid">
                @foreach ($products as $product)
                <div class="card">
                    <a href="{{ url('/products/' . $product->id) }}">
                        <img class="card-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <p>
                            <span>{{ $product->name }}</span>
                            <span>￥{{ number_format($product->price) }}</span>
                        </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </form>
    
    <div class="pagination-area">
        {{ $products->appends(request()->query())->links() }}
    </div>
    
</div>

@endsection