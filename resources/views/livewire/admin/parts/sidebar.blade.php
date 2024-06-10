<div class="drawer-side z-40 shadow-lg">
    <label for="drawer" class="drawer-overlay"></label>
    <aside class="bg-base-100 w-80 h-full">
        <div
            class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex ">
            <a href="/admin/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2">
                <div
                    class="font-title text-primary inline-flex text-lg transition-all duration-200 md:text-3xl">
                    <span class="uppercase">ABOBA</span>
                </div>
            </a>
        </div>
        <div class="h-4"></div>
        <ul class="menu menu-sm lg:menu-md px-4 py-0">
            <li>
                <a href="{{ route('admin.orders.index') }}" class="flex gap-4 {{request()->routeIs('admin.orders.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-shopping-cart-2-line"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.admin.orders.index') }}</span>
                </a>
            </li>
            <li class="mt-3">
                <a href="{{ route('admin.products.index') }}" class="flex gap-4 {{request()->routeIs('admin.products.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-archive-line"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.admin.products.index') }}</span>
                </a>
            </li>
            <li class="mt-3">
                <a href="{{ route('admin.categories.index') }}" class="flex gap-4 {{request()->routeIs('admin.categories.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-list-check"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.admin.categories.index') }}</span>
                </a>
            </li>
            <li class="mt-3">
                <a href="{{ route('admin.tags.index') }}" class="flex gap-4 {{request()->routeIs('admin.tags.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-bookmark-line"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.admin.tags.index') }}</span>
                </a>
            </li>
            <li class="mt-3">
                <a href="{{ route('admin.pages.index') }}" class="flex gap-4 {{request()->routeIs('admin.pages.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-pages-line"></i>
                    </span>
                    <span class="flex-1">
                        {{ trans('pages.admin.pages.index') }}
                    </span>
                </a>
            </li>
            <li class="mt-3">
                <a href="{{ route('admin.seo.index') }}" class="flex gap-4 {{request()->routeIs('admin.seo.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-[9px] rounded-lg flex items-center">
                        <img src="{{ asset('images/icons/seo-fill.svg') }}" alt="SEO">
                    </span>
                    <span class="flex-1">{{ trans('pages.admin.seo.index') }}</span>
                </a>
            </li>
            <li class="mt-3">
                <a href="{{ route('admin.email.index') }}" class="flex gap-4 {{request()->routeIs('admin.email.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-[9px] rounded-lg flex items-center">
                        <i class="ri-mail-line"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.admin.email.index') }}</span>
                </a>
            </li>
            {{--            <li>--}}
            {{--                <a href="https://remixicon.com/" target="_blank" class="flex gap-4">--}}
            {{--                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">--}}
            {{--                        <i class="ri-remixicon-line"></i>--}}
            {{--                    </span>--}}
            {{--                    <span class="flex-1">Icons site</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li>--}}
            {{--                <a href="https://daisyui.com/components/tab/" target="_blank" class="flex gap-4">--}}
            {{--                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">--}}
            {{--                        <i class="ri-brush-4-fill"></i>--}}
            {{--                    </span>--}}
            {{--                    <span class="flex-1">Component</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
    </aside>
</div>
