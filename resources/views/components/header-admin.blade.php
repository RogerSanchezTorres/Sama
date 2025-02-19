<div class="menu">
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

    </div>
    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" aria-label="Logout">Cerrar Sesión</button>
        </form>
    </div>
</div>