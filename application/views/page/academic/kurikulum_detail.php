

<style>
    .table-grade tr th,.table-grade tr td {
        text-align: center;
    }
</style>

<div class="row animated zoomIn">
    <div class="col-md-4">
        <div class="thumbnail">
            <table class="table">
                <tr>
                    <td style="width: 25%;">Create By</td>
                    <td style="width: 1%;">:</td>
                    <td>
                        <?php echo $data_json['detail'][0]['CreateBy']; ?>
                        <span style="float: right;">| Desc 2017 16:00</span>
                    </td>
                </tr>
                <tr>
                    <td>Last Update</td>
                    <td>:</td>
                    <td>
                        <?php echo $data_json['detail'][0]['UpdateByName']; ?>
                        <br/>
                        <span style=""><?php echo $data_json['detail'][0]['UpdateAt']; ?></span>
                    </td>
                </tr>
            </table>
        </div>
        <hr/>
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="fa fa-line-chart" aria-hidden="true"></i> Grade</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs"><i class="icon-pencil"></i> Edit</span>
                    </div>
                </div>
            </div>
            <div class="widget-content" style="display: block;">
                <table class="table table-striped table-bordered table-grade">
                    <thead>
                    <tr>
                        <th>Nilai Huruf</th>
                        <th>Range Start</th>
                        <th>Range End</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($data_json['grade'] as $item_grade){
                    ?>
                    <tr>
                        <td><?php echo $item_grade['Grade']; ?></td>
                        <td><?php echo $item_grade['StartRange']; ?></td>
                        <td><?php echo $item_grade['EndRange']; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr/>
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="fa fa-tasks" aria-hidden="true"></i> Prasyarat KRS</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs"><i class="icon-pencil"></i> Edit</span>
                    </div>
                </div>
            </div>
            <div class="widget-content" style="display: block;">
                <table class="table table-striped table-bordered table-grade">
                    <thead>
                    <tr>
                        <th>Nilai Huruf</th>
                        <th>Range Start</th>
                        <th>Range End</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data_json['grade'] as $item_grade){
                        ?>
                        <tr>
                            <td><?php echo $item_grade['Grade']; ?></td>
                            <td><?php echo $item_grade['StartRange']; ?></td>
                            <td><?php echo $item_grade['EndRange']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="col-md-8">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="fa fa-th-list" aria-hidden="true"></i> Daftar Mata Kuliah</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs"><i class="icon-plus"></i> Add</span>
                        <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											Manage <i class="icon-angle-down"></i>
										</span>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                            <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                            <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-content" style="display: block;">
                <div class="alert alert-warning fade in">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    <strong>Warning!</strong> Your monthly traffic is reaching limit.
                </div>
                <div class="alert alert-success fade in">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    <strong>Success!</strong> The customer has been successfully added.
                </div>
                <div class="alert alert-info fade in">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    <strong>Info!</strong> You have 17 unread messages.
                </div>
                <div class="alert alert-danger fade in">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    <strong>Error!</strong> Your hourly cronjob has failed.
                </div>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                    Cras mattis consectetur purus sit amet fermentum. est non commodo luctus, nisi erat porttitor ligula,
                    eget lacinia odio sem nec elit. Cras mattis.</p>
            </div>
        </div>
    </div>
</div>