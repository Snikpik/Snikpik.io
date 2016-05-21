@extends('spark::layouts.app')

@section('content')
    <section class="hero container">
        <preview inline-template>
            <form action="#" method="POST" @submit.prevent="preview">
                <div class="row">
                    <div class="col-md-6 col-md-push-3">
                        <div class="input-group input-group-lg">
                            <input type="url" name="url" class="form-control" placeholder="http://github.com"
                                   v-model="url" autofocus>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Preview!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="webpage">
                    <div class="col-md-6 col-md-push-3">
                        <div class="media">
                            <div class="media-left" v-if="webpage.type === 'link' && webpage.main_image">
                                <a href="#">
                                    <img class="media-object" :src="webpage.main_image" :alt="webpage.title" class=img-responsive>
                                </a>
                            </div>
                            <div class="media-body" @click="follow">
                                <div v-if="webpage.type === 'rich'" v-html="webpage.embed.data.code"
                                     class="embed-responsive embed-responsive-16by9"></div>
                                <div v-if="webpage.type === 'video'" v-html="webpage.embed.data.code"
                                     class="embed-responsive embed-responsive-16by9"></div>
                                <h4 class="media-heading">@{{ webpage.title }}</h4>
                                <p>@{{ webpage.description }}</p>
                                <p class="media-provider">
                                    <img :src="webpage.provider.icon" :alt="webpage.provider.name">
                                    <small>From&nbsp;<a :href="webpage.provider.url">@{{ webpage.provider.name }}</a></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </form>
        </preview>
    </section>
@endsection