import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from '../auth.service';
import { User } from '../shop';
import { OrderService } from '../service/order.service';
import { ShopService } from '../shop.service';
import { environment } from 'src/environments/environment';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  categories: any[] = [];
  url: string = environment.url;
  currentUser: any;
  token: any;
  userData: any;
  listCart: any;
  cartSubtotal: number = 0;
  products: any;
  constructor(private shopService: ShopService,
    private authService: AuthService,
    private _Router: Router,
    private orderService: OrderService
  ) {
    this.authService.user.subscribe(user => {
      this.currentUser = user
      this.currentUser = this.currentUser.email;
    });
  }

  ngOnInit(): void {
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
    });
    this.token = localStorage.getItem('currentUser');
    this.getAllCart();
  }
  logout() {
    this.authService.logout();
    this.token = true;
  }
  getAllCart() {
    this.orderService.getAllCart().subscribe(res => {
      this.listCart = res;
      this.cartSubtotal = 0;
      for (let cart of this.listCart) {
        this.cartSubtotal += cart.price * cart.quantity;
      }
    });
  }
  deleteCart(id: any) {
    this.orderService.deleteCart(id).subscribe(res => {
      this.getAllCart();
    });
  }
  handdleSearch(name: any){
    const keywork = name.target.value;
  const search = this.shopService.searchProductList(keywork).then(res => {
    this.products = res;
  })
  }
  reloadCurrentPage(id:any){
    this._Router.navigate(['/product-detail/'+id]);
  }
}
