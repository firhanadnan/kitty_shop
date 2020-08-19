<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="simpos" name="description" />
    <meta content="codebanten.blogspot.com" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url();?>uploads/logo/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="<?= base_url();?>assets/admin/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url();?>assets/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url();?>assets/admin/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

    <body>
        <div class="account-pages my-4 pt-sm-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Point Of Sales</h5>
                                            <p>Sign in to continue.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="<?= base_url();?>assets/admin/assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="<?= base_url();?>uploads/logo/logo.png" alt="" class="rounded-circle" height="100">
                                        </span>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <?= $this->session->userdata('message');?>
                                    <form class="form-horizontal" action="<?= site_url('auth');?>" method="POST">
                            
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                                            <small class="form-text text-danger"><?= form_error('username'); ?></small>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                                            <small class="form-text text-danger"><?= form_error('password'); ?></small>
                                        </div>
                
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                        </div>
            
                                        <div class="mt-4 text-center">
                                            <a href="#" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <p><a target="_blank" href="http://codebanten.blogspot.com">© Codebanten</a> <i class="mdi mdi-heart text-danger"></i> All Right Reserved</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>

</html>
