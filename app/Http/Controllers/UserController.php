<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $paginate = 20;
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }
    
}
