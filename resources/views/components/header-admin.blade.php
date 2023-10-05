<div class="menu">
    <div class="rutas">
        <div class="dashboard">
            <a href="{{route('admin-view-products')}}" aria-label="View Products">Ver Productos</a>
        </div>
        <div class="view-users">
            <a href="{{ route('admin-view-users') }}" aria-label="View users">Ver Usuarios</a>
        </div>
        <div class="add-products">
            <a href="{{ route('admin-agregar-producto') }}" aria-label="Add Products">Añadir Productos</a>
        </div>
        <div class="add-user">
            <a href="{{ route('admin-create-user') }}" aria-label="Add user">Añadir Usuarios</a>
        </div>
        <div class="view-orders">
            <a href="#" aria-label="View orders">Ver Pedidos</a>
        </div>
    </div>
    <div class="logout">
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" aria-label="Logout">Cerrar Sesión</button>
        </form>
    </div>
</div>
