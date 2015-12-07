<html>
<head>
<script type="text/javascript">
var bug = function(value,title)
{
if(window.console != undefined)
{    
    if(title!=null) console.debug(title);
    console.debug(value);
}
};
    var intval=""
    function start_Int(){
        if(intval==""){
          intval=window.setInterval("start_clock()",1000)
          bug(intval,"intval");
      }else{
          stop_Int()
      }
    }

    function stop_Int(){
        if(intval!=""){
          window.clearInterval(intval)
          intval=""
          myTimer.innerHTML="Interval Stopped"
      }
    }

    function start_clock(){
        var d=new Date()
        var sw="am"
        var h=d.getHours()
        var m=d.getMinutes() + ""
        var s=d.getSeconds() + ""
        if(h>12){
          h-=12
          sw="pm"
      }
        if(m.length==1){
          m="0" + m
      }
        if(s.length==1)  {
          s="0" + s
      }
        myTimer.innerHTML=h + ":" + m + ":" + s + " " + sw
    }
</script>
</head>

<body>
<span id="myTimer">Interval Stopped</span>
    <br><br><br>
    <input type="button" value="Start" onclick="start_Int()">
    <input type="button" value="Stop" onclick="stop_Int()">
</body>
