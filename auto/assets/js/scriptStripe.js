$(function(){

    const stripe = Stripe
    ("pk_test_51Id9H1LPA37e67FkD6cGPdNl6gqEDWIYN960LOFXYPlx09QEV7hkrU5nhEKP3Q29QaSYUKv0kxuwjFhFGc1QHA1G007ldAnXNi");
    const checkoutButton = $('#checkout-button');
    checkoutButton.on('click', function(e){
        console.log($('#email').val());
        e.preventDefault();
        $.ajax({
                url:'index.php?action=pay',
                method:'post',
                data:{
                    id:$('#ref').val(),
                    marque:$('#marque').val(),
                    modele:$('#modele').val(),
                    prix:$('#prix').val(),
                    email:$('#email').val(),
                    quantite:$('#quant').val(),
                    nb:$('#nb').val()

                    
                },
                datatype: 'json',
                success:function(session){
                    console.log(session);
                    return stripe.redirectToCheckout({ sessionId: session.id});
                },
                error: function(){

                    console.error("fail to send !");
                }

        });

    })


});