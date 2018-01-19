
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach ($conf as $item){ ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $item['Name']; ?></td>
            <td><button>D</button></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

