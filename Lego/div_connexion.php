<div id="arriere_plan_div_connexion"></div>

<div id="div_connexion">
    <!-- Formulaire de connexion -->
    <form action="actions/connexion_utilisateur.php" method="POST" id="form_connexion">
        <label for="pseudo">
            Pseudo
            <input type="text" name="pseudo" id="" required>
        </label>
        <label for="mdp">
            Mot de passe
            <input type="password" name="mdp" id="" required autocomplete="off">
        </label>
        <input type="submit" value="Connexion">
    </form>
    <!-- Formulaire de création de compte -->
    <form action="actions/ajout_utilisateur.php" method="POST" id="form_creation_compte">
        <p>Pas de compte ? Créez-en un !</p>
        <label for="pseudo">
            Pseudo
            <input type="text" name="pseudo" id="" required autocomplete="off">
        </label>
        <div id="div_mdp">
            <label for="mdp">
                Mot de passe
                <input type="password" name="mdp" id="" required autocomplete="off">
            </label>
            <label for="confirmation_mdp">
                Confirmation mot de passe
                <input type="password" name="confirmation_mdp" id="" required autocomplete="off">
            </label>
        </div>
        <input type="submit" value="Je créés mon compte !" class="bouton">
    </form>

    <button onclick="fermerDivConnexion()">Annuler</button>

</div>
