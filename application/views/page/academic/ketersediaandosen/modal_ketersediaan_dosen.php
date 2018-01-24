
<?php

$day = ['Monday','Tuesday','Wednesday','Thursday','Friday'];

foreach ($dataDosen as $item){ ?>
    <input type="hide" value="<?php echo $item['SemesterID'] ?>" class="hide" id="SemesterID" />
    <input type="hide" value="<?php echo $item['laID'] ?>" class="hide" id="laID" />
    <input type="hide" value="<?php echo $item['ladID'] ?>" class="hide" id="ladID" />
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
                <b><?php echo $item['NIP'].' | '.$item['NameLecturer']; ?></b>
            </td>
        </tr>
        <tr>
            <td>Mata Kuliah</td>
            <td>
                <b><?php echo $item['MKCode'].' | '.$item['NameMK']; ?></b>
            </td>
        </tr>
        <tr>
            <td>Date</td>
            <td>
                <select class="form-control form-modal" id="modalDate" style="max-width: 150px;"></select>
            </td>
        </tr>
        <tr>
            <td>Start</td>
            <td>
                <input type="time" class="form-control form-modal" id="modalStart" value="<?php echo $item['Start']; ?>" style="max-width: 150px;" />
            </td>
        </tr>
        <tr>
            <td>End</td>
            <td>
                <input type="time" class="form-control form-modal" id="modalEnd" value="<?php echo $item['End']; ?>" style="max-width: 150px;" />
            </td>
        </tr>

    </table>
<?php } ?>

<script>
    $(document).ready(function () {
        var DayID = '<?php echo $item['DayID']; ?>';
        fillDays('#modalDate','Eng',DayID);
    });

    $(document).on('click','#modalBtnEdit',function () {

        var prosess = true;

        var DayID = $('#modalDate').find(":selected").val();
        var tStart = $('#modalStart').val();
        prosess = formRequired('#modalStart',tStart);
        var tEnd = $('#modalEnd').val();
        prosess = formRequired('#modalEnd',tEnd);

        if(prosess) {
            var SemesterID = $('#SemesterID').val();
            var ladID = $('#ladID').val();
            var data = {
                action : 'edit',
                ladID : ladID,
                dataForm_lad : {
                    DayID : DayID,
                    Start : tStart,
                    END : tEnd
                }
            };

            loading_button('#modalBtnEdit');
            $('#modalBtnClose, #modalBtnDelete, .form-modal').prop('disabled',true);
            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+"api/__setLecturersAvailability";
            $.post(url,{token:token},function (result) {
                page_detailDosen(SemesterID);
                setTimeout(function () {
                    toastr.success('Data tersimpan','Success');
                    $('#modalBtnEdit').html('Save');
                    $('#modalBtnEdit, #modalBtnClose, #modalBtnDelete, .form-modal').prop('disabled',false);
                },2000);

            });
            

        } else {
            toastr.error('Form Required','Error!!');
        }
    });

    $(document).on('click','#modalBtnDelete',function () {
        if (window.confirm('Hapus Data ?'))
        {
            var SemesterID = $('#SemesterID').val();
            var laID = $('#laID').val();
            var ladID = $('#ladID').val();
            var data = {
                action : 'delete',
                laID : laID,
                ladID : ladID
            };

            loading_button('#modalBtnDelete');
            $('#modalBtnEdit, #modalBtnClose, .form-modal').prop('disabled',true);

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+"api/__setLecturersAvailability";
            $.post(url,{token:token},function (result) {
                page_detailDosen(SemesterID);
                $('#modalBtnDelete').html('Delete');
                setTimeout(function () {
                    $('#GlobalModal').modal('hide');
                    $('#modalBtnEdit, #modalBtnClose, #modalBtnDelete, .form-modal').prop('disabled',false);
                },2000);
            })
        }
    });

    function formRequired(element,value) {
        if(value==''){
            $(''+element).css('border','1px solid red');
            return false;
        } else {
            return true;
        }
    }
</script>
