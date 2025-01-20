@extends('layouts/contentNavbarLayout')

@section('title', 'Organization - List')

@section('content')
{{--    <script src="{{ asset('orgchart/orgchart.js') }}"></script>--}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

{{--    <div id="tree"></div>--}}
    <div id="chart_div"></div>

    <script type="text/javascript">
        google.charts.load('current', {packages:["orgchart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Manager');
            data.addColumn('string', 'ToolTip');

            // Dynamic organization data from server
            var orgData = {!! $orgData !!};

            // Convert PHP orgData to rows for Google Charts
            var rows = orgData.map(function(item) {
                return [
                    {v: item.v, f: item.f},
                    item.manager,
                    item.tooltip
                ];
            });

            // Add rows to chart data
            data.addRows(rows);

            // Create the chart.
            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
            // Draw the chart, setting the allowHtml option to true for the tooltips.
            chart.draw(data, {'allowHtml':true});
        }
        /*document.addEventListener("DOMContentLoaded", function () {
            const chart = new OrgChart(document.getElementById("tree"), {
                mouseScrool: OrgChart.action.ctrlZoom, // Allows zooming with mouse scroll while holding Ctrl
                template: "isla", // Template style for the chart
                searchDisplayField: 'name',
                searchFieldsWeight: {
                    "name": 20, // Search weight for 'name'
                    "manager": 100 // Search weight for 'manager'
                },
                editForm: {
                    buttons: {
                        share: {
                            icon: OrgChart.icon.share(24, 24, '#fff'),
                            text: 'Share'
                        },
                        pdf: {
                            icon: OrgChart.icon.pdf(24, 24, '#fff'),
                            text: 'Save as PDF'
                        },
                        edit: null,
                        remove: null
                    }
                },
                nodeBinding: {
                    field_0: "name",
                    field_1: "title",
                    img_0: "img"
                },
            });

            // Load the organization data via AJAX
            fetch("{{ route('organization.data') }}")
                .then(response => response.json())
                .then(data => {
                    chart.load(data);
                })
                .catch(error => console.error('Error loading organization data:', error));
        });*/
    </script>
@endsection