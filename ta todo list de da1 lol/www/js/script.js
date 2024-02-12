rappel_task = '';

function load(url, element)
{
    fetch(url).then(res => {
        element.innerHTML = res; 
    });
}

function BarrerTexte(id)
{
  if(document.getElementById('termine' + id).checked) 
  {
    document.getElementById('titre_tache' + id).classList.add("barrer");
  } 
  else
  {
    document.getElementById('titre_tache' + id).classList.remove("barrer");
  }
  load("taches.php?complete=" + id, "Nowhere");
}

function DateRappel()
{
  if(document.getElementById('ch_rappel_tache').checked) 
  {
    let date_task = document.getElementById('date_tache').getAttribute('value');
    rappel_task = document.getElementById('d_rappel_tache').getAttribute('value');
    
	document.getElementById('d_rappel_tache').setAttribute('value', date_task);
    document.getElementById('d_rappel_tache').setAttribute('readonly', 'readonly');
  }
  else
  {
    document.getElementById('d_rappel_tache').removeAttribute('readonly');
    document.getElementById('d_rappel_tache').setAttribute('value', rappel_task);
  }
}