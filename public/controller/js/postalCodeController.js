$(document).ready(function () {
    // URL de l'API Carto
    const apiCartocodes = 'https://apicarto.ign.fr/api/codes-postaux/communes/';

    // Récupération des données des codes postaux
    async function getPostalCode(postalCode) {
        try {
            const response = await fetch(apiCartocodes + postalCode);
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Erreur:', error);
            return null;
        }
    }
    // Insertion automatique dans le formulaire d'inscription
    $("#postalCodeId").on("change", function () {
        const pCode = this.value;
        getPostalCode(pCode)
            .then(data => {
                $("#cityId").val(data[0].nomCommune);
            });
    });
});