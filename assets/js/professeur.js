import SlimSelect from 'slim-select'

if (!null == document.getElementById("professeur_classes")) {
  new SlimSelect({
    select: '#professeur_classes'
  })
  
  new SlimSelect({
    select: '#professeur_modules'
  })
}


new SlimSelect({
  select: '#inscription_classe'
})

