$(document).ready(function() {
    "use strict";
    // ============================================================== 
    // Current week scores per branch
    // ============================================================== 
    var weekScores = [];
    for(var x in week_scores)
        weekScores.push(week_scores[x].score);
    var weekBranchs = [];
    for(var y in week_scores)
        weekBranchs.push(week_scores[y].branch);  

    new Chartist.Bar('.curwscores', {
        labels: weekBranchs ,
        series: [ weekScores ]
    }, {
        stackBars: true,
        axisY: {
            labelInterpolationFnc: function(value) {
                return (value / 1);
            }
        },
        axisX: {
            showGrid: true
        },
        plugins: [
            Chartist.plugins.tooltip()
        ],
        seriesBarDistance: 1,
        chartPadding: {
            top: 10,
            right: 5,
            bottom: 0,
            left: 0
        }
    }).on('draw', function(data) {
        if (data.type === 'bar') {
            data.element.attr({
                style: 'stroke-width: 25px'
            });
        }
    });
   var chart = [chart];
   
   // ============================================================== 
    // Current week scores per branch
    // ============================================================== 
    var monthScores = [];
    for(var x in month_scores)
        monthScores.push(month_scores[x].score);
    var monthBranchs = [];
    for(var y in month_scores)
        monthBranchs.push(month_scores[y].branch);  

    new Chartist.Bar('.curmscores', {
        labels:  monthBranchs ,
        series: [ monthScores ]
    }, {
        stackBars: true,
        axisY: {
            labelInterpolationFnc: function(value) {
                return (value / 1);
            }
        },
        axisX: {
            showGrid: true
        },
        plugins: [
            Chartist.plugins.tooltip()
        ],
        seriesBarDistance: 1,
        chartPadding: {
            top: 10,
            right: 5,
            bottom: 0,
            left: 0
        }
    }).on('draw', function(data) {
        if (data.type === 'bar') {
            data.element.attr({
                style: 'stroke-width: 25px'
            });
        }
    });
   var chart = [chart];
    // ============================================================== 
    // Last 12 months Result
    // ==============================================================
    var l_12m_g = Morris.Area({
        element: '12monthresult',
        data: last_12m_data,
        lineColors: ['#d81159', '#ffc6ff'],
        xkey: 'month',
        ykeys: ['polls', 'score'],
        labels: ['Polls', 'Scores'],
        pointSize: 0,
        lineWidth: 0,
        resize: true,
        fillOpacity: 1,
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        hideHover: 'auto',
        parseTime: false

    });
    
    var scores_4m = [];
    for(var x in last_4m_data)
        scores_4m.push(last_4m_data[x].score);
    var polls_4m = [];
    for(var y in last_4m_data)
        polls_4m.push(last_4m_data[y].polls);  
    
    // ============================================================== 
    // Last 4 Months Score
    // ============================================================== 
    new Chartist.Bar('.last4scores', {
        labels: ['Last 4th', 'Last 3rd', 'Last 2nd', 'Previous'],
        series: [ scores_4m ]
    }, {
        stackBars: true,
        axisY: {
            labelInterpolationFnc: function(value) {
                return (value / 1);
            }
        },
        axisX: {
            showGrid: true
        },
        plugins: [
            Chartist.plugins.tooltip()
        ],
        seriesBarDistance: 1,
        chartPadding: {
            top: 10,
            right: 5,
            bottom: 0,
            left: 0
        }
    }).on('draw', function(data) {
        if (data.type === 'bar') {
            data.element.attr({
                style: 'stroke-width: 65px'
            });
        }
    });
   var chart = [chart];
    // ============================================================== 
    // Last 4 months polls
    // ============================================================== 
    var chart = c3.generate({
        bindto: '#last4polls',
        data: {
            columns: [
                ['4th month', polls_4m[0]],
                ['3rd month', polls_4m[1]],
                ['2nd month', polls_4m[2]],
                ['1st month', polls_4m[3]],
            ],

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: "Ratio",
            width: 35,

        },

        legend: {
            hide: true
                // or hide: 'data1'
                // or hide: ['data1', 'data2']

        },
        color: {
            pattern: ['#15b7b9', '#ff5a1d', '#8a2be2', '#f7347a']
        }
    });
    $("#branch_list").on('change', function() {
        var branch = $(this).val();
        var agent = null;
        $.ajax({
            type: 'POST',
            url : base_url + '/user/get_info_by_filter',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
                branch_id: branch,
                agent_id: agent
            },
            success: function(response) {
                var agents = response.agents;
                var today_result = response.today_result;
                var week_result = response.week_result;
                var month_result = response.month_result;
                var cm_result = response.cm_result;
                var emp_score = response.emp_score;
                var ser_score = response.ser_score;
                var env_score = response.env_score;
                var active_users = response.active_agents;
                var l_12m_data = response.last_12months_result;
                var l_4m_data = response.last_4months_result;
                var top3_employees = response.top3_employees;
                var bottom3_employees = response.bottom3_employees;
                var html = "<option value=''>Select Agent Here</option>";
                for(var i=0; i<agents.length; i++) {
                    html += '<option value="'+ agents[i].id +'">'+ agents[i].firstName + agents[i].lastName +'</option>'
                }
                
                $("#agent_list").html(html);
                $("#today_result_cnt").text(today_result[0]);
                $("#today_result_avg").text(today_result[1]);
                $("#week_result_cnt").text(week_result[0]);
                $("#week_result_avg").text(week_result[1]);
                $("#month_result_cnt").text(month_result[0]);
                $("#month_result_avg").text(month_result[1]);
                $("#cm_result_cnt").text(cm_result[0]);
                $("#cm_result_avg").text(cm_result[1]);
                $("#emp_score").text(emp_score);
                $("#ser_score").text(ser_score);
                $("#env_score").text(env_score);
                if(active_users != 0) {
                    $("#active_agents").text(active_users);
                }
                else {
                    $("#active_agents").text(0);
                }
                l_12m_g.setData(l_12m_data);
                var scores_4m_u = []
                for(var x in l_4m_data)
                    scores_4m_u.push(l_4m_data[x].score);
                // l_4m_s.series = scores_4m_u; 
                // l_4m_s.series.update(l_4m_data);
                new Chartist.Bar('.last4scores', {
                        labels: ['Last 4th', 'Last 3rd', 'Last 2nd', 'Previous'],
                        series: [
                            scores_4m_u,
                        ]
                    }, {
                        stackBars: true,
                        axisY: {
                            labelInterpolationFnc: function(value) {
                                return (value / 1);
                            }
                        },
                        axisX: {
                            showGrid: true
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ],
                        seriesBarDistance: 1,
                        chartPadding: {
                            top: 10,
                            right: 5,
                            bottom: 0,
                            left: 0
                        }
                    }).on('draw', function(data) {
                        if (data.type === 'bar') {
                            data.element.attr({
                                style: 'stroke-width: 65px'
                            });
                        }
                    });
                var chart = [chart];

                var polls_4m_u = [];
                for(var y in l_4m_data)
                    polls_4m_u.push(l_4m_data[y].polls);
                $("#last_4th_month").text(polls_4m_u[0]);
                $("#last_3rd_month").text(polls_4m_u[0]);
                $("#last_2nd_month").text(polls_4m_u[0]);
                $("#previous_month").text(polls_4m_u[0]);

                c3.generate({
                bindto: '#last4polls',
                data: {
                    columns: [
                        ['4th month', polls_4m_u[0]],
                        ['3rd month', polls_4m_u[1]],
                        ['2nd month', polls_4m_u[2]],
                        ['1st month', polls_4m_u[3]],
                    ],

                    type: 'donut',
                    tooltip: {
                        show: true
                    }
                },
                donut: {
                    label: {
                        show: false
                    },
                    title: "Ratio",
                    width: 35,

                },

                legend: {
                    hide: true
                        // or hide: 'data1'
                        // or hide: ['data1', 'data2']

                },
                color: {
                    pattern: ['#15b7b9', '#ff5a1d', '#8a2be2', '#f7347a']
                }
            });

            var top3_emps = "<tr><th class='border-top-0'>Name</th><th class='border-top-0'>Polls</th><th class='border-top-0'>Average Score</th>";
            for(var i=0; i<top3_employees.length; i++) {
                top3_emps += "<tr><td <span class='text-success'>";
                top3_emps += top3_employees[i]['name'];
                top3_emps += "</span></td>";
                top3_emps += "<td><span class='font-medium text-success'>";
                top3_emps += top3_employees[i]['polls'];
                top3_emps += "</span></td>";
                top3_emps += "<td><span class='text-success'>";
                top3_emps += top3_employees[i]['score'];
                top3_emps += "</span></td></tr>";
            }
            $("#top3_employess").html("");
            $("#top3_employess").html(top3_emps);
            var bottom3_emps = "<tr><th class='border-top-0'>Name</th><th class='border-top-0'>Polls</th><th class='border-top-0'>Average Score</th>";
            for(var i=0; i<bottom3_employees.length; i++) {
                bottom3_emps += "<tr><td <span class='text-success'>";
                bottom3_emps += bottom3_employees[i]['name'];
                bottom3_emps += "</span></td>";
                bottom3_emps += "<td><span class='font-medium text-success'>";
                bottom3_emps += bottom3_employees[i]['polls'];
                bottom3_emps += "</span></td>";
                bottom3_emps += "<td><span class='text-success'>";
                bottom3_emps += bottom3_employees[i]['score'];
                bottom3_emps += "</span></td></tr>";
            }
            $("#bottom3_employees").html("");
            $("#bottom3_employees").html(bottom3_emps);
            }
        })
    })

    $("#agent_list").on('change', function() {
        var agent = $(this).val();
        var branch = $("#branch_list").val();
        $.ajax({
            type: 'POST',
            url : base_url + '/user/get_info_by_filter',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
                branch_id: branch,
                agent_id: agent
            },
            success: function(response) {
                var agents = response.agents;
                var today_result = response.today_result;
                var week_result = response.week_result;
                var month_result = response.month_result;
                var cm_result = response.cm_result;
               
                var emp_score = response.emp_score;
                var ser_score = response.ser_score;
                var env_score = response.env_score;
                var active_users = response.active_agents;
                var l_12m_data = response.last_12months_result;
                var l_4m_data = response.last_4months_result;
                
                var top3_employees = response.top3_employees;
                var bottom3_employees = response.bottom3_employees;
                var html = "<option value=''>Select Agent Here</option>";
                for(var i=0; i<agents.length; i++) {
                    html += '<option value="'+ agents[i].id +'">'+ agents[i].firstName + agents[i].lastName +'</option>'
                }
                
                $("#agent_list").html(html);
                $("#today_result_cnt").text(today_result[0]);
                $("#today_result_avg").text(today_result[1]);
                $("#week_result_cnt").text(week_result[0]);
                $("#week_result_avg").text(week_result[1]);
                $("#month_result_cnt").text(month_result[0]);
                $("#month_result_avg").text(month_result[1]);
                $("#cm_result_cnt").text(cm_result[0]);
                $("#cm_result_avg").text(cm_result[1]);
                $("#emp_score").text(emp_score);
                $("#ser_score").text(ser_score);
                $("#env_score").text(env_score);
                if(active_users != 0) {
                    $("#active_agents").text(active_users);
                }
                else {
                    $("#active_agents").text(0);
                }
                l_12m_g.setData(l_12m_data);
                var scores_4m_u = []
                for(var x in l_4m_data)
                    scores_4m_u.push(l_4m_data[x].score);
                // l_4m_s.series = scores_4m_u; 
                // l_4m_s.series.update(l_4m_data);
                new Chartist.Bar('.last4scores', {
                        labels: ['Last 4th', 'Last 3rd', 'Last 2nd', 'Previous'],
                        series: [
                            scores_4m_u,
                        ]
                    }, {
                        stackBars: true,
                        axisY: {
                            labelInterpolationFnc: function(value) {
                                return (value / 1);
                            }
                        },
                        axisX: {
                            showGrid: true
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ],
                        seriesBarDistance: 1,
                        chartPadding: {
                            top: 10,
                            right: 5,
                            bottom: 0,
                            left: 0
                        }
                    }).on('draw', function(data) {
                        if (data.type === 'bar') {
                            data.element.attr({
                                style: 'stroke-width: 65px'
                            });
                        }
                    });
                var chart = [chart];

                var polls_4m_u = [];
                for(var y in l_4m_data)
                    polls_4m_u.push(l_4m_data[y].polls);
                $("#last_4th_month").text(polls_4m_u[0]);
                $("#last_3rd_month").text(polls_4m_u[0]);
                $("#last_2nd_month").text(polls_4m_u[0]);
                $("#previous_month").text(polls_4m_u[0]);

                c3.generate({
                bindto: '#last4polls',
                data: {
                    columns: [
                        ['4th month', polls_4m_u[0]],
                        ['3rd month', polls_4m_u[1]],
                        ['2nd month', polls_4m_u[2]],
                        ['1st month', polls_4m_u[3]],
                    ],

                    type: 'donut',
                    tooltip: {
                        show: true
                    }
                },
                donut: {
                    label: {
                        show: false
                    },
                    title: "Ratio",
                    width: 35,

                },

                legend: {
                    hide: true
                        // or hide: 'data1'
                        // or hide: ['data1', 'data2']

                },
                color: {
                    pattern: ['#15b7b9', '#ff5a1d', '#8a2be2', '#f7347a']
                }
            });

            var top3_emps = "<tr><th class='border-top-0'>Name</th><th class='border-top-0'>Polls</th><th class='border-top-0'>Average Score</th>";
            for(var i=0; i<top3_employees.length; i++) {
                top3_emps += "<tr><td <span class='text-success'>";
                top3_emps += top3_employees[i]['name'];
                top3_emps += "</span></td>";
                top3_emps += "<td><span class='font-medium text-success'>";
                top3_emps += top3_employees[i]['polls'];
                top3_emps += "</span></td>";
                top3_emps += "<td><span class='text-success'>";
                top3_emps += top3_employees[i]['score'];
                top3_emps += "</span></td></tr>";
            }
            $("#top3_employess").html("");
            $("#top3_employess").html(top3_emps);
            var bottom3_emps = "<tr><th class='border-top-0'>Name</th><th class='border-top-0'>Polls</th><th class='border-top-0'>Average Score</th>";
            for(var i=0; i<bottom3_employees.length; i++) {
                bottom3_emps += "<tr><td <span class='text-success'>";
                bottom3_emps += bottom3_employees[i]['name'];
                bottom3_emps += "</span></td>";
                bottom3_emps += "<td><span class='font-medium text-success'>";
                bottom3_emps += bottom3_employees[i]['polls'];
                bottom3_emps += "</span></td>";
                bottom3_emps += "<td><span class='text-success'>";
                bottom3_emps += bottom3_employees[i]['score'];
                bottom3_emps += "</span></td></tr>";
            }
            $("#bottom3_employees").html("");
            $("#bottom3_employees").html(bottom3_emps);
            }
        })
    })
});
