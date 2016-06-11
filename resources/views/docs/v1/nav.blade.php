<!-- Tabs -->
<div class="col-md-4">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Navigation
        </div>

        <div class="panel-body">
            <div class="spark-settings-tabs">
                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                    <li role="presentation" @if(Request::is('docs/1.0')) class="active" @endif>
                        <a href="/docs/1.0">
                            Documentation
                        </a>
                    </li>

                    <li role="presentation" @if(Request::is('docs/1.0/faq*')) class="active" @endif>
                        <a href="/docs/1.0/faq">
                            FAQ
                        </a>
                    </li>

                    <li role="presentation" @if(Request::is('docs/1.0/release-notes*')) class="active" @endif>
                        <a href="/docs/1.0/release-notes">
                            Release Notes
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>