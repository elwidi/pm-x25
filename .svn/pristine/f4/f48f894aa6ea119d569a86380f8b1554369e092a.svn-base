<script type="text/javascript" src="<?php echo base_url()?>themes/Limitless/default/assets/js/plugins/visualization/c3/c3.min.js"></script>

<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <div class = "row m-10">
            <table class="table table-borderless text-nowrap">
                <tbody>
                <tr>
                    <th style="width: 50px">Name</th>
                    <th style="width: 300px">: <?php echo $resource->fullname; ?></th>
                </tr>
                <tr>
                    <th style="width: 50px">Total Project </th>
                    <th style="width: 300px">: <?php echo $total; ?></th>
                </tr>
                <tr>
                    <th style="width: 50px">Availbility</th>
                    <th style="width: 300px">: <?php echo $avail; ?>%</th>
                </tr>
                <tr>
                    <th style="width: 50px">Outstanding Work </th>
                    <th style="width: 300px">: <?php echo $os_work; ?>%</th>
                </tr>
                </tbody>
            </table>
        </div>

        <div class = "col-md-7">
            <div class="chart-container">
                <div class="chart" id="c3-bar-chart"></div>
            </div>
        </div>
    </div>
    <div class = "row">
        <div class = "col-md-12">

            <div class = "col-md-7 mb-20">
                <div class="progress">
                    <div class="progress-bar bg-info" style="width: <?php echo $avail?>%">
                        <span> <?php echo $avail?>%</span>
                    </div>

                    <div class="progress-bar progress-bar-warning" style="width: <?php echo $os_work?>%">
                        <span> <?php echo $os_work?>%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-nowrap">
            <thead>
            <tr>
                <th style="width: 500px">Project Name</th>
                <th style="width: 250px">Project Completion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($project as $key => $value) { ?>
                <tr>
                    <td><?php echo $value->project_name?></td>
                    <td><?php echo $value->completion?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<style>
    .dataTable{
    border-collapse: collapse;
    }
    .dataTable tbody > tr:first-child > td {
    border-top: none;
        border-top: 1px solid #ddd;
        border-collapse: collapse;
    }
    .table > tbody > tr.border-double > td {
    border-top-width: 3px;
        border-top-style: double;
    }
</style>

<script type="text/javascript">
    $(function(){
        var proj = [];
        var completion = ['completion'];
        <?php foreach ($project as $p) {?>
            proj.push("<?php echo $p->project_name?>");
            completion.push("<?php echo $p->completion/100?>");
        <?php }?>
        console.log(proj);
        var bar_chart = c3.generate({
            bindto: '#c3-bar-chart',
            size: { height: 200 },
            data: {
                columns: [
                    completion,
                ],
                type: 'bar'
            },
            color: {
                pattern: ['#2196F3', '#FF9800', '#4CAF50']
            },
            bar: {
                width: {
                    ratio: 0.05
                }
            },
            axis: {
                x: {
                    type: 'category',
                    categories: proj
                },
                y: {
                    max: 1,
                    padding: {
                        top: 20, bottom:0
                    },

                    tick:{
                        format:d3.format("%"),
                        values:[0.25,0.50,0.75,1],
                        count: 4
                    },


                },
            },
            grid: {
                y: {
                    show: true
                }
            }
        });
    });
</script>


