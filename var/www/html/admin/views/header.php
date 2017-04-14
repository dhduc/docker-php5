<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">KEEP NODE</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="../index" target="_blank">Trang chủ</a>
                    
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=(isset($this->username)) ? $this->username : ''; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?=SITE?>/admin/account"><i class="fa fa-fw fa-user"></i>Tài khoản</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="dashboard/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="<?=SITE?>/admin/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   <!--  <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-home"></i> Trang chủ <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-list"></i> General</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-list"></i> About</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-list"></i> Contact</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-list"></i> Footer</a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="<?=SITE?>/admin/user"><i class="fa fa-fw fa-bar-chart-o"></i> Người dùng</a>
                    </li>
                    <li>
                        <a href="<?=SITE?>/admin/statistic"><i class="fa fa-fw fa-table"></i> Thống kê</a>
                    </li>
                    <li>
                        <a href="<?=SITE?>/admin/account"><i class="fa fa-fw fa-edit"></i> Tài khoản</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-wrench"></i> Cài đặt</a>
                    </li>
                    
                   
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>