<html>
<head>
<body>
<form method="get" action="dodaj.php">
Podaj PESEL: <input id="pesel" name="pesel" type="number">
<input type="button" value="Sprawdź poprawność" onClick="sprawdz_pesel()">
<input type="button" value="Sprawdź ponownie" onClick="window.location.reload()">
<div id="wynik"></div>
<div id="wynik2"></div>
<div id="wynik3"></div>
<div id="guzik"></div>
</form>
<script type="text/javascript">
  function sprawdz_date(dzien,miesiac,rok)
  {
    var data = new Date(rok,miesiac-1,dzien);
    return data.getDate()==dzien &&
           data.getMonth()==miesiac-1 &&
           data.getFullYear()==rok;
  }

  function sprawdz_pesel()
  {
    var cyfra = new Array();
    var pesel_dlugosc = document.getElementById("pesel").value;
    var wagi = [1,3,7,9,1,3,7,9,1,3,1];
    var suma_kontrolna=0;

    for (i=0;i<11; i++)
    {
      cyfra[i] = Number(String(pesel_dlugosc.substring(i,i+1)));
      if (isNaN(cyfra[i]))
      {
        return;
      }
    }
    
    for (i=0;i<11;i++)
        suma_kontrolna+=wagi[i]*cyfra[i];

    var sprawdz_rok = 1900+cyfra[0]*10+cyfra[1];
    if (cyfra[2]>=2 && cyfra[2]<8)
        sprawdz_rok+=Math.floor(cyfra[2]/2)*100;
    if (cyfra[2]>=8)
        sprawdz_rok-=100;

    var miesiac = (cyfra[2]%2)*10+cyfra[3];
    var dzien = cyfra[4]*10+cyfra[5];

    function zla_suma(sumaa){
        document.getElementById("wynik").innerHTML = (sumaa?"Zła suma" : "Suma okej");
        return sumaa;
    }

    function zla_dlugosc(dlugosc){
        document.getElementById("wynik2").innerHTML = (dlugosc?"Zła długość" : "Długosć okej");
        return dlugosc;
    }

    function zla_data(data){
        document.getElementById("wynik3").innerHTML = (data?"Zła data" : "Data okej");
        return data;
    }

    var dlug = (zla_dlugosc(pesel_dlugosc.length != 11));
    var sum = (zla_suma((suma_kontrolna%10)!=0));
    var dat = (zla_data(!sprawdz_date(dzien,miesiac,sprawdz_rok)));
    var dlug_d = !(zla_dlugosc(pesel_dlugosc.length != 11));
    var sum_d = !(zla_suma((suma_kontrolna%10)!=0));
    var dat_d = !(zla_data(!sprawdz_date(dzien,miesiac,sprawdz_rok)));

    if (dlug||sum||dat)
    {
        document.getElementById("pesel").style.backgroundColor = "yellow";
        przycisk.innerHTML = przycisk.innerHTML + "<input type='hidden'>";
        return;
    }
    if ((dlug&&sum)||(dlug&&dat)||(sum&&dat))
    {
        document.getElementById("pesel").style.backgroundColor = "orange";
        przycisk.innerHTML = przycisk.innerHTML + "<input type='hidden'>";
        return;
    }
    if (dlug&&sum&&dat)
    {
        document.getElementById("pesel").style.backgroundColor = "red";
        przycisk.innerHTML = przycisk.innerHTML + "<input type='hidden'>";
        return;
    }
    if (dlug_d&&sum_d&&dat_d)
    {
        document.getElementById("pesel").style.backgroundColor = "green";
        var przycisk = document.getElementById("guzik");
        przycisk.innerHTML = przycisk.innerHTML + "<input type='submit'>";
        return;
    }
}
</script>
</head>
</body>
</html>
