<style>
    .scrolling table {
        table-layout: inherit;
        *margin-left: -100px;/*ie7*/
    }
    .scrolling td, th {
        vertical-align: top;
        padding: 10px;
        min-width: 100px;
    }
    .scrolling th {
        position: absolute;
        *position: relative; /*ie7*/
        left: 0;
        width: 120px;
    }
    .outer {
        position: relative
    }
    .inner {
        overflow-x: auto;
        overflow-y: visible;
        margin-left: 120px;
    }

</style>

<div class="">

    <div class="row" style="margin-top: 30px;">
        <div class="col-md-8 col-sm-8 col-xs-9">
            <div class="scrolling outer">
                <div class="inner">
                    <table class="table table-striped table-hover table-condensed">
                        <tr>
                            <th>Date:</th>
                            <td>Content One</td>
                            <td>Longer Content Two</td>
                            <td>Third Content Contains More</td>
                            <td>Short Four</td>
                            <td>Standard Five</td>
                            <td>Who's Counting</td>
                        </tr>
                        <tr>
                            <th><input type="text" class="form-control" value="03-03-2008"></th>
                            <td><input type="text" class="form-control" value="22"></td>
                            <td><input type="text" class="form-control" value="22"></td>
                            <td><input type="text" class="form-control" value="22"></td>
                            <td><input type="text" class="form-control" value="22"></td>
                            <td><input type="text" class="form-control" value="22"></td>
                            <td><input type="text" class="form-control" value="22"></td>
                        </tr>
                        <tr>
                            <th><input type="text" class="form-control" value="07-05-2009"></th>
                            <td><input type="text" class="form-control" value="23"></td>
                            <td><input type="text" class="form-control" value="23"></td>
                            <td><input type="text" class="form-control" value="23"></td>
                            <td><input type="text" class="form-control" value="23"></td>
                            <td><input type="text" class="form-control" value="23"></td>
                            <td><input type="text" class="form-control" value="23"></td>
                        </tr>
                        <tr>
                            <th><input type="text" class="form-control" value="17-06-2010"></th>
                            <td><input type="text" class="form-control" value="24"></td>
                            <td><input type="text" class="form-control" value="24"></td>
                            <td><input type="text" class="form-control" value="24"></td>
                            <td><input type="text" class="form-control" value="24"></td>
                            <td><input type="text" class="form-control" value="24"></td>
                            <td><input type="text" class="form-control" value="24"></td>
                        </tr>
                        <tr>
                            <th><input type="text" class="form-control" value="05-07-2011"></th>
                            <td><input type="text" class="form-control" value="25"></td>
                            <td><input type="text" class="form-control" value="25"></td>
                            <td><input type="text" class="form-control" value="25"></td>
                            <td><input type="text" class="form-control" value="25"></td>
                            <td><input type="text" class="form-control" value="25"></td>
                            <td><input type="text" class="form-control" value="25"></td>
                        </tr>
                        <tr>
                            <th><input type="text" class="form-control" value="09-08-2012"></th>
                            <td><input type="text" class="form-control" value="26"></td>
                            <td><input type="text" class="form-control" value="26"></td>
                            <td><input type="text" class="form-control" value="26"></td>
                            <td><input type="text" class="form-control" value="26"></td>
                            <td><input type="text" class="form-control" value="26"></td>
                            <td><input type="text" class="form-control" value="26"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-3">
            <div class="well">
                <p class="text-danger">Shrink your browser window to see the scroll bar apear as content overflows to the right</p>
                <p>Left Column (th) stays fixed</p>
                <p>Anytime there is too much content to the right the scroll bar will appear.</p>
            </div>
        </div>
    </div>
</div>
</div>
