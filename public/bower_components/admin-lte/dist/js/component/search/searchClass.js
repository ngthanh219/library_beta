var base_url = 'http://localhost:8082/php/QuanLyDiemDanh/';
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.zIndex="9999";
    document.getElementById("livesearch").style.display = "none";
    document.getElementById("tableContent").style.display = "block";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.display = "block";
      document.getElementById("tableContent").style.display = "none";
    }
  }
  xmlhttp.open("GET",base_url+"ClassRoom/searchClass?TenLop="+str,true);
  xmlhttp.send();
}