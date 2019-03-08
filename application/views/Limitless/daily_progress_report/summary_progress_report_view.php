<!-- Bordered striped table -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Summary Progress Report</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
            </ul>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-xs" style="font-weight: bold; overflow-x: auto;">
            <thead class="bg-info-800">
            <tr>
                <th rowspan="2" style="background-color: rgb(31,78,120);color:#ffffff;">No.</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">PROJECT NAME</th>
                <th  width="50px" rowspan="2" class="text-center" style="background-color: rgb(84,130,53);color:#ffffff;">OVERALL COMPLETION</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">BASELINE</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">GAP</th>
                <th width="50px" rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">SCOPE (KM)</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">HDPE (KM)</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">POLE</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">CABLE (KM)</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">TOWER</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">ISP</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">DWDM</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">OTB</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">FDT</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">FAT</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">Doc ATP</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">ATP</th>
                <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">BAST</th>
            </tr>
            <tr>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($project as $key => $v) {?>
            <tr>
                <td><?php echo $no?></td>
                <td><?php echo $v->project_name?></td>
                <td style="background-color: rgb(231,230,230);color:#000;text-align: center"><?php echo $v->completion;?>%</td>
                <td style="color:#000;text-align: center"><?php echo $v->baseline;?>%</td>
                <td style="color:#000;text-align: center"><?php echo $v->baseline - $v->completion;?>%</td>
                <td><?php echo $v->km['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->hdpe['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->hdpe['actual'];?></td>
                <td><?php echo $v->pole['scope'];?></td>
                <td><?php echo $v->pole['actual'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->km['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->km['actual'];?></td>
                <td><?php echo $v->tower['actual'];?></td>
                <td><?php echo $v->tower['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->isp['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->isp['actual'];?></td>
                <td><?php echo $v->dwdm['scope'];?></td>
                <td><?php echo $v->dwdm['actual'];?></td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td>0</td>
                <td>0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td>0</td>
                <td>0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <?php $no++; } ?>

            </tbody>
        </table>
    </div>
</div>
<!-- /bordered striped table -->


<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 2px solid #000000;
    }


</style>