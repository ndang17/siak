
<style>
    #tableTahunAkademik tr th {
        text-align: center;
    }
    .td-center {
        text-align: center;
    }
</style>
<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Tahun Akademik</h4>
            </div>
            <div class="widget-content no-padding">

                <div class="table-responsive">
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
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $no=1; foreach ($semester as $item_smt) { ?>
                            <tr>
                                <td class="td-center"><?php echo $no; ?></td>
                                <td>Program Reguler</td>
                                <td class="td-center"><?php echo $item_smt['YearCode']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('academic/tahun-akademik/'.$item_smt['YearCode']); ?>"><?php echo $item_smt['Name']; ?></a>
                                    <div style="float: right;">
                                        <?php
                                        if($item_smt['Status']==1){
                                            echo '<span class="label label-success">Publish</span>';
                                        } else {
                                            echo '<span class="label label-danger">Unpublish</span>';
                                        }
                                        ?>
                                    </div>


                                </td>
                                <td class="td-center"><div class="btn-group">
                                        <button type="button" class="btn btn-default btn-default-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)" data-id="<?php echo $item_smt['ID']; ?>" data-action="edit" class="btn-th-action"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
                                            <li><a href="javascript:void(0)" data-id="<?php echo $item_smt['ID']; ?>" data-action="delete" class="btn-th-action"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)" data-id="<?php echo $item_smt['ID']; ?>" data-action="publish" class="btn-th-action"><i class="fa fa-bullhorn" aria-hidden="true"></i> Publish</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>

                </div>

                <!--                <div class="list-group" style="margin: 0px;">-->
                <!--                    --><?php //foreach ($semester as $item_smt) { ?>
                <!--                        <a href="#" class="list-group-item">-->
                <!--                            --><?php
                //                            echo $item_smt['YearCode'].' | '.$item_smt['Name'];
                //                            if($item_smt['Status']==1){
                //                                echo '<i class="fa fa-check-circle" aria-hidden="true"></i>';
                //                            }
                //                            ?>
                <!--                            <br/>-->
                <!--                            Program : <strong>Reguler</strong>-->
                <!--                            <hr/>-->
                <!--                            <div style="text-align: right;">-->
                <!--                                --><?php //echo $item_smt['NameEmployee']; ?>
                <!--                                | --><?php //echo date("d F Y h:m", strtotime($item_smt['UpdateAt'])); ?><!--</div>-->
                <!---->
                <!--                        </a>-->
                <!---->
                <!--                    --><?php //} ?>
                <!--                </div>-->
            </div>
        </div>
    </div>
</div>