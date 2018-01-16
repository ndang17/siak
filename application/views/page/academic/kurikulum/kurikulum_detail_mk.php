

<style>
    .td-center, #tableMK th {
        text-align: center;
    }
    .name-eng {
        font-style: italic;
        color: #737373;
    }
</style>

<div class="widget box animated fadeInRight">
    <div class="widget-header">
        <h4><i class="fa fa-th-list" aria-hidden="true"></i> Daftar Mata Kuliah</h4>

        <div class="toolbar no-padding">
            <div class="btn-group">
                <span class="btn btn-xs"><i class="icon-plus"></i> Add</span>
                <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown"
                <i class="fa fa-print" aria-hidden="true"></i> Download
                </span>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> CSV</a></li>
                    <li><a href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="widget-content no-padding" style="display: block;">
        <table id="tableMK" class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
            <thead>
            <tr>
                <th>No</th>
                <th>Prodi</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Smt</th>
                <th>SKS</th>
                <th>#</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Prodi</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Smt</th>
                <th>SKS</th>
                <th>#</th>
            </tr>
            </tfoot>
            <tbody>
            <?php $no=1; foreach ($data_json['mk'] as $item_mk) { ?>
                <tr>
                    <td class="td-center"><?php echo $no; ?></td>
                    <td data-select="<?php echo $item_mk['ProdiName']; ?>">
                        <strong><?php echo $item_mk['ProdiName']; ?></strong>
                        <br/>
                        <span class="name-eng"><?php echo $item_mk['ProdiNameEng']; ?></span>
                    </td>
                    <td class="td-center"><?php echo $item_mk['MKCode']; ?></td>
                    <td>
                        <strong><?php echo $item_mk['NameMK']; ?></strong>
                        <br/>
                        <span class="name-eng"><?php echo $item_mk['NameMKEng']; ?></span>
                        <br/>
                        <span style="color: #056a77;"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $item_mk['NameLecturer']; ?></span>
                    </td>
                    <td class="td-center"><?php echo $item_mk['Semester']; ?></td>
                    <td class="td-center"><?php echo $item_mk['TotalSKS']; ?></td>
                    <td class="td-center"><button class="btn btn-default btn-default-danger btn-sm bs-tooltip"
                                                  data-placement="left"
                                                  data-original-title="Hapus dari daftar kurikulum"><i class="fa fa-trash-o" aria-hidden="true"></i></button> </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tableMK').DataTable({
            'iDisplayLength' : 25,
            'scrollY' : '700px'
        });
        $('.bs-tooltip').tooltip();


    });
</script>