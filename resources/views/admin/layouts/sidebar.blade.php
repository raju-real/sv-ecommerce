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
                <i class="bx bx-list-check"></i>
                <span>Attributes</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('admin.categories.index') }}">Category</a></li>
                <li><a href="{{ route('admin.subcategories.index') }}">Sub Category</a></li>
                <li><a href="{{ route('admin.sub-subcategories.index') }}">Sub Subcategory</a></li>
                <li><a href="{{ route('admin.sizes.index') }}">Size</a></li>
                <li><a href="{{ route('admin.colors.index') }}">Color</a></li>
                <li><a href="{{ route('admin.units.index') }}">Unit</a></li>
            </ul>
        </li>
    </ul>
</div>
