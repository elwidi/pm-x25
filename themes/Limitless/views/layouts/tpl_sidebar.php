<?php
if ($this->uri->segment(1) == 'planningX') {
    ?>
    <div class="sidebar sidebar-main sidebar-default">
        <div class="sidebar-content">
            <!-- Main navigation -->
            <div class="sidebar-category sidebar-category-visible">
                <!--
                <div class="category-title h6">
                    <span>Main navigation</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>
                -->
                <div class="category-content sidebar-user">
                    <div class="media">
                        <a href="#" class="media-left"><img src="<?php echo $obj_photo; ?>" class="img-circle img-sm"
                                                            alt=""></a>

                        <div class="media-body">
                            <span class="media-heading text-semibold"><?php echo $obj_fullname; ?></span>

                            <div class="text-size-mini text-muted">
                                <i class="icon-pin text-size-small"></i> &nbsp;<?php echo $userRole[1];?>
                            </div>
                        </div>

                        <div class="media-right media-middle">
                            <ul class="icons-list">
                                <li>
                                    <a href="#"><i class="icon-cog3"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-main navigation-accordion">

                        <!-- Main -->
                        <li class="navigation-header"><span>Project</span> <i class="icon-menu" title="Main pages"></i>
                        </li>
                        <!-- /main -->
                    </ul>

                    <!--
                    <ul class="list-feed" style="margin-left:15px;">
                        <li class="border-warning-400">
                            <a href="#">Palapa Ring Barat</a>
                        </li>

                        <li class="border-warning-400">
                            <a href="#">Upgrade SBB</a
                        </li>

                        <li class="border-warning-400">
                            <div class="text-muted text-size-small mb-5">12 minutes ago</div>
                        </li>
                    </ul>
                    -->

                </div>
            </div>
            <!-- /main navigation -->
        </div>
    </div>
    <?php
}
?>