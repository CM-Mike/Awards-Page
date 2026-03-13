@extends('admin.layout.app')

@section('content')

<div class="flex justify-between items-center mb-6">

<h1 class="text-2xl text-black font-bold">
Events
</h1>

@section('content')
<h1 class="text-3xl font-bold mb-6">Events</h1>

<a href="{{ route('admin.events.create') }}" class="glass px-4 py-2 mb-4 inline-block text-black rounded-lg shadow-md">
    Add Event
</a>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="overflow-x-auto">
<table class="w-full table-auto border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Title</th>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td class="border px-4 py-2">{{ $event->id }}</td>
            <td class="border px-4 py-2">{{ $event->title }}</td>
            <td class="border px-4 py-2">{{ $event->date }}</td>
            <td class="border px-4 py-2 space-x-2">
                <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-500 hover:underline">Edit</a>

                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Delete this event?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection

</div>

<div class="glass p-6">

<table class="w-full text-black">

<thead>

<tr class="border-b border-blue/30">

<th class="p-3 text-left">ID</th>
<th class="p-3 text-left">Title</th>
<th class="p-3 text-left">Date</th>
<th class="p-3 text-left">Action</th>

</tr>

</thead>

<tbody>

@foreach($events as $event)

<tr class="border-b border-blue/20">

<td class="p-3">{{$event->id}}</td>
<td class="p-3">{{$event->title}}</td>
<td class="p-3">{{$event->date}}</td>

<td class="p-3 space-x-2">

<button class="bg-blue-500 px-3 py-1 rounded">
Edit
</button>

<button class="bg-red-500 px-3 py-1 rounded">
Delete
</button>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection