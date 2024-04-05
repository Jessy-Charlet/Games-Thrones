<section class="corp">
  <form action="/submit_form.php" method="post">
    <h1>Formulaire de Contact</h1>
    <label for="nom">Nom complet :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>

    <label for="telephone">Numéro de téléphone :</label>
    <input type="tel" id="telephone" name="telephone">

    <label for="sujet">Sujet de la demande :</label>
    <select id="sujet" name="sujet" required>
      <option value="Assistance produit">Assistance produit</option>
      <option value="Suivi de commande">Suivi de commande</option>
      <option value="Problème de paiement">Problème de paiement</option>
      <option value="Suggestions / Commentaires">Suggestions / Commentaires</option>
      <option value="Autre">Autre</option>
    </select>

    <label for="message">Message :</label>
    <textarea id="message" name="message" required></textarea>

    <label for="captcha">Veuillez résoudre : 5 + 3 = </label>
    <input type="text" id="captcha" name="captcha" required>

    <button type="submit">Envoyer</button>

    <label for="telephone">Téléphone :</label>
    <input type="int" name="telephone" value="01/23/45/67/89" readonly>

    <label for="courrier">Courrier :</label>
    <input type="text" name="courrier" placeholder="Ici chez nous la bas 00000 Ailleurs rue de quelque part" readonly>

  </form>
</section>