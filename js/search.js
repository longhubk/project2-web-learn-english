function showSuggest(string){

  if(string.length == 0){
    document.getElementById('txtSuggest').innerHTML = "Suggestion here"
    return
  }else{
    let xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        document.getElementById('txtSuggest').innerHTML = this.responseText
      }
    }
    xmlhttp.open("GET", "../../php/getSuggest.php?q=" + string, true)
    xmlhttp.send()
  }

}