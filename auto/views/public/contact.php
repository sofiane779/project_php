<?php ob_start();?>
<div class="container">
<div class="container mt-5 mb-5 bg-light">
            <div class="row ">
                    <section class="col-sm">
                        <form>
                            <h1 class="text-info text-center">Formulaire d'inscription</h1>
                            <div>
                                <label for="name" class="col-form-label">Nom :</label>
                                <input type="text" id="name" name="user_name" class="form-control" />
                            </div>
                            <div>
                                <label for="last_name" class="form-check-label">Prénom :</label>
                                <input type="text" id="last_name" name="user_last_name" class="form-control" />
                            </div>
                            <div>
                                <label for="telephone" class="form-check-label">Téléphone :</label>
                                <input type="tel" id="telephone" name="user_telephone" class="form-control" />
                            </div>
                            <div>
                                <label for="mail" class="form-check-label">e-mail :</label>
                                <input type="email" id="mail" name="user_mail" class="form-control" />
                            </div>
                            <div>
                                <label for="msg" class="form-check-label">Message :</label>
                                <textarea id="msg" name="user_message" class="form-control"></textarea>
                            </div><br />
                            <div class="button mb-3">
                                <button type="submit" class="bg-warning">Envoyer le message</button>
                            </div>
                        </form>
                    </section>
                    <section class="col-sm text-center p-6">
                        <h1 class="text-center text-info mb-5" >Contactez-moi</h1>
                        <div id="mail" class="text-center mt-2"><FiMail />
                            <p>
                               
                            <a href="mailto:sofiane.mameri7@gmail.com" >
                                    <span>sofiane.mameri7@gmail.com</span>
                                </a>
                            </p>
                        </div>
                        <div  class="text-center "><FiSmartphone />
                            <p>Tel:<span class="text-success"> +33 06 95 62 69 77</span></p>
                        </div>
                        <div class="text-center"><BiBeenHere color="red" />
                            <p class="">Mr Mameri</p>
                            <p><span>24 rue des pins 77090 Collégien</span> </p>
                        </div>
                    </section>
                </div>

            </div>

                <section class="">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.3530354100626!2d2.6722002156734663!3d48.83240437928489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e60523db641b5d%3A0xdeaeaf41ac1604c4!2s24%20Rue%20des%20Pins%2C%2077090%20Coll%C3%A9gien!5e0!3m2!1sfr!2sfr!4v1606401589003!5m2!1sfr!2sfr" width="100%" height="450" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </section>
            </div>
    <?php 
    $contenu = ob_get_clean();
    require_once './views/public/templatePublic.php';?>
