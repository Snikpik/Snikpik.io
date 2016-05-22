@extends('spark::layouts.app')

@section('content')
<dashboard :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Requests history</div>

                    <div class="panel-body">
                        <div class="dropdown">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td>Origin</td>
                                        <td>URL</td>
                                        <td>Application</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ date('d/m/Y H:i:s') }}</td>
                                    <td>http://snikpik.dev</td>
                                    <td>http://www.google.com</td>
                                    <td>Snikpik</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dashboard>
@endsection
