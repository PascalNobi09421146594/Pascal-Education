<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</head>

<style>
    ::placeholder {
        color: gray;          /* change color */
        font-size: 14px;  
    }
</style>

<body>

    <div class="nav">
        <?php require_once "Reusable_php/nav.php" ?>
    </div>

    <div class="login">
        <section class="vh-100" style="background-color: #faf5f6ff;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="../Picture/Login.png"
                                        alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; ">
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">

                                        <form>

                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <img width="50px" height="50px" src="../Picture/Logo3.png">
                                                <span class="h4 fw-bold mb-0"> Welcome Back!!!</span>
                                            </div>

                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;" >Sign into your account</h5>

                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="email">Email address</label>
                                                <input type="email" placeholder="Email address..." id="email" class="form-control form-control-lg" />
                                                
                                            </div>

                                            <div data-mdb-input-init class="form-outline mb-4">
                                                 <label class="form-label" for="password">Password</label>
                                                <input type="password" placeholder="Password..." id="password" class="form-control form-control-lg" />
                                               
                                            </div>

                                            <div class="pt-1 mb-4">
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="button">Login</button>
                                            </div>

                                            <a class="small text-muted" href="#!">Forgot password?</a>
                                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="../SignUP.php"
                                                    style="color: #393f81;">Register here</a></p>
                                            <a href="#!" class="small text-muted">Terms of use.</a>
                                            <a href="#!" class="small text-muted">Privacy policy</a>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="footer">
        <?php require_once "Reusable_php/footer.php" ?>

    </div>
</body>

</html>