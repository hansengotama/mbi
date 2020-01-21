(window.webpackJsonp=window.webpackJsonp||[]).push([[42],{216:function(t,n,a){"use strict";var e=a(24);a.n(e).a},217:function(t,n,a){(n=t.exports=a(5)(!1)).push([t.i,"@import url(https://fonts.googleapis.com/css?family=Public+Sans&display=swap);",""]),n.push([t.i,".orange[data-v-5cdcf383] {\n  color: #f77321;\n}\n.blue[data-v-5cdcf383] {\n  color: #0000f5;\n}\n.soft-blue[data-v-5cdcf383] {\n  color: #0076bd;\n}\n.red[data-v-5cdcf383] {\n  color: #f00;\n}\n.display-flex[data-v-5cdcf383] {\n  display: -webkit-box;\n  display: flex;\n}\n.display-block[data-v-5cdcf383] {\n  display: block;\n}\nhtml[data-v-5cdcf383],\nbody[data-v-5cdcf383] {\n  font-family: 'Public Sans', sans-serif !important;\n  font-size: 14px;\n}\nhtml[data-v-5cdcf383],\nbody[data-v-5cdcf383] {\n  width: 100%;\n  min-height: 100%;\n}\ninput[data-v-5cdcf383]:active,\ninput[data-v-5cdcf383]:focus,\nbutton[data-v-5cdcf383]:active,\nbutton[data-v-5cdcf383]:focus,\nselect[data-v-5cdcf383]:active,\nselect[data-v-5cdcf383]:focus {\n  outline: none;\n}\ninput.error[data-v-5cdcf383] {\n  border-color: #f00 !important;\n  margin-bottom: 5px;\n}\ntable[data-v-5cdcf383],\ntr[data-v-5cdcf383] {\n  width: 100%;\n}\ntable > tr > th[data-v-5cdcf383] {\n  padding: 10px 12px;\n  padding-top: 0;\n  min-width: 50px;\n  text-transform: uppercase;\n  font-size: 14px;\n  font-weight: normal;\n  border-bottom: 2px solid #f0f0f0;\n}\ntable > tr > td[data-v-5cdcf383] {\n  padding: 10px 15px;\n  border-left: none;\n  border-right: none;\n}\n.table-container[data-v-5cdcf383] {\n  overflow-x: auto;\n}\n.text-center[data-v-5cdcf383] {\n  text-align: center;\n}\n.mt-1[data-v-5cdcf383] {\n  margin-top: 1em;\n}\n.mt-2[data-v-5cdcf383] {\n  margin-top: 2em;\n}\n.mt-3[data-v-5cdcf383] {\n  margin-top: 3em;\n}\n.mt-4[data-v-5cdcf383] {\n  margin-top: 4em;\n}\n.mt-5[data-v-5cdcf383] {\n  margin-top: 5em;\n}\n#user-management[data-v-5cdcf383] {\n  padding-top: 15px;\n}\n.table-container[data-v-5cdcf383] {\n  margin-top: 2em;\n  margin-bottom: 1em;\n}\n",""])},24:function(t,n,a){var e=a(217);"string"==typeof e&&(e=[[t.i,e,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};a(6)(e,r);e.locals&&(t.exports=e.locals)},336:function(t,n,a){"use strict";a.r(n);var e=a(3),r={props:["accessToken"],components:{Panel:function(){return a.e(0).then(a.bind(null,340))},Search:function(){return a.e(3).then(a.bind(null,343))},Paginate:function(){return a.e(2).then(a.bind(null,344))}},data:function(){return{user:{data:[]},filter:{text:"",page:1,per_page:10}}},mounted:function(){this.getUser()},computed:{userLogin:{get:function(){return this.$store.getters.getUserLogin},set:function(t){this.$store.commit("setUserLogin",t)}}},methods:{getUser:function(){var t=this;this.accessToken&&e.a.get("/api/user?filter[text]="+this.filter.text+"&filter[page]="+this.filter.page+"&filter[per_page]="+this.filter.per_page+"&filter[district_id]="+this.userLogin.district_id,this.accessToken).then((function(n){n.data.success&&(t.user=n.data.result)}))},search:function(t){this.filter.text=t,this.getUser()},changePaginate:function(t){this.filter.page=t.page,this.filter.per_page=t.per_page,this.getUser()}}},i=(a(216),a(2)),c=Object(i.a)(r,(function(){var t=this,n=t.$createElement,a=t._self._c||n;return a("div",{attrs:{id:"user-management"}},[a("panel",{attrs:{title:"Kelola Pengguna"}},[a("template",{slot:"body"},[a("search",{on:{search:t.search}}),t._v(" "),a("div",{staticClass:"table-container"},[a("table",[a("tr",[a("th",[t._v("No")]),t._v(" "),a("th",[t._v("Nama")]),t._v(" "),a("th",[t._v("Email")]),t._v(" "),a("th",[t._v("Tanggal Lahir")]),t._v(" "),a("th",[t._v("Tempat Lahir")]),t._v(" "),a("th",[t._v("Nomor Telepon")]),t._v(" "),a("th",[t._v("Peran")]),t._v(" "),a("th",[t._v("Jenis Kelamin")]),t._v(" "),a("th",[t._v("No. KTUB")])]),t._v(" "),0==t.user.data.length?a("tr",[a("td",{attrs:{colspan:"100%",align:"center",bgcolor:"#f0f0f0"}},[t._v("Tidak ada data")])]):t._l(t.user.data,(function(n,e){return a("tr",[a("td",[t._v(t._s(e+1))]),t._v(" "),a("td",[t._v(t._s(n.name))]),t._v(" "),a("td",[t._v(t._s(n.email))]),t._v(" "),a("td",[t._v(t._s(t._f("dateFormat")(n.birth_of_date,"DD MMMM YYYY")))]),t._v(" "),a("td",[n.place_of_birth?a("span",[t._v("\n                                "+t._s(n.place_of_birth)+"\n                            ")]):a("span",[t._v("-")])]),t._v(" "),a("td",[t._v(t._s(n.phone_number))]),t._v(" "),a("td",[t._v(t._s(n.role))]),t._v(" "),a("td",[n.blood_type?a("span",[t._v("\n                                "+t._s(n.blood_type)+"\n                            ")]):a("span",[t._v("-")])]),t._v(" "),a("td",[n.ktub_number?a("span",[t._v("\n                                "+t._s(n.ktub_number)+"\n                            ")]):a("span",[t._v("-")])])])}))],2)]),t._v(" "),a("paginate",{attrs:{data:t.user},on:{changePaginate:t.changePaginate}})],1)],2)],1)}),[],!1,null,"5cdcf383",null);n.default=c.exports}}]);