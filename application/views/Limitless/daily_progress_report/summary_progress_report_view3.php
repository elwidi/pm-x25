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
        <table class="">
            <thead class="bg-info-800">
            <tr>
                <!-- <th width="40px" rowspan="2" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">No.</th> -->
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">PROJECT NAME</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(84,130,53);color:#ffffff;">OVERALL COMPLETION</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">BASELINE</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">GAP</th>
                <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">SCOPE (KM)</th>
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
                <!-- <td style=""><?php echo $no?></td> -->
                <td style=""><?php echo $v->project_name?></td>
                <td style="background-color: rgb(231,230,230);color:#000;text-align: center"><?php echo $v->completion;?>%</td>
                <td style="color:#000;"><?php echo $v->baseline;?>%</td>
                <td style="color:#000;"><?php echo $v->baseline - $v->completion;?>%</td>
                <td style=""><?php echo $v->km['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->hdpe['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->hdpe['actual'];?></td>
                <td style=""><?php echo $v->pole['scope'];?></td>
                <td style=""><?php echo $v->pole['actual'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->km['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->km['actual'];?></td>
                <td style=""><?php echo $v->tower['actual'];?></td>
                <td style=""><?php echo $v->tower['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->isp['scope'];?></td>
                <td style="background-color: rgb(221,235,247);"><?php echo $v->isp['actual'];?></td>
                <td style=""><?php echo $v->dwdm['scope'];?></td>
                <td style=""><?php echo $v->dwdm['actual'];?></td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="">0</td>
                <td style="">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="">0</td>
                <td style="">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="background-color: rgb(221,235,247);">0</td>
                <td style="">0</td>
                <td style="">0</td>
            </tr>
            <?php $no++; } ?>

            </tbody>
        </table>
    </div>
</div>
<!-- /bordered striped table -->


<style>
    /*table {
        border-collapse: collapse;
    }*/

    /*table, th, td {
        border: 2px solid #000000;*/
        /*padding: 8px 20px;*/
    /*}*/

    table {
      position: relative;
      width: 1000px;
      /*background-color: #aaa;*/
      overflow: hidden;
      border-collapse: collapse;
    }


    /*thead*/
    thead {
      position: relative;
      display: block; /*seperates the header from the body allowing it to be positioned*/
      width: 1500px;
      overflow: visible;
    }

    thead th {
      /*background-color: #99a;*/
      min-width: 120px;
      height: 32px;
      border: 1px solid #222;
    }

    thead th:nth-child(1) {/*first cell in the header*/
      position: relative;
      display: block; /*seperates the first cell in the header from the header*/
      background-color: #88b;
    }


    /*tbody*/
    tbody {
      position: relative;
      display: block; /*seperates the tbody from the header*/
      width: 1500px;
      height: 1000px;
      overflow: scroll;
    }

    tbody td {
      /*background-color: #bbc;*/
      min-width: 120px;
      border: 1px solid #222;
    }

    tbody tr td:nth-child(1) {  /*the first cell in each tr*/
      position: relative;
      display: block; /*seperates the first column from the tbody*/
      height: 100px;
      width: 120px;
      background-color: #ffffff;
    }


</style>


<script type="text/javascript">
    $(function () {
        $(document).ready(function() {
              $('tbody').scroll(function(e) { //detect a scroll event on the tbody
                /*
                Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
                of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain             it's relative position at the left of the table.    
                */
                $('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
                $('thead th:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
                $('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
              });
        });
    })
</script>
