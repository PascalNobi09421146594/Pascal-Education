<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</head>

<style>
    .styled-button {
        position: relative;
        padding: 0.5rem 1rem;
        /* Smaller padding */
        font-size: 0.9rem;
        /* Smaller text */
        font-weight: bold;
        color: #ffffff;
        background: linear-gradient(to bottom, #111111, #000000);
        /* Black */
        border-radius: 9999px;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 1), 0 6px 12px rgba(0, 0, 0, 0.4);
        /* Softer shadow */
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #111;
    }

    .styled-button::before {
        content: "";
        position: absolute;
        top: -2px;
        right: -1px;
        bottom: -1px;
        left: -1px;
        background: #000000;
        /* Solid black border layer */
        z-index: -1;
        border-radius: 9999px;
        transition: all 0.2s ease;
        opacity: 1;
    }

    .styled-button:active {
        transform: translateY(1px);
        /* Less movement */
        box-shadow: 0 1px 2px rgba(0, 0, 0, 1), 0 3px 6px rgba(0, 0, 0, 0.4);
    }

    .styled-button .inner-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000000;
        width: 30px;
        /* Smaller */
        height: 30px;
        margin-left: 6px;
        border-radius: 50%;
        box-shadow: 0 0 1px rgba(0, 0, 0, 1);
        border: 1px solid #111;
        transition: all 0.2s ease;
    }

    .styled-button .inner-button::before {
        content: "";
        position: absolute;
        top: -2px;
        right: -1px;
        bottom: -1px;
        left: -1px;
        background: #000000;
        z-index: -1;
        border-radius: 9999px;
        transition: all 0.2s ease;
        opacity: 1;
    }

    .styled-button .inner-button .icon {
        filter: drop-shadow(0 8px 16px rgba(26, 25, 25, 0.9)) drop-shadow(0 0 3px rgba(0, 0, 0, 1));
        transition: all 0.4s ease-in-out;
    }

    .styled-button .inner-button .icon:hover {
        filter: drop-shadow(0 10px 20px rgba(50, 50, 50, 1)) drop-shadow(0 0 20px rgba(2, 2, 2, 1));
        transform: rotate(-35deg);
    }

    .button {
        cursor: pointer;
        font-size: 1rem;
        line-height: 1.5rem;
        padding: 0.625rem 1rem;
        color: rgb(242 242 242);
        background-color: rgb(79 70 229);
        background: linear-gradient(144deg, #221e24ff, #333047ff 50%, #232b2cff);
        font-weight: 600;
        border-radius: 0.5rem;
        border-style: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.35s linear;
    }

    .button:hover {
        box-shadow: inset 0 5px 25px 0 #94b7e2ff, inset 0 10px 15px 0px #7272e9ff,
            inset 0 5px 25px 0px #00ddeb;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #582b26">

        <div class="container-fluid">

            <a class="navbar-brand text-white" href="#"><img src="Picture/Logo3.png" style="width:150px; height:150px" class="img-responsive"></a></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item mx-3">
                        <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                    </li>



                    <li class="nav-item dropdown mx-3">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tutoring Subjects
                        </a>

                        <ul class="dropdown-menu text-white mx-3" aria-labelledby="navbarDropdown">

                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>

                    <li class="nav-item mx-3">
                        <a class="nav-link text-white" href="#">Teachers</a>
                    </li>

                    <li class="nav-item mx-3">
                        <a class="nav-link text-white" href="#">Pricing</a>
                    </li>

                    <li class="nav-item mx-3">
                        <a class="nav-link text-white" href="#">About us</a>
                    </li>





                </ul>

                <form class="d-flex ">
                    <button class="button">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="1.25rem"
                            height="1.25rem"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2">
                            <path d="M12 19v-7m0 0V5m0 7H5m7 0h7"></path>
                        </svg>
                        Login
                    </button>

                    <div style="width:1px; height:40px; background-color:#000; margin: 0 1.5rem;"></div>

                    <button class="styled-button">
                        Sign up
                        <div class="inner-button">
                            <svg
                                id="Arrow"
                                viewBox="0 0 32 32"
                                xmlns="http://www.w3.org/2000/svg"
                                height="30px"
                                width="30px"
                                class="icon">
                                <defs>
                                    <linearGradient y2="100%" x2="100%" y1="0%" x1="0%" id="iconGradient">
                                        <stop style="stop-color:#FFFFFF;stop-opacity:1" offset="0%"></stop>
                                        <stop style="stop-color:#AAAAAA;stop-opacity:1" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <path
                                    fill="url(#iconGradient)"
                                    d="M4 15a1 1 0 0 0 1 1h19.586l-4.292 4.292a1 1 0 0 0 1.414 1.414l6-6a.99.99 0 0 0 .292-.702V15c0-.13-.026-.26-.078-.382a.99.99 0 0 0-.216-.324l-6-6a1 1 0 0 0-1.414 1.414L24.586 14H5a1 1 0 0 0-1 1z"></path>
                            </svg>
                        </div>
                    </button>





                </form>

            </div>
        </div>
    </nav>

</body>

</html>