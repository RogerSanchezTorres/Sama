<div id="navegador">
    <div class="menu-icon" id="menu-icon">
        &#9776;
    </div>
    <ul class="nav" id="nav">
        <span id="close-icon" class="close-icon">&times;</span>
        @foreach(\App\Models\MainCategory::all() as $mainCategory)
        <li class="main-category">
            <a href="{{ route('products.showByMainCategory', ['mainCategoryId' => $mainCategory->id]) }}" class="titulo-desplegable">
                {{ $mainCategory->nombre }}
            </a>
            <ul class="subcategories">
                @foreach($mainCategory->categories as $category)
                <li>
                    <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $category->slug]) }}">
                        {{ $category->nombre }}
                    </a>
                    <ul class="subcategories-list">
                        @foreach($category->subcategories as $subcategory)
                        <li>
                            <a href="{{ route('products.showProductsBySubcategory', ['subcategorySlug' => $subcategory->slug]) }}">
                                {{ $subcategory->nombre }}
                            </a>
                            <ul class="subsubcategories-list">
                                @foreach($subcategory->subsubcategories as $subsubcategory)
                                <li>
                                    <a href="{{ route('products.showProductsBySubsubcategory', ['subsubcategorySlug' => $subsubcategory->slug]) }}">
                                        {{ $subsubcategory->nombre }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
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
        display: flex;
        flex-direction: row;
        justify-content: center;
        list-style-type: none;
        padding: 0;
        margin: 0;
        gap: 20px;
        margin-top: 30px;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
    }

    .main-category {
        text-align: center;
    }

    .main-category a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
    }

    .main-category:hover a {
        color: #ffc106;
    }

    .main-category:hover {
        background-color: black;
    }

    .subcategories {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: black;
        min-width: 160px;
        padding: 10px;
        border: 1px solid #ddd;
        width: 72%;
        margin-left: 250px;
    }

    .subcategories-list {
        display: none;
        position: fixed;
        background-color: black;
        left: 0;
        min-width: 160px;
        padding: 10px;
        width: 72%;
        margin-left: 251px;
    }

    .subcategories li {
        display: inline-block;
        margin-top: 5px;
    }

    .close-icon {
        display: none;
    }

    @media only screen and (max-width: 800px) {
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
    document.getElementById('menu-icon').addEventListener('click', function() {
        document.getElementById('nav').classList.add('active');
    });

    document.getElementById('close-icon').addEventListener('click', function() {
        document.getElementById('nav').classList.remove('active');
    });

    // Ensure submenus toggle correctly on mobile
    const mainItems = document.querySelectorAll('.nav > li');
    mainItems.forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                this.classList.toggle('active');
            }
        });
    });
</script>

<!--<script>
    // JavaScript para el menú desplegable en dispositivos móviles
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.getElementById('menu-icon');
        const nav = document.getElementById('nav');

        menuIcon.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
    });
</script>-->