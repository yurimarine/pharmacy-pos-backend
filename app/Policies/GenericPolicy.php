<?php

namespace App\Policies;

use App\Models\Generic;
use App\Models\User;
use Illuminate\Auth\Access\Response;

// app/Policies/GenericPolicy.php
class GenericPolicy
{
    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(): bool
    {
        return true;
    }

    public function update(): bool
    {
        return true;
    }

    public function delete(): bool
    {
        return true;
    }
}