<?php
include 'function.php';

if (isset($_POST['daftar'])) {
    var_dump($_POST);
    die;
}
$nav_on = 'login';
include 'header.php'; ?>
<br><br>
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="assets/img/replicate-prediction-ds5p5abbpj2c2w3hn57dfq7wb4.png" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST">
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control form-control-lg" name="nama_lengkap" placeholder="Masukan nama lengkap anda" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Masukan username anda" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="email" id="form3Example3" class="form-control form-control-lg" name="email" placeholder="Masukan email anda" />
                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" id="form3Example4" class="form-control form-control-lg" name="password" placeholder="Masukan password anda" />
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button name="daftar" type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Daftar</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Suda punya akun? <a href="masuk.php" class="link-danger">Masuk</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>