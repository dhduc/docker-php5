<nav class="main-menu">
<div>
  <a class="logo" href="#">
  </a> 
</div> 
<div class="settings">
  <a href="<?=SITE?>/user/dashboard" id="logo">
        <i class="fa fa-book fa-lg"></i>
        <span class="nav-text">NOTE</span>
  </a>
</div>
<div class="scrollbar" id="style-1">

  <ul id="menu">

    <li>                                   
      <a href="<?=SITE?>/user/dashboard">
        <i class="fa fa-home fa-lg"></i>
        <span class="nav-text">Dashboard</span>
      </a>
    </li>

    <li>                                   
      <a href="<?=SITE?>/user/post">
        <i class="fa fa-list-alt fa-lg"></i>
        <span class="nav-text">Bài viết</span>
      </a>
    </li>     

    <li>                                 
      <a href="<?=SITE?>/user/post/insert">
        <i class="fa fa-plus-square fa-lg"></i>
        <span class="nav-text">Tạo mới</span>
      </a>
    </li>   


    <li>                                 
      <a href="<?=SITE?>/user/category">
        <i class="fa fa-folder fa-lg"></i>
        <span class="nav-text">Danh mục</span>
      </a>
    </li>   

    <li>

      <a href="<?=SITE?>/user/tag">
        <i class="fa fa-tags fa-lg"></i>
        <span class="nav-text">Nhãn</span>
      </a>
    </li>
    </li> 
     <li class="darkerli">                                   
      <a href="<?=SITE?>/user/statistic">
        <i class="fa fa-table fa-lg"></i>
        <span class="nav-text">Thống kê</span>
      </a>
    </li>  
    <li class="darkerli">                                   
      <a href="<?=SITE?>/user/account">
        <i class="fa fa-user fa-lg"></i>
        <span class="nav-text">Tài khoản</span>
      </a>
    

     <li class="darkerli">                                   
      <a href="<?=SITE?>" target="_blank">
        <i class="fa fa-laptop fa-lg"></i>
        <span class="nav-text">Trang chủ</span>
      </a>
    </li>

    <li class="darkerli">
      <a href="dashboard/logout">
        <i class="fa fa-sign-out fa-lg"></i>
        <span class="nav-text">
         Đăng xuất
       </span>

     </a>
   </li>       

    
 </ul>
</nav>

<div id="main">
  <div id="search">
        <form name="frm_search" method="post" action="<?=SITE?>/user/search">
          <input type="text" name="inp_search" value="" placeholder="Nội dung cần tìm" width="500">
          <input type="submit" class="button button-info" name="submit_search" value="Tìm kiếm">
        </form> 
  </div>