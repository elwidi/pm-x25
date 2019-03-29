<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/c3/c3.min.js"></script>
<!-- Bordered striped table -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <!--
            <div class="panel-heading">
                <h5 class="panel-title">Progress Per Project</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                    </ul>
                </div>
            </div>
            -->
            <div class="panel-body">

                    <div class="form-group">
                        <label>Select Project:</label>
                        <select id="project" name="project" data-placeholder="Select Project..." class="select text-bold">
                            <option value="">Select</option>
                            <?php foreach ($project as $key => $r) { ?>
                                <option value="<?php echo $r->id ?>"><?php echo $r->project_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php foreach ($project as $i => $d) {
                        if ($d->start_date == '0000-00-00') {
                            $d->start_date = '-';
                        }

                        if ($d->end_date == '0000-00-00') {
                            $d->end_date = '-';
                        }
                        ?>
                        <div class="row tab p<?php echo $d->id ?>">
                            <?php //print_r ($d->milestone[0]->mil[0]->progress->remark);?>
                            <div class="table-responsive">
                                <table class="table table-xs" style="font-weight: bold;">
                                    <thead class="bg-info-800">
                                    <tr>
                                        <th rowspan="2" colspan="3" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">PROJECT NAME</th>
                                        <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">CUSTOMER</th>
                                        <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">PL Start</th>
                                        <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">PL Finish</th>
                                        <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">CAPACITY</th>
                                        <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">OVERALL PROGRESS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="3"><?php echo $d->project_name ?></td>
                                        <td style="text-align: center;"><?php echo $d->customer ?></td>
                                        <td style="text-align: center;"><?php echo date('M-Y', strtotime($d->start_date)); ?></td>
                                        <td style="text-align: center;"><?php echo date('M-Y', strtotime($d->end_date)); ?></td>
                                        <td style="text-align: center;"><?php echo $d->capacity ?></td>
                                        <td style="text-align: center;"><?php echo $d->completion . "%" ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="background-color: rgb(255,0,0);color:#ffffff;text-align: center;">IMPORTANT REMARKS</td>
                                        <td rowspan="4" colspan="4">
                                            <div class="chart-container">
                                                <div class="chart emp" id="c3-axis-labels-<?php echo $d->id;?>"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="vertical-align:top">
                                            <?php if (!empty($d->milestone[0]->mil)) {
                                                if (!empty($d->milestone[0]->mil[0]->progress)) {
                                                    ?>
                                                    <?php echo $d->milestone[0]->mil[0]->progress->remark; ?>

                                                <? } else {
                                                    echo "<p>-</p>";
                                                }
                                            } else {
                                                echo "<p>-</p>";
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">BASELINE</td>
                                        <td colspan="2" style="background-color: rgb(84,130,53);color:#ffffff;text-align: center;">COMPLETION</td>
                                        <td style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">GAP</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $d->progress['plan'] ."%";?></td>
                                        <td colspan="2" style="background-color: rgb(169,208,142);text-align: center;"><?php echo $d->progress['actual'] ."%";?></td>
                                        <td style="text-align: center;color:#ff0000;"><?php echo $d->progress['plan']-$d->progress['actual'] ."%";?></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">ACTIVITY</td>
                                        <td colspan="2" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">SCOPE</td>
                                        <td rowspan="2" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">CR <br/>(Qty)</td>
                                        <td rowspan="2" colspan="2" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">DAILY BASELINE <br/>(Qty)</td>
                                        <td colspan="2" class="text-center text-semibold" style="background-color: rgb(84,130,53);color:#ffffff;text-align: center;">COMPLETE</td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">UoM</td>
                                        <td style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">Qty</td>
                                        <td style="background-color: rgb(84,130,53);color:#ffffff;text-align: center;">QTY</td>
                                        <td style="background-color: rgb(84,130,53);color:#ffffff;text-align: center;">%</td>
                                    </tr>
                                    <?php foreach ($d->milestone as $key => $value) { ?>
                                        <tr class="text-semibold">
                                            <td colspan="10"  style="background-color: rgb(0,0,0);color:#ffffff;"><?php echo $value->group_name ?></td>
                                            <!-- <td colspan="2"></td> -->
                                        </tr>
                                        <?php foreach ($value->mil as $k => $v) { ?>
                                            <tr class="">
                                                <td><?php echo $v->milestone_name ?></td>
                                                <td style="text-align: center;"><?php echo $v->uom ?></td>
                                                <td style="text-align: center;"><?php echo number_format($v->qty); ?></td>
                                                <td style="text-align: center;"></td>
                                                <td colspan="2" style="text-align: center;"><?php echo number_format($v->daily_baseline); ?></td>
                                                <?php if (!empty($v->progress)) { ?>
                                                    <td style="text-align: center;"><?php echo number_format($v->progress->complete_qty); ?></td>
                                                    <td style="text-align: center;"><?php echo $v->progress->complete_percent ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>

            </div>

        </div>
    </div>
    <div class="col-md-2">
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

<script type="text/javascript">
    $(function () {
        $(".tab").hide();
    });

    $("#project").change(function () {
        console.log($(this).val());
        $(".tab1").hide();  
        $(".tab").hide();
        var c = ".p" + $(this).val();
        $(c).fadeIn('slow');
        var project_id = $(this).val();
        var dates = [];
        $.ajax({
                url: JS_BASE_URL + '/dailyProgressReport/daily_project_chart/',
                type: 'POST',
                data : {project_id : project_id},
                dataType: 'json',
                async: false,
                success: function (res) {
                    if(res.status == 'Success'){
                        var chart_date = [];
                        mth = 0;
                        dates = res.data.dates;
                        $.each(dates, function(key, val){
                            mth++;
                        })
                        if(mth < 3) mth = 3;
                        chart_date.push('dates');
                        $.each(res.data.date, function(key, val){
                            chart_date.push(toDate(val));
                        }); 
                        console.log((chart_date.length - 1) * 2 - 1);
                        // $.each(res.data, function(key,value){
                        var chartId = '#c3-axis-labels-'+project_id;
                        var chart = c3.generate({
                            bindto: chartId,
                            size: {
                                width: 800
                            },
                            data: {
                                x: 'dates',
                                columns: [
                                  chart_date,
                                  res.data.plan,
                                  res.data.actual,
                                  res.data.m_actual
                                ],
                                type: 'spline',
                                types: {
                                    'L Actual': 'line',
                                },
                            },

                            axis: {
                                x: {
                                    type: 'timeseries',
                                    tick: {
                                        // culling : false,
                                        count: mth,
                                        format: function (dates) { return monthName(dates.getMonth()); }
                                    }
                                }
                            },
                            tooltip: {
                                format: {
                                    title: function (d) { 

                                        var a = d.toString().substring(4); 
                                        var e = a.substring(0, 11);
                                        return e;

                                    },
                                    value: function (value, ratio, id) {
                                        var format = id === 'Baseline' ? d3.format(',') : d3.format('.');
                                        return format(value);
                                    }
                                }
                            }
                        });


                        // push the years down
                        d3.selectAll('#chart .tick text tspan')[0].forEach(function (d) {
                            var tspan = d3.select(d);
                            if (!isNaN(Number(tspan.text())))
                                tspan.attr('dy', '2em')
                            else 
                                tspan.attr('dy', '0.5em')
                        })
                        // var axis_additional = c3.generate({
                        //     bindto: chartId,
                        //       size: {
                        //         width: 800
                        //       },
                        //       data: {
                        //         x: 'Dates',
                        //         columns: [
                        //           chart_date,
                        //           res.data.plan,
                        //           res.data.actual
                        //         ]
                        //       },
                        //       axis: {
                        //         x: {
                        //           type: 'timeseries',
                        //           tick: {
                        //             culling: false,
                        //             count: (chart_date.length - 1) * 2 - 1,
                        //             format: function(d) {
                        //                 if (d.getDay() === 10) return monthName(d.get(Month));
                        //               /*// show the year in place of Jul
                        //               if (d.getDay() === 15) return d.getMonth();
                        //               // ignore other non quarter months
                        //               else if ([1, 4, 7, 10].indexOf(d.getDay()) === -1) return '';
                        //               // quarter month*/
                        //             }
                        //           }
                        //         }
                        //       }
                        //     });


                        // var $c = '#c3-axis-labels-'+project_id+' .tick text tspan';
                        // d3.selectAll($c)[0].forEach(function (d) {
                        //     var tspan = d3.select(d);
                        //     if (!isNaN(Number(tspan.text())))
                        //         tspan.attr('dy', '2em')
                        //     else 
                        //         tspan.attr('dy', '0.5em')
                        // })
                        // var axis_additional = c3.generate({
                        //     bindto: chartId,
                        //     size: { height: 300, width : 1000},
                        //     data: {
                        //         x : chart_date,
                        //         columns: [
                        //             // ['x','2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26'],
                        //             // ['Baseline', 30, 20, 50, 40, 60, 50],
                        //             chart_date,
                        //             res.data.plan,
                        //             res.data.actual,
                        //             /*res.data.cum_baseline,
                        //             res.data.cum_actual*/
                        //         ],
                        //         type: 'line',
                        //         /*types: {
                        //             'Cum. Baseline': 'line',
                        //             'Cum. Actual': 'line',
                        //         },*/
                        //         axes: {
                        //             'Baseline': 'y',
                        //             'Actual': 'y'
                        //             /*'Cum. Baseline' :'y2',
                        //             'Cum. Actual' :'y2'*/
                        //         }
                        //     },
                        //     bar: {
                        //         width: {
                        //             ratio: 0.1 // this makes bar width 50% of length between ticks
                        //         }
                        //         // or
                        //         //width: 100 // this makes bar width 100px
                        //     },
                        //     color: {
                        //         pattern : ['#FF9800', '#F44336', '#009688', '#4CAF50']
                        //     },
                        //     axis: {
                        //         /*y2: {
                        //             show: true
                        //         },*/
                        //         x: {
                        //             type: 'timeseries',
                        //             tick: {
                        //                 culling: false,
                        //                 count: (chart_date.length - 1) * 2 - 1,
                        //                 format: function (d) {
                        //                     // show the year in place of Jul
                        //                     if (d.getDay() === 15) return d.getMonth();
                        //                     // ignore other non quarter months
                        //                     else if ([1, 4, 7, 10].indexOf(d.getDay()) === -1) return '';
                        //                     // quarter month
                        //                 }
                        //             }
                        //         }
                        //     },
                        //     grid: {
                        //         y: {
                        //             show: true
                        //         }
                        //     },
                        //     /*legend: {
                        //         show: false
                        //     }*/
                        // });
                    } else {
                        var chartId = '#c3-axis-labels-'+project_id;
                        axis_additional = c3.generate({
                            // x: 'x',
                            bindto: chartId,
                            size: { height: 300, width : 600},
                            data: {
                                columns: [
                                    // ['Baseline', 30, 20, 50, 40, 60, 50],
                                    // ['Actual', 200, 130, 90, 240, 130, 220],
                                    // ['Cum. Baseline', 300, 200, 160, 400, 250, 250],
                                    // ['Cum. Actual', 200, 130, 90, 240, 130, 220],
                                ],
                                type: 'bar',
                                /*types: {
                                    'Cum. Baseline': 'line',
                                    'Cum. Actual': 'line',
                                },*/
                                axes: {
                                    'Baseline': 'y',
                                    'Actual': 'y2'
                                }
                            },
                            bar: {
                                width: {
                                    ratio: 0.1 // this makes bar width 50% of length between ticks
                                }
                                // or
                                //width: 100 // this makes bar width 100px
                            },
                            color: {
                                pattern : ['#FF9800', '#F44336', '#009688', '#4CAF50']
                            },
                            axis: {
                                y2: {
                                    show: true
                                },
                                x: {
                                    type: 'category',
                                    // categories: ['2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26']
                                }
                            },
                            grid: {
                                y: {
                                    show: true
                                }
                            }
                        });
                    }

                }
            });
        
        function toDate(string) {
          var from = string.split("-");
          return new Date(from[2], from[1] - 1, from[0]);
        }

        function monthName(index) {
            var month = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            return month[index];
        }

        function midDate(month){
            // return dates[month];
            return toDate(dates[month]);
        }

    });

    /*function toDate(string) {
      var from = string.split("-");
      return new Date(from[2], from[1] - 1, from[0]);
    }*/
</script>