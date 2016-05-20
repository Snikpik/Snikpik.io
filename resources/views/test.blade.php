<h1>{{ $webpage->title }}</h1>
<p>{{ $webpage->description }}</p>
<p>{{ var_dump($webpage->image) }}</p>
<img src="{{ $webpage->image }}" alt="{{ $webpage->title }}">