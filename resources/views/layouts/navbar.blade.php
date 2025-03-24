    <!-- Preloader -->
    <div class="preloader">
    <div class="box"></div>
</div>
<!--Header Start-->
<header class="cursor-light">
    <!--Navigation-->
    <nav class="navbar navbar-top-default navbar-expand-lg navbar-gradient nav-icon alt-font">
        <div class="container container-nav">
        <a class="logo" href="javascript:void(0)" title="Logo">
            <img alt="logo" class="logo-dark default" src="{{ isset($preference->value['logo']) ? $preference->value['logo'] : 'ALCB' }}" />
        </a>

        <!--Nav Links-->
        <div class="collapse navbar-collapse" id="agency">
            <div class="navbar-nav ml-auto">
            <a class="nav-link active" href="/#home">Home</a>
            <a class="nav-link" href="/#about-us">About Us</a>
            <a class="nav-link" href="/#clients">Clients</a>si
            <a class="nav-link" href="/#blog">Gallery</a>
            <div class="nav-link dropdown">
                <a href="javascript:void(0)">Career</a>
                <div class="dropdown-content">
                <!-- <a href="ut.html">BERKARIER DI UT</a> -->
                <a href="/career">INFO REKRUTMEN</a>
                <!-- <a href="tanya.html">TANYA JAWAB</a> -->
                </div>
            </div>
            <a class="nav-link" href="/#why">Why Choose</a>
            <a class="nav-link" href="/#contact">Contact Us</a>
            </div>
        </div>
        </div>
    </nav>

    <!--Full menu-->
    <div class="nav-holder main style-2 alt-font">
        <!--Menu Button-->
        <button class="fullnav-close link" type="button">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
        </button>
    </div>

    <!--Get Quote Model Popup-->
    <div class="animated-modal hidden quote-content" id="animatedModal">
        <!--Heading-->
        <div class="heading-area pb-2 mx-570">
        <span class="sub-title">We are megaone company</span>
        <h2 class="title mt-2">Lets start your <span class="alt-color js-rotating">project, website</span></h2>
        </div>
        <!--Contact Form-->
        <form class="contact-form" id="modal-contact-form-data">
        <div class="row">
            <!--Result-->
            <div class="col-12" id="quote_result"></div>

            <!--Left Column-->
            <div class="col-md-6">
            <div class="form-group">
                <input class="form-control" id="quote_name" name="quoteName" placeholder="Name" required="" type="text" />
            </div>
            <div class="form-group">
                <input class="form-control" id="quote_contact" name="userPhone" placeholder="Contact #" required="" type="text" />
            </div>
            <div class="form-group">
                <input class="form-control" id="quote_type" name="projectType" placeholder="Project type" required="" type="text" />
            </div>
            </div>

            <!--Right Column-->
            <div class="col-md-6">
            <div class="form-group">
                <input class="form-control" id="quote_email" name="userEmail" placeholder="Email" required="" type="email" />
            </div>
            <div class="form-group">
                <input class="form-control" id="quote_address" name="userAddress" placeholder="City / Country" required="" type="text" />
            </div>
            <div class="form-group">
                <input class="form-control" id="quote_budget" name="quoteBudget" placeholder="Budget" required="" type="text" />
            </div>
            </div>

            <!--Full Column-->
            <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" id="quote_message" name="userMessage" placeholder="Please explain your project in detail."></textarea>
            </div>
            </div>

            <!--Button-->
            <div class="col-md-12">
            <div class="form-check">
                <label class="checkbox-lable"
                >Contact by phone ins preffered
                <input type="checkbox" />
                <span class="checkmark"></span>
                </label>
            </div>

            <a class="btn btn-large btn-rounded btn-blue btn-hvr-pink modal_contact_btn" href="javascript:void(0);" id="quote_submit_btn"
                ><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i><b>Send Message</b>
                <div class="btn-hvr-setting">
                <ul class="btn-hvr-setting-inner">
                    <li class="btn-hvr-effect"></li>
                    <li class="btn-hvr-effect"></li>
                    <li class="btn-hvr-effect"></li>
                    <li class="btn-hvr-effect"></li>
                </ul>
                </div>
            </a>
            </div>
        </div>
        </form>
    </div>
    </header>