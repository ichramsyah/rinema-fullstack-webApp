@extends('admin.dashboard')

@section('forumreplycreate')

<div class="px-4">
    <a href="{{route('admin.forumreply.index')}}" class="py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

    <h1 class="text-2xl font-bold mb-4 mt-4">Add Replies</h1>
    @if (session('error'))
        <div class="bg-red-500 text-white p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.forumreply.store') }}" method="POST" class="rounded w-full">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Forum</label>
            <div class="flex gap-2">
                @foreach ($forums as $forum)
                    <button type="button" class="forum-btn hover:bg-gray-500 hover:text-white transition-all px-8 text-gray-600 py-2 border border-gray-500 rounded-sm focus:ring focus:ring-transparent" data-value="{{ $forum->id }}">{{ $forum->title }}</button>
                @endforeach
            </div>
            <input type="hidden" name="forum_id" id="forum_id">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">User</label>
            <input type="text" name="user_name" id="user_name" class="w-full mt-1 px-3 py-2 rounded-lg border border-slate-400 bg-slate-200 focus:outline-none focus:border-red-500" value="{{ Auth::user()->name }}" disabled>
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
        </div>

        <div class="mb-5">
            <label for="body" class="block text-gray-700 text-sm font-bold ">Body</label>
            <textarea name="body" id="body"
                      class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"></textarea>
        </div>
        @if($parentReply)
            <div class="mb-4 bg-gray-100 p-4 rounded">
                <p class="font-semibold">Balasan Induk:</p>
                <p><strong>User:</strong> {{ $parentReply->user->name }}</p>
                <p><strong>Body:</strong> {{ $parentReply->body }}</p>
            </div>
        @endif

        <input type="hidden" name="parent_reply_id" id="parent_reply_id" value="{{ $parentReplyId ?? '' }}">

        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Add</button>
    </form>
</div>

<script>
    document.querySelectorAll('.forum-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Set nilai input hidden
            document.getElementById('forum_id').value = this.dataset.value;

            // Reset semua tombol agar kembali ke warna default
            document.querySelectorAll('.forum-btn').forEach(btn => {
                btn.classList.remove('bg-gray-500', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-600');
            });

            // Tambahkan warna pada tombol yang dipilih
            this.classList.remove('bg-gray-100', 'text-gray-600');
            this.classList.add('bg-gray-500', 'text-white');
        });
    });
</script>
@endsection