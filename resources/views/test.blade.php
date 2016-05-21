<h1>{{ $webpage->title }}</h1>
<h2>{{ $webpage->type }}</h2>
<p>{{ $webpage->description }}</p>
<img src="{{ $webpage->image }}" alt="{{ $webpage->title }}">
<img src="{{ $webpage->providerIcon }}" alt="">
<pre>{{ var_dump($webpage) }}</pre>