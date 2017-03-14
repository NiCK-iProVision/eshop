     var snímkůZaSekundu = 30,
          element = document.getElementById("zprava"),
          přerušitAnimaci = new Function;
 
      function nastavViditelnost(element, opacity) {
        if("filters" in element) // Internet Explorer
          element.style.filter = opacity === 100?"":"alpha(opacity=" + opacity + ")";
        else { // Ostatní prohlížeče
          element.style.opacity =
          element.style.MozOpacity =
          element.style.KhtmlOpacity = opacity === 100?"":opacity / 100;
        }
      };
 
      function získejViditelnost(element) {
        var shoda;
        if("filters" in element) { // Internet Explorer
          shoda = element.style.filter.match(/opacity=(\d*)/);
          return shoda === null?100:Number(shoda[1]);
        } else { // Ostatní prohlížeče
          shoda = element.style.opacity ||
                  element.style.MozOpacity ||
                  element.style.KhtmlOpacity;
          return shoda && shoda.length?Number(shoda) * 100:100;
        }
      };
 
      function zobraz(element, čas, zpětnáVazba) {
        var aktuálníViditelnost = získejViditelnost(element);
        čas *= 1 - aktuálníViditelnost / 100;
        var početFází = Math.floor(čas / snímkůZaSekundu),
            aktuálníFáze = 0,
            přírůstek = (100 - aktuálníViditelnost) / početFází,
            interval = setInterval(function() {
              if(aktuálníFáze === početFází) {
                nastavViditelnost(element, 100);
                clearInterval(interval);
                if(zpětnáVazba instanceof Function)
                  zpětnáVazba();
              } else {
                nastavViditelnost(element, aktuálníViditelnost + přírůstek * aktuálníFáze);
                aktuálníFáze++;
              }
            }, 1000 / snímkůZaSekundu);
        return function() {
          clearInterval(interval);
        };
      };
 
      function skryj(element, čas, zpětnáVazba) {
        var aktuálníViditelnost = získejViditelnost(element);
        čas *= aktuálníViditelnost / 100;
        var početFází = Math.floor(čas / snímkůZaSekundu),
            aktuálníFáze = 0,
            přírůstek = aktuálníViditelnost / početFází,
            interval = setInterval(function() {
              if(aktuálníFáze === početFází) {
                nastavViditelnost(element, 0);
                clearInterval(interval);
                if(zpětnáVazba instanceof Function)
                  zpětnáVazba();
              } else {
                nastavViditelnost(element, aktuálníViditelnost - přírůstek * aktuálníFáze);
                aktuálníFáze++;
              }
            }, 1000 / snímkůZaSekundu);
        return function() {
          clearInterval(interval);
        };
      };
      setTimeout("přerušitAnimaci = skryj(element, 1500)",3000);
      setTimeout("document.getElementById('zprava').style.display = 'none'",5500);