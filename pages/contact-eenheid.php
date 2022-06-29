    <!-- Steps -->
    <script src="<?php echo $site; ?>/js/plugins/staps/jquery.steps.min.js"></script>
    <link href="<?php echo $site; ?>/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <!-- Jquery Validate -->
    <script src="<?php echo $site; ?>/js/plugins/validate/jquery.validate.min.js"></script>


<script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var afdeling = $('#afdeling').val();
                    var uid = $('#uid').val();
                    var naam = $('#naam').val();
                    var email = $('#email').val();
                    var onderwerp = $('#onderwerp').val();
                    var message = $('#message').val();
                    
                      $.ajax({
                        type: "POST",
                        url: "<?php echo $site; ?>/includes/contact_instructeur.php",
                        data: { afdeling: afdeling, uid: uid, naam: naam, email: email, onderwerp: onderwerp, message: message }
                      })
                      .done(function( msg ) {
                        $('#status-send').html(msg);
                      });
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Contact met Instructeur</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Contact</a>
                        </li>
                        <li class="active">
                            <strong>Instructeur</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div id="status-send"></div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Neem contact op met je Instructeur</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <h2>
                                Contact met instructeur
                            </h2>
                            <p>
                                Heb je hulp nodig of heb je een vraag voor je instructeur? Dan kan je dit invullen!
                            </p>

                            <form id="form" action="#" class="wizard-big">
                                <h1>Afdeling</h1>
                                <fieldset>
                                    <h2>Kies een afdeling</h2>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Afdeling *</label>
                                                <select name="afdeling" id="afdeling" class="form-control required">
                                                    <option value="noodhulp">Politie</option>
                                                    <option value="brandweer">Brandweer</option>
                                                    <option value="ambulance">Ambulance</option>
                                                    <option value="meldkamer">Meldkamer</option>
													<option value="kmar">KMar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="text-center">
                                                <div style="margin-top: 20px">
                                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                <h1>Gegevens</h1>
                                <fieldset>
                                    <h2>Jou gegevens</h2>
                                    <div class="row">
                                        <div class="col-lg-6" style="display:none;">
                                            <div class="form-group">
                                                <label>Username *</label>
                                                <input id="naam" name="naam" value="<?php echo $userFetch['username']; ?>" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>Uid *</label>
                                                <input id="uid" name="uid" value="<?php echo $userFetch['id']; ?>" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input id="email" name="email" type="text" class="form-control required email">
                                            </div>
                                            <div class="form-group">
                                                <label>Onderwerp *</label>
                                                <input id="onderwerp" name="onderwerp" type="text" class="form-control required">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1>Bericht</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Bericht*</label>
                                            <textarea id="message" name="message" rows="10" class="form-control required"></textarea>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1>Verzend</h1>
                                <fieldset>
                                    <h2>Verzend</h2>
                                    Weet je het zeker? Druk onderaan op verzend.
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>