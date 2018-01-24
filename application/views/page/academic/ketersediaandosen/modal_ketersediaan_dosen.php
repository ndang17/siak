
<?php

$day = ['Monday','Tuesday','Wednesday','Thursday','Friday'];

foreach ($dataDosen as $item){ ?>
<table class="table table-bordered table-striped">
    <tr>
        <td style="width: 20%;">Semester</td>
        <td>
            <b><?php echo $item['Semester']; ?></b>
        </td>
    </tr>
    <tr>
        <td>Lecturer</td>
        <td>
            <select class="select2-select-00 col-md-12 full-width-fix" id="modalDataLecturer">
                <option></option>
            </select>
<!--            <input class="form-control" value="--><?php //echo $item['NameLecturer']; ?><!--"/>-->
        </td>
    </tr>
    <tr>
        <td>Mata Kuliah</td>
        <td>
            <select class="select2-select-00 col-md-12 full-width-fix" id="modalDataMK">
                <option></option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Date</td>
        <td>
            <select class="form-control" id="modalDate" style="max-width: 150px;"></select>
        </td>
    </tr>
    <tr>
        <td>Start</td>
        <td>
            <input type="time" class="form-control" value="<?php echo $item['Start']; ?>" style="max-width: 150px;" />
        </td>
    </tr>
    <tr>
        <td>End</td>
        <td>
            <input type="time" class="form-control" value="<?php echo $item['End']; ?>" style="max-width: 150px;" />
        </td>
    </tr>

</table>
<?php } ?>

<script>
    $(document).ready(function () {
        var selected = '<?php echo $dataDosen[0]['MKID'].'.'.$dataDosen[0]['MKCode']; ?>';
        var selectedLec = '<?php echo $dataDosen[0]['NIP']; ?>';

        var DayID = '<?php echo $item['DayID']; ?>';
        loadSelectOptionAllMataKuliahSingle('#modalDataMK',selected);
        loadSelectOptionLecturersSingle('#modalDataLecturer',selectedLec);

        $('#modalDataMK, #modalDataLecturer').select2();

        fillDays('#modalDate','Eng',DayID);
    });
</script>
