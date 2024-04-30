<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

    <!-- FontAwosome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v5-font-face.min.css"
        integrity="sha512-gb3xyfj/FrHtphPVLYaKBZ8WyMYEXD1+Cgt3FiKhFmbN2UuOpite2w1Lgmw6NzfsNmMGX+BbVra4ceV95z9Vaw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="education.css">

    <title>education</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="navb">
        <?php include ("navbar2.php"); ?>
    </div>

    <!-- New IMAGE -->
    <div class="container-fluid millionClass">
        <div class="content">
            <p class="mainImageText">Book Donation</p>
            <p class="mainImageText2">We work to give your items a second life</p>
        </div>
    </div>

    <!-- button -->

    <div class="container-fluid bookdonate m-0 px-5">
        <div class="button-container col-12">

            <!-- Donate Button -->
            <div class="container d-flex justify-content-around knowMoreBottomSpace">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="card-body">
                        <a href="bookDonateform" id="blueLink">
                            <button class="donateNowBtn mx-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22"
                                    class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>

                                <span class="text" style="text-decoration: none; !important">Donate Now</span>
                            </button>
                        </a>
                    </div>
                    <!-- Available Books Button -->
                    <div class="card-body">
                        <a href="availableBooks" id="blueLink2">
                            <button class="knowMoreBtn mx-3 mb-3">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22"
                                    fill="#ffffff"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                </svg>

                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                                    class="bi bi-info-circle-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path> -->
                                <span class="text2 px-2">Available Books</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Div -->

        <div class="row featurette">
            <div class="col-md-8 order-md-1 order-sm-2 mt-4" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 bookh2 mt-3">Importance of Book Donation</h2>
                <p class="part1p mt-4">Book donations are important as they serve as a powerful catalyst for education
                    and
                    knowledge
                    dissemination, particularly in underserved communities or regions with limited access to educational
                    resources. By providing books, individuals gain access to a wealth of information, fostering
                    literacy,
                    critical thinking, and lifelong learning. Book donations contribute to breaking the cycle of poverty
                    by
                    empowering individuals with the tools needed for personal development and improved socio-economic
                    prospects.</p>
                <p class="part1p">Additionally, they play a vital role in promoting cultural exchange, fostering a sense
                    of global interconnectedness, and enhancing community well-being. Through the generosity of book
                    donations, communities can bridge educational gaps, empower individuals to pursue their aspirations,
                    and contribute to the overall enrichment and enlightenment of society.</p>
            </div>
            <div class="col-md-4 order-md-2 order-sm-1 part1img">
                <img src="book11.png" class="img-fluid rounded volimg mb-5" alt="Centered Image">
            </div>
        </div>

        <div class="row featurette">
            <div class="col-md-8 order-md-2 order-sm-2 mt-4" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 bookh2 mt-5">Book Donation</h2>
                <p class="part1p mt-4">Book donation is a noble act that serves to
                    bridge the gap between knowledge and those in need. When
                    individuals or organizations contribute books, they not only share the joy of reading but also
                    empower
                    communities with the tools for education and personal growth. Donating books is a powerful way to
                    foster
                    literacy, especially in underserved areas where access to educational resources may be limited. By
                    providing books, donors play a crucial role in promoting a culture of learning and intellectual
                    curiosity.</p>
                <p class="part1p">Furthermore, book donations contribute to the
                    recycling and repurposing of literature,
                    promoting sustainability and minimizing waste. Ultimately, the act of donating books embodies the
                    belief
                    that knowledge is a valuable resource that should be accessible to all, irrespective of
                    socio-economic
                    backgrounds, and can have a lasting impact on the lives of those who receive these literary
                    treasures.</p>
            </div>
            <div class="col-md-4 order-md-1 order-sm-1 part1img">
                <img src="book22.png" class="img-fluid rounded volimg mb-5" alt="Centered Image">
            </div>
        </div>
    </div>

    <!-- old -->
    <!-- <div class="box-container">
        <img class="box-image" src="image/book10.png" alt="image is not set">
        <div class="box-description">
            <h2>Book Donation</h2>
            <p>Book donation is a noble act that serves to bridge the gap between knowledge and those in need. When
                individuals or organizations contribute books, they not only share the joy of reading but also empower
                communities with the tools for education and personal growth. Donating books is a powerful way to foster
                literacy, especially in underserved areas where access to educational resources may be limited. By
                providing books, donors play a crucial role in promoting a culture of learning and intellectual
                curiosity. Furthermore, book donations contribute to the recycling and repurposing of literature,
                promoting sustainability and minimizing waste. Ultimately, the act of donating books embodies the belief
                that knowledge is a valuable resource that should be accessible to all, irrespective of socio-economic
                backgrounds, and can have a lasting impact on the lives of those who receive these literary treasures.
            </p>
        </div>

    </div> -->

    <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
            location.href = "bookDonateform";
        };
    </script>
    <script type="text/javascript">
        document.getElementById("myButton2").onclick = function () {
            location.href = "availableBooks";
        };
    </script>

    <footer>
        <?php include ("footer.php") ?>
    </footer>
</body>

</html>