<html>

<body bgcolor="white">
Test123132123123
<div id="fb-root"></div>
<div id="fb-id"></div>
<div id="amigos"></div>
<div id="hombres"></div>
<div id="mujeres"></div>
<div id="cosas"></div>


<script src="http://connect.facebook.net/es_LA/all.js"></script>
<script>
  FB.init({appId  : '161323440607624',
  status : true, // check login status
    cookie : true, // enable cookies to allow the server to access the session
    xfbml  : true  // parse XFBML
  });
  
  //Login
FB.login(function(response) {
  if (response.session) {
//user_id=response.session.uid;
    // usuario acepta
	  //tirar nombre
  FB.getLoginStatus(function(response)
  {
   var user_id=response.session.uid;
   var nombre_us="";
  if (response.session)
  {
  FB.api('/me', function(response)
  {

nombre_us = response.name;
document.getElementById('fb-root').innerHTML = "<h3>Nombre: "+nombre_us+".</h3>";
  
  });
var query = FB.Data.query('SELECT uid, name, sex FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())',
                           user_id);
query.wait(function(rows) {
var hombres=mujeres=cosas=total=0
for (x in rows){
total=total+1
switch(rows[x].sex){
case "male":
hombres=hombres+1;
break;
case "female":
mujeres=mujeres+1;
break;
default:
cosas=cosas+1;
break;
};
//if (rows[x].gender=='female'){mujeres=mujeres+1}
//else if (rows[x].gender=='male'){hombres=hombres+1}
//else if (!(rows[x].gender=="male") && !(rows[x].gender!="female")){cosas=cosas+1}
};
//document.getElementById('fb-root').innerHTML = "<h3>Nombre: " + nombre_us + ".</h3>";
//document.getElementById('fb-id').innerHTML = "<h3>ID: "+ user_id +".</h3>";
document.getElementById('amigos').innerHTML ="Tiene " + total + " amigos";
document.getElementById('hombres').innerHTML ="Hay " + hombres + " hombres, lo cual es un " + Math.round((hombres/total*100)*100)/100 +"%.";
document.getElementById('mujeres').innerHTML ="Hay " + mujeres + " mujeres, lo cual es un " + Math.round((mujeres/total*100)*100)/100 +"%.";
document.getElementById('cosas').innerHTML ="Hay " + cosas + " sin datos, lo cual es un " + Math.round((cosas/total*100)*100)/100 +"%.";
 });
 
  }
  else {
    // usuario no acepta
	 document.getElementById('fb-root').innerHTML="<h3>usuario no acepto</h3>";
  }
});
  }});

</script>


</body>
</html>