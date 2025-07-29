@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>Color Management</h1>
        <p class="text-muted">Welcome to the Color page.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Color</li>
            </ol>
        </nav>
    </div>
    <div class="color">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
