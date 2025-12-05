tailwind.config = {
    theme: {
        extend: {
            fontFamily: { sans: ['Fredoka', 'sans-serif'] },
            colors: {
                'zoo-green': '#A3E635',
                'zoo-blue': '#60A5FA',
            }
        }
    }
}

const go_to_statistiques_button = document.getElementById("go_to_statistiques_button")
const statistiques_view = document.getElementById("statistiques_view")
const homepage_view = document.getElementById("homepage_view")
const back_to_homepage_view = document.getElementById("back_to_homepage_view")
const educateur_view = document.getElementById("educateur_view")
const mode_educateur_button = document.getElementById("mode_educateur_button")
const back_from_educateur_button = document.getElementById("back_from_educateur")
const success_notification = document.getElementById("success_notification")
const error_notification = document.getElementById("error_notification")

document.addEventListener("DOMContentLoaded", () => {
    const vueSauvegardee = localStorage.getItem('vueActuelle');
    if (vueSauvegardee === 'educateur') {
        educateur_view.classList.remove("hidden");
        homepage_view.classList.add("hidden");
        statistiques_view.classList.add("hidden");
    } else {
        homepage_view.classList.remove("hidden");
        educateur_view.classList.add("hidden");
        statistiques_view.classList.add("hidden");
    }
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success_delete') {
        display_green_notification("Animal supprimé avec succès !");
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    else if (urlParams.get('status') === 'success_ajouter_animal') {
        display_green_notification("Animal ajouté avec succès !");
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    else if (urlParams.get('status') === 'success_habitat') {
        display_green_notification("Nouvel habitat créé avec succès !");
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    else if (urlParams.get('status') === 'error_habitat_exists') {
        display_red_notification("Cet habitat existe déjà !");
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    else if (urlParams.get('status') === 'success_edit_animal') {
        display_green_notification("Informations de l'animal modifiés avec succès !");
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    else if (urlParams.get('status') === 'success_edit_habitat') {
        display_green_notification("Informations de l'habitat modifié avec succès !");
        window.history.replaceState({}, document.title, window.location.pathname);
    }
})

// Fonction qui affiche une notification en vert
function display_green_notification(msg) {
    error_notification.classList.add("hidden")
    success_notification.textContent = msg
    success_notification.classList.remove("hidden");
    setTimeout(() => {
        success_notification.classList.add("hidden")
    }, 3000)
}

// Fonction qui affiche une notification en rouge
function display_red_notification(msg) {
    success_notification.classList.add("hidden")
    error_notification.textContent = msg
    error_notification.classList.remove("hidden");
    setTimeout(() => {
        error_notification.classList.add("hidden")
    }, 3000)
}

mode_educateur_button.addEventListener("click", (e) => {
    e.preventDefault()
    educateur_view.classList.remove("hidden")
    homepage_view.classList.add("hidden")
    statistiques_view.classList.add("hidden")
    localStorage.setItem('vueActuelle', 'educateur')
})

back_from_educateur_button.addEventListener("click", () => {
    educateur_view.classList.add("hidden")
    homepage_view.classList.remove("hidden")
    statistiques_view.classList.add("hidden")
    localStorage.setItem('vueActuelle', 'homepage')
})

go_to_statistiques_button.addEventListener("click", () => {
    statistiques_view.classList.remove("hidden")
    homepage_view.classList.add("hidden")
})

back_to_homepage_view.addEventListener("click", () => {
    statistiques_view.classList.add("hidden")
    homepage_view.classList.remove("hidden")
})

