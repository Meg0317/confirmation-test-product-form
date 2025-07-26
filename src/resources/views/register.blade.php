@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">商品登録</h2>
    <div class="register-form__inner">
        <form action="/products/register" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">商品名
                    <span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="商品名を入力">
                <p class="register-form__error-message">
                @error('name')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="name">値段
                    <span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}"
                    placeholder="値段を入力">
                <p class="register-form__error-message">
                @error('price')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="name">商品画像
                    <span class="register-form__required">必須</span>
                </label>
                <input class="register-form__image-input" type="file" name="image" id="image">
                <p class="register-form__error-message">
                @error('image')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="name">季節
                    <span class="register-form__required">必須</span>
                    <p class="register-form__message">複数選択可</p>
                </label>
                @foreach($seasons as $season)
                    <label class="register-form__season-input">
                        <!-- チェックボックスなのでhidden不要 -->
                        <input type="checkbox" name="season_ids[]" value="{{ $season->id }}"
                            {{ in_array($season->id, old('season_ids', [])) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @endforeach
                <p class="register-form__error-message">
                @error('season_ids')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="name">商品説明
                    <span class="register-form__required">必須</span>
                </label>
                <textarea class="register-form__textarea" name="description" id="" cols="10" rows="5"
                    placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <p class="register-form__error-message">
                @error('description')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="register-form__btn-inner">
                <button type="submit" name="back" value="戻る" class="register-form__back-btn btn">戻る</button>
                <button type="submit" name="send" value="登録" class="register-form__send-btn">登録</button>
            </div>
        </form>
    </div>
</div>


@endsection
