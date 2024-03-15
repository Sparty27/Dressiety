<div class="drawer-side z-40">
    <label for="drawer" class="drawer-overlay"></label>
    <aside class="bg-base-100 w-80 h-full">
        <div
            class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex ">
            <a href="/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2">
                <div
                    class="font-title text-primary inline-flex text-lg transition-all duration-200 md:text-3xl">
                    <span class="uppercase">ABOBA</span>
                </div>
            </a>
        </div>
        <div class="h-4"></div>
        <ul class="menu menu-sm lg:menu-md px-4 py-0">

            <li>
                <a href="{{ route('categories.index') }}" class="flex gap-4 {{request()->routeIs('categories.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-home-8-line"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.categories.index') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="flex gap-4 {{request()->routeIs('products.*') ? 'active':''}}">
                    <span class="bg-base-100 text-base-content shadow-lg w-8 h-8 p-2.5 rounded-lg flex items-center">
                        <i class="ri-home-8-line"></i>
                    </span>
                    <span class="flex-1">{{ trans('pages.products.index') }}</span>
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
