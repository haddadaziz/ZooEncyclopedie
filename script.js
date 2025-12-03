
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
const mode_educateur_button = document.getElementById("mode_educateur_button")
const go_to_statistiques_button = document.getElementById("go_to_statistiques_button")
const statistiques_view = document.getElementById("statistiques_view")
const homepage_view = document.getElementById("homepage_view")
const back_to_homepage_view = document.getElementById("back_to_homepage_view")

go_to_statistiques_button.addEventListener("click", () => {
    statistiques_view.classList.remove("hidden")
    homepage_view.classList.add("hidden")
})

back_to_homepage_view.addEventListener("click" , () => {
    statistiques_view.classList.add("hidden")
    homepage_view.classList.remove("hidden")
})

