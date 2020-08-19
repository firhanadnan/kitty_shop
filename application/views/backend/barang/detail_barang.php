<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
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
                                        <h4 class="card-title">
                                            <a href="<?= base_url('barang')?>" class="btn btn-warning waves-effect waves-light mb-2">
                                                <i class="bx bx-left-arrow-alt font-size-12 align-middle mr-2"></i> Kembali
                                            </a>
                                            <a href="javascript:void();" data-toggle="modal" data-target="#add_ukuran" class="btn btn-success waves-effect waves-light mb-2">
                                                <i class="bx bx-plus font-size-12 align-middle mr-2"></i> Add
                                            </a>
                                        </h4>
                                              <?php
                                                $url = $this->uri->segment(3);
                                                $kode = $this->db->query("SELECT * FROM tb_barang JOIN tb_kategori ON kategori = kode_kategori JOIN tb_satuan ON satuan = kode_satuan WHERE kd_barang = '$url'")->row_array();
                                                
                                              ?>
                                        <h4>Kode barang : <?= strtoupper($kode['kd_barang']); ?> | Jenis : <?= strtoupper($kode['nama_satuan']); ?> | Merk : <?= strtoupper($kode['nama_kategori']); ?></h4>        
                                        <table id="tableon" class="table table-bordered dt-responsive nowrap" style="border-collapse: block; border-spacing: 0; width: 100%;">
                                            
                                            
                                              <?php
                                                $url = $this->uri->segment(3);
                                                $kode = $this->db->query("SELECT ukuran FROM tb_ukuran WHERE kd_barang = '$url' GROUP BY ukuran")->result_array();
                                                
                                              ?>
                                                <?php
                                                    foreach($kode as $kd):
                                                    $uk = $kd['ukuran'];  
                                                    $stok = $this->db->query("SELECT SUM(qty) as qty FROM tb_ukuran WHERE kd_barang = '$url' AND ukuran = '$uk'")->row_array();     
                                                ?>
                                                
                                                <tr>
                                                <th colspan="5">Size <?= $kd['ukuran']?> : Sisa stok <?= $stok['qty'];?></th>
                                                </tr>
                                                <tr>
                                                    <th  style="text-indent: 20px; ">Warna</th>
                                                    <th>Stok</th>
                                                    <th>Harga Beli</th>
                                                    <th>Harga Jual</th>
                                                    <th style="text-align:center;">Action</th>
                                                </tr>
                                                <?php
                                                    $url = $this->uri->segment(3);
                                                    $modals = $this->db->query("SELECT id_ukuran,warna,qty,harga_beli,harga_jual FROM tb_ukuran WHERE kd_barang = '$url' AND ukuran = '$uk'")->result_array();
                                                ?>
                                                    <?php
                                                        foreach ($modals as $md) :
                                                    ?>
                                                    <tr>
                                                        <td style="text-indent: 20px; "><?= $md['warna']?></td>
                                                        <td><?= $md['qty']?></td>
                                                        <td><?= $md['harga_beli']?></td>
                                                        <td><?= $md['harga_jual']?></td>
                                                        <td style="text-align:center;">
                                                            <a href="<?= base_url('')?>barang/edit_ukuran/<?= $md['id_ukuran']?>" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                            <a href="#"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            
            
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                            
                        
                       </div>     
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="add_ukuran">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="modal_title">Add ukuran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form class="custom-validation" action="<?= base_url('barang/add_ukuran')?>" method="POST">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="hidden" name="kd_barang" value="<?= $this->uri->segment(3)?>">
                                            <input type="text" name="size" class="form-control" placeholder="Size"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" name="warna" class="form-control" placeholder="Warna"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" name="qty" class="form-control" placeholder="qty"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Beli</label>
                                            <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual"/>
                                            <span class="invalid-feedback"></span>
                                        </div>                                               
                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Save
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect">
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    