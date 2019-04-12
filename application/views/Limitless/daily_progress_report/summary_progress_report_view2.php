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
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead class="bg-info-800">
            <tr>
                <th rowspan="2" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">No.</th>
                <th width="370px" rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">PROJECT NAME</th>
                <th width="50px" rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(84,130,53);color:#ffffff;">OVERALL COMPLETION</th>
                <th rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">BASELINE</th>
                <th rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">GAP</th>
                <th width="50px" rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">SCOPE (KM)</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">HDPE (KM)</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">POLE</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">CABLE (KM)</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">TOWER</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">ISP</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">DWDM</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">OTB</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">FDT</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">FAT</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Doc ATP</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">ATP</th>
                <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">BAST</th>
            </tr>
            <tr>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Scope</th>
                <th style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">Actual</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($project as $key => $v) {?>
                <tr>
                    <td width="63px" style="padding: 8px 20px;"><?php echo $no?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->project_name?></td>
                    <td style="padding: 8px 20px;background-color: rgb(231,230,230);color:#000;text-align: center"><?php echo $v->completion;?>%</td>
                    <td style="padding: 8px 20px;color:#000;text-align: center"><?php echo $v->baseline;?>%</td>
                    <td style="padding: 8px 20px;color:#000;text-align: center"><?php echo $v->baseline - $v->completion;?>%</td>
                    <td style="padding: 8px 20px;"><?php echo $v->km['scope'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);"><?php echo $v->hdpe['scope'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);"><?php echo $v->hdpe['actual'];?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->pole['scope'];?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->pole['actual'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);"><?php echo $v->km['scope'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);"><?php echo $v->km['actual'];?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->tower['actual'];?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->tower['scope'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);"><?php echo $v->isp['scope'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);"><?php echo $v->isp['actual'];?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->dwdm['scope'];?></td>
                    <td style="padding: 8px 20px;"><?php echo $v->dwdm['actual'];?></td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);">0</td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);">0</td>
                    <td style="padding: 8px 20px;">0</td>
                    <td style="padding: 8px 20px;">0</td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);">0</td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);">0</td>
                    <td style="padding: 8px 20px;">0</td>
                    <td style="padding: 8px 20px;">0</td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);">0</td>
                    <td style="padding: 8px 20px;background-color: rgb(221,235,247);">0</td>
                    <td style="padding: 8px 20px;">0</td>
                    <td style="padding: 8px 20px;">0</td>
                </tr>
                <?php $no++; } ?>

            </tbody>
        </table>
    </div>
</div>
<!-- /bordered striped table -->


<script>
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            ordering:       false,
            scrollY:        "480px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns: {
                leftColumns: 2
            }
        } );
    } );
</script>

<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>


<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 2px solid #000000;
        /*padding: 8px 20px;*/
    }


</style>
