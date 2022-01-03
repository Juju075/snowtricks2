// =============================================================================
//Ajouter un nom de foncction function x(){ ... }
/** id=   value=   */
/** Dans le Navigateur (Html) - On Capturer le onclick du bouton LOAD MORE et on empecher comportement par default */
// =============================================================================
document.getElementById("load").addEventListener("", function (e) {
  e.preventDefault();
  return false;
});
// Recuperer la query string
const param = "/?page=" + number; // <a href=""

/** On cree un nouvel Objet XMLHttpRequest pour les appels asynchrones */
console.log("Debut"); //Marqueur de debut d'execution
const xhr = new XMLHttpRequest();

// =============================================================================
//J'ajoute un addEventListener (pour ecouter les changements d'action)
//Declare les evenement on
//ON ATTEND LA REPONSE Gestionnaire d'events pour attendre une réponse et la traite.
//xhr.addEventListener() fonction fleche
// =============================================================================

xhr.onload("readystatechange", () => {
  console.log("readyState => ${xhr.readyState}");
  if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    //traite la reponse
    console.log(xhr.responseText);
  } else if (xhr.readyState === 4 && xhr.status === 404) {
    alert("Erreur 404");
  }
});

// =============================================================================
//emplacement du fichier qui reponds a la requete
// Parametre de la requete dans l'Uri

//ON OUVRE LA CONNEXION - Method Url target et boll((Syncrone ou asyncrhrone)).
// =============================================================================
const uri = ".php";
xhr.open("POST", uri, true);
//xhr.responseType = "text";
//xhr.responseType = "json";

xhr.setRequestHeader("Content-Type", "");

// =============================================================================
//Envoie de la requete. je n'attends pas la réponse ici.
//null pas d'informations dans le body de la requete donc c un GET.
// =============================================================================
xhr.send(param);
console.log("Fin"); //Marqueur de fin d'execution
