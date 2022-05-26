async function elementUpdate(selector) {
  try {
    var html = await (await fetch(location.href)).text();
    var newdoc = new DOMParser().parseFromString(html, 'text/html');
    document.querySelector(selector).outerHTML = newdoc.querySelector(selector).outerHTML;
    console.log('Элемент '+selector+' был успешно обновлен');
    return true;
  } catch(err) {
    console.log('При обновлении элемента '+selector+' произошла ошибка:');
    console.dir(err);
    return false;
  }
}


function ShoppingListOpen() {
  document.getElementById("ShoppingList").style.display = 'block';
  document.getElementById("background").style.zIndex = 2;
}

function closeList() {
  document.getElementById("ShoppingList").style.display = '';
  document.getElementById("background").style.zIndex = -2;
}