(function(a){"use strict";var b=[],c=function(a,c,d){b.push({name:a,drawShape:c,drawBorder:d})},d=function(){return b},e=function(a){return function(b,c,d,e,f,g){g.fillStyle=f,g.beginPath(),a(b,c,d,e,g),g.closePath(),g.fill()}},f=function(a){return function(b,c,d,e,f,g){g.strokeStyle=f,g.lineWidth=e/5,g.beginPath(),a(b,c,d,e,g),g.closePath(),g.stroke()}},g=function(a,b,c,d,e){var f=45*Math.PI/180;e.moveTo(b+d*Math.sin(f),c-d*Math.cos(f));for(var g=1;g<4;g++)e.lineTo(b+Math.sin(f+2*Math.PI*g/4)*d,c-Math.cos(f+2*Math.PI*g/4)*d)};c("square",e(g),f(g));var h=function(a,b,c,d,e){e.arc(b,c,d,0,2*Math.PI,!0)};c("circle",e(h),f(h));var i=function(a,b,c,d,e){e.moveTo(b-d,c),e.lineTo(b,c-d),e.lineTo(b+d,c),e.lineTo(b,c+d)};c("diamond",e(i),f(i));var j=function(a,b,c,d,e){var f=a.cross&&a.cross.lineWeight||5;e.moveTo(b-d,c-f),e.lineTo(b-d,c+f),e.lineTo(b-f,c+f),e.lineTo(b-f,c+d),e.lineTo(b+f,c+d),e.lineTo(b+f,c+f),e.lineTo(b+d,c+f),e.lineTo(b+d,c-f),e.lineTo(b+f,c-f),e.lineTo(b+f,c-d),e.lineTo(b-f,c-d),e.lineTo(b-f,c-f)};c("cross",e(j),f(j));var k=function(a,b,c,d,e){var f=a.equilateral&&a.equilateral.numPoints||5,g=(a.equilateral&&a.equilateral.rotate||0)*Math.PI/180,h=d;e.moveTo(b+h*Math.sin(g),c-h*Math.cos(g));for(var i=1;i<f;i++)e.lineTo(b+Math.sin(g+2*Math.PI*i/f)*h,c-Math.cos(g+2*Math.PI*i/f)*h)};c("equilateral",e(k),f(k));var l=function(a,b,c,d,e){var f=a.star&&a.star.numPoints||5,g=a.star&&a.star.innerRatio||.5,h=d,i=d*g,j=Math.PI/f;e.moveTo(b,c-d);for(var k=0;k<f;k++)e.lineTo(b+Math.sin(j+2*Math.PI*k/f)*i,c-Math.cos(j+2*Math.PI*k/f)*i),e.lineTo(b+Math.sin(2*Math.PI*(k+1)/f)*h,c-Math.cos(2*Math.PI*(k+1)/f)*h)};c("star",e(l),f(l));var m=function(a,b,c,d,e,f){f.fillStyle="yellow",f.beginPath(),f.arc(b,c,d,1.25*Math.PI,0,!1),f.arc(b,c,d,0,.75*Math.PI,!1),f.lineTo(b,c),f.closePath(),f.fill(),f.fillStyle="white",f.strokeStyle="black",f.beginPath(),f.arc(b+d/3,c-d/3,d/4,0,2*Math.PI,!1),f.closePath(),f.fill(),f.stroke(),f.fillStyle="black",f.beginPath(),f.arc(b+4*d/9,c-d/3,d/8,0,2*Math.PI,!1),f.closePath(),f.fill()};c("pacman",m,null),this.ShapeLibrary={enumerate:d,version:"0.1"}}).call(this),function(a){"use strict";if("undefined"==typeof sigma)throw"sigma is not declared";if("undefined"==typeof ShapeLibrary)throw"ShapeLibrary is not declared";sigma.utils.pkg("sigma.canvas.nodes"),sigma.utils.pkg("sigma.svg.nodes");var b=a,c={},d=function(a){b=a},e=function(a,d,e,f,g){if(b&&a.image&&a.image.url){var h=a.image.url,i=a.image.h||1,j=a.image.w||1,k=a.image.scale||1,l=a.image.clip||1,m=c[h];m||(m=document.createElement("IMG"),m.src=h,m.status="loading",m.onerror=function(){console.log("error loading",h),m.status="error"},m.onload=function(){console.log("redraw on image load",h),m.status="ok",b.refresh()},c[h]=m);var n=j<i?j/i:1,o=i<j?i/j:1,p=f*k;g.save(),g.beginPath(),g.arc(d,e,f*l,0,2*Math.PI,!0),g.closePath(),g.clip(),"ok"===m.status&&g.drawImage(m,d+Math.sin(-.7855)*p*n,e-Math.cos(-.7855)*p*o,p*n*2*Math.sin(-.7855)*-1,p*o*2*Math.cos(-.7855)),g.restore()}},f=function(a,c,d){if(b&&a.image&&a.image.url){var e=document.createElementNS(d("xmlns"),"circle"),f=document.createElementNS(d("xmlns"),"clipPath"),g=d("classPrefix")+"-clip-path-"+a.id,h=document.createElementNS(d("xmlns"),"defs"),i=document.createElementNS(d("xmlns"),"image");a.image.url;f.setAttributeNS(null,"id",g),f.appendChild(e),h.appendChild(f);var j=/MSIE [5-9]/.test(navigator.userAgent)?"":document.location.href;j=j.split("#")[0],i.setAttributeNS(null,"class",d("classPrefix")+"-node-image"),i.setAttributeNS(null,"clip-path","url("+j+"#"+g+")"),i.setAttributeNS(null,"pointer-events","none"),i.setAttributeNS("http://www.w3.org/1999/xlink","href",a.image.url),c.appendChild(h),c.appendChild(i)}},g=function(a,b,c){sigma.canvas.nodes[a]=function(a,d,f){var g=f("prefix")||"",h=a[g+"size"],i=a.color||f("defaultNodeColor"),j=a.borderColor||i,k=a[g+"x"],l=a[g+"y"];d.save(),b&&b(a,k,l,h,i,d),c&&c(a,k,l,h,j,d),e(a,k,l,h,d),d.restore()},sigma.svg.nodes[a]={create:function(a,b){var c=document.createElementNS(b("xmlns"),"g"),d=document.createElementNS(b("xmlns"),"circle");return c.setAttributeNS(null,"class",b("classPrefix")+"-node-group"),c.setAttributeNS(null,"data-node-id",a.id),d.setAttributeNS(null,"data-node-id",a.id),d.setAttributeNS(null,"class",b("classPrefix")+"-node"),d.setAttributeNS(null,"fill",a.color||b("defaultNodeColor")),c.appendChild(d),f(a,c,b),c},update:function(a,b,c){for(var d=c("classPrefix"),e=a.image.clip||1,f=a.image.h||1,g=a.image.w||1,h=c("prefix")||"",i=a.image.scale||1,j=a[h+"size"],k=a[h+"x"],l=a[h+"y"],m=i*j,n=g<f?g/f:1,o=f<g?f/g:1,p=0,q=b.childNodes;p<q.length;p++){var r=q[p].getAttribute("class");switch(r){case d+"-node":q[p].setAttributeNS(null,"cx",k),q[p].setAttributeNS(null,"cy",l),q[p].setAttributeNS(null,"r",j),c("freeStyle")||q[p].setAttributeNS(null,"fill",a.color||c("defaultNodeColor"));break;case d+"-node-image":q[p].setAttributeNS(null,"x",k+Math.sin(-.7855)*m*n),q[p].setAttributeNS(null,"y",l-Math.cos(-.7855)*m*o),q[p].setAttributeNS(null,"width",m*n*2*Math.sin(-.7855)*-1),q[p].setAttributeNS(null,"height",m*o*2*Math.cos(-.7855));break;default:var s=q[p].firstChild;if(null!=s){var t=d+"-clip-path-"+a.id;s.getAttribute("id")===t&&(s.firstChild.setAttributeNS(null,"cx",k),s.firstChild.setAttributeNS(null,"cy",l),s.firstChild.setAttributeNS(null,"r",e*j))}}}b.style.display=""}}};ShapeLibrary.enumerate().forEach(function(a){g(a.name,a.drawShape,a.drawBorder)}),this.CustomShapes={init:d,version:"0.1"}}.call(this);