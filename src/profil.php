<<<<<<< Updated upstream
<section class="corp">
    <form method="post" action="<?= $router->generate('deconnexion') ?>">
=======
<button>Mon compte <span>►</span></button>
<div>
    <button>Informations personnelles <span>►</span></button>
        <div>
            <form method="post">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="">
                <label for="telephone">Téléphone</label>
                <input type="tel" name="telephone" id="telephone" value="">
                <input type="submit" value="Enregistrer">
            </form>
        </div>
    <button>Mes commandes <span>►</span></button>
        <div>
        
        </div>
    <button>Mes commantaires <span>►</span></button>
        <div>
        
        </div>
</div>
<form method="post" action="<?= $router->generate('deconnexion') ?>">
>>>>>>> Stashed changes
    <input type="submit" value="Se déconnecter">
</form>
</section>
