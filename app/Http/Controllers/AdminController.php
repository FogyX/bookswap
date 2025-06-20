<?php

namespace App\Http\Controllers;

use App\Models\BookCard;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $query = BookCard::query();

        if ($request->filled('search'))
            $query = $query->where('title', 'like', '%' . $request->search . '%');

        if ($request->filled('status'))
            $query = $query->where('status_id', $request->status);

        $cards = $query->get();
        $statuses = Status::all();
        return view('cards.index', compact('cards', 'statuses'));
    }

    public function approve($id)
    {
        $card = BookCard::find($id);
        $card->status_id = Status::find(2)->id;
        $card->save();
        return redirect()->back()->with('success', 'Карточка одобрена.');
    }

    public function reject($id)
    {
        $card = BookCard::find($id);
        $card->status_id = Status::find(3)->id;
        $card->save();

        return redirect()->back()->with('success', 'Карточка отклонена.');
    }
}
