<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>

        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= base_url('assets/image/') . $user['image']; ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2><?= $user['nama']; ?></h2>
            </div>
        </div>

        <br />

        <?php
        $role_id = $this->session->userdata('role_id');
        $menu = $this->m_menu->querySideBar('user_menu', $role_id);
        ?>

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <?php foreach ($menu as $m) : ?>
                    <ul class="nav side-menu">
                        <li><a><i class="<?= $m['icon']; ?>"></i><?= $m['menu']; ?><span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">

                                <?php
                                $menuId = $m['id'];
                                $submenu = $this->m_menu->getWhereSubMenu('user_sub_menu', $menuId);
                                ?>

                                <?php foreach ($submenu as $sm) : ?>
                                    <li><a href="<?= base_url($sm['url']); ?>"><?= $sm['title']; ?></a></li>
                                <?php endforeach; ?>

                            </ul>
                        </li>
                    </ul>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>