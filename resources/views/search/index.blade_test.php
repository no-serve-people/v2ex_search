<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>氢搜索</title>
    <link href="{{ elixir('css/style.css') }}" rel="stylesheet">
    <link href="{{ elixir('css/index.css') }}" rel="stylesheet">
</head>
<body>

<div id="container">
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

    <div id="bd">
        <div id="main">
            <h1 class="title">
                <div class="logo large"></div>
            </h1>
            <div class="nav ue-clear">
                <ul class="searchList">
                    <li class="searchItem current" data-type="article">V2EX文章</li>
                    <li class="searchItem" data-type="question">知乎问答</li>
                    <li class="searchItem" data-type="job">互联网职位</li>
                    <li class="searchItem" data-type="lyric">网易云音乐歌词</li>
                    <li class="searchItem" data-type="trend">可视化分析</li>
                    <li class="searchItem" data-type="yingping">豆瓣影评</li>
                </ul>
            </div>
            <div class="inputArea">
                <input type="text" class="searchInput"/>
                <input type="button" class="searchButton" onclick="add_search()"/>
                <ul class="dataList">
                    <li>如何学好设计</li>
                    <li>界面设计</li>
                    <li>UI设计培训要多少钱</li>
                    <li>设计师学习</li>
                    <li>哪里有好的网站</li>
                </ul>
            </div>

            <div class="historyArea">
                <p class="history">
                    <label>热门搜索：</label>

                </p>

                <p class="history mysearch">
                    <label>我的搜索：</label>
                    <span class="all-search">
                        <a href="javascript:;">专注界面设计网站</a>
                        <a href="javascript:;">用户体验</a>
                        <a href="javascript:;">互联网</a>
                        <a href="javascript:;">资费套餐</a>
                    </span>

                </p>
            </div>
        </div><!-- End of main -->
    </div><!--End of bd-->

    <div class="foot">
        <div class="wrap">
            <div class="copyright">Copyright &copy;等车的猪 版权所有 E-mail:826739558@qq.com</div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript">
    var suggest_url = "/suggest/"
    var search_url = "/search/"

    $('.searchList').on('click', '.searchItem', function () {
        $('.searchList .searchItem').removeClass('current');
        $(this).addClass('current');
    });

    function removeByValue(arr, val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] == val) {
                arr.splice(i, 1);
                break;
            }
        }
    }

    // 搜索建议
    $(function () {
        $('.searchInput').bind(' input propertychange ', function () {
            var searchText = $(this).val();
            var tmpHtml = ""
            $.ajax({
                cache: false,
                type: 'get',
                dataType: 'json',
                url: suggest_url + "?s=" + searchText + "&s_type=" + $(".searchItem.current").attr('data-type'),
                async: true,
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        tmpHtml += '<li><a href="' + search_url + '?q=' + data[i] + '">' + data[i] + '</a></li>'
                    }
                    $(".dataList").html("")
                    $(".dataList").append(tmpHtml);
                    if (data.length == 0) {
                        $('.dataList').hide()
                    } else {
                        $('.dataList').show()
                    }
                }
            });
        });
    })

    hideElement($('.dataList'), $('.searchInput'));

</script>
<script>
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
        var val = $(".searchInput").val();
        if (val.length >= 2) {
            //点击搜索按钮时，去重
            KillRepeat(val);
            //去重后把数组存储到浏览器localStorage
            localStorage.search = searchArr;
            //然后再把搜索内容显示出来
            MapSearchArr();
        }

        window.location.href = search_url + '?q=' + val + "&s_type=" + $(".searchItem.current").attr('data-type')

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
            tmpHtml += '<a href="' + search_url + '?q=' + searchArr[i] + '">' + searchArr[i] + '</a>'
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
</html>