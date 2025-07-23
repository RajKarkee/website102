@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Partners Management')</h1>
          <p class="text-muted">Welcome to the partner page where you can add partners.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Partners')</li>
            </ol>
        </nav>
    </div>
    <div class="service">
      
        

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

{{-- @extends('layouts.admin') --}}

@section('content')
<div class="contanier">
    <h1 class="mb-4">Partners</h1>
    <div class="text-right mb-3">
    </div>
</div>