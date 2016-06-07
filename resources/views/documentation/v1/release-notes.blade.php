@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('documentation.v1.nav')

            <div class="col-md-8 docs-content">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Release Notes</h1>
                        <ul>
                            <li><a href="#1.0.0">1.0.0</a></li>
                        </ul>
                        <h2>1.0.0</h2>
                        <p>The initial release of Snikpik.io. Snikpik provides an easy way for developers to generate link previews (link unfurling).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop