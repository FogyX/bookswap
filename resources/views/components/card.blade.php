@props(['card'])

<div class="flex flex-col justify-start
@switch($card->status_id)
  @case(1)
    bg-yellow-100 text-yellow-800
    @break
  @case(2)
    bg-green-100 text-green-800
    @break
  @case(3)
    bg-red-100 text-red-800
    @break
  @case(4)
    bg-gray-100 text-gray-600
  @break
@endswitch
 shadow overflow-hidden sm:rounded-lg mx-2 p-4">
<h1 class="text-3xl">Карточка №{{ $card->id }}</h1>
<p><span class="font-bold">Тип:</span> {{ $card->cardType()->first()->name }}</p>
<p><span class="font-bold">Статус:</span> {{ $card->status()->first()->name }}</p>
<p><span class="font-bold">Автор:</span> {{ $card->author }}</p>
<p><span class="font-bold">Название:</span> {{ $card->title }}</p>
@if($card->publisher)
<p><span class="font-bold">Издатель:</span> {{ $card->publisher }}</p>
@endif
@if($card->publication_year)
<p><span class="font-bold">Год издания:</span> {{ $card->publication_year }}</p>
@endif
@if($card->coverType()->first())
<p><span class="font-bold">Тип обложки:</span> {{ $card->coverType()->first()->name }}</p>
@endif
@if($card->bookCondition()->first())
<p><span class="font-bold">Состояние:</span> {{ $card->bookCondition()->first()->name }}</p>
@endif
@auth
  @can('admin')
    @if ($card->status_id == 1)
    <form method="POST" action="{{ route('admin.approve', ['id' => $card->id]) }}" onsubmit="return confirm('Вы действительно хотите одобрить карточку?')">
      @csrf
      @method('PATCH')
      <x-primary-button class="mt-4 bg-green-500 text-white">Одобрить карточку</x-primary-button>
    </form>
    <form method="POST" action="{{ route('admin.reject', ['id' => $card->id]) }}" onsubmit="return confirm('Вы действительно хотите отклонить карточку?')">
      @csrf
      @method('PATCH')
      <x-primary-button class="mt-4 bg-red-500 text-white">Отклонить карточку</x-primary-button>
    </form>
    @endif
  @else
    @if ($card->status_id == 1 || $card->status_id == 2)
    <form method="POST" action="{{ route('cards.soft-delete', ['id' => $card->id]) }}" onsubmit="return confirm('Вы действительно хотите удалить карточку?')">
      @csrf
      @method('PATCH')
      <x-primary-button class="mt-4">Удалить карточку</x-primary-button>
    </form>
    @endif
  @endcan
@endauth
</div>