<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/c3/c3.min.js"></script>
<!-- Bordered striped table -->
<div class="row">
    <?php foreach ($project as $i => $d) { ?>
        <div class="col-md-10">
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

                    <div class="row tab p<?php echo $d->id ?>">
                        <div class="table-responsive">
                            <table class="" style="font-weight: bold; width: 1300px">
                                <thead class="bg-info-800">
                                <tr>
                                    <th rowspan="2" colspan="3" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">PROJECT NAME</th>
                                    <th rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">CUSTOMER</th>
                                    <th rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">PL Start</th>
                                    <th rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">PL Finish</th>
                                    <th rowspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">CAPACITY</th>
                                    <th colspan="2" class="text-center" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;">OVERALL PROGRESS</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="3" style="padding: 8px 20px;"><?php echo $d->project_name ?></td>
                                    <td style="padding: 8px 20px;text-align: center;"><?php echo $d->customer ?></td>
                                    <td style="padding: 8px 20px;text-align: center;"><?php echo $d->start_date ?></td>
                                    <td style="padding: 8px 20px;text-align: center;"><?php echo $d->end_date ?></td>
                                    <td style="padding: 8px 20px;text-align: center;"><?php echo $d->capacity ?></td>
                                    <td style="padding: 8px 20px;text-align: center;"><?php echo $d->completion . "%" ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="width:500px;padding: 8px 20px;background-color: rgb(255,0,0);color:#ffffff;text-align: center;">IMPORTANT REMARKS</td>
                                    <td rowspan="4" colspan="4" style="width:800px;padding: 8px 20px;vertical-align: bottom;height: 400px">
                                        <div class="chart-container"">
                                            <div class="chart emp" id="c3-axis-labels-<?php echo $d->id;?>"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding: 8px 20px;vertical-align: top;height: 300px">
                                        <?php if (!empty($d->milestone[0]->mil)) {
                                            if (!empty($d->milestone[0]->mil[0]->progress)) {
                                                ?>
                                                <p><?php echo $d->milestone[0]->mil[0]->progress->remark; ?></p>

                                            <? } else {
                                                echo "<p>-</p>";
                                            }
                                        } else {
                                            echo "<p>-</p>";
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">BASELINE</td>
                                    <td colspan="2" style="padding: 8px 20px;background-color: rgb(84,130,53);color:#ffffff;text-align: center;">COMPLETION</td>
                                    <td style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">GAP</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 20px;text-align: center;"><?php echo $d->baseline ."%";?></td>
                                    <td colspan="2" style="padding: 8px 20px;background-color: rgb(169,208,142);text-align: center;"><?php echo $d->completion ."%";?></td>
                                    <td style="padding: 8px 20px;text-align: center;color:#ff0000;"><?php echo $d->baseline-$d->completion ."%";?></td>
                                </tr>
                                <tr>
                                    <td rowspan="2" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">ACTIVITY</td>
                                    <td colspan="2" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">SCOPE</td>
                                    <td rowspan="2" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">CR <br/>(Qty)</td>
                                    <td rowspan="2" colspan="2" style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">DAILY BASELINE <br/>(Qty)</td>
                                    <td colspan="2" style="padding: 8px 20px;background-color: rgb(84,130,53);color:#ffffff;text-align: center;">COMPLETE</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">UoM</td>
                                    <td style="padding: 8px 20px;background-color: rgb(31,78,120);color:#ffffff;text-align: center;">Qty</td>
                                    <td style="padding: 8px 20px;background-color: rgb(84,130,53);color:#ffffff;text-align: center;">QTY</td>
                                    <td style="padding: 8px 20px;background-color: rgb(84,130,53);color:#ffffff;text-align: center;">%</td>
                                </tr>
                                <?php foreach ($d->milestone as $key => $value) { ?>
                                    <tr class="text-semibold">
                                        <td colspan="10" style="padding: 8px 20px;background-color: rgb(0,0,0);color:#ffffff;"><?php echo $value->group_name ?></td>
                                        <!-- <td colspan="2"></td> -->
                                    </tr>
                                    <?php foreach ($value->mil as $k => $v) { ?>
                                        <tr class="">
                                            <td style="padding: 8px 20px;"><?php echo $v->milestone_name ?></td>
                                            <td style="padding: 8px 20px;text-align: center;"><?php echo $v->uom; ?></td>
                                            <td style="padding: 8px 20px;text-align: center;"><?php echo number_format($v->qty); ?></td>
                                            <td style="text-align: center;"><?php if($v->cr_qty >= 1000)  { echo number_format($v->cr_qty, 2);} else {echo $v->cr_qty;}?></td>
                                            <td colspan="2" style="text-align: center;"><?php if($v->daily_baseline >= 1000)  { echo number_format($v->daily_baseline, 2);} else {echo $v->daily_baseline;}?></td>
                                            <!-- <td colspan="2" style="padding: 8px 20px;text-align: center;"><?php echo number_format($v->daily_baseline); ?></td> -->
                                            <?php if (!empty($v->progress)) { ?>
                                                <td style="padding: 8px 20px;text-align: center;"><?php echo number_format($v->progress->complete_qty); ?></td>
                                                <td style="padding: 8px 20px;text-align: center;"><?php echo $v->progress->complete_percent ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>

                </div>
                
            </div>
        </div>
        <div class="col-md-2">
        </div>
    <?php } ?>
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
            
            
            var e = 0;
            var axis_additional = [];
            $('.emp').each(function( index ) {
                chartId = '#'+$(this).attr('id');
                axis_additional[index] = c3.generate({
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
                        /*axes: {
                            'Baseline': 'y',
                            'Actual': 'y2'
                        }*/
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
                        /*y2: {
                            show: true
                        },*/
                        x: {
                            type: 'category',
                            categories: ['2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26']
                        }
                    },
                    grid: {
                        y: {
                            show: true
                        }
                    }
                });
                e++;
            });

            $.ajax({
                url: JS_BASE_URL + '/dailyProgressReport/national_progress_chart/',
                type: 'GET',
                dataType: 'json',
                async: false,
                success: function (res) {
                    if(res.status == 'Success'){
                        $.each(res.data, function(key,value){
                            console.log(value);
                            var chart_date = [];
                            var daily = [];
                            mth = 0;
                            dates = value.date2;
                            daily.push('daily');
                            $.each(dates, function(key, val){
                                daily.push(val);
                                mth++;
                            })
                            if(mth < 3) mth = 3;
                            chart_date.push('dates');
                            $.each(value.date, function(key, val){
                                chart_date.push(val);
                            });

                            var chartId = '#c3-axis-labels-'+key;
                            axis_additional[e] = c3.generate({
                                bindto: chartId,
                                size: { height: 300, width : 700},
                                data: {
                                    xs: {
                                        'Actual': 'daily',
                                        'Plan': 'dates',
                                    },
                                    columns: [
                                        chart_date,
                                        daily,
                                        value.plan,
                                        value.d_actual
                                    ],
                                    type: 'spline',
                                },
                                color: {
                                    pattern : ['#FF9800', '#F44336', '#009688', '#4CAF50']
                                },
                                axis: {
                                    x: {
                                        type: 'timeseries',
                                        tick: {
                                            culling: {
                                                max: 1
                                            },
                                            format: function (chart_date) {
                                                if(chart_date.getDate() == 1){
                                                    var y = chart_date.getFullYear();
                                                    var e = y.toString();
                                                    e = e.substring(2,4);
                                                    return monthName(chart_date.getMonth()) +'-'+ e; 
                                                } else {
                                                    return "";
                                                }
                                            },
                                            rotate: 45,
                                            multiline: false
                                        },
                                    }
                                },
                                tooltip: {
                                    format: {
                                        title: function (d) { 

                                            var a = d.toString().substring(4); 
                                            var e = a.substring(0, 11);
                                            return e;

                                        },
                                        /*value: function (value, ratio, id) {
                                            var format = id === 'Baseline' ? d3.format(',') : d3.format('.');
                                            return format(value);
                                        }*/
                                    }
                                }
                            });
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
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Okt',
                    'Nov',
                    'Des'
                ];

                return month[index];
            }

            // $.ajax({
            //     url: JS_BASE_URL + '/dailyProgressReport/get_charts2/',
            //     type: 'GET',
            //     dataType: 'json',
            //     async: false,
            //     success: function (res) {
            //         if(res.status == 'Success'){
            //             console.log(res.data);
            //             $.each(res.data, function(key,value){
            //                 var chartId = '#c3-axis-labels-'+key;
            //                 axis_additional[e] = c3.generate({
            //                 bindto: chartId,
            //                 size: { height: 300, width : 700},
            //                 data: {
            //                     columns: [
            //                         // ['x','2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26'],
            //                         // ['Baseline', 30, 20, 50, 40, 60, 50],
            //                         value.plan,
            //                         value.actual,
            //                         /*value.cum_baseline,
            //                         value.cum_actual*/
            //                     ],
            //                     type: 'line',
            //                     /*types: {
            //                         'Cum. Baseline': 'line',
            //                         'Cum. Actual': 'line',
            //                     },*/
            //                     axes: {
            //                         'Baseline': 'y',
            //                         'Actual': 'y',
            //                         'Cum. Baseline' :'y2',
            //                         'Cum. Actual' :'y2'
            //                     }
            //                 },
            //                 bar: {
            //                     width: {
            //                         ratio: 0.1 // this makes bar width 50% of length between ticks
            //                     }
            //                     // or
            //                     //width: 100 // this makes bar width 100px
            //                 },
            //                 color: {
            //                     pattern : ['#FF9800', '#F44336', '#009688', '#4CAF50']
            //                 },
            //                 axis: {
            //                     y2: {
            //                         show: true
            //                     },
            //                     x: {
            //                         type: 'category',
            //                         categories: value.date,
            //                         /*tick: {
            //                             rotate: 45,
            //                             multiline: false
            //                         },
            //                         height: 130*/
            //                     }
            //                 },
            //                 grid: {
            //                     y: {
            //                         show: true
            //                     }
            //                 }
            //             });
            //             });
            //         }

            //     }
            // });
           
            


            /*axis_additional[1] = c3.generate({
                bindto: '#c3-axis-labels-6',
                size: { height: 200 },
                data: {
                    columns: [
                        ['Baseline', 30, 200, 100, 400],
                        ['Actual', 90, 100, 140, 200],
                        ['Cum. Baseline', 130, 200, 150, 350],
                        ['Cum. Actual', 190, 180, 190, 140],
                    ],
                    type: 'bar',
                    types: {
                        'Cum. Baseline': 'line',
                        'Cum. Actual': 'line',
                    },
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
                    }
                },
                grid: {
                    y: {
                        show: true
                    }
                }
            });*/
        });
    </script>
