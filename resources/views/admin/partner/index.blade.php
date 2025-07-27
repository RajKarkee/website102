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



            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- @extends('layouts.admin') --}}

        @section('content')
            <div class="contanier">

                <form method="POST" action="{{ route('admin.partner.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Page Header --}}
                    <div class="mb-3">
                        <label class="form-label">Valued Partners</label>
                        <input type="text" class="form-control" placeholder="Header here...">
                    </div>

                    {{-- Page Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Description here..."></textarea>
                    </div>

                    {{-- Partners Table --}}
                    <h4 class="mt-4">Partners</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partner as $item)
                                <tr>
                                    <td>
                                        <input type="text" name="partners[{{ $item->id }}][name]"
                                            value="{{ $item->name }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="email" name="partners[{{ $item->id }}][email]"
                                            value="{{ $item->email }}" class="form-control">
                                    </td>
                                    <td>
                                        @if ($item->logo)
                                            <img src="{{ asset('storage/' . $item->logo) }}" width="50"
                                                class="mb-1" />
                                        @endif
                                        <input type="file" name="partners[{{ $item->id }}][logo]"
                                            class="form-control">
                                    </td>
                                    <td>
                                        <button type="submit" name="action" value="delete_{{ $item->id }}"
                                            class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- New Partner Row --}}
                            <tr>
                                <td><input type="text" name="new_partner[name]" class="form-control"
                                        placeholder="New name"></td>
                                <td><input type="email" name="new_partner[email]" class="form-control"
                                        placeholder="New email"></td>
                                <td><input type="file" name="new_partner[logo]" class="form-control"></td>
                                <td><small class="text-muted">New</small></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" name="action" value="save" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        @endsection




    </div>
