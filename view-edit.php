<?php
require_once 'config.php';
require_once 'pelangganService.php';

$database = new Database();
$db = $database->getConnection();

$pelanggan = new Pelanggan($db);

$pelanggan->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggan->name = $_POST['name'];
    $pelanggan->email = $_POST['email'];
    $pelanggan->phone = $_POST['phone'];

    if ($pelanggan->update()){
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data Pelanggan";
    }
} else {
    $stmt = $pelanggan->show($pelanggan->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $pelanggan->name = $data['name'];
    $pelanggan->email = $data['email'];
    $pelanggan->phone = $data['phone'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Edit Pelanggan</h1>

                <form action="view-edit.php?id=<?php echo $pelanggan->id; ?>" method="POST"
                    class="shadow p-4 bg-light rounded">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="<?php echo $pelanggan->name; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="<?php echo $pelanggan->email; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                            value="<?php echo $pelanggan->phone; ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-warning fw-bold" value="Update Pelanggan">
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-link">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>