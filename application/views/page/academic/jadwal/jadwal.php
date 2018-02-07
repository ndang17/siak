

<div class="thumbnail" style="padding: 5px;">
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="0"> All Day
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="1"> Monday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="2"> Tuesday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="3"> Wednesday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="4"> Thrusday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="5"> Friday
    </label>
</div>
<h1>Jadwal</h1>



<script>
    $(document).ready(function () {

        $('.form-filter-jadwal').prop("disabled",false);
    });

    $('input[type=checkbox][class=filterDay]').change(function () {
        var v = $(this).val();
        if(v==0){
            $('input[type=checkbox][class=filterDay]').prop('checked',false);
            $(this).prop('checked',true);
        } else {
            $('input[type=checkbox][value=0]').prop('checked',false);
            // $(this).prop('checked',true);
        }
    });
</script>