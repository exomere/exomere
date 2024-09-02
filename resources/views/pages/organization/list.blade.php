@extends('layouts/contentNavbarLayout')

@section('title', 'Organization - List')

@section('content')
    <script src="{{ asset('orgchart/OrgChart.js') }}"></script>

    <div id="tree"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
        });
    </script>
@endsection