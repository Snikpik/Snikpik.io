@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('docs.v1.nav')

            <div class="col-md-8 docs-content">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>FAQ</h1>
                        <ul>
                            <li><a href="#cors">Does Snikpik.io supports Cross Origin Resource Sharing?</a></li>
                            <li><a href="#cors-multidomain">What if I want to use preview on multiple domains?</a></li>
                        </ul>
                        <p><a name="cors"></a></p>
                        <h3>Does Snikpik.io supports Cross Origin Resource Sharing?</h3>
                        <p>
                            Snikpik.io API supports Cross Origin Resource Sharing. Simply enter the domain that will be making the requests
                            and Snikpik.io will authorize any requests coming from this domain.
                        </p>
                        <p><a name="cors-multidomain"></a></p>
                        <h3>What if I want to use preview on multiple domains?</h3>
                        <p>
                            When you create a new application on Snikpik.io, you can only specify one domain/subdomain.
                            Snikpik.io does not yet support domain wildcards, but if you need to use preview on a different
                            domain or subdomain, simply create another application for the time being.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop