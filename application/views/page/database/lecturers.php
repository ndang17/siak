
<style>
    #tableLecturer th {
        text-align: center;
    }
</style>

<div class="widget-content no-padding">

    <div class="table-responsive">
        <table id="tableLecturer" class="table table-striped table-bordered table-hover table-responsive">
            <thead>
            <tr>
                <th style="width: 30%;">Lecturer</th>
                <th style="width: 3%;">JK</th>
                <th style="width: 15%;">Prodi</th>
                <th style="width: 10%;">action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Lecturer</th>
                <th>JK</th>
                <th>Prodi</th>
                <th>action</th>
            </tr>
            </tfoot>
            <tbody id="data_body">

            </tbody>
        </table>

    </div>

</div>

<script>
    $(document).ready(function () {
       load_lecturers();
    });
    function load_lecturers() {
        var url = base_url_js+'api/__getLecturer';
        var tr = $('#data_body');
        $.get(url,function (data) {
            tr.append('<tr>' +
                '<td>' +
                '<div class="row">' +
                '<div class="col-md-3 col-md-push-9"><img src="https://img.faceyourmanga.com/mangatars/0/0/39/normal_511.png" style="max-width: 50px;"></div> ' +
                '<div class="col-md-9 col-md-pull-3">' +
                '<b>Nandang Mulyadi</b><br/>' +
                '<i>A11.2012.07197</i>' +
                '</div> ' +
                '</div> ' +
                '</td>' +
                '</tr>');
        });

    }
</script>