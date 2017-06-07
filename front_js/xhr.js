function getXMLHttpRequest() {
	var xhr = null;

	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	return xhr;
}

function IsUserFree(callback) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	var username = encodeURIComponent(document.getElementById("username").value);
	var champ = encodeURIComponent(document.getElementById("username").name);
	xhr.open("POST", "controller_js/check_account.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('username=' + username + '&champ=' + champ);
}

function UserData(tData) {

	if (tData == "NO") {
		document.getElementById("box_username").innerHTML = "Ce pseudo est déjà pris";
		document.getElementById("box_username").style.display = "block";
		document.getElementById("box_username").style.color = "red";
	}
	else if (tData == "EMPTY")
	{
		document.getElementById("box_username").innerHTML = "Le champ doit etre renseigné";
		document.getElementById("box_username").style.color = "red";
		document.getElementById("box_username").style.display = "block";
	}
	else
	{
		document.getElementById("box_username").style.display = "none";
	}
}

function IsMailNew(callback) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	var username = encodeURIComponent(document.getElementById("mail").value);
	var champ = encodeURIComponent(document.getElementById("mail").name);
	xhr.open("POST", "controller_js/check_account.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('username=' + username + '&champ=' + champ);

}

function MailData(tData) {

	if (tData == "NO") {
		document.getElementById("box_mail").innerHTML = "Cet email est déjà utilisé.";
		document.getElementById("box_mail").style.display = "block";
		document.getElementById("box_mail").style.color = "red";
	}
	else if (tData == "EMPTY")
	{
		document.getElementById("box_mail").innerHTML = "Le champ doit etre renseigné";
		document.getElementById("box_mail").style.color = "red";
		document.getElementById("box_mail").style.display = "block";
	}
	else
	{
		document.getElementById("box_mail").style.display = "none";
	}
}

