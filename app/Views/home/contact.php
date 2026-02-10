<?php Config::header(); ?>
        <div class="page-header pb-5">
            <div class="container text-center py-5">
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">Contact</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="title wow fadeInUp" data-wow-delay="0.1s">
                        <div class="title-left">
                            <h5>Contact</h5>
                            <h1>Please Contact Us</h1>
                        </div>
                    </div>
                    <h4 class="lh-base mb-4">Receive messages instantly with our PHP and Ajax contact form - available
                        in the <a href="https://htmlcodex.com/downloading/?item=3631">Pro Version</a> only.</h4>
                    <table class="table table-dark mb-0 wow fadeInUp" data-wow-delay="0.3s">
                        <tr>
                            <td>PHONE</td>
                            <td>+0123456789</td>
                        </tr>
                        <tr>
                            <td>E-MAIL</td>
                            <td>info@example.com</td>
                        </tr>
                        <tr>
                            <td>ADDRESS</td>
                            <td>123 Street, New York, USA</td>
                        </tr>
                        <tr class="border-dark">
                            <td>FOLLOW US</td>
                            <td>
                                <a class="me-1" href="#!"><i class="fab fa-x-twitter"></i></a>
                                <a class="me-1" href="#!"><i class="fab fa-facebook-f"></i></a>
                                <a class="me-1" href="#!"><i class="fab fa-youtube"></i></a>
                                <a class="me-1" href="#!"><i class="fab fa-linkedin-in"></i></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-secondary border-0" id="name"
                                        placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-secondary border-0" id="email"
                                        placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-secondary border-0" id="subject"
                                        placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-secondary border-0"
                                        placeholder="Leave a message here" id="message"
                                        style="height: 150px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-outline-primary border-2 w-100 py-3" type="submit">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Google Map Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.3s">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"
            style="width: 100%; height: 500px; filter: grayscale(100%) invert(92%) contrast(83%); border: 0;"></iframe>
    </div>
    <!-- Google Map End -->


<?php Config::footer(); ?>
