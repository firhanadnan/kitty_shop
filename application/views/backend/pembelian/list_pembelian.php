<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        	<!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Daftar Pembelian Bahan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Pembelian</li>
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
                                <a href="<?= base_url()?>Pembelian/add" class="btn btn-primary waves-effect waves-light mb-2">
                                    <i class="bx bx-plus font-size-12 align-middle mr-2"></i> Add Pembelian
                                </a>
                            </h4>        
                            <table id="tableon" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                  <th width="2%">No</th>
                                  <th style="text-align: center;">Nama Bahan</th>
                                  <th style="text-align: center;">Satuan</th>
                                  <th style="text-align: center;">Kategori</th>
                                  <th style="text-align: center;">Harga Beli</th>
                                  <th style="text-align: center;">Stok</th>
                                  <th style="text-align: center;">Minimal Stok</th>
                                  <th width="5%" style="text-align: center;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>