<!-- Displaying the current category -->
<li>
    <a href=" {{ route('site.category.index', $category->slug) }}">
        {{ $category->category_name}}
    </a>

    <!-- If category has children -->
    @if (count($category->children) > 0)

        <!-- Create a nested unordered list -->
        <ul class="sub-menu">

            <!-- Loop through this category's children -->
            @foreach ($category->children as $sub)

                <!-- Call this blade file again (recursive) and pass the current subcategory to it -->
                @include('Site.components.subcategories', ['category' => $sub])
        
            @endforeach
        </ul>
    @endif
</li>