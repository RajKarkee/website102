@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'FAQ Management',
            'description' => 'Manage frequently asked questions',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'FAQ Management', 'url' => '#']
            ]
        ])

        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-question-circle me-2"></i>FAQ Management
                </h5>
            </div>
            <div class="card-body">
                <div class="container">
                {{-- Add FAQ Form --}}
                <form action="{{ route('admin.faq.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-2">
                        <input type="text" name="question" class="form-control" placeholder="Enter question" required>
                    </div>
                    <div class="mb-2">
                        <textarea name="answer" class="form-control" rows="3" placeholder="Enter answer" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add FAQ</button>
                </form>

                {{-- FAQ Table --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td>
                                    <a href="{{ route('admin.faq.status', $faq) }}"
                                        class="btn btn-sm {{ $faq->status ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $faq->status ? 'Enabled' : 'Disabled' }}
                                    </a>
                                </td>
                                <td>
                                    {{-- Edit Form (inline) --}}
                                    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="question" value="{{ $faq->question }}"
                                            class="form-control mb-1" required>
                                        <textarea name="answer" class="form-control mb-1" rows="2" required>{{ $faq->answer }}</textarea>
                                        <button class="btn btn-sm btn-success" type="submit">Update</button>
                                    </form>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST"
                                        class="d-inline mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mt-2"
                                            onclick="return confirm('Delete this FAQ?')">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach

                        @if ($faqs->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No FAQs available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
