<div class="page-header">
    <div class="pull-left">
        <h2>New SOW / Plan</h2>
    </div>
    <div class="pull-right">

    </div>
    <div class="clearfix"></div>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe023;"></span> New Scope of Work / Plan
                </div>
            </div>
            <div class="widget-body">
                <form class="form-horizontal no-margin well">
                    <div class="control-group">
                        <label class="control-label">
                            Segment
                        </label>
                        <div class="controls">
                            <select id="segment" class="span12">
                                <option value="">Select...</option>
                                <?php
                                if(isset($segment)) {
                                    foreach($segment as $rec)
                                    {
                                        ?>
                                        <option value="<?php echo $rec->segment_id;?>">
                                            <?php echo $rec->segment_name;?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            Sub Segment
                        </label>
                        <div class="controls">
                            <select id="sub_segment" class="span12">
                                <option value="">Select...</option>
                                <?php
                                if(isset($segment)) {
                                    foreach($segment as $rec)
                                    {
                                        ?>
                                        <option value="<?php echo $rec->segment_id;?>">
                                            <?php echo $rec->segment_name;?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            Handhole
                        </label>
                        <div class="controls">
                            <input class="span12" type="number" placeholder="Number of handhole">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            Website URL
                        </label>
                        <div class="controls">
                            <a href="#" id="url" data-type="url" data-pk="1" data-original-title="Click here to edit your first name" class="inputText editable editable-click">
                                http:www.abcxyz.com
                            </a>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            Tags
                        </label>
                        <div class="controls">
                            <a href="#" id="tags" data-type="select2" data-pk="1" data-original-title="Enter tags" class="editable editable-click">
                                Html, CSS, Javascript
                            </a>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">
                            About
                        </label>
                        <div class="controls">
                            <a data-original-title="Write about your self" data-placeholder="Your comments here..." data-pk="1" data-type="textarea" id="aboutMe" href="#" class="inputTextArea editable editable-click" style="margin-bottom: 10px;">
                                About me :)
                            </a>
                        </div>
                    </div>
                    <div class="form-actions no-margin">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                        <button type="button" class="btn">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
