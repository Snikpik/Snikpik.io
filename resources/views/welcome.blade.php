@extends('spark::layouts.app')

@section('content')
    <section class="hero">
        <header>
            <h1>Website previews made easy.</h1>
            <p class="lead">See it in action:</p>
            <preview class="preview" inline-template>
                <form action="#" method="POST" @submit.prevent="preview">
                    <div class="row">
                        <div class="col-md-8 col-md-push-2">
                            <div class="input-group input-group-lg">
                                <input type="url" name="url" class="form-control"
                                       placeholder="http://github.com"
                                       @keyup="validateUrl"
                                       v-model="url" required autofocus>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"
                                        data-loading-text="Fetching preview...">Preview now!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="webpage">
                        <div class="col-md-8 col-md-push-2">
                            <div class="media">
                                <i class="fa fa-times pull-right" @click="closePreview"></i>
                                <div class="media-left" v-if="webpage.type === 'link' && webpage.main_image">
                                    <a :href="webpage.url" :title="webpage.title" target="_blank">
                                        <img class="media-object" :src="webpage.main_image" :alt="webpage.title" class=img-responsive>
                                    </a>
                                </div>
                                <div class="media-body">
                                <div v-if="webpage.type === 'rich'" v-html="webpage.embed.data.code"
                                     class="embed-responsive embed-responsive-16by9"></div>
                                <div v-if="webpage.type === 'video'" v-html="webpage.embed.data.code"
                                     class="embed-responsive embed-responsive-16by9"></div>
                                <h4 class="media-heading">
                                    <a :href="webpage.url" :title="webpage.title" target="_blank">
                                        @{{ webpage.title }}
                                    </a>
                                </h4>
                                <p>@{{ webpage.description }}</p>
                                <p class="media-provider">
                                    <img :src="webpage.provider.icon" :alt="webpage.provider.name">
                                    <small>From&nbsp;<a :href="webpage.provider.url" target="_blank">@{{ webpage.provider.name }}</a></small>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </form>
            </preview>
        </header>
    </section>
    <section class="how-it-works">
        <h2>How does it work?</h2>
        <section class="make-a-request">
            <div class="col-md-6">
                <h3>1. Make a request</h3>
                <p>
                    To obtain a website's information, simply make a request to
                    <code>{{ route('api.snikpik', ['url' => 'YourURL']) }}</code> using the language
                    of your choice:
                </p>
            </div>
            <div class="col-md-6">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#curl" aria-controls="curl" role="tab" data-toggle="tab">cURL</a></li>
                    <li role="presentation"><a href="#php" aria-controls="php" role="tab" data-toggle="tab">PHP (using Guzzle)</a></li>
                    <li role="presentation"><a href="#javascript" aria-controls="javascript" role="tab" data-toggle="tab">JavaScript (using jQuery)</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="curl">
                        <pre><code class="bash">curl -H "Authorization: Bearer InsertYourAPITokenHere" \
-X GET "{{ route('api.snikpik', ['url' => 'https://www.youtube.com/watch?v=fpbOEoRrHyU']) }}"</code></pre>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="php">
                        <pre><code class="php">$client = new GuzzleHttp\Client();

// Make a request to Snikpik.io
$response = $client->get('http://{{ env('API_DOMAIN') }}/v1/snikpik', [
    'headers' => [
        'Authorization' => 'Bearer YourAPITokenHere'
    ],
    'query' => [
        'url' => 'https://www.youtube.com/watch?v=fpbOEoRrHyU'
    ]
]);</code></pre>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="javascript">
                        <pre><code>var settings = {
    "async": true,
    "crossDomain": true,
    "url": "{{ route('api.snikpik', ['url' => 'https://www.youtube.com/watch?v=fpbOEoRrHyU']) }}",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization":"Bearer YourAPITokenHere"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section class="using-the-response">
            <div class="col-md-6">
                <h3>2. Consume the JSON response</h3>
                <p>
                    Consume the JSON response however your want, for example, to create a preview like this:
                </p>
            </div>
            <div class="col-md-6">
                <div class="media">
                    <div class="media-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="480" height="270" src="https://www.youtube.com/embed/fpbOEoRrHyU?feature=oembed" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <h4 class="media-heading">
                            <a href="https://www.youtube.com/watch?v=fpbOEoRrHyU" title="Last Week Tonight with John Oliver: Net Neutrality (HBO)">
                                Last Week Tonight with John Oliver: Net Neutrality (HBO)
                            </a>
                        </h4>
                        <p>Cable companies are trying to create an unequal playing field for internet speeds, but they're doing it so boringly that most news outlets aren't covering it...</p>
                        <footer class="media-provider">
                            <img src="https://www.youtube.com/favicon.ico" alt="YouTube">
                            <small>From&nbsp;<a href="https://www.youtube.com/">YouTube</a></small>
                            <span class="pull-right">
                                Published
                                <time datetime="2014-06-01">{{ \Carbon\Carbon::createFromFormat('Y-m-d', '2014-06-01')->diffForHumans() }}</time>
                            </span>
                        </footer>
                    </div>
                    </p>
                </div>
            </div>
        </section>
    </section>
    <section class="pricing">
        <hr>
        <h2>Plans & Pricing</h2>
        <p class="lead">No credit card required!</p>
        <ul class="plans">
        @foreach(Spark::plans() as $plan)
            <li class="plan">
                <div class="details">
                    <h4>{{ $plan->name }}</h4>
                    <h3>
                        @if($plan->price === 0)
                            FREE
                        @else
                            ${{ $plan->price }}
                        @endif
                    </h3>
                    <hr>
                    <a href="{{ url('/register') }}" class="btn btn-lg btn-primary btn-block">
                        Get started
                    </a>
                    <hr>
                    <div class="features">
                        <h5>Features:</h5>
                        <ul>
                            <li>
                                @if($plan->attribute('max-requests') > 0)
                                    <strong>{{ number_format($plan->attribute('max-requests'), 0, '.', ' ') }}</strong>
                                    requests/month
                                @else
                                    <strong>Unlimited</strong> requests/month
                                @endif
                            </li>
                            <li>
                                @if($plan->attribute('rate-limiting') > 0)
                                    <strong>{{ number_format($plan->attribute('rate-limiting'), 0, '.', ' ') }}</strong>
                                    requests/minute
                                @else
                                    <strong>Unlimited</strong> requests/minute
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    </section>
    <footer>
        <div class="container text-center">
            <ul class="list-unstyled list-inline">
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            </ul>
            <p>
                <small>Copyright {{ date('Y') }} Snikpik.io. All rights reserved.</small>
            </p>
        </div>
    </footer>
@endsection