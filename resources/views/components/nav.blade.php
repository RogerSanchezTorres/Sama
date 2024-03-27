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

<style>
    #navegador {
        position: relative;
    }

    .menu-icon {
        display: none;
    }

    .nav {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .main-category {
        position: relative;
        display: inline-block;
        margin-right: 20px;
    }

    .main-category a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        transition: color 0.3s;
    }

    .main-category:hover a {
        color: black;
        
    }

    .titulo-desplegable:hover{
        background-color: #f9f9f9;
        border: 1px solid #ddd;
    }

    .subcategories {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #f9f9f9;
        min-width: 160px;
        padding: 10px;
        border: 1px solid #ddd;
        z-index: 1;
        width: 1020px;
    }

    .main-category:nth-child(3) .subcategories{
        margin-left: -170px;
        width: 1020px;
    }

    .main-category:nth-child(4) .subcategories{
        margin-left: -292px;
        width: 1020px;
    }

    .main-category:nth-child(5) .subcategories{
        margin-left: -432px;
        width: 1020px;
    }

    .main-category:nth-child(6) .subcategories{
        margin-left: -618px;
        width: 1020px;
    }

    .main-category:nth-child(7) .subcategories{
        margin-left: -758px;
        width: 1020px;
    }

    .main-category:nth-child(8) .subcategories{
        margin-left: -928px;
        width: 1020px;
    }

    .subcategories li {
        display: inline-block;
        margin-top: 5px;
    }

    .subcategories li a {
        text-decoration: none;
        color: #333;
        transition: color 0.3s;
    }

    .subcategories li a:hover {
        color: #ffc106;
    }

    .nav {
        list-style-type: none;
        padding: 0;
        margin: 0;
        margin-top: 30px;
        margin-bottom: 30px;
        text-align: center;
    }

    .close-icon {
        display: none;
    }

    @media only screen and (max-width: 768px) {
        .subcategories {
        display: none;
    }

    .subcategories li {
        display: none;
    }

    .subcategories li a {
        display: none;
    }

    .subcategories li a:hover {
        display: none;
    }
    }
</style>

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