<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <li class="dropdown menu-item">
              <?php 
                $sql = "select id,categoryName  from category";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) :
            ?>
                <a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>
                    <?php echo $row['categoryName'];?></a>
            <?php endwhile; ?>
                </li>
            </ul>
        </nav>
    </div>