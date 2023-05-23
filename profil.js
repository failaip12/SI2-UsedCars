// let aktivanTab = '/profil'

const navigationButtons = document.getElementsByClassName('navigation-button')
const tabs = document.getElementsByClassName('tab')

for (const button of navigationButtons) {
  button.addEventListener('click', function() {
    // Remove active button classes
    for (const button of navigationButtons) {
      button.classList.remove('active-nav')
    }

    // Remove active button classes
    console.log(tabs)
    for (const tab of tabs) {
      tab.classList.remove('active-tab')
    }

    this.classList.add('active-nav')
    
    document.getElementById(this.value).classList.add('active-tab')
  })
}