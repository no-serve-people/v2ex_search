@extends('layouts.main')
@section('content')



    <div class="row">
        <div class="col-md-12">
            <form action="/search">
                <div  class="input-group" >
                    <input type="text" class="form-control h50" id="searchInput" name="query" placeholder="关键字..." value="{{ $q }}" autocomplete="off" HaoyuSug="4C664569809341CAA51AD59CBC052B13">
                    <span class="input-group-btn" ><button class="btn btn-default h50 "  type="submit" type="button" onclick="add_search()"><span
                                    class="glyphicon glyphicon-search"></span></button></span>
                </div>
            </form>
        </div>
    </div>
    @if($q)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default list-panel search-results">
                    <div class="panel-heading">
                        <h3 class="panel-title ">
                            <i class="fa fa-search"></i> 关于 “<span style="color: red" class="highlight"><strong>{{ $q }}</strong></span>” 的搜索结果,
                            共 {{ $paginator->total() }} 条
                        </h3>
                    </div>

                    <div class="panel-body ">
                        @foreach($paginator as $post)
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
                                    <span class="label label-primary">微信公众号</span>
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
                                        {{ mb_substr($post->content, 0, 150) }}......
                                    @endif
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    {{ $paginator->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="row text-center">
            <div class="col-md-12">
                <br/>
                <p class="history mysearch">
                    <label>搜索历史：</label>
                    <span class="all-search">
                        {{--<a href="javascript:;">互联网</a>--}}
                    </span>

                </p>
                <hr/>
                <h2>你会搜索到什么？</h2>
                <br>
                <p><a href="#"><strong>人民日报</strong></a>&nbsp;公众号文章</p>
                <p><a href="#"><strong>网易新闻</strong></a>&nbsp;公众号文章</p>
                <p><a href="#"><strong>联合早报</strong></a>&nbsp;公众号文章，新加坡媒体眼中的中国</p>
                <br/>
                <h4><strong><em>可直接搜文章，或微信公众号</em></strong></h4>
            </div>
        </div>
    @endif
@endsection