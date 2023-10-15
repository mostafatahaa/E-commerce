<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Actions
    public function index()
    {
        $user = "Mostafa Taha";

        // Return response: view, json, redirect, file...
        // by default will search in dir views and no need to wirte .php
        return view('dashboard.index', compact("user"));
    }
}
