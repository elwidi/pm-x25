<!--
<div class="breadcrumb-line">
    <div class="breadcrumb-boxed">
        <ul class="breadcrumb">
            <li><a href=""><i class="icon-office position-left"></i> PT MORA TELEMATIKA INDONESIA</a></li>
        </ul>
    </div>
</div>
-->

<div class="page-header-content"> <!-- Hello, <?php //echo $this->session->userdata('user_fullname'); ?>!</small> -->
    <div class="page-title">
        <h4><i class="icon-file-check position-left"></i> <?php echo isset($page_title) ? $page_title : '<span class="text-semibold">Home</span> - Dashboard' ?></h4>
    </div>

    <?php if($this->uri->segment(1)=='invoice') {
        ?>
        <div class="heading-elements">
            <a href="#" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-calculator"></i></b> Create
                invoice</a>
            <a href="#" class="btn btn-default btn-icon heading-btn"><i class="icon-gear"></i></a>
        </div>
        <?php
    }
    ?>
    <!--
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-indigo-400"></i><span>Statistics</span></a>
            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-indigo-400"></i><span>Invoices</span></a>
            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-indigo-400"></i><span>Schedule</span></a>
        </div>
    </div>
    -->
</div>