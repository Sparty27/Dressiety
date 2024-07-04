<div class="w-full bg-base-300 flex justify-center">
    <div class="navbar max-w-screen-2xl">
        <div class="flex-none lg:hidden">
            <label for="my-drawer-" aria-label="open sidebar" class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </label>
        </div>
        <div class="flex-1 px-2 mx-2">
            <a href="/shop" class="cursor-pointer">Pet project</a>
        </div>
        <div class="flex-none lg:block">
            <ul class="menu menu-horizontal">
                <!-- Navbar menu content here -->
                <li>
                    @livewire('basket-widget')
                </li>
            </ul>
        </div>
    </div>
</div>
