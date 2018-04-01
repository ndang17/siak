<div style="text-align: center;">
    <?php 
        //var_dump($getColoumn);
        //echo "<br>";
        //echo "<hr>";
        //var_dump($getData);
     ?>
    <form class="form-horizontal" id="formModal">
    		<?php for($i = 0; $i < count($getColoumn['field']); $i++): ?>
                <?php switch($getColoumn['field'][$i]):
                    case "ID": 
                    case "CreateAT":
                    case "Active": ?>
                        <?php if ($action == 'add'): ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo $getColoumn['field'][$i] ?> :</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label class="col-sm-5 control-label">Automatic</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo $getColoumn['field'][$i] ?> :</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label class="col-sm-5 control-label"><?php echo  $getData[0][$getColoumn['field'][$i]]; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php break; ?> 
                    <?php case "Required":  ?> 
                        <?php if ($action == 'add'): ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo $getColoumn['field'][$i] ?> :</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label class="col-sm-5 control-label">Automatic</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo $getColoumn['field'][$i] ?> :</label>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select id = "Required">
                                                <option value = "Yes" <?php echo $selected = ($getData[0][$getColoumn['field'][$i]] == 'Yes') ? 'selected' : '' ?> >Yes</option>
                                                <option value = "No" <?php echo $selected = ($getData[0][$getColoumn['field'][$i]] == 'No') ? 'selected' : '' ?> >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <?php endif ?>
                     <?php break; ?> 
                    <?php default: ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo $getColoumn['field'][$i] ?> :</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input class="form-control" id="<?php echo $getColoumn['field'][$i] ?>" placeholder="Input <?php echo $getColoumn['field'][$i] ?>..."
                                        <?php if ($getData != null): ?>
                                            value = "<?php echo  $getData[0][$getColoumn['field'][$i]];     ?>"
                                        <?php endif ?>  
                                        ">
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endswitch ?>      
    		<?php endfor ?>
    		<div class="col-sm-12" id="BtnFooter">
                <button type="button" id="ModalbtnCancleForm" data-dismiss="modal" class="btn btn-default">Cancel</button>
                <button type="button" id="ModalbtnSaveForm" class="btn btn-success" aksi = "<?php echo $action ?>" kodeuniq = "<?php echo $id ?>">Save</button>
                <!--<button type="button" id="ModalbtnEditForm" class="btn btn-default btn-default-success hide">Edit Data</button>-->
    		</div>
        </form>
</div>