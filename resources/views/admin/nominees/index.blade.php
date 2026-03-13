@extends('admin.layout.app')

@section('content')

<h1 class="text-2xl text-black mb-6">Nominees</h1>

<div class="glass-card">

    <div class="table-header">
        <input type="text" id="searchInput" placeholder="Search nominee..." class="search-box">
        <button id="addNomineeBtn" class="add-btn">+ Add Nominee</button>
    </div>

    <div class="table-responsive">
        <table class="glass-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Category</th>
                    <th>Nominations</th>
                    <th>Actions</th>
                </tr>
            </thead>
       <tbody id="nomineeTable">
@foreach($nominees as $nom)
<tr>
    <td>{{ $nom->id }}</td>
    <td>{{ $nom->name }}</td>
    <td>{{ $nom->email ?? 'N/A' }}</td>
    <td>{{ $nom->phone ?? 'N/A' }}</td>
    <td>{{ $nom->category }}</td>
    <td>{{ $nom->nomination_count }}</td>
    <td class="actions">
        <form action="{{ route('admin.nominees.destroy', $nom->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="delete-btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $nominees->links() }}
    </div>

</div>

<!-- Add Nominee Modal -->
<div id="addNomineeModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Add Nominee</h2>
        <form action="{{ route('admin.nominees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nominee Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email (optional)</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="phone">Phone (optional)</label>
                <input type="text" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason (optional)</label>
                <textarea name="reason" id="reason" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Upload Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            <div class="button-group">
                <button type="submit" class="submit-btn">Save</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // Search functionality
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let value = this.value.toLowerCase();
        document.querySelectorAll("#nomineeTable tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
        });
    });

    // Modal elements
    const modal = document.getElementById("addNomineeModal");
    const addBtn = document.getElementById("addNomineeBtn");
    const closeX = document.querySelector(".modal-close");
    const cancelBtn = document.querySelector(".cancel-btn");

    // Open modal
    addBtn.addEventListener("click", () => modal.style.display = "block");

    // Close modal
    closeX.addEventListener("click", () => modal.style.display = "none");
    cancelBtn.addEventListener("click", () => modal.style.display = "none");

    // Close modal if click outside content
    window.addEventListener("click", (e) => {
        if(e.target === modal) modal.style.display = "none";
    });

});
</script>

@endsection

<style>
/* Glass card */
.glass-card {
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.15);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 8px 32px 0 rgba(0,0,0,0.1);
    color: #000;
}

/* Table header */
.table-header {
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
}

/* Search box */
.search-box {
    padding:10px 15px;
    border-radius:8px;
    border:none;
    outline:none;
    width:250px;
}

/* Add button */
.add-btn {
    background:#0d6efd;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
}

/* Table */
.glass-table {
    width:100%;
    border-collapse:collapse;
    color:#000;
}

.glass-table thead {
    background: rgba(255,255,255,0.5);
}

.glass-table th,
.glass-table td {
    padding:14px;
    border-bottom:1px solid rgba(0,0,0,0.2);
    text-align:left;
}

.glass-table tr:hover {
    background: rgba(255,255,255,0.3);
}

/* Actions buttons */
.actions {
    display:flex;
    gap:10px;
}

.edit-btn, .view-btn {
    background:#ffc107;
    color:black;
    border:none;
    padding:6px 12px;
    border-radius:6px;
    cursor:pointer;
}

.delete-btn {
    background:#dc3545;
    color:white;
    border:none;
    padding:6px 12px;
    border-radius:6px;
    cursor:pointer;
}

/* Modal */
.modal {
    display:none;
    position:fixed;
    z-index:999;
    left:0;
    top:0;
    width:100%;
    height:100%;
    overflow:auto;
    background:rgba(0,0,0,0.5);
    padding-top:60px;
}

.modal-content {
    margin:5% auto;
    padding:30px;
    border-radius:15px;
    max-width:500px;
    background:#fff;
    color:#000;
    position:relative;
}

/* Close button */
.modal-close {
    position:absolute;
    top:15px;
    right:20px;
    font-size:28px;
    font-weight:bold;
    cursor:pointer;
}

/* Form styling */
.form-group {
    margin-bottom:15px;
    display:flex;
    flex-direction:column;
}

.form-group label {
    margin-bottom:5px;
    font-weight:600;
}

.form-group input, .form-group select, .form-group textarea {
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    background:#fff;
    color:#000;
}

/* Buttons */
.button-group {
    display:flex;
    gap:10px;
    margin-top:10px;
    justify-content:flex-end;
}

.submit-btn {
    background:#0d6efd;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    border:none;
    cursor:pointer;
}

.submit-btn:hover {
    background:#0b5ed7;
}

.cancel-btn {
    background:#6c757d;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    border:none;
    cursor:pointer;
}

.cancel-btn:hover {
    background:#5a6268;
}

/* Responsive */
@media(max-width:480px){
    .button-group{
        flex-direction:column;
    }
    .search-box{
        width:100%;
    }
}
</style>