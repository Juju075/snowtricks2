//attendre le chargement du DOM
window.onload = () => {
  // Gestion des liens "Supprimer"
  let links = document.querySelectorAll("[data-delete]");

  //debug noeuds
  console.log(links);
  // On boucle sur links

  for (link of links) {
    // On écoute le clic desactive le lien preventdefault
    link.addEventListener("click", function (e) {
      // On empêche la navigation
      e.preventDefault();

      // On demande confirmation
      if (confirm("Voulez-vous supprimer cette image ?")) {
        //promesse ajax fetch .then reponse
        // On envoie une requête Ajax vers le href du lien avec la méthode DELETE
        //this c le lien qui a ete clique
        fetch(this.getAttribute("href"), {
          method: "DELETE",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ _token: this.dataset.token }),
        })
          .then(
            // On récupère la réponse en JSON
            (response) => response.json()
          )
          .then((data) => {
            if (data.success) this.parentElement.remove();
            else alert(data.error);
          })
          .catch((e) => alert(e));
      }
    });
  }
};
