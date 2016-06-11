@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('docs.v1.nav')

            <!-- Content -->
            <div class="col-md-8 docs-content">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h1>Documentation</h1>
                        <p>To be able to make calls to the <a href="https://snikpik.io">Snikpik.io</a> API, you will need to create an application first. Follow the guide.</p>
                        <ul>
                            <li><a href="#create-your-first-application">Create your first application</a></li>
                            <li><a href="#authentication">Authentication</a></li>
                            <li><a href="#request-url-preview">Request URL preview</a></li>
                        </ul>
                        <!-- Create your first application -->
                        <section id="create-your-first-application">
                            <h2>Create your first application</h2>
                            <p>When you first login, you will be prompted to create your first application:</p>
                            <img src="{{ asset('img/docs/create-application.png') }}" alt="Dashboard first time" class="img-responsive thumbnail center-block">
                            <p>To create an application, simply enter a name and the domain of your application, including the <code>http://</code> or <code>https://</code> part.</p>
                            <img src="{{ asset('img/docs/create-application-form.png') }}" alt="Create application form" class="img-responsive thumbnail center-block">
                            <p>You will then receive an application token that you will use to make request to the Snikpik.io API.</p>
                            <blockquote>This is the only time the token will be displayed, so do not lose it!</blockquote>
                            <img src="{{ asset('img/docs/create-application-token.png') }}" alt="Create application token" class="img-responsive thumbnail center-block">
                        </section>

                        <!-- Authentication -->
                        <section id="authentication">
                            <h2>Authentication</h2>
                            <p>
                                There are two ways to authenticate your application to the Snikpik.io API when making a request:
                                <ol>
                                    <li>Attach the token as a query parameter within the URL.</li>
                                    <li>Use it in the <code>Authorization</code> header.</li>
                                </ol>
                            </p>
                            <h3>1. Query String</h3>
                            <p>
                                To authenticate your application using a query parameter, simply pass the token along as a parameter in the URL:
                                <br>
                                <pre><code class="http">https://api.snikpik.io/v1/preview?api_token=USE_YOUR_APPLICATION_TOKEN_HERE&url={{ urlencode('https://www.youtube.com/watch?v=hxUAntt1z2c') }}</code></pre>
                            </p>
                            <h3>2. Headers</h3>
                            <p>
                                To authenticate your application using headers, simply attach the token as a bearer token in the <code>Authorization</code> header:
                                <br>
                                <pre><code class="http">Authorization: Bearer USE_YOUR_APPLICATION_TOKEN_HERE</code></pre>
                            </p>
                        </section>

                        <!-- Request URL preview -->
                        <section id="request-url-preview">
                            <h2>Request URL preview</h2>
                            <p>Making requests for previews to the Snikpik.io API is super-easy, here are a few example using popular languages:</p>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#php" aria-controls="php" role="tab" data-toggle="tab">PHP (using Guzzle)</a></li>
                                <li role="presentation"><a href="#javascript" aria-controls="javascript" role="tab" data-toggle="tab">JavaScript (using jQuery)</a></li>
                                <li role="presentation"><a href="#curl" aria-controls="curl" role="tab" data-toggle="tab">cURL</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="php">
                    <pre><code class="php">$client = new GuzzleHttp\Client();

// Make a request to Snikpik.io
$response = $client->get('http://{{ env('API_DOMAIN') }}/v1/snikpik', [
    'headers' => [
        'Authorization' => 'Bearer USE_YOUR_APPLICATION_TOKEN_HERE'
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
        "authorization":"Bearer USE_YOUR_APPLICATION_TOKEN_HERE"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="curl">
                    <pre><code class="bash">curl -H "Authorization: Bearer USE_YOUR_APPLICATION_TOKEN_HERE" \
-X GET "{{ route('api.snikpik', ['url' => 'https://www.youtube.com/watch?v=fpbOEoRrHyU']) }}"</code></pre>
                                </div>
                            </div>
                        </section>

                        <!-- Example -->
                        <section id="examples">
                            <h2>Cross-Origin</h2>
                            <p>
                                Snikpik.io API supports Cross Origin Resource Sharing. Simply enter the domain that will be making the requests
                                and Snikpik.io will authorize any requests coming from this domain.
                            </p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop