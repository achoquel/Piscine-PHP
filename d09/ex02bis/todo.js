function del(id)
{
  if (confirm( "Do you want to delete this ToDo ?"))
  {
    $("#"+id).remove();
    eraseCookie(id);
    document.location.reload(true);
  }
}

function initCookie()
{
  var cookies = document.cookie.split(';');
  if (cookies[0])
  {
    for (var i = 0; i < cookies.length; i++)
    {
      var cook = cookies[i].split('=');
      var todo = cook[0];
      $('<div id="'+todo+'" onClick="del('+cook[0]+')">'+cook[1]+'</div>').prependTo('#ft_list');
    }
  }
}

function createCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

function new_todo()
{
  var text = prompt("Ajouter un To Do", "");
  if (text === "")
  {
        alert("Le texte est vide");
  }
  else if (text){
    var todo = Math.floor(Math.random() * 1000000000);
    $('<div id="'+todo+'">'+text+'</div>').prependTo('#ft_list');
    createCookie(todo, text, 1);
    $("#"+todo).click(function(){
      if (confirm( "Do you want to delete this ToDo ?"))
      {
        eraseCookie(todo);
        $("#"+todo).remove();
      }
    });
  }
}
