import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastController } from '@ionic/angular';
import { PostProvider } from '../../providers/post-provider';
@Component({
 selector: 'app-tab2',
 templateUrl: 'tab2.page.html',
 styleUrls: ['tab2.page.scss']
})
export class Tab2Page implements OnInit {
 nama: string = '';
 nim: string = '';
 tgl_lahir: string = '';
 statuss: string = '';
 email: string = '';
 nomorwa: string = '';
 favoritegirlboy: string = '';
 jenis_kelamin: string = '';
 constructor(
 private router: Router,
 public toastController: ToastController,
 private postPvdr: PostProvider,
 ) {

 }
 ngOnInit() {
 }
 async addRegister() {
 if (this.nama == '') {
 const toast = await this.toastController.create({
 message: 'Nama lengkap harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.nim == '') {
 const toast = await this.toastController.create({
 message: 'Nim harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.tgl_lahir == '') {
 const toast = await this.toastController.create({
 message: 'tanggal lahir harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.statuss == '') {
 const toast = await this.toastController.create({
 message: 'Statuss kelamin harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.email == '') {
 const toast = await this.toastController.create({
 message: 'Email harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.nomorwa == '') {
 const toast = await this.toastController.create({
 message: 'No HP/WA harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.favoritegirlboy == '') {
 const toast = await this.toastController.create({
 message: 'Favorite Girl Boy harus di isi',
 duration: 2000
 });
 toast.present();
 } else if (this.jenis_kelamin == '') {
 const toast = await this.toastController.create({
  message: 'Jenis Kelamin harus di isi',
 duration: 2000
 });
 toast.present();
 } else {
 let body = {
 nama: this.nama,
 nim: this.nim,
 tgl_lahir: this.tgl_lahir,
 statuss: this.statuss,
 email: this.email,
 nomorwa: this.nomorwa,
 favoritegirlboy: this.favoritegirlboy,
 jenis_kelamin: this.jenis_kelamin,
 aksi: 'add_register'
 };
 this.postPvdr.postData(body, 'action.php').subscribe(async data => {
 var alertpesan = data.msg;
 if (data.success) {
 this.router.navigate(['/tab4']);
 const toast = await this.toastController.create({
 message: 'Selamat! Registrasi Pendaftaran Sukses.',
 duration: 2000
 });
 toast.present();
 } else {
 const toast = await this.toastController.create({
 message: alertpesan,
 duration: 2000
 });
}
});
}
}
}