<img src="{{ $src ?? '' }}" alt="{{ $alt ?? 'image' }}" class="{{ $class ?? '' }}" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';"/>
