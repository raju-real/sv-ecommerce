<div id="sidebar-menu">
    <ul class="metismenu list-unstyled" id="side-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxl-product-hunt"></i>
                <span>Products</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('admin.products.index') }}"><i class="bx bx-chevron-right"></i> Product List</a></li>
                <li><a href="{{ route('admin.products.create') }}"><i class="bx bx-chevron-right"></i> Add Product</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-list-check"></i>
                <span>Attributes</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('admin.categories.index') }}"><i class="bx bx-chevron-right"></i> Category</a></li>
                <li><a href="{{ route('admin.subcategories.index') }}"><i class="bx bx-chevron-right"></i> Sub Category</a></li>
                <li><a href="{{ route('admin.sub-subcategories.index') }}"><i class="bx bx-chevron-right"></i> Sub Subcategory</a></li>
                <li><a href="{{ route('admin.brands.index') }}"><i class="bx bx-chevron-right"></i> Brand</a></li>
                <li><a href="{{ route('admin.sizes.index') }}"><i class="bx bx-chevron-right"></i> Size</a></li>
                <li><a href="{{ route('admin.colors.index') }}"><i class="bx bx-chevron-right"></i> Color</a></li>
                <li><a href="{{ route('admin.units.index') }}"><i class="bx bx-chevron-right"></i> Unit</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-cog"></i>
                <span>Settings</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('admin.site-settings') }}"><i class="bx bx-chevron-right"></i> Site Settings</a></li>
            </ul>
        </li>
    </ul>
</div>
