import{a as c}from"./axios-G2rPRu76.js";import{_ as i,c as o,a as t,F as _,r as u,o as a,t as l}from"./index-gxKAu0iK.js";const h={data(){return{orders:[],categories:[]}},methods:{getOrders(){c.get("http://localhost:9050/order",{}).then(s=>{s.data.data.map(r=>{this.orders.push(r)})}).catch(s=>console.log(s)),console.log(this.orders)}},created(){this.getOrders()}},p={class:"content"},m={class:"about"},g=t("tr",null,[t("th",null,"title"),t("th",null,"total sold"),t("th",null,"total tax paid")],-1),f={class:"roll"};function x(s,n,r,$,d,v){return a(),o("div",p,[t("div",m,[t("table",null,[g,t("div",f,[(a(!0),o(_,null,u(d.orders,e=>(a(),o("tr",null,[t("td",null,l(e.product_title),1),t("td",null,l(e.total_sold),1),t("td",null,"$"+l(e.total_tax_paid),1)]))),256))])])])])}const b=i(h,[["render",x]]);export{b as default};