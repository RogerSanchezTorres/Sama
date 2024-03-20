<div id="navegador">
    <div class="menu-icon" id="menu-icon">
        &#9776;
    </div>
    <ul class="nav" id="nav">
        <span id="close-icon" class="close-icon">&times;</span>
        @foreach(\App\Models\MainCategory::all() as $mainCategory)
        <li class="main-category">
            <a href="{{ route('products.showByMainCategory', ['mainCategoryId' => $mainCategory->id]) }}" class="titulo-desplegable">{{ $mainCategory->nombre }}</a>
            <ul class="subcategories">
                @foreach($mainCategory->categories as $category)
                <li>
                    <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $category->slug]) }}">
                        {{ $category->nombre }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>

</div>


<script>
    // JavaScript para el menú desplegable en dispositivos móviles
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.getElementById('menu-icon');
        const nav = document.getElementById('nav');

        menuIcon.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
    });
</script>