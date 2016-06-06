@extends('spark::layouts.app')

@section('content')
<dashboard :user="user" :applications="{{ auth()->user()->tokens()->get()->toJson() }}" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" v-if="applications && applications.length > 0">
                    <div class="panel-heading --with-options">
                        <h4 class="panel-title">
                            Requests history
                        </h4>
                        <div class="options">
                            <button class="btn btn-link btn-xs" @click="reloadRequests">
                            <i class="fa fa-refresh"></i>&nbsp;Reload
                            </button>
                            <div class="btn-group" v-if="applications.length > 1">
                                <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Show only <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" @click="showOnly()">All</a></li>
                                    <li class="divider"></li>
                                    <li v-for="application in applications">
                                        <a href="#" @click="showOnly(application.name)">
                                            @{{ application.name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ url('/settings#/applications') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>&nbsp;Create a new application
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive" v-if="requests.data && requests.data.length > 0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Application</th>
                                        <th>IP</th>
                                        <th>Origin</th>
                                        <th>URL</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr v-for="request in requests.data | showOnly filter">
                                    <td>@{{ request.token.name }}</td>
                                    <td>@{{ request.from_ip }}</td>
                                    <td v-show="request.from_origin">
                                        <a :href="request.from_origin">
                                            @{{ request.from_origin }}
                                        </a>
                                    </td>
                                    <td v-else>N/A</td>
                                    <td>
                                        <a :href="request.url">
                                            @{{ request.url }}
                                        </a>
                                    </td>
                                    <td>@{{ request.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pager">
                                    <li class="previous" v-show="requests.prev_page_url">
                                        <a href="#" @click="showPage(requests.prev_page_url)"><span aria-hidden="true">&larr;</span> Next</a>
                                    </li>
                                    <li class="next" v-show="requests.next_page_url">
                                        <a href="#" @click="showPage(requests.next_page_url)">Previous <span aria-hidden="true">&rarr;</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div v-else>
                            <p class="text-center">
                                <i class="fa fa-spin fa-spinner fa-lg text-primary"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-panel-default" v-else>
                    <div class="panel-body text-center">
                        <p class="lead text-primary">
                            <i class="fa fa-cubes fa-5x"></i>
                        </p>
                        <p class="lead">
                            Welcome to Snikpik.io!
                        </p>
                        <p>
                            <a href="{{ url('/settings#/applications') }}" class="btn btn-primary btn-lg">
                                Create your first application
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dashboard>
@endsection
