<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/header.php";
?>

        <!-- Start Page Header Section -->

        <section class="bg-page-header">
            <div class="page-header-overlay">
                <div class="container">
                    <div class="row">
                        <div class="page-header">
                            <div class="page-title">
                                <h2>Donate Page</h2>
                            </div>
                            <!-- .page-title -->
                            <div class="page-header-content">
                                <ol class="breadcrumb">
                                    <li><a href="index.html">Home</a></li>
                                    <li>Donate</li>
                                </ol>
                            </div>
                            <!-- .page-header-content -->
                        </div>
                        <!-- .page-header -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .page-header-overlay -->
        </section>


        <!-- End Page Header Section -->


        <!-- Start our Donate  Section -->
        <section class="bg-donate-section">
            <div class="container">
                <div class="row">
                    <div class="donate-form">
                        <form action="#" method="POST" class="contact-form">
                            <div class="select-amount">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <h3>How Much Would you like to Donate?</h3>
                                            <div class="radio-select">
                                                <input type="radio" name="sel-amount" id="amount-1">
                                                <label for="amount-1">$100</label>
                                            </div>
                                            <!-- .radio-select -->
                                            <div class="radio-select">
                                                <input type="radio" name="sel-amount" id="amount-2">
                                                <label for="amount-2">$150</label>
                                            </div>
                                            <!-- .radio-select -->
                                            <div class="radio-select">
                                                <input type="radio" name="sel-amount" id="amount-3">
                                                <label for="amount-3">$250</label>
                                            </div>
                                            <!-- .radio-select -->
                                            <div class="radio-select">
                                                <input type="radio" name="sel-amount" id="amount-4">
                                                <label for="amount-4">$350</label>
                                            </div>
                                            <!-- .radio-select -->
                                            <div class="radio-select">
                                                <input type="radio" name="sel-amount" id="amount-5">
                                                <label for="amount-5">$500</label>
                                            </div>
                                            <!-- .radio-select -->
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-md-7 -->
                                    <div class="col-lg-5">
                                        <div class="form-group other-amount contact-form">
                                            <input type="text" class="form-control" name="other-amount" value="" placeholder="Or Other Amount">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-md-5 -->
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- .select-amount -->
                            <div class="information-form">
                                <h3>BILLING INFORMATION</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">First Name<span>*</span></label>
                                            <input type="text" class="form-control" name="firstName" id="firstname" placeholder="First Name">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Last Name<span>*</span></label>
                                            <input type="text" class="form-control" name="lastName" id="firstname" placeholder="Last Name">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email<span>*</span></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Phone<span>*</span></label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Address 1<span>*</span></label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Address 1">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="addressTwo">Address 2<span>*</span></label>
                                            <input type="text" class="form-control" name="addressTwo" id="addresstwo" placeholder="Address 2">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- .information-form -->
                            <div class="paymeny-information">
                                <h3>PAYMENT INFORMATION</h3>
                                <ul class="paymeny-card">
                                    <li><img src="assets/images/donate/payment-logo-1.jpg" alt="payment-logo-1" /></li>
                                    <li><img src="assets/images/donate/payment-logo-2.jpg" alt="payment-logo-1" /></li>
                                    <li><img src="assets/images/donate/payment-logo-3.jpg" alt="payment-logo-1" /></li>
                                    <li><img src="assets/images/donate/payment-logo-4.jpg" alt="payment-logo-1" /></li>
                                </ul>
                                <!-- .paymeny-card -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cardNumber">Card Number<span>*</span></label>
                                            <input type="text" class="form-control" name="cardNumber" id="cardnumber" placeholder="Card Number">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cardName">Card Holder Name<span>*</span></label>
                                            <input type="text" class="form-control" name="cardName" id="cardname" placeholder="Card Holder Name">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cardName">Expire Date<span>*</span></label>
                                            <div class="select-option">
                                                <div class="select-box">
                                                    <select>
														<option value="">01</option>
														<option value="">02</option>
														<option value="">03</option>
														<option value="">04</option>
														<option value="">05</option>
														<option value="">06</option>
														<option value="">07</option>
														<option value="">08</option>
														<option value="">09</option>
														<option value="">10</option>
														<option value="">11</option>
														<option value="">12</option>
														
													</select>
                                                    <span class="select-icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                                </div>
                                                <!-- .select-box -->
                                                <div class="select-box">
                                                    <select>
														<option value="">2013</option>
														<option value="">2014</option>
														<option value="">2015</option>
														<option value="">2016</option>
														<option value="">2017</option>
														<option value="">2018</option>
														<option value="">2019</option>
														<option value="">2020</option>
														
													</select>
                                                    <span class="select-icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                                </div>
                                                <!-- .select-box -->
                                            </div>
                                            <!-- .select-option -->
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="security">Security Code (CVC)<span>*</span></label>
                                            <input type="text" class="form-control" name="security" id="security" placeholder="Security Code">
                                        </div>
                                        <!-- .form-group -->
                                    </div>
                                    <!-- .col-lg-6 -->
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- .paymeny-information -->
                            <button type="submit" class="btn btn-default">Donate Now</button>
                        </form>
                    </div>
                    <!-- .donate-form -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </section>
        <!-- End our Donate section -->


        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/includes/footer.php";
        ?>