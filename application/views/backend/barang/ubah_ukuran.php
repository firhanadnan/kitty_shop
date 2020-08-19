            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Manage Barang</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">Barang</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                        <h4 class="card-title">Form Update</h4>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Kode Barang</label>
                                            <div class="col-md-10">
                                                <input type="hidden" name="id_ukuran" value="<?= $ukuran['id_ukuran']?>">
                                                <input class="form-control" type="text" name="kd_barang" value="<?= $ukuran['kd_barang']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Warna</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="warna" value="<?= $ukuran['warna']?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-md-2 col-form-label">Stok</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="qty" value="<?= $ukuran['qty']?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Harga Beli</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="harga_beli" value="<?= $ukuran['harga_beli']?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-md-2 col-form-label">Harga Jual</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="harga_jual" value="<?= $ukuran['harga_jual']?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="example-month-input" class="col-md-2 col-form-label"></label>
                                            <div class="col-md-10">
                                                <button type="submit" onClick="javascript:history.go(-1)" class="btn btn-primary btn-sm">Save</button>
                                                <input onClick="javascript:history.go(-1)" type="button" class="btn btn-danger btn-sm" value="Back">
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                </div> 
            </div> 


           