<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" id="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '氢搜索') }}</title>

    <!-- Styles -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default" >
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header" >
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand"  href="/search"><strong>氢搜索</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--专注于微信公众号搜索
                            </a>

                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a>|</a></li>
                                <li><a href="/rmrb"><strong>人民日报</strong> 全部文章</a></li>
                                <li><a>|</a></li>
                                <li><a href="/about">关于</a></li>
                                <li><a>|</a></li>
                                <li><a href="/admin/dashboard">个人中心</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
        @yield('content')
        <!--旁边框加入分享 -->
        <div class="side-bar">
            <a href="http://wpa.qq.com/msgrd?v=3&uin=826739558&site=qq&menu=yes" class="icon-qq" title="向作者发起会话">向作者发起会话</a>
            <a href="#" class="icon-chat" title="联系作者">微信
                <div class="chat-tips"><i></i>
                    <img style="width:138px;height:138px;" src="img/wechat.jpg" alt="扫一扫加我微信"></div>
            </a>
            <a target="_blank" href="#" class="icon-blog" title="关注作者微博">微博</a>
            <a href="mailto:" class="icon-mail" title="给作者发短信联系">mail</a>
        </div>

    </div>
    <footer>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <p class="text-center"><a href="http://www.your-me.cn" target="_blank">©等车的猪</a>&nbsp;&nbsp; |&nbsp;&nbsp;<strong>氢搜索</strong>
                    &nbsp;&nbsp;|&nbsp;&nbsp; <a
                            href="http://www.github.com/ixingjue/zmu_search" target="_blank"><span style="color:red;"
                                                                                        class="glyphicon glyphicon-hand-right"
                                                                                        aria-hidden="true"></span>
                        毕业设计GitHub,欢迎<span style="color: red;">Star</span></a></p>
            </div>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script>
    function removeByValue(arr, val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] == val) {
                arr.splice(i, 1);
                break;
            }
        }
    }
    var searchArr;
    //定义一个search的，判断浏览器有无数据存储（搜索历史）
    if (localStorage.search) {
        //如果有，转换成 数组的形式存放到searchArr的数组里（localStorage以字符串的形式存储，所以要把它转换成数组的形式）
        searchArr = localStorage.search.split(",")
    } else {
        //如果没有，则定义searchArr为一个空的数组
        searchArr = [];
    }
    //把存储的数据显示出来作为搜索历史
    MapSearchArr();

    function add_search() {
        var val = $("#searchInput").val();
        if (val.length >= 2) {
            //点击搜索按钮时，去重
            KillRepeat(val);
            //去重后把数组存储到浏览器localStorage
            localStorage.search = searchArr;
            //然后再把搜索内容显示出来
            MapSearchArr();
        }
        // window.location.href = search_url + '?q=' + val + "&s_type=" + $(".searchItem.current").attr('data-type')
    }

    function MapSearchArr() {
        var tmpHtml = "";
        var arrLen = 0
        if (searchArr.length >= 5) {
            arrLen = 5
        } else {
            arrLen = searchArr.length
        }
        for (var i = 0; i < arrLen; i++) {
            tmpHtml += '<a href="' + '?query=' + searchArr[i] + '">' + searchArr[i] + '</a>&nbsp;&nbsp;'
            // tmpHtml += 'searchArr[i]'
        }
        $(".mysearch .all-search").html(tmpHtml);
    }

    //去重
    function KillRepeat(val) {
        var kill = 0;
        for (var i = 0; i < searchArr.length; i++) {
            if (val === searchArr[i]) {
                kill++;
            }
        }
        if (kill < 1) {
            searchArr.unshift(val);
        } else {
            removeByValue(searchArr, val)
            searchArr.unshift(val)
        }
    }


</script>
<link href="{{ elixir('css/index.css') }}" rel="stylesheet">
</body>
<script charset="UTF-8" src="http://www.92find.com/inteltip.js"></script>
</html>
