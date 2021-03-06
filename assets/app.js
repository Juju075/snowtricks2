/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";

//
import { Tooltip, Toast, Popover } from "bootstrap";
// start the Stimulus application
import "./bootstrap";

//Pour afficher le nom du fichier selectioner dans le label
$(".custom-file-input").on("change", function (e) {
  var inputFile = e.currentTarget;
  $(inputFile).parent().find(".custom-file-label").html(inputFile.file[0].name);
});
