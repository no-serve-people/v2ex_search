<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
<div class="sidebar-menu toggle-others fixed">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="{{ url('admin') }}" class="logo-expanded">
                    <img src="{{ asset('assets/images/logo@2x.png') }}" width="80" alt=""/>
                </a>

                <a href="{{ url('admin') }}" class="logo-collapsed">
                    <img src="{{ asset('assets/images/logo-collapsed@2x.png') }}" width="40" alt=""/>
                </a>
            </div>

            <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
            <div class="mobile-menu-toggle visible-xs">
                <a href="#" data-toggle="user-info-menu">
                    <i class="fa-bell-o"></i>
                    <span class="badge badge-success">7</span>
                </a>

                <a href="#" data-toggle="mobile-menu">
                    <i class="fa-bars"></i>
                </a>
            </div>

            <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
            <div class="settings-icon">
                <a href="#" data-toggle="settings-pane" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>
            </div>


        </header>


        <ul id="main-menu" class="main-menu">
            <li>
                <a href="{{ url('admin') }}">
                    <i class="linecons-fire"></i>
                    <span class="title">仪表盘</span>
                </a>
            </li>
            @if(Auth::user()->auth == 5)
                {{--<li>
                    <a href="#">
                        <i class="linecons-eye"></i>
                        <span class="title">标签</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="{{ url('admin/tag') }}">
                                <span class="title">标签列表</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin/tagadd') }}">
                                <span class="title">添加标签</span>
                            </a>
                        </li>
                    </ul>
                </li>--}}
                {{--<li>
                    <a href="#">
                        <i class="linecons-photo"></i>
                        <span class="title">媒体库</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="{{ url('admin/gallery/id') }}">
                                <span class="title">图片列表</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin/uploadFile') }}">
                                <span class="title">上传图片</span>
                            </a>
                        </li>
                    </ul>
                </li>--}}
            @endif

            <li>
                <a href="admin">
                    <i class="linecons-user"></i>
                    <span class="title">用户</span>
                </a>
                <ul>
                    @if(Auth::user()->auth == 5)
                        <li class="active">
                            <a href="{{ url('admin/user') }}">
                                <span class="title">用户列表</span>
                            </a>
                        </li>
                    @endif
                    <li class="active">
                        <a href="{{ url('admin/profile') }}">
                            <span class="title">我的个人资料</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="admin">
                    <i class="linecons-search"></i>
                    <span class="title">搜索</span>
                </a>
                <ul>
                    <li class="active">
                        <a href="{{ url('admin/history') }}">
                            <span class="title">搜索记录</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if(Auth::user()->auth == 5)
                <li>
                    <a href="admin">
                        <i class="linecons-inbox"></i>
                        <span class="title">访客记录</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="{{ url('admin/ips') }}">
                                <span class="title">IP地址</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->auth == 5)
                <li>
                    <a href="admin">
                        <i class="linecons-pencil"></i>
                        <span class="title">友情链接</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="{{ url('admin/link') }}">
                                <span class="title">链接列表</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin/linkadd') }}">
                                <span class="title">添加友链</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="admin">
                        <i class="linecons-camera"></i>
                        <span class="title">微信爬虫设置</span>
                    </a>
                    <ul>
                        {{--  <li class="active">
                              <a href="{{ url('admin/spiderlist') }}">
                                  <span class="title">爬虫列表</span>
                              </a>
                          </li>
                          <li class="active">
                              <a href="{{ url('admin/spiderstart') }}">
                                  <span class="title">启动爬虫</span>
                              </a>
                          </li>--}}
                        <li class="active">
                            <a href="{{ url('admin/urllist') }}">
                                <span class="title">url列表</span>
                            </a>
                            <a href="{{ url('admin/urladd') }}">
                                <span class="title">url增加</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--  <li>
                      <a href="#">
                          <i class="linecons-trash"></i>
                          <span class="title">elasticsear设置</span>
                      </a>
                      <ul>
                          <li class="active">
                              <a href="{{ url('admin/spiderlist') }}">
                                  <span class="title">爬虫列表</span>
                              </a>
                          </li>
                          <li class="active">
                              <a href="{{ url('admin/spiderstart') }}">
                                  <span class="title">启动爬虫</span>
                              </a>
                          </li>
                          <li class="active">
                              <a href="{{ url('admin/urladd') }}">
                                  <span class="title">url增加</span>
                              </a>
                          </li>
                      </ul>
                  </li>--}}

                <li class="has-sub">
                    <a href="admin">
                        <i class="linecons-cloud"></i>
                        <span class="title">设置</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="{{ url('admin/seo') }}">
                                <span class="title">SEO设置</span>
                            </a>
                        </li>
                        {{--    <li class="active">
                                <a href="{{ url('admin/ik') }}">
                                    <span class="title">分词设置</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{ url('admin/search') }}">
                                    <span class="title">搜索设置</span>
                                </a>
                            </li>--}}
                    </ul>
                </li>

            @endif


        </ul>

    </div>

</div>

