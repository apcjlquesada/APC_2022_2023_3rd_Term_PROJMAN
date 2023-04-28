<?php require APPROOT . '/views/templates/header.php'; ?>
    <header class="container-fluid col-12 p-0">
        <h5 class="display-5 px-4 py-2" style="background-color: darkblue; color: White">
            <?php echo $data['title']; ?>
        </h5>
    </header>
    <style>
        img {
            max-width: 50%;
            height: auto;
            margin-top: 10px;

        }

        a {
            text-decoration: none;
            margin-right: 5px;
        }

        a:hover {
            text-decoration: none;

        }

        .fa-envelope {
            padding: 8px;
            font-size: 30px;
        }

        .fa-phone {
            padding: 8px;
            font-size: 30px;
        }

        .fa-facebook {

            padding: 8px;
            font-size: 30px;

        }

        .bi-messenger {
            padding: 8px;
            font-size: 30px;

        }

        .card-header {
            background-color: gold;
            font-weight: bold;
            text-align: center;
            font-style: italic;
            font-size: large;
        }

        .card {
            border-color: gold;
            flex-direction: column;
            width: 18rem;
            text-align: center;

        }

        .card-text {
            text-align: center;
        }



        p {
            margin: 20ps;
            color: white;
            justify-content: baseline;
        }

        .section {
            background-color: darkblue;
            display: flex;
            justify-content: space-between;
            padding: 40px;
            width: 98%;
            margin: 10;
        }

        .section img {
            height: 250px;
        }
    </style>
    </head>
    <!------>

    <body>
    <nav class="navbar navbar-expand-lg bg-warning" ;>
        <div class="container-fluid ps-3">
        </div>
    </nav>
    <div class="container-fluid mt-2 ps-5 justify-content-center" style="border-color: gold;">
        <div class="section">
            <div class="text">
                <h1 style="color: gold;" class="">About Us</h1>
                <p>
                    Villamin Wood & Iron Works is a construction supplies company in Pio Felipe, Metro Manila's Taguig
                    City.
                    Corporate management is what Villamin Wood & Iron Works does. For the benefit of our devoted
                    clients, we
                    provide products of the highest quality that can be customized.
                </p>
                <a href="https://www.facebook.com/Villamin-Wood-Iron-Glass-Aluminum-Works-479583689050461"
                   target="_blank" class="fw-bold" style="color: gold;">Visit Us</a>
            </div>
            <img src="map.png" alt="sigra">
        </div>
    </div>
    <div class="card-group mt-3" style="padding: 40px;">
        <div class="card">
            <img src="---" class="card-img-top" alt="manager">
            <div class="card-body">
                <h5 class="card-title">STORE MANAGER</h5>
                <p class="card-text"><small class="text-muted">Manuel Villamin Jr.</small></p>
            </div>
        </div>
        <div class="card" style="text-align: center;">
            <img src="manager.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">STORE MANAGER</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>

    <div class="container-lg">
        <div class="container-fluid md-3 mt-5" style="text-align: center;">
            <h2>Having a hard time locating our shop? We got you!</h2>
            <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.5773366197463!2d121.06266201483369!3d14.508936383206272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cf4ef4353bbb%3A0x2dc5242263659839!2s1632%20MRT%20Ave%2C%20Taguig%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1678604168724!5m2!1sen!2sph"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <p class="fst-italic" style="color: black;">G367+F29, MRT Ave, Taguig, 1632 Metro Manila</p>
            <div class="mt-5 d-flex aligns-items-center justify-content-center">
                <table>
                    <tr>
                        <td>
                            <h3>OPENING HOURS</h3>
                            <p style="color: black;">MONDAY 11:00-18:00</p>
                            <p style="color: black;">TUESDAY 11:00-18:00</p>
                            <p style="color: black;">WEDNESDAY 11:00-18:00</p>
                            <p style="color: black;">THURSDAY 11:00-18:00</p>
                            <p style="color: black;">FRIDAY 11:00-18:00</p>
                            <p style="color: black;">SATURDAY 11:00-18:00</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="section" style="justify-content: center;">
            <div class="container" style="justify-content: c;">
                <h2 style="color: white;">CONTACT US</h2>
                <a type="button" href="tel:09292799021" target="_blank">
                    <i class="fa-solid fa-phone" style="color:white;"></i></a>
                <a href="https://www.facebook.com/Villamin-Wood-Iron-Glass-Aluminum-Works-479583689050461"
                   alt="facebook">
                    <i class="fa-brands fa-facebook" style="color:white;"></i> </a>
                <a type="button" href="mailto:villaminwoodworks@gmail.com" target="_blank">
                    <i class="fa-solid fa-envelope" style="color:white;"></i></a>
            </div>
        </div>
    </div>





<?php require APPROOT . '/views/templates/footer.php'; ?>