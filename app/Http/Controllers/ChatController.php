<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChatStoreRequest;
use App\Http\Requests\ChatUpdateRequest;

class ChatController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Chat::class);

        $search = $request->get('search', '');

        $chats = Chat::search($search)
            ->latest()
            ->paginate();

        return view('app.chats.index', compact('chats', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Chat::class);

        $users = User::pluck('name', 'id');

        return view('app.chats.create', compact('users'));
    }

    /**
     * @param \App\Http\Requests\ChatStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatStoreRequest $request)
    {
        $this->authorize('create', Chat::class);

        $validated = $request->validated();

        $chat = Chat::create($validated);

        return redirect()
            ->route('chats.edit', $chat)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Chat $chat)
    {
        $this->authorize('view', $chat);

        return view('app.chats.show', compact('chat'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Chat $chat)
    {
        $this->authorize('update', $chat);

        $users = User::pluck('name', 'id');

        return view('app.chats.edit', compact('chat', 'users'));
    }

    /**
     * @param \App\Http\Requests\ChatUpdateRequest $request
     * @param \App\Models\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function update(ChatUpdateRequest $request, Chat $chat)
    {
        $this->authorize('update', $chat);

        $validated = $request->validated();

        $chat->update($validated);

        return redirect()
            ->route('chats.edit', $chat)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Chat $chat)
    {
        $this->authorize('delete', $chat);

        $chat->delete();

        return redirect()
            ->route('chats.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
