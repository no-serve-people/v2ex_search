@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default list-panel search-results">
                <div class="panel-heading">
                    <h3 class="panel-title ">
                        <i class="fa fa-search"></i>"人民日报"共有“<span
                                class="highlight">{{ $posts->total() }}</span>” 篇文章，按时间排序,
                    </h3>
                </div>

                <div class="panel-body ">
                    @foreach($posts as $post)
                        <div class="result">
                            <h2 class="title">
                                <a href="{{ $post->url }}" target="_blank">
                                    @if (isset($post->highlight['title']))
                                        @foreach ($post->highlight['title'] as $item)
                                            {!! $item !!}
                                        @endforeach
                                    @else
                                        {{ $post->title }}
                                    @endif
                                </a>
                            </h2>

                            <div class="info">
                                <span class="label label-primary">公众号</span>
                                <span class="label label-success">{{ $post->wxname}}</span>
                                <span class="label label-default">作者：{{ $post->author}}</span>
                                <span class="label label-default">{{ $post->post_date}}</span>
                            </div>

                            <div class="desc">
                                @if (isset($post->highlight['content']))
                                    @foreach ($post->highlight['content'] as $item)
                                        ......{!! $item !!}......
                                    @endforeach
                                @else
                                    {{ mb_substr($post->content, 0, 60) }}......
                                @endif
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>


@endsection