<div id="navegador">
    <div class="menu-icon" id="menu-icon">
        &#9776;
    </div>
    <ul class="nav" id="nav">
        <span id="close-icon" class="close-icon">&times;</span>
        @foreach(\App\Models\MainCategory::all() as $mainCategory)
        <li>
            <a href="{{ route('products.showByMainCategory', ['mainCategoryId' => $mainCategory->id]) }}" class="titulo-desplegable">{{ $mainCategory->nombre }}</a>
        </li>
        @endforeach
    </ul>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.getElementById('menu-icon');
        const nav = document.getElementById('nav');
        const closeIcon = document.getElementById('close-icon');

        menuIcon.addEventListener('click', function() {
            nav.classList.toggle('active');
            document.body.classList.toggle('nav-active');
        });

        closeIcon.addEventListener('click', function() {
            nav.classList.remove('active');
            document.body.classList.remove('nav-active');
        });
    });
</script>