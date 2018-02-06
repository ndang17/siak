<!--<div class="thumbnail" style="background: lightyellow;">-->
<!--    <strong>Last Update</strong>-->
<!--    <br/>-->
<!---->
<!--    --><?php //echo $data_json['detail'][0]['UpdateByName']; ?>
<!--    <span style="">--><?php //echo $data_json['detail'][0]['UpdateAt']; ?><!--</span>-->
<!--</div>-->
<!--<hr/>-->
<div class="widget box animated slideInUp">
    <div class="widget-header">
        <h4><i class="fa fa-line-chart" aria-hidden="true"></i> Grade</h4>

        <div class="toolbar no-padding">
            <div class="btn-group">
                <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											Manage <i class="icon-angle-down"></i>
										</span>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="icon-plus"></i> Add</a></li>
                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                </ul>
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
<div class="widget box animated slideInUp">
    <div class="widget-header">
        <h4><i class="fa fa-tasks" aria-hidden="true"></i> Prasyarat KRS</h4>

        <div class="toolbar no-padding">
            <div class="btn-group">
                <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											Manage <i class="icon-angle-down"></i>
										</span>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="icon-plus"></i> Add</a></li>
                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                </ul>
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
