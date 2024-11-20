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
                <li><a href="{{ route('admin.products.index') }}"><i class="bx bx-chevron-right"></i> Product List</a>
                </li>
                <li><a href="{{ route('admin.products.create') }}"><i class="bx bx-chevron-right"></i> Add Product</a>
                </li>
            </ul>
        </li>
        <li class="{{ isMainMenuActive('categories,subcategories,sub-subcategories,brands,sizes,colors,units,tags') }}">
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-list-check"></i>
                <span>Attributes</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="{{ isSubMenuActive('categories') }}">
                        <i class="bx bx-chevron-right"></i> Category
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.subcategories.index') }}" class="{{ isSubMenuActive('subcategories') }}">
                        <i class="bx bx-chevron-right"></i> Sub Category
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sub-subcategories.index') }}" class="{{ isSubMenuActive('sub-subcategories') }}">
                        <i class="bx bx-chevron-right"></i> Sub Subcategory
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.brands.index') }}" class="{{ isSubMenuActive('brands') }}">
                        <i class="bx bx-chevron-right"></i> Brand
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sizes.index') }}" class="{{ isSubMenuActive('sizes') }}">
                        <i class="bx bx-chevron-right"></i> Size
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.colors.index') }}" class="{{ isSubMenuActive('colors') }}">
                        <i class="bx bx-chevron-right"></i> Color
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.units.index') }}" class="{{ isSubMenuActive('units') }}">
                        <i class="bx bx-chevron-right"></i> Unit
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tags.index') }}" class="{{ isSubMenuActive('tags') }}">
                        <i class="bx bx-chevron-right"></i> Tag
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-cog"></i>
                <span>Settings</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('admin.site-settings') }}"><i class="bx bx-chevron-right"></i> Site Settings</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
