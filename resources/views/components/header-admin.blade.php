<div class="menu">

    <div class="top-bar">
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" aria-label="Logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <div class="rutas">
        <div class="dashboard">
            <a href="{{ route('admin-view-products') }}" aria-label="View Products">Ver Productos</a>
        </div>
        <div class="view-users">
            <a href="{{ route('admin-view-users') }}" aria-label="View users">Ver Usuarios</a>
        </div>
        <div class="add-products">
            <a href="{{ route('admin-agregar-producto') }}" aria-label="Añadir Productos">Añadir Productos</a>
        </div>
        <div class="add-user">
            <a href="{{ route('admin-create-user') }}" aria-label="Añadir Usuarios">Añadir Usuarios</a>
        </div>
        <div class="excel">
            <a href="{{ route('showImportForm') }}" aria-label="Subir Excel">Subir archivo</a>
        </div>
        <div class="view-orders">
            <a href="{{ route('admin.view-orders') }}" aria-label="Ver Pedidos">Ver Pedidos</a>
        </div>
        <div class="registros">
            <a href="{{ route('admin.pending-users') }}" aria-label="Ver Registros">Ver Registros</a>
        </div>
        <div class="add-category">
            <a href="{{ route('admin-create-maincategory') }}" aria-label="Añadir Categoria Principal">Añadir Categoría 1</a>
        </div>
        <div class="add-category">
            <a href="{{ route('admin.create_category') }}" aria-label="Añadir Categoria Secundaria">Añadir Categoría 2</a>
        </div>
        <div class="add-category">
            <a href="{{ route('admin.create-subcategories') }}" aria-label="Añadir Subcategoria Principal">Añadir Subcategoría 1</a>
        </div>
        <div class="add-category">
            <a href="{{ route('admin.createSubSubcategory') }}" aria-label="Añadir Subcategoria Secundaria">Añadir Subcategoría 2</a>
        </div>
        <div class="delete-category">
            <a href="{{ route('admin.categories.index') }}" aria-label="Add Category">Borrar Categoría</a>
        </div>
        <div class="upload-content">
            <a href="{{ route('admin.upload') }}" aria-label="Subir Archivos">Archivos Usuarios</a>
        </div>
        <div class="brand-images">
            <a href="{{ route('admin.brand-image-upload') }}" aria-label="Subir Imágenes de Marcas">Marcas</a>
        </div>
        <div class="manage-apartados">
            <a href="{{ route('apartados.index') }}" aria-label="Gestionar Apartados">Apartados</a>
        </div>
    </div>
</div>

<style>
    .menu {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .top-bar {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px 30px;
        gap: 20px;
    }

    .logout {
        position: relative;
        top: -165px;
        right: 60px;
        z-index: 1000;
    }

    .logout button {
        padding: 7px 15px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        background-color: rgb(24, 24, 24);
        color: white;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .logout button:hover {
        background-color: rgb(61, 61, 61);
    }

    .rutas {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        max-width: 90vw;
        margin-top: -70px;
    }

    .rutas>div {
        margin-right: 10px;
        margin-top: 10px;
    }

    .rutas a {
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
        background-color: #f0f0f0;
        transition: background-color 0.3s ease;
    }

    .rutas a:hover {
        background-color: #5f5f5f;
        color: #ffc106;
    }
</style>