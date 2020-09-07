Request examples:
```
var res = await window.fetch('/generator/generate-products', {method: 'POST'});
var text = await res.text();
console.log(text);


var res = await window.fetch('/order', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify([1, 2, 3])
});
var text = await res.text();
console.log(text);


var res = await window.fetch('/order/pay/1', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({'sum': 1000})
});
var text = await res.text();
console.log(text);
```
