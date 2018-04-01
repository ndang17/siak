<table id="tableTahunAkademik" class="table table-striped table-bordered table-hover table-responsive">
    <thead>
    <tr>
        <th style="width: 1%;">No</th>
        <th style="width: 20%;">Program</th>
        <th style="width: 7%;">Year</th>
        <th>Name</th>
        <th style="width: 15%;">Action</th>
    </tr>
    </thead>
    <?php if(count($semester)<=0){
        echo '<tr><td colspan="5" class="td-center">--- Data Empty ---</td></tr>';
    } ?>
    <tbody>
    <?php $no=1; foreach ($semester as $item_smt) { ?>
        <tr>
            <td class="td-center"><?php echo $no; ?></td>
            <td><?php echo $item_smt['ProgramName']; ?></td>
            <td class="td-center"><?php echo $item_smt['Year'].''.$item_smt['Code']; ?></td>
            <td>
<!--                <a href="--><?php //echo base_url('academic/tahun-akademik/'.$item_smt['YearCode']); ?><!--">--><?php //echo $item_smt['Name']; ?><!--</a>-->
                <a href="javascript:void(0)" class="btn-detail-tahun-akademik" data-id="<?php echo $item_smt['ID']; ?>"><?php echo $item_smt['Name']; ?></a>
                <div style="float: right;">
                    <?php
                    if($item_smt['Status']==1){
                        echo '<span class="label label-success">Publish</span>';
                        $publish = 'hide';
                    } else {
                        echo '<span class="label label-danger">Unpublish</span>';
                        $publish = '';
                    }
                    ?>
                </div>


            </td>
            <td class="td-center"><div class="btn-group">
                    <button type="button" class="btn btn-default btn-default-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" data-id="<?php echo $item_smt['ID']; ?>" data-action="edit" class="btn-th-action" id="modalBtnEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
                        <li class="<?php echo $publish; ?>"><a href="javascript:void(0)" data-id="<?php echo $item_smt['ID']; ?>" data-action="publish" class="btn-th-action" id="modalBtnPublish"><i class="fa fa-bullhorn" aria-hidden="true"></i> Publish</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>