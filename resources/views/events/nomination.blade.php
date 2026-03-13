```blade
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">

<!-- ====================== Categories Buttons ====================== -->
<div class="flex flex-wrap gap-3 mb-8 justify-center">

@php
$categories = [
'Tech','Music','Influencer','Tech Below 30','Arts','Innovation',
'Fashion','Film','Literature','Science','Sports','Entrepreneurship',
'Gaming','Education','Photography','Health','Environment','Podcast',
'Journalism','AI & Robotics'
];
@endphp

@foreach($categories as $cat)

<button class="category-btn px-4 py-2 rounded-full border border-gray-300 text-gray-800 bg-white hover:bg-blue-100 transition"
data-category="{{ $cat }}">
{{ $cat }}
</button>

@endforeach

</div>


<!-- ====================== Nominees Tiles ====================== -->
<div id="nominees-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">

@php
$nominees = $nominees->sortByDesc('nominations_count'); 
@endphp

@foreach($nominees as $nominee)

<div class="nominee-tile bg-white rounded-lg shadow p-3 relative"
data-category="{{ $nominee->category }}">

<div class="nominee-img w-full h-32 bg-gray-200 rounded-md flex items-center justify-center">

@if($nominee->image)

<img src="{{ asset('storage/'.$nominee->image) }}"
alt="{{ $nominee->name }}"
class="w-full h-full object-cover rounded-md">

@else

<span class="text-gray-500 text-sm">No Image</span>

@endif

</div>

<h3 class="mt-2 text-center font-semibold text-gray-800">
{{ $nominee->name }}
</h3>

<div class="nomination-count absolute top-2 right-2 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">

{{ $nominee->nomination_count }}

</div>

</div>

@endforeach

</div>



<!-- ====================== Nomination Form ====================== -->
<div class="bg-white rounded-xl shadow-lg p-6 max-w-2xl mx-auto">

<h2 class="text-2xl font-bold mb-4 text-gray-800">
Nominate The Star ⚡
</h2>

<p class="text-sm text-gray-600 mb-6">
Disclaimer: By submitting a nomination, you confirm that the nominee has agreed to participate.
Only one nomination per person/company is allowed.
</p>

<form action="{{ route('nomination.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<!-- Who to nominate -->

<label class="block text-gray-700 mb-1">Who are you nominating?</label>

<select name="nominee_type"
class="w-full mb-4 p-3 border border-gray-300 rounded text-black"
required>

<option value="">Select</option>
<option value="self">Yourself</option>
<option value="friend">Friend</option>
<option value="company">Company</option>

</select>


<!-- Nominee Name -->

<input
type="text"
id="nomineeName"
name="name"
placeholder="Nominee Name"
value="{{ request('nominee') }}"
class="w-full mb-4 p-3 border border-gray-300 rounded text-black"
required
>


<!-- Share Box -->

<div class="share-box">

<p class="share-title">Share your nomination link</p>

<div class="share-buttons">

<button type="button" onclick="copyNominationLink()" class="share-btn copy">
🔗 Copy
</button>

<button type="button" onclick="shareWhatsApp()" class="share-btn whatsapp">
WhatsApp
</button>

<button type="button" onclick="shareFacebook()" class="share-btn facebook">
Facebook
</button>

<button type="button" onclick="shareTwitter()" class="share-btn twitter">
X
</button>

</div>

</div>


<input type="email"
name="email"
placeholder="Email (optional)"
class="w-full mb-4 p-3 border border-gray-300 rounded text-black">


<input type="text"
name="phone"
placeholder="Phone (optional)"
class="w-full mb-4 p-3 border border-gray-300 rounded text-black">



<!-- Category Select -->

<select name="category"
id="category-select"
class="w-full mb-4 p-3 border border-gray-300 rounded text-black"
required>

<option value="">Select Category</option>

@foreach($categories as $cat)

<option value="{{ $cat }}">{{ $cat }}</option>

@endforeach

</select>



<!-- Age input -->

<div id="age-container" class="mb-4" style="display:none;">

<input
type="number"
name="age"
placeholder="Nominee Age"
class="w-full p-3 border border-gray-300 rounded text-black"
min="1"
max="30">

</div>



<textarea
name="reason"
placeholder="Reason for nomination"
class="w-full mb-4 p-3 border border-gray-300 rounded text-black"
rows="4"
required>
</textarea>



<input type="file"
name="image"
class="mb-4 w-full text-gray-700">



<button
type="submit"
class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600 transition">

Submit Nomination

</button>

</form>

</div>

</div>


@if(session('success'))

<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
{{ session('success') }}
</div>

@endif



<!-- ====================== JS ====================== -->

<script>

/* Category filter */

const categoryBtns = document.querySelectorAll('.category-btn');
const nomineeTiles = document.querySelectorAll('.nominee-tile');

categoryBtns.forEach(btn=>{
btn.addEventListener('click',()=>{
let cat = btn.getAttribute('data-category');

nomineeTiles.forEach(tile=>{
tile.style.display =
(cat === '' || tile.getAttribute('data-category') === cat)
? 'block'
: 'none';
});
});
});


/* Age field */

const categorySelect = document.getElementById('category-select');
const ageContainer = document.getElementById('age-container');

categorySelect.addEventListener('change',function(){

if(this.value === 'Tech Below 30'){
ageContainer.style.display='block';
ageContainer.querySelector('input').setAttribute('required','required');
}else{
ageContainer.style.display='none';
ageContainer.querySelector('input').removeAttribute('required');
}

});


/* Generate share link */

function generateLink(){

let name=document.getElementById("nomineeName").value;

if(name===""){
alert("Enter nominee name first");
return null;
}

return window.location.origin + "/?nominee=" + encodeURIComponent(name);

}


/* Copy */

function copyNominationLink(){

let link=generateLink();
if(!link) return;

navigator.clipboard.writeText(link);

alert("Nomination link copied!\n\n"+link);

}


/* WhatsApp */

function shareWhatsApp(){

let link=generateLink();
if(!link) return;

let msg="Nominate me here: "+link;

window.open("https://wa.me/?text="+encodeURIComponent(msg),'_blank');

}


/* Facebook */

function shareFacebook(){

let link=generateLink();
if(!link) return;

window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(link),'_blank');

}


/* Twitter */

function shareTwitter(){

let link=generateLink();
if(!link) return;

window.open("https://twitter.com/intent/tweet?url="+encodeURIComponent(link),'_blank');

}

</script>



<style>

/* nominee hover */

.nominee-tile:hover{
transform:translateY(-2px);
box-shadow:0 4px 15px rgba(0,0,0,0.2);
transition:0.3s ease;
}


/* share box */

.share-box{
backdrop-filter:blur(12px);
background:rgba(255,255,255,0.2);
border-radius:14px;
padding:18px;
margin-bottom:20px;
border:1px solid rgba(255,255,255,0.3);
box-shadow:0 8px 20px rgba(0,0,0,0.15);
text-align:center;
}


.share-buttons{
display:flex;
flex-wrap:wrap;
gap:8px;
justify-content:center;
}


.share-btn{
padding:8px 14px;
border-radius:30px;
border:none;
color:white;
font-size:13px;
cursor:pointer;
transition:all .3s ease;
}


.share-btn:hover{
transform:translateY(-3px) scale(1.05);
box-shadow:0 6px 14px rgba(0,0,0,0.25);
}


.copy{background:#444;}
.whatsapp{background:#25D366;}
.facebook{background:#1877F2;}
.twitter{background:#000;}


</style>

@endsection
```
