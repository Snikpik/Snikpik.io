@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('documentation.v1.nav')

            <div class="col-md-8 docs-content">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>FAQ</h1>
                        <ul>
                            <li><a href="#billing-providers">Which billing providers does Spark support?</a></li>
                            <li><a href="#billing-intervals">Which billing intervals does Spark support?</a></li>
                            <li><a href="#one-off">Does Spark support one-off charges?</a></li>
                            <li><a href="#user-and-team-billing">Does Spark support user and team subscriptions at the same time?</a></li>
                            <li><a href="#limiting-resources">Does Spark support limiting the resources for a given plan?</a></li>
                            <li><a href="#vat">Does Spark support collecting European VAT?</a></li>
                            <li><a href="#existing">Can Spark be integrated into an existing application?</a></li>
                        </ul>
                        <p><a name="billing-providers"></a></p>
                        <h3>Which billing providers does Spark support?</h3>
                        <p>Spark supports Stripe and Braintree.</p>
                        <p><a name="billing-intervals"></a></p>
                        <h3>Which billing intervals does Spark support?</h3>
                        <p>Spark supports monthly and yearly billing plans, as well as one-off charges.</p>
                        <p><a name="one-off"></a></p>
                        <h3>Does Spark support one-off charges?</h3>
                        <p>Yes, Spark supports making one-off charges using <a href="https://laravel.com/docs/billing#single-charges">Cashier's <code>invoiceFor</code> method</a>.</p>
                        <p><a name="user-and-team-billing"></a></p>
                        <h3>Does Spark support user and team subscriptions at the same time?</h3>
                        <p>Yes, you can have both user and team plans at the same time.</p>
                        <p><a name="limiting-resources"></a></p>
                        <h3>Does Spark support limiting the resources for a given plan?</h3>
                        <p>Yes, you can limit <a href="/docs/1.0/billing#configuring-team-billing-plans">team plans</a> by team members. You can also limit plans by <a href="/docs/1.0/billing#constraining-access-to-plans">your own arbitrary conditions</a>.</p>
                        <p><a name="vat"></a></p>
                        <h3>Does Spark support collecting European VAT?</h3>
                        <p>Yes, Spark <a href="/docs/1.0/european-vat">supports collecting European VAT</a>.</p>
                        <p><a name="existing"></a></p>
                        <h3>Can Spark be integrated into an existing application?</h3>
                        <p>Spark is not designed to be integrated into existing applications. Spark is designed for new applications.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop