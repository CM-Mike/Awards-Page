@extends('admin.layout.app')

@section('content')

<h1 class="text-2xl text-black mb-6">Add New Category</h1>

<div class="glass-card">

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" placeholder="Enter category name" required>
        </div>

        <div class="form-group">
            <label for="event_id">Event</label>
            <select name="event_id" id="event_id" required>
                <option value="">Select Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="button-group">
            <button type="submit" class="submit-btn">Save Category</button>
            <a href="{{ route('admin.categories.index') }}" class="back-btn">Back</a>
        </div>

    </form>

</div>

@endsection

@section('styles')
<style>
/* Glass Card */
.glass-card{
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.15);
    border-radius: 15px;
    padding:25px;
    border:1px solid rgba(255,255,255,0.2);
    max-width:500px;
    margin:auto;
}

/* Form groups */
.form-group{
    margin-bottom:20px;
    display:flex;
    flex-direction:column;
}

.form-group label{
    margin-bottom:8px;
    font-weight:600;
}

.form-group input,
.form-group select{
    padding:10px 15px;
    border-radius:8px;
    border:none;
    outline:none;
    background: rgba(255,255,255,0.2);
    color: #000;
}

/* Buttons */
.button-group{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.submit-btn{
    background:#0d6efd;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    border:none;
    cursor:pointer;
}

.back-btn{
    background:#6c757d;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
}

/* Responsive */
@media(max-width:480px){
    .button-group{
        flex-direction:column;
    }
}
</style>
@endsection