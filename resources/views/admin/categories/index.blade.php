@extends('admin.layout.app')

@section('content')

<h1 class="text-2xl text-black mb-6">Categories</h1>

<div class="glass-card">

    <div class="table-header">
        <input type="text" id="searchCategory" placeholder="Search category..." class="search-box">
            <button id="addCategoryBtn" class="add-btn">+ Add Category</button>
    </div>

    <div class="table-responsive">
        <table class="glass-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Event</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="categoryTable">
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->event->name ?? 'N/A' }}</td>
                            <td class="actions">
                                <a href="#" class="edit-btn">Edit</a>
                                <form action="#" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align:center;">No categories found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        @if(isset($categories)) {{ $categories->links() }} @endif
    </div>

</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="modal">
    <div class="modal-content">
        <!-- Top X button -->
        <span class="modal-close">&times;</span>

        <h2>Add Category</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="button-group">
                <button type="submit" class="submit-btn">Save</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>



<script>
document.getElementById("searchCategory").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    document.querySelectorAll("#categoryTable tr").forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});
// Modal open/close
const modal = document.getElementById("addCategoryModal");
const addBtn = document.getElementById("addCategoryBtn");
const closeBtns = document.querySelectorAll(".close-btn");

addBtn.onclick = () => modal.style.display = "block";

closeBtns.forEach(btn => {
    btn.onclick = () => modal.style.display = "none";
});

// Close modal if click outside
window.onclick = (e) => {
    if(e.target == modal){
        modal.style.display = "none";
    }
};
document.addEventListener("DOMContentLoaded", function() {

    // Modal elements
    const modal = document.getElementById("addCategoryModal");
    const addBtn = document.getElementById("addCategoryBtn");
    const closeX = document.querySelector(".modal-close");
    const cancelBtn = document.querySelector(".cancel-btn");

    // Open modal
    addBtn.addEventListener("click", () => {
        modal.style.display = "block";
    });

    // Close modal on X
    closeX.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Close modal on Cancel
    cancelBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Close modal if clicking outside content
    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

});
</script>

@endsection

<style>
/* Glassmorphism card */
.glass-card {
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.15);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
    color: #000; /* Make all text inside visible */
}

/* Table header */
.table-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
    color: #000; /* ensure header text is black */
}

/* Search box */
.search-box {
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    outline: none;
    width: 250px;
    background: rgba(255, 255, 255, 0.7); /* make input lighter */
    color: #000; /* black text */
}

/* Add button */
.add-btn {
    background: #0d6efd;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}

/* Table */
.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: #000; /* black text in table */
}

.glass-table thead {
    background: rgba(255, 255, 255, 0.5); /* lighter header for contrast */
    color: #000; /* header text black */
}

.glass-table th,
.glass-table td {
    padding: 14px;
    border-bottom: 1px solid rgba(0,0,0,0.2);
    text-align: left;
}

/* Hover row */
.glass-table tr:hover {
    background: rgba(255, 255, 255, 0.3);
    transition: background 0.3s;
}

/* Modal */
.modal-content {
    margin: 5% auto;
    padding: 25px;
    border-radius: 15px;
    max-width: 500px;
    background: rgba(255, 255, 255, 0.95); /* white background */
    color: #000; /* black text */
}
.form-group label,
.form-group input,
.form-group select {
    color: #000;
    background: #fff;
}
/* Modal content */
.modal {
    display: none; /* hide modal initially */
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background: rgba(0,0,0,0.5);
    padding-top: 60px;
}

.modal-content {
    margin: 5% auto;
    padding: 30px;
    border-radius: 15px;
    max-width: 500px;
    background: rgba(255, 255, 255, 0.95);
    color: #000;
    box-shadow: 0 8px 32px 0 rgba(0,0,0,0.2);
    position: relative;
}

/* Close button */
.close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #000;
}

/* Form inside modal */
.form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 8px;
    font-weight: 600;
    color: #000;
}

.form-group input,
.form-group select {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
    background: #fff;
    color: #000;
    font-size: 14px;
}

/* Button group */
.button-group {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    justify-content: flex-end;
}

.submit-btn {
    background: #0d6efd;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.submit-btn:hover {
    background: #0b5ed7;
}

.close-btn.button {
    background: #6c757d;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.close-btn.button:hover {
    background: #5a6268;
}

/* Responsive */
@media(max-width:480px){
    .button-group {
        flex-direction: column;
    }
}
</style>