<?php
    $koneksi = mysqli_connect("localhost","root","","arkademy");
    
    // Check connection
    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Arkademy</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .search::-webkit-input-placeholder {
            color: white;
        }
        .input::-webkit-input-placeholder {
            color: #CECECE;
        }
    </style>
  </head>
  <body>
    <section id="header">
        <nav class="navbar navbar-expand-sm navbar-dark bg-white align-middle shadow">
            <img src="https://www.arkademy.com/img/logo%20arkademy.1c82cf5c.svg" class="px-5 py-2" alt="arkademy logo" width="220">
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <div class="row w-100">
                    <div class="col-lg-10">
                        <form class="w-100">
                            <input class="form-control search text-white" style="background:#CECECE;font-size:1.4rem;border-radius: 10px;" type="text" placeholder="Search ...">
                        </form>  
                    </div>
                    <div class="col-lg-2">
                        <button id="add" type="button" style="border-radius: 10px;background:#FADC9C;border:none;font-size:1.6rem" class=" px-5 btn btn-primary shadow text-white">ADD</button>
                    </div>
                </div>
                
            </div>
        </nav>
    </section>
    <section id="body" class="py-5">
        <div class="row w-100 d-flex justify-content-center align-items-center h-100 py-5">
            <div class="col-lg-8">
                <table class="table shadow" style="border-radius:20px;background-color: #FADC9C;">
                    <thead style="font-size:1.4rem" class="text-white">
                        <tr style="border: none;">
                            <th class="py-4 text-center align-middle" style="border: none;">No</th>
                            <th class="py-4 text-center align-middle" style="border: none;">Cashier</th>
                            <th class="py-4 text-center align-middle" style="border: none;">Product</th>
                            <th class="py-4 text-center align-middle" style="border: none;">Category</th>
                            <th class="py-4 text-center align-middle" style="border: none;">Price</th>
                            <th class="py-4 text-center align-middle" style="border: none;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php  
                        $data = mysqli_query($koneksi,"SELECT b.name AS cashier, a.name AS product, c.name as category, a.price FROM product a LEFT JOIN cashier b ON a.id_cashier = b.id LEFT JOIN category c ON a.id_category = c.id");
                        $no = 1;
                        while($row = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td class="py-4 pl-5 text-center align-middle" style="border: none;font-size:1.3rem"> <b><?= $no ?></b> </td>
                            <td class="py-4 pl-5 text-left align-middle" style="border: none;font-size:1.3rem"><?= $row['cashier'] ?></td>
                            <td class="py-4 pl-5 text-left align-middle" style="border: none;font-size:1.3rem"><?= $row['product'] ?></td>
                            <td class="py-4 pl-5 text-left align-middle" style="border: none;font-size:1.3rem"><?= $row['category'] ?></td>
                            <td class="py-4 pl-5 text-left align-middle" style="border: none;font-size:1.3rem"><?= number_format($row['price'],0,'.','.') ?></td>
                            <td class="py-4 text-center align-middle" style="border: none;font-size:1.3rem"> <i class="fa fa-edit text-success" onclick="edit_product()"></i> <i onclick="delete_product('#product3')" class="fa fa-trash text-danger"></i> </td>
                        </tr>
                        <?php $no+=1; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header" style="border:none">
                        <h5 class="modal-title">ADD</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <select style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control" name="kasir" id="">
                          <?php  
                        $data = mysqli_query($koneksi,"SELECT * FROM  cashier");
                        $no = 1;
                        while($row = mysqli_fetch_array($data)){
                        ?>
                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php $no+=1; } ?>
                        </select>
                        </div>
                        <div class="form-group">
                            <select style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control" name="kategori" id="">
                            <?php  
                            $data = mysqli_query($koneksi,"SELECT * FROM  category");
                            $no = 1;
                            while($row = mysqli_fetch_array($data)){
                            ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php $no+=1; } ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <input type="text"
                            style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control input px-3" name="produk" id="" aria-describedby="helpId" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <input type="text"
                            style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control input px-3" name="harga" id="" aria-describedby="helpId" placeholder="Price">
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none">
                        <button id="add" value="add" name="add" type="submit" style="border-radius: 10px;background:#FADC9C;border:none;font-size:1.3rem" class=" px-4 btn btn-primary shadow text-white">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="">
                    <div class="modal-body text-center py-5">
                        <h3 class="py-4">Data Raisa Andriani ID <span style="color:#FADC9C">#1</span></h3>
                        
                            <i class="fa fa-check fa-5x rounded-circle px-4 py-4" style="border:10px solid #3db393;color:#3db393"></i>
                        
                        <h3 class="py-4">Berhasil Dihapus</h3>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header" style="border:none">
                        <h5 class="modal-title">EDIT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <select style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control" name="" id="">
                            <option>Raisa Andriana</option>
                            <option>Raisa Andriana</option>
                            <option>Raisa Andriana</option>
                            <option>Raisa Andriana</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <select style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control" name="" id="">
                                <option>Drink</option>
                                <option>Drink</option>
                                <option>Drink</option>
                                <option>Drink</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <input type="text"
                            style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control input px-3" name="" id="" aria-describedby="helpId" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <input type="text"
                            style="color:#CECECE;font-size:1.2rem;border:none;border-bottom: 1px solid grey;" class="form-control input px-3" name="" id="" aria-describedby="helpId" placeholder="Price">
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none">
                        <button id="add" type="button" style="border-radius: 10px;background:#FADC9C;border:none;font-size:1.3rem" class=" px-4 btn btn-primary shadow text-white">EDIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Proses -->
    <?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['add'])){
            $kasir = $_POST['kasir'];
            $produk = $_POST['produk'];
            $kategori = $_POST['kategori'];
            $harga = $_POST['harga'];

            mysqli_query($koneksi,"insert into product values('',$produk,$harga,$kategori,$kasir)");

        }
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $("#add").click(function (e) { 
            $("#addModal").modal("show");
        });
        function delete_product(id_row){
            $("#deleteModal").modal("show");
        }
        function edit_product(id) { 
            $("#editModal").modal("show");
        }
    </script>
  </body>
</html>