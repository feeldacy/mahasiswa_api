<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
$id_mhs = $_GET['id_mhs'];
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// URL for fetching data (replace with the correct endpoint)
curl_setopt($curl, CURLOPT_URL, 'http://10.33.35.33/sait_project_api/mahasiswa_api.php?id_mhs=' . $id_mhs);
$res = curl_exec($curl);
$json = json_decode($res, true);
curl_close($curl);

// Check if data exists in the response before using it
if (isset($json['data'][0])) {
    $student = $json['data'][0];
    $nama = $student['nama'];
    $alamat = $student['alamat'];
} else {
    // If there's no valid data, display an error
    $nama = '';
    $alamat = '';
    echo "<center><br>No data found for ID: $id_mhs</center>";
}
?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Data</h2>
                </div>
                <p>Please fill this form and submit to update the student record.</p>
                <form action="updateMahasiswaDo.php" method="post">
                    <input type="hidden" name="id_mhs" value="<?php echo $id_mhs; ?>">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($nama); ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($alamat); ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                </form>
            </div>
        </div>        
    </div>
</div>

</body>