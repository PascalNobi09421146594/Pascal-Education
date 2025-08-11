<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
    <br>
    
    <div class="SignUP">
        <section class="vh-80 bg-image"
            style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-80">
                    <div class="row d-flex justify-content-center align-items-center h-80">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                    <form>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="name" class="form-control form-control-lg" placeholder="Enter your name"/>
                                            <label class="form-label" for="form3Example1cg">Your Name</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="email" class="form-control form-control-lg" placeholder="Enter your Email"/>
                                            <label class="form-label" for="form3Example3cg">Your Email</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="password" class="form-control form-control-lg" placeholder="Enter password"/>
                                            <label class="form-label" for="form3Example4cg">Password</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="password2" class="form-control form-control-lg" placeholder="Enter password again" />
                                            <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                                            <label class="form-check-label" for="form2Example3g">
                                                I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="button" data-mdb-button-init
                                                data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="../Login.php"
                                                class="fw-bold text-body"><u>Login here</u></a></p>

                                    </form>

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