<h1>Thống kê</h1>
<?php if (isset($this->total) && !empty($this->total)): $total = $this->total; ?>
    <p>
        <span class="fa fa-list-alt"></span> Bài viết: <?php echo $total['total_post']; ?>
    </p>
    <p>
        <span class="fa fa-folder"></span> Danh mục: <?php echo $total['total_category']; ?>
    </p>
    <p>
        <span class="fa fa-tags"></span> Nhãn:<?php echo $total['total_tag']; ?>
    </p>
    
    
<?php  endif; ?>