
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</head>
<style>
    .row,
    .row * {
        box-shadow: none !important;
        text-shadow: none !important;
        font-family: 'Times New Roman', Times, serif;
    }
</style>



<body class="d-flex flex-column h-100">

    <!-- Nav bar-->

    <div class="nav">
        <?php require_once "Reusable_php/nav.php" ?>
    </div>

    <!-- Header-->

    <header class="bg-warning py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-dark mb-2">Pascal's Education</h1>
                        <p class="lead fw-normal text-dark-50 mb-4">Find your professional tutors to suit budget. <br>We are here to give the best online class experience.</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-success btn-lg px-4 me-sm-3" href="teacherView.php">Find a tutor</a>
                            <a class="btn btn-outline-dark btn-lg px-4" href="#!">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="Picture/display1.png" alt="..." /></div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h2 class="fw-bolder mb-0">How Pascal Education system works</h2>
                    <br>
                    <br><br><br><br><br><br><br>
                    <a class="btn btn-outline-dark btn-lg px-4" href="order.php">Get Started</a>


                </div>
                <div class="col-lg-8">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                            <i class="fa-solid fa-person-chalkboard" style="font-size: 48px;"></i>
                            <br>
                            <h2 class="h5 fw-bold">Click Find a tutor</h2>
                            <p class="mb-0">Tell us what help you need. The more information the better. We instantly alert top Tutors for your request.</p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                            <i class="fa-solid fa-people-arrows" style="font-size: 48px;"></i>
                            <h2 class="h5 fw-bold">Free consulation</h2>
                            <p class="mb-0">Contact tutors via text, phone or video. saving time and money on quality tutoring.</p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                            <i class="fa-solid fa-magnifying-glass-dollar" style="font-size: 48px;"></i>
                            <h2 class="h5 fw-bold">Hire Tutors</h2>
                            <p class="mb-0">Browse teacher's profiles, compare tuition rates, and read real student reviews.</p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                            <i class="fa-solid fa-users-viewfinder" style="font-size: 48px;"></i>
                            <h2 class="h5 fw-bold">Have Classes</h2>
                            <p class="mb-0">Flexible scheduling to fit your routine. All lessons are recorded so you can review anytime. Secure payments via many suitable payment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Teacher preview section-->
    <section class="bg-info py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">View Our Tutors</h2>
                        <p class="lead fw-normal text-muted mb-5">All of our high quality online Tutors are interviewed and background-checked before tutoring on Pascal.</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img width="600px" height="350px" class="card-img-top" src="../Picture/Teacher1.jpg" alt="teacher photo" />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Top</div>
                            <a class="text-decoration-none link-dark stretched-link" href="teacherView.php">
                                <h5 class="card-title mb-3 fw-bold"> Amy <br><br> BA/MA English, <br> Drama and Education University of Cambridge</h5>
                            </a>
                            <p class="card-text mb-0">I am flexible, dedicated and personal in my approach, making what seems complex and alien seem relevant and applicable - and therefore more memorable!.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img width="40px" height="40px" class="rounded-circle me-3" src="../Picture/Rating.png" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Rating</div>
                                        <div class="text-muted">
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img width="600px" height="350px" class="card-img-top" src="../Picture/Teacher3.jpg" alt="teacher photo" />

                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Top</div>
                            <a class="text-decoration-none link-dark stretched-link" href="teacherView.php">
                                <h5 class="card-title mb-3 fw-bold"> Dr.Pascal Nobi <br><br> Doctorate, <br>University College London: Institute of Education; Postgraduate in Philosophy: Birkbeck College, University of London; MA in Design: UAL Central Saint Martins;</h5>
                            </a>
                            <p class="card-text mb-0">Qualified secondary Computer Science and Math teacher with 2+ years of experience teaching and tutoring. A year experience in volunteering.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img width="40px" height="40px" class="rounded-circle me-3" src="../Picture/Rating.png" alt="..." />

                                    <div class="small">
                                        <div class="fw-bold">Rating</div>
                                        <div class="text-muted">
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img width="600px" height="350px" class="card-img-top" src="../Picture/Teacher2.jpg" alt="teacher photo" />

                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Top</div>
                            <a class="text-decoration-none link-dark stretched-link" href="teacherView.php">
                                <h5 class="card-title mb-3 fw-bold">Samantha <br><br> BA, University of Texas at Austin</h5>
                            </a>
                            <p class="card-text mb-0">Qualified secondary Maths and Biology teacher with 15+ years of experience teaching and tutoring. Published academic and educational content writer. Former medical scribe.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img width="40px" height="40px" class="rounded-circle me-3" src="../Picture/Rating.png" alt="..." />

                                    <div class="small">
                                        <div class="fw-bold">Rating</div>
                                        <div class="text-muted">
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center" >
                <a class="btn btn-outline-dark btn-lg px-4" href="teacherView.php">More Tutor</a>
            </div>
            <!-- Call to action-->
            <aside class="bg-warning bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                    <div class="mb-4 mb-xl-0">
                        <div class="fs-3 fw-bold text-white">To nofity our up to date classes</div>
                        <div class="text-black-50">Sign up for our tutoring for the latest updates.</div>
                    </div>
                    <div class="ms-xl-4">
                        <div class="input-group mb-2">
                            <input class="form-control" type="text" placeholder="Email address..." aria-label="Email address..." aria-describedby="button-newsletter" />
                            <a href="SignUP.php"><button class="btn btn-outline-light" id="button-newsletter" name="button" type="button">Sign up</button></a>
                        </div>
                        <div class="small text-black-50">We care about privacy, and will never share your data.</div>
                    </div>
                </div>
                
            </aside>
        </div>
    </section>
    <!-- <div class="py-5" style="background-color: #258364;">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-10 col-xl-7">
                            <div class="text-center">
                                <div class="fs-4 mb-4 fst-italic">"Contact Us!" <br><br>A tutoring service you can depend on. Use Find A Tutor to book a tutor today.</div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                    <div class="fw-bold">
                                        Tom Ato
                                        <span class="fw-bold text-primary mx-1">/</span>
                                        CEO, Pomodoro
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

    




    <div class="footer">
        <?php require_once "Reusable_php/footer.php" ?>

    </div>



</body>

</html>