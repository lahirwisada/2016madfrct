<?php
$terbayar_perbulan = isset($terbayar_perbulan) ? $terbayar_perbulan : "[]";
$pendaftar_perbulan = isset($pendaftar_perbulan) ? $pendaftar_perbulan : "[]";
$var_bulan = isset($var_bulan) ? $var_bulan : "[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]";
?>

<script type="text/javascript">

    var plot = {
        data_series: {data: null, label: 'Label'},
        plot_setting: {
            series: {
                lines: {
                    show: true,
                    lineWidth: 1.5,
                    fill: 0.05
                },
                points: {
                    show: true
                },
                shadowSize: 0
            },
            grid: {
                labelMargin: 10,
                hoverable: true,
                clickable: true,
                borderWidth: 0
            },
            colors: ["#71a5e7"],
            xaxis: {
                tickColor: "transparent",
                ticks: <?php echo $var_bulan; ?>,
                tickDecimals: 0,
                autoscaleMargin: 0,
                font: {
                    color: '#8c8c8c',
                    size: 12
                }
            },
            yaxis: {
                ticks: 4,
                tickDecimals: 0,
                tickColor: "#e3e4e6",
                font: {
                    color: '#8c8c8c',
                    size: 12
                },
                tickFormatter: function (val, axis) {
                    if (val > 999999) {
                        return (val / 1000000) + " Jt";
                    } else if (val > 999) {
                        return (val / 1000) + " Rb";
                    } else {
                        return val;
                    }
//                return val;
                }
            },
            legend: {
                labelBoxBorderColor: 'transparent'
            }
        },
        create_plot: function (element, data_series, label_series) {
            plot.data_series.data = data_series;
            plot.data_series.label = label_series
            return $.plot(element, [plot.data_series], plot.plot_setting);
        },
        init: function(){
            this.create_plot($("#plot-pendapatan"), <?php echo $terbayar_perbulan; ?>, 'Pendapatan');
            this.create_plot($("#plot-penghuni"), <?php echo $pendaftar_perbulan; ?>, 'Pendaftar');
        }
    };

    $(document).ready(function () {
        plot.init();
    });
</script>


