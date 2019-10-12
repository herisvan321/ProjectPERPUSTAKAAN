
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import $ from 'jquery';
window.$ = window.jQuery = $;


Vue.use(VueRouter);



const Index = require('./pages/index.vue').default
const Setting = require('./pages/akun.vue').default
const Euser = require('./pages/entry/user.vue').default
const Ebuku = require('./pages/entry/buku.vue').default
const Epenerbit = require('./pages/entry/penerbit.vue').default
const Ekategori = require('./pages/entry/kategori.vue').default
const PminjamanBukuSiswa = require('./pages/pengolahan/siswa/peminjaman.vue').default
const RiwayatPeminjaman = require('./pages/pengolahan/siswa/riwayat.vue').default
const PinjamBuku = require('./pages/pengolahan/pjbuku.vue').default
const PengembalianBuku = require('./pages/pengolahan/pengembuku.vue').default
const LaporanBuku = require('./pages/laporan/buku.vue').default
const LaporanPenerbit = require('./pages/laporan/penerbit.vue').default
const LaporanSiswa = require('./pages/laporan/siswa.vue').default
const LaporanUser = require('./pages/laporan/user.vue').default
const LaporanPeminjamanBuku = require('./pages/laporan/peminjaman.vue').default





const routes = [
    {
        path : '/',
        component : Index,
    },
    {
        path : '/entry/user',
        component : Euser,
    },
    {
        path : '/entry/buku',
        component : Ebuku,
    },
    {
        path : '/entry/penerbit',
        component : Epenerbit,
    },
    {
        path : '/entry/kategori',
        component : Ekategori,
    },
    {
        path : '/peminjaman/buku/siswa',
        component : PminjamanBukuSiswa,
    },
    {
        path : '/riwayat/buku/siswa',
        component : RiwayatPeminjaman,
    },
    {
        path : '/peminjaman/buku',
        component : PinjamBuku,
    },
    {
        path : '/pengembalian/buku',
        component : PengembalianBuku,
    },
    {
        path : '/laporan/buku',
        component : LaporanBuku,
    },
    {
        path : '/laporan/penerbit',
        component : LaporanPenerbit,
    },
    {
        path : '/laporan/siswa',
        component : LaporanSiswa,
    },
    {
        path : '/laporan/user',
        component : LaporanUser,
    },
    {
        path : '/laporan/peminjaman',
        component : LaporanPeminjamanBuku,
    },
    {
        path : '/setting/akun',
        component : Setting,
        name : 'akun',
    },
]

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('tambahdatabuku', require('./pages/modal/tambahbuku.vue').default);
Vue.component('editbuku', require('./pages/modal/editbuku.vue').default);
Vue.component('pinjambukusiswa', require('./pages/modal/pinjambukusiswa.vue').default);
Vue.component('editkategori', require('./pages/modal/editkategori.vue').default);
Vue.component('editpenerbit', require('./pages/modal/editpenerbit.vue').default);
Vue.component('edituser', require('./pages/modal/edituser.vue').default);
Vue.component('biodatasiswa', require('./pages/modal/biodatasiswa.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes
});

const app = new Vue({
    router
}).$mount('#app');


