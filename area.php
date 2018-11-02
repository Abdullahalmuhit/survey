<?php
include_once 'header.php';
require_once 'config.php';
$db = getDbInstance();
if(isset($_POST['search'])){
    $select = $_POST['select'];
    $query = "select * from questions where qarea = '$select'";
    $result = $db->query($query);
}
?>
<div class="col-md-12">
    <div class="container">
        <div class="row">
        <h1 style="text-align: center;">Crime Survey of <?php echo $select; ?> </h1>    
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Question</th>
                        <th>Chances</th>
                        <th>Rated By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['qtitle']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['qrating']/$row['ratedby']) ?> </td>
                            <td><?php echo htmlspecialchars($row['ratedby']) ?> </td>
                        </tr>
                    <?php endforeach; ?>  
                </tbody>
            </table>
        </div>
    </div>
</div>