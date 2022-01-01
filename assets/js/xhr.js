console.log("Debut"); //Marqueur de debut d'execution
const xhr = new XMLHttpRequest();

//J'ajoute un addEventListener

//Declare les evenement on
//ON ATTEND LA REPONSE Gestionnaire d'events pour attendre une réponse et la traite.
//xhr.addEventListener() fonction fleche

xhr.onload("readystatechange", () => {
  console.log("readyState => ${xhr.readyState}");
  if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    //traite la reponse
    console.log(xhr.responseText);
  } else if (xhr.readyState === 4 && xhr.status === 404) {
    alert("Erreur 404");
  }
});

//emplacement du fichier qui reponds a la requete
// Parametre de la requete dans l'Uri

//à recuperer du LOAD (fichier qui vas repondre a la requete)
const uri = "/?page=" + number;

//ON OUVRE LA CONNEXION - Method Url target et boll((Syncrone ou asyncrhrone)).
xhr.open("GET", uri, true);
//xhr.responseType = "text";
//xhr.responseType = "json";

//Envoie de la requete. je n'attends pas la réponse ici.
//null pas d'informations dans le body de la requete donc c un GET.
xhr.send(null);

console.log("Fin"); //Marqueur de fin d'execution
