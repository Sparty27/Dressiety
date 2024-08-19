<div class="text-sm breadcrumbs mt-5 mx-4 px-4 bg-white rounded-2xl shadow-lg">
    <ul>
        @foreach($links as $link)
            <li>
                <a href="{{$link['url']}}">{{$link['name']}}</a>
            </li>
        @endforeach
    </ul>
</div>
