<?php

namespace App\Http\Controllers;

use App\Models\BookCard;
use App\Models\CardType;
use App\Models\CoverType;
use App\Models\BookCondition;
use App\Models\Status;
use Auth;
use Illuminate\Http\Request;

class BookCardController extends Controller
{
    public function index(Request $request)
    {
        $query = BookCard::where('user_id', Auth::id());

        if ($request->filled('search'))
            $query = $query->where('title', 'like', '%' . $request->search . '%');

        if ($request->filled('status'))
            $query = $query->where('status_id', $request->status);

        $cards = $query->get();
        $statuses = Status::all();
        return view('cards.index', compact('cards', 'statuses'));
    }


    public function create()
    {
        return view('cards.create', [
            'cardTypes' => CardType::all(),
            'coverTypes' => CoverType::all(),
            'bookConditions' => BookCondition::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'author' => ['required', 'string', 'max:255'],
                'title' => ['required', 'string', 'max:255'],
                'card_type' => ['required', 'exists:card_types,id'],
                'publisher' => ['nullable', 'string', 'max:255'],
                'publication_year' => ['nullable', 'numeric', 'min:0', 'max:' . date('Y')],
                'cover_type' => ['nullable', 'exists:cover_types,id'],
                'book_condition' => ['nullable', 'exists:book_conditions,id'],
            ],
            [
                'publication_year.max' => 'Год публикации не может быть больше текущего года.',
            ]
        );

        $card = new BookCard();
        $card->author = $validated['author'];
        $card->title = $validated['title'];
        $card->card_type_id = $validated['card_type'];
        $card->publisher = $validated['publisher'];
        $card->publication_year = $validated['publication_year'];
        $card->cover_type_id = $validated['cover_type'];
        $card->book_condition_id = $validated['book_condition'];
        $card->user_id = Auth::id();
        $card->status_id = 1;
        $card->save();

        return redirect()->route('cards.index')->with('success', 'Карточка добавлена.');
    }

    public function softDelete($id)
    {
        $card = BookCard::find($id);
        if ($card->user_id != Auth::id())
            abort(403);

        $card->status_id = Status::find(4)->id;
        $card->save();
        return redirect()->back()->with('success', 'Карточка удалена.');
    }
}