function PasswdSec(callback){
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	var passwd = encodeURIComponent(document.getElementById("passwd").value);
	xhr.open("POST", "controller_js/sec_pass.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('passwd=' + passwd);
}

function PutPass(tData)
{
	if (tData == "NO") {
		document.getElementById("box_passwd").innerHTML = "Le mot de passe doit contenir au moins 8 caractères et comporter au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
		document.getElementById("box_passwd").style.display = "block";
		document.getElementById("box_passwd").style.color = "red";
	}
	else
	{
		document.getElementById("box_passwd").style.display = "none";
	}
}

function SamePass()
{
	var passwd = encodeURIComponent(document.getElementById("passwd").value);
	var reppasswd = encodeURIComponent(document.getElementById("reppasswd").value);
	if (passwd != reppasswd)
	{
		document.getElementById("box_reppasswd").innerHTML = "Les mots de passe ne correspondent pas.";
		document.getElementById("box_reppasswd").style.display = "block";
		document.getElementById("box_reppasswd").style.color = "red";
		return false;
	}
	else if (!(reppasswd))
	{
		document.getElementById("box_reppasswd").innerHTML = "Le champ doit etre renseigné";
		document.getElementById("box_reppasswd").style.color = "red";
		document.getElementById("box_reppasswd").style.display = "block";
		return false;
	}
	else
	{
		document.getElementById("box_reppasswd").style.display = "none";
		return true;
	}
}

function MailValid()
{
	var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	var mail = document.getElementById("mail").value;

	if(!regex.test(mail))
	{
		document.getElementById("box_mail_valid").innerHTML = "L'adresse e-mail n'est pas valide.";
		document.getElementById("box_mail_valid").style.display = "block";
		document.getElementById("box_mail_valid").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("box_mail_valid").style.display = "none";
		return true;
	}
}

function UserValid()
{
	var regex = /[^a-zA-Z0-9_]/;
	var username = document.getElementById('username').value;

	if(!regex.test(username))
	{
		document.getElementById("box_username_valid").style.display = "none";
		return true;
	}
	else
	{
		document.getElementById("box_username_valid").innerHTML = "Seul les caractères alpha-numérique et le _ sont acceptés";
		document.getElementById("box_username_valid").style.display = "block";
		document.getElementById("box_username_valid").style.color = "red";
		return false;


	}

}

function IsUserBox()
{

	var username = document.getElementById("username").value;
	var display = document.getElementById("box_username").style.display;
	if (username && display == "none")
		return true;
	else
		return false;
}

function IsMailBox()
{

	var mail = document.getElementById("mail").value;
	var display = document.getElementById("box_mail").style.display;
	if (mail && display == "none")
	{
		return true;
	}
	else
		return false;
}

function IsPasswdBox()
{

	var passwd = document.getElementById("passwd").value;
	var display = document.getElementById("box_passwd").style.display;
	if (passwd  && display == "none")
		return true;
	else
		return false;
}

function VerifForm()
{
	PasswdSec(PutPass);
	IsUserFree(UserData);
	IsMailNew(MailData);
	var free = IsUserBox();
	var mailnew = IsMailBox();
	var mail = MailValid();
	var username = UserValid();
	var same = SamePass();
	var passwd = IsPasswdBox();
	
	if (mail && same && free && mailnew && passwd)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function MailExistsData(tData) {

	if (tData == "FREE") {
		document.getElementById("box_mail").innerHTML = "Aucun compte lié à cet e-mail.";
		document.getElementById("box_mail").style.display = "block";
		document.getElementById("box_mail").style.color = "red";
	}
	else if (tData == "EMPTY")
	{
		document.getElementById("box_mail").innerHTML = "Le champ doit etre renseigné";
		document.getElementById("box_mail").style.color = "red";
		document.getElementById("box_mail").style.display = "block";
	}
	else
	{
		document.getElementById("box_mail").style.display = "none";
	}
}

function VerifMail()
{

	IsMailNew(MailExistsData);
	var mail = MailValid();
	var mailexists = IsMailBox();
	if (mail && mailexists)
		return true;
	else
		return false;
}

function VerifNewPasswd()
{
	PasswdSec(PutPass);
	var same = SamePass();
	var passwd = IsPasswdBox();

	if (same && passwd)
		return true;
	else
		return false;
}

function SavePhoto(callback) {

	var publish = document.getElementById("publishbutton");
	var button_div = document.getElementById("button");
	button_div.removeChild(publish);

	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	var sticker;
	if (document.getElementById('pikachu_i').checked) {
		sticker = document.getElementById('pikachu_i').value;
	}
	else if (document.getElementById('mario_i').checked) {
		sticker = document.getElementById('mario_i').value;
	}
	else if (document.getElementById('link_i').checked) {
		sticker = document.getElementById('link_i').value;
	}
	else if (document.getElementById('sonic_i').checked) {
		sticker = document.getElementById('sonic_i').value;
	}
	var canvas2 = document.querySelector('#canvas2');
	var image = canvas2.toDataURL('image/png');

	xhr.open("POST", "controller_js/make_image.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('sticker=' + sticker + '&image=' + image);
}

function PutPhoto(tData)
{
	document.getElementById("photos").innerHTML = tData;
}

function DelPhoto(callback)
{
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	if (confirm("Voulez-vous vraiment supprimer cette photo ? Elle sera définitivement perdue."))
	{
		var url = document.location.href;
		url = url.split('=');
		var id  = url[url.length - 1];

		xhr.open("POST", "controller_js/del_photo.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('id=' + id);
	}
}

function DelConfirm(tData)
{
	if(tData === "DELETED")
	{
		var photo = document.getElementById("photo_del");
		var button = document.getElementById("delete");
		photo.parentNode.removeChild(photo);
		button.parentNode.removeChild(button);
		var div = document.getElementById("photo");
		var prg = document.createElement("p");
		prg.setAttribute("id", "message")
			div.appendChild(prg);
		P = document.getElementById("message");
		P.innerHTML = "Votre photo a bien été supprimé";
	}
	else if (tDAta === "NOT DELETED")
	{
		var div = document.getElementById("photo");
		var prg = document.createElement("p");
		prg.setAttribute("id", "message");
		div.appendChild(prg);
		P = document.getElementById("message");
		P.innerHTML = "Une erreur est survenue. Votre photo n'a pas été supprimé";
	}
	else
	{
		var div = document.getElementById("photo");
		var prg = document.createElement("p");
		prg.setAttribute("id", "message");
		div.appendChild(prg);
		P = document.getElementById("message");
		P.innerHTML = "Vous ne pouvez pas supprimer la photo d'autres utilisateurs";
	}
}

function infiniteScroll() {
	var html = document.documentElement;
	var height = Math.max( document.body.scrollHeight, document.body.offsetHeight, 
			html.clientHeight, html.scrollHeight, html.offsetHeight );
	var offset = 4;
	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
	var loader = document.getElementById("loader");
	var ajaxready = true;
	window.onscroll = function() {
		if (ajaxready === false)
			return;
		function DisplayOnScroll(callback)
		{
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					callback(xhr.responseText);
					document.getElementById("loader").style.display = "none";
				}
				else if (xhr.readyState < 4) 
				{
					document.getElementById("loader").style.display = "inline";
				}
			};
			height = Math.max( document.body.scrollHeight, document.body.offsetHeight, 
					html.clientHeight, html.scrollHeight, html.offsetHeight );

			if((window.scrollY + window.innerHeight) == height
					|| agentID && (window.scrollY + window.innerHeight) + 150 > height)
			{
				ajaxready = false;
				xhr.open("POST", "controller_js/Scroll_Image.php", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send('offset=' + offset );
			}
		}
		function PutImage(tData)
		{
			if (tData != '')
			{
				ajaxready = true;
				offset += 4;
				var gallery = document.getElementById("gallery");
				var new_div = document.createElement("div");
				new_div.innerHTML = tData;
				new_div.style.opacity = 0;
				gallery.insertBefore(new_div, loader);
				fadeIn(new_div);
			}
			document.getElementById("loader").style.display = "none";
		}
		DisplayOnScroll(PutImage);
	};
};	

function infiniteScrollOffline() {
	var html = document.documentElement;
	var height = Math.max( document.body.scrollHeight, document.body.offsetHeight, 
			html.clientHeight, html.scrollHeight, html.offsetHeight );
	var offset = 4;
	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
	var loader = document.getElementById("loader");
	var ajaxready = true;
	window.onscroll = function() {
		if (ajaxready === false)
			return;
		function DisplayOnScroll(callback)
		{
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					callback(xhr.responseText);
					document.getElementById("loader").style.display = "none";
				}
				else if (xhr.readyState < 4) 
				{
					document.getElementById("loader").style.display = "inline";
				}
			};
			height = Math.max( document.body.scrollHeight, document.body.offsetHeight, 
					html.clientHeight, html.scrollHeight, html.offsetHeight );

			if((window.scrollY + window.innerHeight) == height
					|| agentID && (window.scrollY + window.innerHeight) + 150 > height)
			{
				ajaxready = false;
				xhr.open("POST", "controller_js/Scroll_Image_Offline.php", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send('offset=' + offset );
			}
		}
		function PutImage(tData)
		{
			if (tData != '')
			{
				ajaxready = true;
				offset += 4;
				var gallery = document.getElementById("gallery");
				var new_div = document.createElement("div");
				new_div.innerHTML = tData;
				new_div.style.opacity = 0;
				gallery.insertBefore(new_div, loader);
				fadeIn(new_div);
			}
			document.getElementById("loader").style.display = "none";
		}
		DisplayOnScroll(PutImage);
	};
};

function fadeIn(el) {

	var tick = function() {
		el.style.opacity = +el.style.opacity + 0.02;

		if (+el.style.opacity < 1) {
			(window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
		}
	};
	tick();
}

function AddCom(img_id)
{
	var id = "com" + img_id.getAttribute('id');
	var input = document.getElementById(id);
	var com = input.value;

	function PushCom(callback) {

		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				callback(xhr.responseText);
			}
			else if (xhr.readyState < 4) {
				input.value = "";
			}
		};
		xhr.open("POST", "controller_js/Add_Com.php", true);
		var form = new FormData();
		form.append('com', com);
		form.append('img_id', img_id.getAttribute('id'));
//		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//		xhr.send('com=' + com + '&img_id=' + img_id.getAttribute('id'));
		xhr.send(form);
	}

	function ConfirmCom(tData)
	{
		var p_id = "nb_coms_" + img_id.getAttribute('id');
		P = document.getElementById(p_id);
		if (tData > 1)
			P.innerHTML = tData + " commentaires";
		else
			P.innerHTML = tData + " commentaire";
		input.value = "";

	}

	if (typeof com !== 'undefined' && com != "")
		PushCom(ConfirmCom);
}

function AddComToPage(img_id)
{
	var id = "com" + img_id.getAttribute('id');
	var input = document.getElementById(id);
	var com = input.value;

	function PushComToPage(callback) {

		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				callback(xhr.responseText);
			}
			else if (xhr.readyState < 4) {
				input.value = "";
			}
		};
		xhr.open("POST", "controller_js/Add_Com_To_Page.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('com=' + com + '&img_id=' + img_id.getAttribute('id'));
	}

	function DisplayCom(tData)
	{
		input.value = "";
		div = document.getElementById("coms");
		div.innerHTML = tData;

	}

	if (typeof com !== 'undefined' && com != "")
		PushComToPage(DisplayCom);
}

