<section class="corp">
  <form action="/submit_form.php" method="post" class="contact">
    <h3>Formulaire de Contact</h3>
    <label for="nom">Nom complet :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>

    <label for="telephone">Numéro de téléphone :</label>
    <input type="tel" id="telephone" name="telephone">

    <label for="sujet">Sujet de la demande :</label>
    <select id="sujet" name="sujet" required>
      <option value=""></option>
      <option value="Assistance produit">Assistance produit</option>
      <option value="Suivi de commande">Suivi de commande</option>
      <option value="Problème de paiement">Problème de paiement</option>
      <option value="Suggestions / Commentaires">Suggestions / Commentaires</option>
      <option value="Données personnelle">Données personnelle</option>
      <option value="Autre">Autre</option>
    </select>

    <label for="message">Message :</label>
    <textarea id="message" name="message" rows="6" cols="33" required></textarea>

    <label for="captcha">Veuillez résoudre : 5 + 3 = </label>
    <input type="text" id="captcha" name="captcha" required>

    <button type="submit">Envoyer</button>

    <h3>✆ Par téléphone</h3>
    <p>01 23 45 67 89 <span>De 9h à 17h</span><span>Du Lundi au Vendredi</span></p>

    <h3>✉ Par courrier</h3>
    <p>Ici chez nous la bas</br>rue de quelque part</br>00000 Ailleurs</p>

  </form>
</section>