@extends('layouts.app')

@section('title', 'Карточки')

@section('content')

@cannot('admin')
  <h1 class="text-3xl">Карточки</h1>
@else
  <h1 class="text-3xl">Админ-панель</h1>
@endcannot

<div class="container flex flex-col md:flex-row flex-wrap gap-y-4 space-x-4 justify-center items-center mx-6 mt-6 mb-6">
  {{-- Поиск --}}
  <form 
    @can('admin')
      action="{{ route('admin.index') }}"
    @else
      action="{{ route('cards.index') }}"
    @endcan
    method="GET"
    class="flex flex-col md:flex-row flex-wrap gap-y-4 space-x-4 justify-center items-center">
    <x-input-label for="search" value="Поиск по названию" textSize="text-lg"/>
    <x-text-input id="search" class="block text-lg mt-1 mx-8 min-w-4 grow" type="text" name="search" :value="request('search')"
      autofocus autocomplete="search" />
    <x-input-label for="status" value="Статус" textSize="text-lg"/>
    <x-select-input id="status" class="block text-lg mt-1 mx-8 min-w-4" name="status" :value="request('status')">
      <option value="" @selected(request('status') == null)>Все</option>
      @foreach ($statuses as $status)
        <option value="{{ $status->id }}" @selected(request('status') == $status->id)>{{ $status->name }}</option>
      @endforeach
    </x-select-input>
    <x-primary-button>Найти</x-primary-button>
  </form>

  @cannot('admin')
    <x-link-button href="{{ route('cards.create') }}">Добавить карточку</x-link-button>
  @endcannot
</div>

@if($cards->isEmpty())
  @if(request('search') != null || request('status') != null)
    @can('admin')
      <h3 class="text-2xl ">В базе нет карточек.</h3>
    @else
      <h3 class="text-2xl ">У вас нет карточек.</h3>
    @endcan
  @else
    <h3 class="text-2xl ">Ничего не нашлось.</h3>
  @endif
@else
<div class="container grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-around items-start mx-4">
  @foreach($cards as $card)
  <x-card :card="$card" />
  @endforeach
</div>
@endif  
@endsection

@if(session('success'))
  @push('scripts')
  <script>
    alert('{{ session('success') }}');
  </script>
  @endpush
@endif