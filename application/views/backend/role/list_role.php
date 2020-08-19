            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                    <?php if ($this->session->flashdata('flash')) : ?>
                    <?php endif; ?>
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Manage Role</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">Manage Role</li>
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
                                            <a href="" class="btn btn-primary waves-effect waves-light mb-2" data-toggle="modal" data-target="#role"><i class="bx bx-plus font-size-12 align-middle mr-2"></i> Add Role</a>
                                        </h4>        
                                        <table id="data" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Role</th>
                                              
                                              <th style="text-align: center;">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              <?php $i = 0;  ?>
                                              <?php 
                                                foreach ($role as $kt) : 
                                                $i++
                                              ?>
                                              <tr>
                                                <td><?= $i;?></td>
                                                <td><?= $kt['role_name']; ?></td>
                                                <td style="text-align: center;">
                                                  <a href="<?= base_url()?>role/detail/<?= $kt['role_id'];?>" class="btn btn-action bg-warning btn-sm mr-1" data-toggle="tooltip" title="Access"><i class="far fa-eye"></i></a> 
                                                  <a href="" class="btn btn-action bg-secondary btn-sm mr-1" data-toggle="modal" data-target="#editrole<?= $kt['role_id'];?>" title="Edit"><i class="fas fa-pencil-alt"></i></a> 
                                                  <a href="<?= base_url()?>role/delete/<?= $kt['role_id'];?>" class="btn btn-danger btn-action btn-sm tombol-hapus" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                                                </td>
                                              </tr>
                                              
                                              <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->     
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Modal Add-->
                <div class="modal fade" id="role" tabindex="-1" role="dialog" aria-labelledby="roleLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fakultasLabel">Form Role</h5>
                                
                            </div>
                            <form action="<?= base_url('role/add'); ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Nama Role">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php foreach ($role as $kt) : ?>
                <!-- Modal Edit-->
                <div class="modal fade" id="editrole<?= $kt['role_id'];?>" tabindex="-1" role="dialog" aria-labelledby="editroleLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editroleLabel">Edit Role</h5>
                                
                            </div>
                            <form action="<?= base_url('role/update'); ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?= $kt['role_id']; ?>">
                                        <input type="text" class="form-control" id="role_name" name="role_name" value="<?= $kt['role_name'];?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
                <?php endforeach; ?>