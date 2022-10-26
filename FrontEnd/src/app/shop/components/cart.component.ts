import { Component, OnInit } from '@angular/core';
import { OrderService } from '../service/order.service';

@Component({
  selector: 'app-cart',
  templateUrl: '../templates/cart.component.html',
})
export class CartComponent implements OnInit {
    listCart: any;
    cartSubtotal: number = 0;
    constructor(private orderService: OrderService) { }


  ngOnInit(): void {
    this.getAllCart();
  }

    getAllCart() {
        this.orderService.getAllCart().subscribe(res => {
            this.listCart = res;
            this.cartSubtotal = 0;
            for(let cart of this.listCart){
                this.cartSubtotal += cart.price * cart.quantity;
            }
        });
    }
    updateQuantity(id: any, quantity: any){
        this.orderService.updateQuantity(id, quantity).subscribe(res => {
            this.getAllCart();
        });
    }
    deleteCart(id: any){
        this.orderService.deleteCart(id).subscribe(res => {
            this.getAllCart();
        });
    }
}
