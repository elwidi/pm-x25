<div class="page-header">
    <div class="pull-left">
        <h2><?php echo $segment->segment_name;?></h2>
    </div>
    <div class="pull-right">

    </div>
    <div class="clearfix"></div>
</div>

<?php
if(isset($sub_segment)){
    foreach($sub_segment as $row)
    {
        ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            <span class="fs1" aria-hidden="true" data-icon="&#xe1cd;"></span> <?php echo $row->segment_name;?>
                        </div>
                    </div>
                    <div class="widget-body">
                        <table class="table table-condensed table-bordered no-margin">
                            <thead>
                            <tr>
                                <th rowspan="2" class="span1" style="vertical-align:middle">#</th>
                                <th rowspan="2" class="span4 " style="vertical-align:middle">Scope Of Work</th>
                                <th rowspan="2" class="span1" style="vertical-align:middle">SOW/ PLAN</th>
                                <th rowspan="2" class="span1" style="vertical-align:middle">Cummulative Progress (Meter/Pcs)</th>
                                <th rowspan="2" class="span1" style="vertical-align:middle">Remaining Qty/Meter</th>
                                <th class="span1 hidden-phone">HH</th>
                                <th class="span1 hidden-phone">01<th>
                            </tr>
                            <tr>
                                <th class="hidden-phone">Span</th>
                                <th class="hidden-phone">00-01<th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($sow[$row->segment_id])) {
                                foreach($sow[$row->segment_id] as $rec)
                                {
                                    ?>
                                    <tr>
                                        <td ><?php echo $rec->sow_id;?></td>
                                        <td class=""><?php echo $rec->scope_of_work;?></td>
                                        <td><?php echo $rec->sow_plan;?></td>
                                        <td><?php echo $rec->cummulative_progress;?></td>
                                        <td class="hidden-phone"><?php echo $rec->remaining_qty;?></td>
                                        <td class="hidden-phone"><?php echo $rec->remaining_qty;?></td>
                                        <td class="hidden-phone"><?php echo $rec->remaining_qty;?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe1cd;"></span> Purwokerto - Kebumen
                </div>
            </div>
            <div id="tbl_sow" class="widget-body">
                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                    <tr>
                        <th class="headcol" width="10px">#</th>
                        <th width="100px">Scope of Work</th>
                        <th width="50px" class="hidden-phone">SOW/Plan</th>
                        <th width="50px" class="hidden-phone">Cummulative Progress</th>
                        <th width="50px" class="hidden-phone">Remaining Qty</th>
                        <th width="30px" class="hidden-phone">01</th>
                        <th width="30px" class="hidden-phone">02</th>
                        <th width="30px" class="hidden-phone">03</th>
                        <th width="30px" class="hidden-phone">04</th>
                        <th width="30px" class="hidden-phone">05</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="headcol">
                            1
                        </td>
                        <td>
                            Permit
                        </td>
                        <td class="hidden-phone">
                            Bel Road, 12th Cross
                        </td>
                        <td class="hidden-phone">
                            662
                        </td>
                        <td class="hidden-phone">
				  <span class="badge badge-info">
					Processing
				  </span>
                        </td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                    </tr>
                    <tr>
                        <td class="headcol">
                            2
                        </td>
                        <td>
                            Installasi HDPE ( Rojok ) --Meter
                        </td>
                        <td class="hidden-phone">
                            Baswa lane, Kanpur
                        </td>
                        <td class="hidden-phone">
                            129
                        </td>
                        <td class="hidden-phone">
				  <span class="badge badge-success">
					Sent
				  </span>
                        </td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                    </tr>
                    <tr>
                        <td class="headcol">
                            3
                        </td>
                        <td>
                            Installasi Pole / KU  = Kabel Udara --> meter
                        </td>
                        <td class="hidden-phone">
                            Lavelle Road, Bangalore
                        </td>
                        <td class="hidden-phone">
                            567
                        </td>
                        <td class="hidden-phone">
				  <span class="badge badge-important">
					Cancelled
				  </span>
                        </td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                    </tr>
                    <tr>
                        <td class="headcol">
                            4
                        </td>
                        <td>
                            Handhole -->pcs
                        </td>
                        <td class="hidden-phone">
                            H.S.No. 229, Garabandha
                        </td>
                        <td class="hidden-phone">
                            887
                        </td>
                        <td class="hidden-phone">
				  <span class="badge badge-info">
					Processing
				  </span>
                        </td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                    </tr>
                    <tr>
                        <td class="headcol">
                            5
                        </td>
                        <td>
                            Pulling Cable --> Meter
                        </td>
                        <td class="hidden-phone">
                            Silicon Valley
                        </td>
                        <td class="hidden-phone">
                            548
                        </td>
                        <td class="hidden-phone">
				  <span class="badge badge-success">
					Sent
				  </span>
                        </td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                        <td>Done</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    table {
        /*border-collapse: separate;*/
        /*border-spacing: 0;*/
        /*border-top: 1px solid grey;*/
    }

    td, th {
        /*margin: 0;*/
        /*border: 1px solid grey;*/
        white-space: nowrap;
        /*border-top-width: 0px;*/
    }

    #tbl_sow {
        width:700px;
        overflow-x: scroll;
        margin-left: 100px;
        overflow-y: visible;
        /*padding: 0;*/
    }

    .headcol {
        position: absolute;
        width: 62px;
        left: 20px;
        /*top: auto;*/
        /*border-top-width: 1px;*/
        /*only relevant for first row*/
        /*margin-top: -1px;*/
        /*compensate for top border*/
    }


</style>

