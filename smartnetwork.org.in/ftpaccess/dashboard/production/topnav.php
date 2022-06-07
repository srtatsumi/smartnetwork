<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class="navbar-right">
            
            <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="images/img.jpg" alt=""><?php echo $name; ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
                
            </li>

            <li class="nav-item" style="padding-right: 55px; font-size: 20px; color: black;"> 
                Status: <?php echo $status; ?>
            </li>
            <li class="nav-item" style="padding-right: 55px; font-size: 20px; color: black;"> 
                Ref Code: <?php echo $my_ref; ?>
            </li>
        </ul>
    </nav>
    </div>
</div>