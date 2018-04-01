
<table class="table" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 25%;">Program</td>
        <td colspan="2">
            <select class="form-control" id="modalProgram"></select>
        </td>
    </tr>
    <tr>
        <td>Semester</td>
        <td>
            <select class="form-control" id="modalTahun"></select>
        </td>
        <td style="width: 40%;">
            <label class="radio-inline">
                <input type="radio" name="semester" value="1" checked> Ganjil
            </label>
            <label class="radio-inline">
                <input type="radio" name="semester" value="2"> Genap
            </label>
        </td>
    </tr>
</table>

<script>
    $(document).ready(function () {

        var action = '<?php echo $action; ?>';
        var Tahun = '<?php echo $tahun; ?>';
        var ProgramCampusID = '<?php echo $ProgramCampusID; ?>';
        loadModalTahun(Tahun,action);
        loadSelectOptionConf('#modalProgram','programs_campus',ProgramCampusID);




        if(action!='add'){
            $('input[type=radio][name=semester][value=<?php echo $Code; ?>]').prop('checked',true);
        }

    });

    function loadModalTahun(selected,action) {
        var option = $('#modalTahun');

        // Sebelumnya
        // for(var i=0;i>=-1;i--){
        for(var i=0;i>=-4;i--){
            var sel ='';
            var n = (i>=0) ? Math.abs(i+1) : -Math.abs(i+1) ;
            var n1 = (i>=0) ? Math.abs(i) : -Math.abs(i) ;
            var tahun = moment().add(n1,'year').year()+'/'+moment().add(n,'year').year();

            if(action!="add"){
                if(selected==tahun) {
                    sel = 'selected';
                } else {
                    sel = '';
                }

            } else {
                if(i==-1){
                    sel = 'selected';
                }
            }

            option.prepend('<option value="'+moment().add(n1,'year').year()+'.'+tahun+'" '+sel+'>'+tahun+'</option>');
        }
    }



</script>