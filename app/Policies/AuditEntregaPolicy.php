<?php

namespace App\Policies;

use App\Models\AuditEntrega;
use App\Models\User;

class AuditEntregaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role?->name === 'product_owner';
    }

    public function view(User $user, AuditEntrega $audit): bool
    {
        return $user->role?->name === 'product_owner';
    }

    public function update(User $user, AuditEntrega $audit): bool
    {
        return false;
    }

    public function delete(User $user, AuditEntrega $audit): bool
    {
        return false;
    }
}
