<?php

namespace App\Presenters\Url;

use App\Models\User;

class UserUrlPresenter extends UrlPresenter
{
    public function index(string $filters = ''): string
    {
        return route('users.index', $filters);
    }

    public function store(): string
    {
        return route('users.store');
    }

    public function create(): string
    {
        return route('users.create');
    }

    public function edit(User $user): string
    {
        return route('users.edit', $user);
    }

    public function update(User $user): string
    {
        return route('users.update', $user);
    }
}
