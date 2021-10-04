<?php
	include 'db.php';

	$search = isset($_GET["search"]) ? mysqli_real_escape_string($conn, $_GET["search"]) : "";

	$sql = "SELECT * FROM `users` WHERE concat(`name`, `surname`) like '%$search%'";
	$results = $conn->query($sql) or die($conn->error."; Query: $sql");
	$count = 0;
    $num = mysqli_num_rows($results);
?>

<table class="table">
    <tr>
        <th>#N</th>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Birthday</th>
        <th>Registered at</th>
        <th>Edit or delete</th>
    </tr>
    <?php while ($row = $results->fetch_assoc()): ?>
    <tr>
        <td><?php echo ++$count ?></td>
        <td><?php echo $row["id"] ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["surname"] ?></td>
        <td><?php echo $row["birthday"] ?></td>
        <td><?php echo $row["registered_at"] ?></td>

        <span class="json">
            <?php echo json_encode($row) ?>
        </span>

        <td class="d-flex">

            <form action="delete.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                <button class="btn btn-danger">
                    Delete
                </button>
            </form>
            <button class="btn btn-warning pen" id="btnu_<?php echo $row['id'] ?>" data-bs-toggle="modal"
                data-bs-target="#updateModal">
                <img src="pen.svg" alt="My Happy SVG" width="20" />
            </button>
        </td>
    </tr>
    <?php endwhile;?>
</table>
<?php if($num == 0): ?>
<span>Nothing here! Try different keywords.</span>
<?php endif; ?>