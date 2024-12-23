<script>
    function getcvt(val) {
       $.ajax({
           type: "POST",
           url: "get-cvt.php",
           data: 'ID =' + val,
           success: function(data) {
               $("#aID").html(data);
           }
       });
   }
   
   $(document).ready(function(){
    $('#ID').change(function(){
        var ID = $(this).val();
        if(ID){
            $.ajax({
                type: 'POST',
                url: 'get-cvt.php',
                data: {ID: ID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#imt').val(data.imt);
                    $('#marque').val(data.marque);
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
 $(document).ready(function(){
    $('#ID').change(function(){
        var ID = $(this).val();
        if(ID){
            $.ajax({
                type: 'POST',
                url: 'get-acv.php',
                data: {ID: ID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#imt').val(data.imt);
                    $('#marque').val(data.marque);
                    $('#model').val(data.model);
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
 $(document).ready(function(){
    $('#aID').change(function(){
        var aID = $(this).val();
        if(aID){
            $.ajax({
                type: 'POST',
                url: 'get-cvs.php',
                data: {aID: aID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#permis').val(data.permis);
                    $('#nom').val(data.nom);
                    $('#prenom').val(data.prenom);
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
                                    $(document).ready(function(){
                                       

                                      

                                        $('#genres, #jour').change(calculerRecette);
                                    });

                                    const recettes = {
    yango: {
        ordinaire: 22000,
        ferie: 17000
    },
    taxi: {
        ordinaire: 22000,
        ferie: 17000
    }
};

const versements = {
    yango: {
        ordinaire: 24000,
        ferie: 17000
    },
    taxi: {
        ordinaire: 27000,
        ferie: 22000
    }
};

function calculerRecette() {
    const vehicule = document.getElementById('genres').value;
    const jour = document.getElementById('jour').value;
    const recetteInput = document.getElementById('recet');
    const versementInput = document.getElementById('versements');

    if (vehicule && jour) {
        // Calcul des recettes
        const recet = recettes[vehicule][jour];
        recetteInput.value = recet ? recet+ " francs CFA" : "";

        // Calcul des versements
        const versement = versements[vehicule][jour];
        versementInput.value = versement ? versement + " francs CFA" : "";
    } else {
        recetteInput.value = "";
        versementInput.value = "";
    }
}


                                    function calculerRecetteTotal() {
                                        const versement = parseFloat(document.getElementById('versement').value) || 0;
                                        const pointage = parseFloat(document.getElementById('pointage').value) || 0;

                                        const recette = versement - pointage;
                                        document.getElementById('recette').value = recette.toFixed(2);

                                        document.getElementById('total_v').value = versement.toFixed(2);
                                        document.getElementById('total_r').value = recette.toFixed(2);
                                        document.getElementById('total').value = versement.toFixed(2);
                                    }

                                    //autre fonction//
                                                    </script>
