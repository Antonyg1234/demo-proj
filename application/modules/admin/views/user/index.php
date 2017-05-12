<table id="myTable" width="100%">
    <thead>
    <tr>
        <th style="">First Name </th>
        <th style="">Last Name</th>
        <th style="">Email</th>
        <th style="">Role </th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
   // $list = json_decode($json);
    foreach ($list as $row)
    {
        ?>
        <tr>
            
            <td><?php echo $row->firstname;?></td>
            <td><?php echo $row->lastname;?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->role_name; ?></td>
            <td>
                <div class="buttons">
                   <button onclick="deleteFunction(<?php echo $row->id; ?>)">Delete</button>
                   <a href="#">Edit</a>
                </div>

            </td>

        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
<script>
    var datatable_url = '<?php echo base_url(); ?>/admin/user';
</script>
