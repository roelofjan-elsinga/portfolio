if(!self.define){const e=e=>{"require"!==e&&(e+=".js");let s=Promise.resolve();return o[e]||(s=new Promise(async s=>{if("document"in self){const o=document.createElement("script");o.src=e,document.head.appendChild(o),o.onload=s}else importScripts(e),s()})),s.then(()=>{if(!o[e])throw new Error(`Module ${e} didn’t register its module`);return o[e]})},s=(s,o)=>{Promise.all(s.map(e)).then(e=>o(1===e.length?e[0]:e))},o={require:Promise.resolve(s)};self.define=(s,r,t)=>{o[s]||(o[s]=Promise.resolve().then(()=>{let o={};const n={uri:location.origin+s.slice(1)};return Promise.all(r.map(s=>{switch(s){case"exports":return o;case"module":return n;default:return e(s)}})).then(e=>{const s=t(...e);return o.default||(o.default=s),o})}))}}define("./sw.js",["./workbox-f88cfb32"],(function(e){"use strict";e.skipWaiting(),e.clientsClaim(),e.precacheAndRoute([{url:"/css/front.css",revision:"ff6c55c6cfe46e14dcba2abfc8b8891e"},{url:"/css/resume.css",revision:"6162dce22f4a52e478c3ba0eac78fb87"}],{}),e.registerRoute(/https:\/\/roelofjanelsinga.com/,new e.NetworkFirst({cacheName:"roelofjanelsinga-https://roelofjanelsinga.com",fetchOptions:{mode:"no-cors"},matchOptions:{ignoreSearch:!0},plugins:[new e.CacheableResponsePlugin({statuses:[0,200]})]}),"GET"),e.registerRoute(/\.(?:png|jpg|jpeg|svg)$/,new e.CacheFirst({cacheName:"images",plugins:[]}),"GET"),e.registerRoute(/https:\/\/fonts.(googleapis|gstatic).com/,new e.CacheFirst({cacheName:"google-fonts",plugins:[new e.CacheableResponsePlugin({statuses:[0,200]})]}),"GET")}));
