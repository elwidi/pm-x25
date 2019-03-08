<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <?php echo isset($page_title) ? $page_title : '<span class="text-semibold">Home</span> - Dashboard' ?></h4>
    </div>
    <?php if($this->apps->check('addProject')) {
        if ($this->uri->segment(1) == 'planning' && $this->uri->segment(2) == 'allProject') {
            ?>
            <div class="heading-elements">
                <a href="javascript:;" class="btn bg-success btn-labeled heading-btn" id="add_project_form"><b><i
                            class="icon-plus2"></i></b>Add Project</a>
                <a href="javascript:;" class="btn btn-default btn-icon heading-btn"><i class="icon-gear"></i></a>
            </div>
            <?php
        }
    }
    ?>
</div>

