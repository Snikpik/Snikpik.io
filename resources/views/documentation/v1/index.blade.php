@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('documentation.v1.nav')

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
                            <img src="http://placehold.it/600x300?text=Dashboard+Screenshot" alt="Dashboard First Time" class="img-responsive thumbnail center-block">
                        </section>

                        <!-- Authentication -->
                        <section id="authentication">
                            <h2>Authentication</h2>
                            <p>...</p>
                        </section>

                        <!-- Request URL preview -->
                        <section id="request-url-preview">
                            <h2>Request URL preview</h2>
                            <p>...</p>
                        </section>

                        <!-- Example -->
                        <section id="examples">
                            <h2>Examples</h2>
                            <p>...</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop