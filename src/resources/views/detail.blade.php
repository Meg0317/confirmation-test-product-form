@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail-form">
    <form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

        <div class="detail-form__group">
            <p class="product-list">
                <span>商品一覧 ></span>
                <span>{{ $product->name }}</span>
            </p>

            <div class="detail-form__inner">
                <div class="detail-form__image-area">
                    <div class="product-card">
                        <div class="card-area">
                            <img class="card-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="upload-area">
                            <input class="register-form__image-input" type="file" name="image" id="image">
                        </div>
                    </div>
                    <p class="detail-form__error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                    </p>
                </div>

                <div class="detail-form__input-area">
                    <div class="detail-form__name-input">
                        <label class="detail-form__label" for="name">商品名</label>
                        <input class="detail-form__input" type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            placeholder="商品名を入力">
                        {{--<input type="hidden" name="name" value="{{ $product->name }}">--}}

                        <p class="detail-form__error-message">
                        @error('name')
                            {{ $message }}
                        @enderror
                        </p>
                    </div>

                    <div class="detail-form__price-input">
                        <label class="detail-form__label" for="name">値段</label>
                        <input class="detail-form__input" type="text" name="price" id="price" value="{{ old('price', $product->price) }}"
                            placeholder="値段を入力">
                        {{--<input type="hidden" name="price" value="{{ $product->price }}">--}}
                        <p class="detail-form__error-message">
                        @error('price')
                            {{ $message }}
                        @enderror
                        </p>
                    </div>

                    <div class="detail-form__season-input">
                        <label class="detail-form__label" for="name">季節</label>
                        @foreach($seasons as $season)
                            <label class="detail-form__season-choice">
                                <!-- チェックボックスなのでhidden不要 -->
                                <input type="checkbox" name="season_ids[]" value="{{ $season->id }}"
                                    {{ in_array($season->id, old('season_ids', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                        <p class="detail-form__error-message">
                        @error('season_ids')
                            {{ $message }}
                        @enderror
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-form__area-secondary">
            <div class="detail-form__description-input">
                <label class="detail-form__label" for="name">商品説明</label>
                <textarea class="detail-form__textarea" name="description" id=""
                    placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                    {{--<input type="hidden" name="description" value="{{ $product->description }}">--}}
                <p class="detail-form__error-message">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>
        </div>

        <div class="detail-form__operation-area">
            <div class="detail-form__btn-inner">
                <a href="/products" class="detail-form__back-btn btn">戻る</a>
                <button type="submit" name="send" value="登録" class="detail-form__send-btn">変更を保存</button>
            </div>
        </div>
    </form>

    <form action="/products/{{ $product->id }}/delete" method="POST">
        @method('DELETE')
        @csrf
        <div class="delete-form">
            <input type="hidden" name="id" value="{{ $product['id'] }}">
            <button type="submit" name="send" value="削除" class="detail-form__delete-btn">
                <img src="{{ asset('images/delete-icon.png') }}" alt="" width="20">
            </button>
        </div>
    </form>
</div>

@endsection
