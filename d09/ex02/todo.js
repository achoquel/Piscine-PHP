function del(id)
{
  if (confirm( "Do you want to delete this ToDo ?"))
  {
    var element = document.getElementById(id);
    eraseCookie(id);
    document.location.reload(true);
    element.remove();
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
    var div = document.createElement("div");
    var todo = cook[0];
    div.setAttribute("id", cook[0]);
    div.setAttribute("onClick", 'del('+cook[0]+')');
    var node = document.createTextNode(cook[1]);
    div.appendChild(node);
    var element = document.getElementById("ft_list");
    element.insertAdjacentElement('afterbegin',div);
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
    var div = document.createElement("div");
    var todo = Math.floor(Math.random() * 1000000000);
    div.setAttribute("id", todo);
    var node = document.createTextNode(text);
    div.appendChild(node);
    var element = document.getElementById("ft_list");
    element.insertAdjacentElement('afterbegin',div);
    createCookie(todo, text, 1);
    document.getElementById(todo).addEventListener('click',
    function (remove)
    {
      if (confirm( "Do you want to delete this ToDo ?"))
      {
        var element = document.getElementById(todo);
        eraseCookie(todo);
        element.remove();
      }
    }
  );
  }
}
