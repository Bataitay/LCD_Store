import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from '../auth.service';
import { User } from '../shop';
import { OrderService } from '../service/order.service';
import { ShopService } from '../shop.service';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  categories: any[] = []
  currentUser: any;
  token: any;
  userData: any;
  listCart: any;
  cartSubtotal: number = 0;
  constructor(private shopService: ShopService,
    private authService: AuthService,
    private route: ActivatedRoute,
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
}
