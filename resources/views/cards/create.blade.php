@extends('layouts.app')

@section('content')
<h1 class="text-3xl">Создание карточки</h1>
<div class="container sm:max-w-md mt-6 px-6 py-4 bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
    <form method="POST" action="{{ route('cards.store') }}">
        @csrf

        <!-- Автор -->
        <div>
            <x-input-label for="author" value="Автор" />
            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')"
                required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('author')" class="mt-2" />
        </div>

        <!-- Название -->
        <div class="mt-4">
            <x-input-label for="title" value="Название" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                :value="old('title')" required autocomplete="off" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        
        <!-- Тип карточки -->
        <div class="mt-4">
          <legend class="text-sm font-medium text-gray-700">Тип карточки</legend>
          <div class="flex items-center space-x-6 mt-2">
            @foreach ($cardTypes as $type)
              <label class="flex items-center space-x-2">
              <x-radio-input name="card_type" value="{{ $type->id }}" :checked="old('card_type') == $type->id" required/>
              <span>{{ $type->name }}</span>
            </label>
            @endforeach
          </div>
          <x-input-error :messages="$errors->get('card_type')" class="mt-2" />
        </div>

        <!-- Издательство (опц.) -->
        <div class="mt-4">
            <x-input-label for="publisher" value="Издательство" />
            <x-text-input id="publisher" class="block mt-1 w-full" type="text" name="publisher"
                :value="old('publisher')" autocomplete="off" />
            <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
        </div>

        {{-- Год издания (опц.) --}}
        <div class="mt-4">
            <x-input-label for="publication_year" value="Год издания" />
            <x-text-input id="publication_year" class="block mt-1 w-full" type="number" name="publication_year"
                :value="old('publication_year')" autocomplete="off" />
            <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
        </div>

        {{-- Переплёт --}}
        <div class="mt-4">
            <x-input-label for="cover_type" value="Переплёт" />
            <x-select-input id="cover_type" name="cover_type" class="block mt-1 w-full">
              <option value="">-- Не выбрано --</option>
              @foreach ($coverTypes as $type)
                <option value="{{ $type->id }}" {{ old('cover_type') == $type->id ? 'selected' : '' }}>
                  {{ $type->name }}
                </option>
              @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('cover_type')" class="mt-2" />
        </div>

        {{-- Состояние --}}
        <div class="mt-4">
            <x-input-label for="book_condition" value="Состояние" />
            <x-select-input id="book_condition" name="book_condition" class="block mt-1 w-full">
              <option value="">-- Не выбрано --</option>
              @foreach ($bookConditions as $condition)
                <option value="{{ $condition->id }}" {{ old('book_condition') == $condition->id ? 'selected' : '' }}>
                  {{ $condition->name }}
                </option>
              @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('book_condition')" class="mt-2" />
        </div>

        <x-link-button href="{{ route('cards.index') }}" class="ms-4">Назад</x-link-button>
        <x-primary-button class="mt-5 ms-4">
            Создать карточку
        </x-primary-button>
    </form>
</div>
@endsection