function Like (button)
{
	var id = button.getAttribute('id');
	id = id.split("_");
	img_id = id[id.length - 1];


	function PushLike(callback) {

		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				callback(xhr.responseText);
			}
		};
		xhr.open("POST", "controller_js/Add_Like.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('img_id=' + img_id);
	}
	function ConfirmLike(tData)
	{
		button.parentNode.removeChild(button);
		var encart_like = document.getElementById("like_gallery_" + img_id);
		var new_button = document.createElement("button");
		new_button.setAttribute("id", "dis_" + img_id);
		new_button.setAttribute("onclick", "Dislike(this)");
		encart_like.appendChild(new_button);
		dis_button = document.getElementById("dis_" + img_id);
		dis_button.innerHTML = "Désaimer";
		var p_id = "nb_likes_" + img_id;
		P = document.getElementById(p_id);
		if (tData > 1 && P !== null)
			P.innerHTML = tData + " likes";
		else if (P !== null)
			P.innerHTML = tData + " like";
	}
	PushLike(ConfirmLike);
}

function Dislike(button)
{
	var id = button.getAttribute('id');
	id = id.split("_");
	img_id = id[id.length - 1];

	function PushDislike(callback) {

		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				callback(xhr.responseText);
			}
		};
		xhr.open("POST", "controller_js/Del_Like.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('img_id=' + img_id);
	}

	function ConfirmDislike(tData)
	{
		button.parentNode.removeChild(button);
		var encart_like = document.getElementById("like_gallery_" + img_id);
		var new_button = document.createElement("button");
		new_button.setAttribute("id", "like_" + img_id);
		new_button.setAttribute("onclick", "Like(this)");
		encart_like.appendChild(new_button);
		dis_button = document.getElementById("like_" + img_id);
		dis_button.innerHTML = "Aimer";
		var p_id = "nb_likes_" + img_id;
		P = document.getElementById(p_id);
		if (tData > 1 && P !== null)
			P.innerHTML = tData + " likes";
		else if (P !== null)
			P.innerHTML = tData + " like";
	}
	PushDislike(ConfirmDislike);
}
