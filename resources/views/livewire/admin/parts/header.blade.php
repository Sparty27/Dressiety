<div class="
  sticky top-0 z-30 flex h-16 w-full justify-center bg-opacity-90 backdrop-blur transition-all duration-100
  bg-base-100 text-base-content

">
    <nav class="flex items-center justify-between gap-x-3 px-3 lg:px-6 w-full">
        <div class="flex flex-1 gap-1">
            <span class="tooltip tooltip-bottom before:text-xs lg:hidden before:content-[attr(data-tip)]" data-tip="Menu">
                <label for="drawer" class="btn btn-square btn-ghost drawer-button">
                    <i class="ri-menu-line"></i>
                </label>
            </span>
            <h1 class="card-title mr-auto">{{ trans('pages.'.request()->route()->getName()) ?? 'index' }}</h1>
        </div>

        <div class="flex-0">
            {{--            <div class="dropdown dropdown-end">--}}
            {{--                <span tabindex="0" class="avatar cursor-pointer  btn  btn-ghost font-bold">User Name</span>--}}
            {{--                <ul tabindex="0"--}}
            {{--                    class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">--}}
            {{--                    <li><a href="{{ route('logout') }}">Logout</a></li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
            <div class="dropdown dropdown-end">
                <span tabindex="0" class="avatar cursor-pointer  btn  btn-ghost font-bold">{{ auth()->user()->name ?? '' }}</span>
                <ul tabindex="0"
                    class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <li><button type="submit">Logout</button></li>
                    </form>
                </ul>
            </div>
        </div>
    </nav>
</div>
