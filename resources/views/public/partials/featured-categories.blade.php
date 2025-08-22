<div class="container mb-5">
    <h2 class="fw-bold text-center mb-4">Shop by Category</h2>
    <div class="row g-3 justify-content-center">
        @foreach($categories as $cat)
        <div class="col-4 col-sm-3 col-md-2">
            <div class="category-card text-center p-2 h-100 position-relative">
                <div class="category-shape position-relative overflow-hidden rounded-circle mx-auto" style="width:100px; height:100px;">
                    <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}" class="img-fluid w-100 h-100" style="object-fit:cover;">
                    <!-- Overlay -->
                    <div class="category-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-circle">
                        <a href="{{ url('/categories/'.$cat->id) }}" class="text-white fs-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                <h6 class="fw-semibold mt-2 text-truncate">{{ $cat->name }}</h6>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.category-card {
    transition: transform 0.2s;
}
.category-card:hover {
    transform: translateY(-5px);
}
.category-overlay {
    background: rgba(0, 0, 0, 0.25);
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 10;
}
.category-card:hover .category-overlay {
    opacity: 1;
}
</style>

<!-- Include Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
